<?php

namespace App\Console\Commands;

use App\Actions\Activities\ActivityModelDeleteStore;
use App\Actions\Activities\ActivityModelIndexStore;
use App\Actions\Activities\ActivityModelShowStore;
use App\Actions\Activities\ActivityModelStoreStore;
use App\Actions\Activities\ActivityModelUpdateStore;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;
use function Laravel\Prompts\info;
use function Laravel\Prompts\error;

class MakeIsapModelActivity extends Command
{
    private $modelName = '';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:isap-model-activity 
                            {name : The name of the model}
                            {--all : Implement all methods}
                            {--index : Implement index method}
                            {--show : Implement show method}
                            {--store : Implement store method}
                            {--update : Implement update method}
                            {--delete : Implement delete method}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make activity with some options';

    protected $possibleActionOptions = ['all', 'index', 'show', 'store', 'update', 'delete'];
    protected $selectedActionOptions = [];
    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach ($this->possibleActionOptions as $possibleAction){
            if ($this->options()[$possibleAction]){
                $this->selectedActionOptions[] = $possibleAction;
            }
        }

        if (count($this->selectedActionOptions) === 0) {
            $this->selectedActionOptions = multiselect(
                label: 'Please select at least one option',
                options: ['all', 'index', 'show', 'store', 'update', 'delete'],
            );
        }
        if (in_array('all', $this->selectedActionOptions)) {
            $this->selectedActionOptions = $this->possibleActionOptions;
        }
        if (in_array('index', $this->selectedActionOptions)) {
            if (app(ActivityModelIndexStore::class)->execute(['name' => $this->argument('name')])) {
                info('Index activity added succesfully.');
            } else {
                error('An error happend when adding index activity');
            }
        }
        if (in_array('show', $this->selectedActionOptions)) {
            if (app(ActivityModelShowStore::class)->execute(['name' => $this->argument('name')])) {
                info('Show activity added succesfully.');
            } else {
                error('An error happend when adding show activity');
            }
        }
        if (in_array('store', $this->selectedActionOptions)) {
            if (app(ActivityModelStoreStore::class)->execute(['name' => $this->argument('name')])) {
                info('Store activity added succesfully.');
            } else {
                error('An error happend when adding store activity');
            }
        }
        if (in_array('update', $this->selectedActionOptions)) {
            if (app(ActivityModelUpdateStore::class)->execute(['name' => $this->argument('name')])) {
                info('Update activity added succesfully.');
            } else {
                error('An error happend when adding update activity');
            }
        }
        if (in_array('delete', $this->selectedActionOptions)) {
            if (app(ActivityModelDeleteStore::class)->execute(['name' => $this->argument('name')])) {
                info('Delete activity added succesfully.');
            } else {
                error('An error happend when adding delete activity');
            }
        }
    }
}
