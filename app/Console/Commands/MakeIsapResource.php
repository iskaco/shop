<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class MakeIsapResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:isap-resource {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command create some file like Model, Controller, Actions, Requests and ... related to a iskaco  smart admin panel(ISAP) entity.';

    protected $actions = [['action' => 'store', 'actionName' => 'Store'], ['action' => 'update', 'actionName' => 'Update'], ['action' => 'index', 'actionName' => 'Index'], ['action' => 'show', 'actionName' => 'Show'], ['action' => 'destroy', 'actionName' => 'Destroy']];
    protected $request_actions = [['action' => 'store', 'actionName' => 'Store'], ['action' => 'update', 'actionName' => 'Update'], ['action' => 'destroy', 'actionName' => 'Destroy']];
    private $pluralModelName = '';
    private $lowerPluralModelName = '';

    private $modelName = '';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->modelName = Str::singular($name);
        $this->pluralModelName = Str::plural($this->modelName);
        $this->lowerPluralModelName = Str::lower($this->pluralModelName);

        $this->createModel();
        $this->createController();
        $this->createModelResource();

        $this->createActions();
        $this->createRequests();

        $this->createMigration();

        $this->createActivities();

        $this->info("Panel model,controller,actions,requests,migration and resource created successfully.");
        return Command::SUCCESS;
    }

    protected function createController()
    {
        $controllerPath = app_path("Http/Controllers/Admins/{$this->modelName}Controller.php");
        // Create Controller (Example)
        if (!file_exists($controllerPath)) {
            $this->createFileWithParams(
                $controllerPath,
                $this->getStub('controller'),
                [
                    ['src' => '{{pluralModelName}}', 'val' => $this->pluralModelName],
                    ['src' => '{{modelName}}', 'val' => $this->modelName]
                ]
            );
        } else {
            $this->error("Controller {$this->modelName}Controller already exists.");
            return Command::FAILURE;
        }
    }

    protected function createModel()
    {

        $modelPath = app_path("Models/{$this->modelName}.php");
        // Create Model
        if (!file_exists($modelPath)) {
            $this->createFileWithParams(
                $modelPath,
                $this->getStub('model'),
                [
                    ['src' => '{{pluralModelName}}', 'val' => $this->pluralModelName],
                    ['src' => '{{modelName}}', 'val' => $this->modelName]
                ]
            );
        } else {
            $this->error("Model {$this->modelName} already exists.");
            return Command::FAILURE;
        }
    }

    protected function createActions()
    {
        foreach ($this->actions as $key => $action) {
            $actionName = $action['actionName'];
            $actionPath = app_path("Actions/{$this->pluralModelName}/{$this->modelName}{$actionName}.php");
            $this->createFileWithParams(
                $actionPath,
                $this->getStub('action'),
                [
                    ['src' => '{{pluralModelName}}', 'val' => $this->pluralModelName],
                    ['src' => '{{modelName}}', 'val' => $this->modelName],
                    ['src' => '{{actionName}}', 'val' => $actionName]
                ]
            );
        }
    }

    protected function createRequests()
    {
        foreach ($this->request_actions as $request) {
            $actionName = $request['actionName'];
            $request_path = app_path("Http/Requests/Admins/{$this->pluralModelName}/{$this->modelName}{$actionName}Request.php");
            $this->createFileWithParams(
                $request_path,
                $this->getStub('request'),
                [
                    ['src' => '{{pluralModelName}}', 'val' => $this->pluralModelName],
                    ['src' => '{{modelName}}', 'val' => $this->modelName],
                    ['src' => '{{actionName}}', 'val' => $actionName],
                    ['src' => '{{thisAction}}', 'val' => Str::lower($this->pluralModelName) . '.' . $request['action']],
                ]
            );
        }
    }

    protected function createModelResource()
    {
        $modelResourcePath = app_path("Isap/Resources/{$this->modelName}Resource.php");
        // Create Model
        if (!file_exists($modelResourcePath)) {
            $this->createFileWithParams(
                $modelResourcePath,
                $this->getStub('model_resource'),
                [
                    ['src' => '{{lowerPluralModelName}}', 'val' => $this->lowerPluralModelName],
                    ['src' => '{{modelName}}', 'val' => $this->modelName]
                ]
            );
        } else {
            $this->error("Model Resource {$this->modelName}Resource already exists.");
            return Command::FAILURE;
        }
    }

    protected function createMigration()
    {
        $now = Carbon::now()->format('Y_m_d_his');
        $tableName = Str::lower($this->pluralModelName);
        $migrationPath = database_path("migrations/{$now}-create-{$tableName}-table.php");
        $this->createFileWithParams(
            $migrationPath,
            $this->getStub('migration'),
            [['src' => '{{tableName}}', 'val' => $tableName]]
        );
    }

    protected function createFileWithParams($path, $template, $params = [])
    {
        foreach ($params as $key => $param) {
            $template = str_replace($param['src'], $param['val'], $template);
        }
        $this->createDirectory($path);
        file_put_contents($path, $template);
        $this->info("Created  -> {$path} successfully! ");
    }

    protected function createFile($path, $template, $name)
    {
        $template = str_replace('{{modelName}}', $name, $template);
        file_put_contents($path, $template);
    }

    protected function createDirectory($path)
    {
        // Extract directory path
        $directory = dirname($path);
        // Create directory if it doesn't exist (recursive creation)
        if (!is_dir($directory)) {

            if (!mkdir($directory, 0755, true)) { // 0755 is the permission; adjust as needed. 'true' enables recursive creation.
                die("Error creating directory: " . $directory);
            }
        }
    }

    public function createActivities()
    {
        $this->call(
            'make:isap-model-activity',
            [
                'name' => $this->modelName,
                '--all' => true
            ]
        );
    }

    protected function getStub($type)
    {
        // Path to your stub files (create these in resources/stubs)
        $stubPath = resource_path("stubs/{$type}.stub");

        if (!file_exists($stubPath)) {
            $this->error("Stub file not found: {$stubPath}");
            return '';
        }
        return file_get_contents($stubPath);
    }
}
