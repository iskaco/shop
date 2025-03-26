<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Models\Permission;
use FilesystemIterator;
use Illuminate\Console\Command;

use function Laravel\Prompts\select;
use Illuminate\Support\Str;

class RemoveIsapResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'isap:remove-resource
                            {name : The name of the model or resource}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove files and data of a resource ';

    private $data = [];
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->data['name'] = $this->argument('name');
        $this->data['plural_name'] = Str::plural($this->data['name']);
        $this->data['confirmation'] = select(
            label: "Are you sure to remove {$this->data['name']} resourse?",
            options: ['Yes', 'No'],
            default: 'No'
        );
        if ($this->data['confirmation'] === 'No') {
            $this->info("Command Canceled By User!");
            return;
        }
        $this->data['option'] = select(
            label: 'What do you want to remove?',
            options: [
                'all' => "all - All thing related to {$this->data['name']} resource",
                'activities' => "activities - Just activities and related data"
            ]
        );
        $this->startRemoving();
    }

    private function startRemoving()
    {

        if ($this->data['option'] === 'all') {
            $this->info("Start Removing Files and Folders...");
            $this->removeActions();
            $this->removeRequests();
            $this->removeModelResource();
            $this->removeController();
            $this->removeModel();
            $this->removeMigration();
        }
        $this->info("Start Removing Activities Data...");
        $this->removeActivityData();
        $this->info("{$this->data['name']}Resource Removed Successfully!");
    }

    private function removeActivityData()
    {
        $activities = Activity::where('action', "LIKE", "%{$this->data['name']}Controller%")->get();
        foreach ($activities as $activity) {
            $permision = $activity?->permission;
            $activity?->delete();
            $permision?->delete();
        }
        $this->info("{$this->data['name']} Activities Data Remove Successfully!");
    }

    private function removeActions()
    {
        $actionsPath = app_path("Actions/{$this->data['plural_name']}");
        if (!$this->deleteDirectory($actionsPath))
            $this->error("Error ocured in removing {$this->data['name']} Actions!");
        else
            $this->info("{$this->data['name']} Actions Remove Successfully!");
    }

    private function removeRequests()
    {
        $request_path = app_path("Http/Requests/Admins/{$this->data['plural_name']}");
        if (!$this->deleteDirectory($request_path))
            $this->error("Error ocured in removing {$this->data['name']} Requests!");
        else
            $this->info("{$this->data['name']} Requests Remove Successfully!");
    }

    private function removeModelResource()
    {
        $modelResource = app_path("Isap/Resources/{$this->data['name']}Resource.php");
        if (!$this->deleteFile($modelResource))
            $this->error("Error ocured in removing {$this->data['name']}Resource!");
        else
            $this->info("{$this->data['name']}Resource Remove Successfully!");
    }

    private function removeController()
    {
        $controllerPath = app_path("Http/Controllers/Admins/{$this->data['name']}Controller.php");
        if (!$this->deleteFile($controllerPath))
            $this->error("Error ocured in removing {$this->data['name']}Controller!");
        else
            $this->info("{$this->data['name']}Controller Remove Successfully!");
    }

    private function removeModel()
    {
        $modelPath = app_path("Models/{$this->data['name']}.php");
        if (!$this->deleteFile($modelPath))
            $this->error("Error ocured in removing {$this->data['name']} Model!");
        else
            $this->info("{$this->data['name']} Model Remove Successfully!");
    }

    private function  removeMigration()
    {
        $migrationsPath = database_path('migrations');
        $table_name = Str::plural(Str::lower($this->data['name']));        // Define the partial filename to search for
        $partialName = "*-create-{$table_name}-table.php";

        // Use glob() to find files matching the pattern
        $files = glob($migrationsPath . '/' . $partialName);

        // Check if any files were found
        if (!empty($files)) {
            // Delete the first matching file (assuming only one file matches)
            unlink($files[0]);
            $this->info("{$this->data['name']} Migration Remove Successfully!");
            return;
        }

        // If no file is found
        $this->error("Error ocured in removing {$this->data['name']} Migration!");
    }

    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        $files = new FilesystemIterator($dir);
        foreach ($files as $file) {
            if ($file->isDir()) {
                $this->deleteDirectory($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }
        return rmdir($dir);
    }

    private function deleteFile($file)
    {
        if (file_exists($file)) {
            unlink($file);
            return true;
        }
        return false;
    }
}
