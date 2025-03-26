<?php

namespace App\Console\Commands;

use App\Actions\Activities\ActivityStore;
use App\Isap\Framework\HttpConstants;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\error;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class MakeIsapAcitivity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:isap-activity 
                            {uri? : Uri of activity}
                            {method? : Http method}
                            {action? : ControllerFullName@functionName}
                            {title? : Title for users}
                            {description? : Description for users}
                            {is_active? : Is active}
                            {is_menu? : Is menu}
                            {parent_id? : Parent Id}
                            {middleware?* : Array of middlewares}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create custom activity';

    private $data = [];
    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!($this->data['uri'] = $this->argument('uri'))) {
            $this->data['uri'] = text(
                label: 'Please enter the uri:',
                placeholder: 'E.g. /admin/users/{user_id}/edit',
                hint: 'This is the same route uri.'
            );
        }
        if (!($this->data['method'] = $this->argument('method'))) {
            $this->data['method'] = select(
                label: 'Please enter the method:',
                options: HttpConstants::METHODS,
                default: Request::METHOD_GET
            );
        }
        if (!($this->data['action'] = $this->argument('action'))) {
            $this->data['action'] = text(
                label: 'Please enter the action:',
                placeholder: 'E.g \\App\\Http\\Controllers\\UserContoller@edit',
                hint: 'This the same function name in route.'
            );
        }
        if (!($this->data['title'] = $this->argument('title'))) {
            $this->data['title'] = text(
                label: 'Please enter the title:',
                placeholder: 'E.g Edit Profile',
                hint: 'This string will be shown to user in menu'
            );
        }
        if (!($this->data['description'] = $this->argument('description'))) {
            $this->data['description'] = text(
                label: 'Please enter the description:',
                placeholder: 'E.g You can edit your profile here',
                hint: 'This string will be shown to user in a tooltip'
            );
        }
        if (!($this->data['is_active'] = $this->argument('is_active'))) {
            $this->data['is_active'] = confirm(
                label: 'Is this activity will be active?',
                yes: 'Yes, it\'s active',
                no: 'No, it\'s not active'
            );
        }
        if (!($this->data['is_menu'] = $this->argument('is_menu'))) {
            $this->data['is_menu'] = confirm(
                label: 'Is this activity will be menu?',
                yes: 'Yes, it\'s a menu',
                no: 'No, it\'s not a menu'
            );
        }
        if (!($this->data['parent_id'] = $this->argument('parent_id')) && $this->data['is_menu']) {
            $this->data['parent_id'] = text(
                label: 'Please enter parent id.',
                placeholder: 'E.g 0 for parents and an id for others',
                default: '0'
            );
        }
        if (!($this->data['middleware'] = $this->argument('middleware'))) {
            $this->data['middleware'] = text(label: 'Please enter the middleware:');
        }

        app(ActivityStore::class)->execute($this->data);
    }
    
}
