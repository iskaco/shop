<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateEntityFromMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:entity-from-migration {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate code for an entity based on its migration fields.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $entityName = $this->argument('name');
        $migrationFile = $this->findMigrationFile($entityName);

        if (!$migrationFile) {
            $this->error("Migration file for {$entityName} not found.");
            return Command::FAILURE;
        }

        $fields = $this->extractFieldsFromMigration($migrationFile);

        if (empty($fields)) {
            $this->error("No fields found in the migration file for {$entityName}.");
            return Command::FAILURE;
        }

        $this->generateModel($entityName, $fields);
        $this->generateController($entityName);
        $this->generateResource($entityName, $fields);

        $this->info("Code for {$entityName} generated successfully.");
        return Command::SUCCESS;
    }

    /**
     * Find the migration file for the given entity.
     */
    protected function findMigrationFile($entityName)
    {
        $migrationPath = database_path('migrations');
        $files = File::files($migrationPath);
        foreach ($files as $file) {
            if (Str::contains($file->getFilename(), 'create_' . Str::plural(Str::snake($entityName)) . '_table')) {
                return $file->getPathname();
            }
        }

        return null;
    }

    /**
     * Extract fields from the migration file.
     */
    protected function extractFieldsFromMigration($migrationFile)
    {
        $content = File::get($migrationFile);
        preg_match_all('/\$table->(\w+)\(\'(\w+)\'/', $content, $matches);

        $fields = [];
        foreach ($matches[2] as $index => $fieldName) {
            $fields[] = [
                'type' => $matches[1][$index],
                'name' => $fieldName,
            ];
        }

        return $fields;
    }

    /**
     * Generate the model file.
     */
    protected function generateModel($entityName, $fields)
    {
        $modelPath = app_path("Models/{$entityName}.php");

        $fillable = array_map(fn($field) => "'{$field['name']}'", $fields);
        $fillableString = implode(', ', $fillable);

        if (File::exists($modelPath)) {
            // If the model exists, update the $fillable property
            $content = File::get($modelPath);

            if (preg_match('/protected \$fillable = \[(.*?)\];/s', $content, $matches)) {
                $existingFillable = array_map('trim', explode(',', $matches[1]));
                $newFillable = array_unique(array_merge($existingFillable, $fillable));
                $newFillableString = implode(', ', $newFillable);

                $updatedContent = preg_replace(
                    '/protected \$fillable = \[(.*?)\];/s',
                    "protected \$fillable = [{$newFillableString}];",
                    $content
                );

                File::put($modelPath, $updatedContent);
                $this->info("Model {$entityName} updated successfully.");
            } else {
                $this->error("Unable to find \$fillable property in the existing model.");
            }
        } else {
            // If the model does not exist, create it
            $template = <<<EOT
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class {$entityName} extends Model
{
    use HasFactory;

    protected \$fillable = [{$fillableString}];
}
EOT;

            File::put($modelPath, $template);
            $this->info("Model {$entityName} created successfully.");
        }
    }
    /**
     * Generate the controller file.
     */
    protected function generateController($entityName)
    {
        $controllerPath = app_path("Http/Controllers/Admins/{$entityName}Controller.php");

        $templateMethods = [
            'index' => <<<EOT
    public function index()
    {
        return \$this->makeInertiaTableResponse({$entityName}::class, {$entityName}::query());
    }
EOT,
            'create' => <<<EOT
    public function create()
    {
        return \$this->makeInertiaFormResponse({$entityName}::class, [], ActionType::STORE);
    }
EOT,
            'store' => <<<EOT
    public function store({$entityName}StoreRequest \$request, {$entityName}Store \$action)
    {
        try {
            \$entity = \$action->execute(\$request->validated());
            if (\$entity) {
                toast_success(__('messages.{$entityName}.store.ok'));

                return \$this->makeInertiaTableResponse({$entityName}::class, {$entityName}::query());
            }
        } catch (\Throwable \$th) {
            throw \$th;
        }
    }
EOT,
            'update' => <<<EOT
    public function update(string \$id, {$entityName}UpdateRequest \$request, {$entityName}Update \$action)
    {
        try {
            \$entity = \$action->execute(\$id, \$request->validated());
            if (\$entity) {
                toast_success(__('messages.{$entityName}.update.ok'));

                return \$this->makeInertiaTableResponse({$entityName}::class, {$entityName}::query());
            }
        } catch (\Throwable \$th) {
            toast_error(__('messages.{$entityName}.update.error') . \$th->getMessage());
        }
    }
EOT,
            'show' => <<<EOT
    public function show(string \$id)
    {
        \$entity = {$entityName}::with('roles')->findOrFail(\$id);
        \$roles = collect(\$entity->roles->toArray())->map(function (\$role) {
            \$role['name'] = Role::find(\$role['id'])->translated_name;

            return \$role;
        });
        \$entity->setRelation('roles', \$roles);

        return \$this->makeInertiaFormResponse({$entityName}::class, \$entity, ActionType::SHOW);
    }
EOT,
            'edit' => <<<EOT
    public function edit(string \$id)
    {
        try {
            \$entity = {$entityName}::with('roles')->findOrFail(\$id);
            \$roles = collect(\$entity->roles->toArray())->map(function (\$role) {
                \$role['name'] = Role::find(\$role['id'])->translated_name;

                return \$role;
            });
            \$entity->setRelation('roles', \$roles);

            return \$this->makeInertiaFormResponse({$entityName}::class, \$entity, ActionType::UPDATE);
        } catch (\Throwable \$th) {
            toast_error(__('messages.{$entityName}.update.error') . \$th->getMessage());
        }
    }
EOT,
            'destroy' => <<<EOT
    public function destroy(string \$id)
    {
        try {
            \$entity = {$entityName}::findOrFail(\$id);
            \$entity->delete();
            toast_success(__('messages.{$entityName}.destroy.ok'));

            return redirect()->back();
        } catch (\Throwable \$th) {
            toast_error(__('messages.{$entityName}.destroy.error') . \$th->getMessage());
        }
    }
EOT,
            'authenticate' => <<<EOT
    public function authenticate({$entityName}LoginRequest \$request)
    {
        \$request->authenticate();
        \$request->session()->regenerate();
        toast_success(__('messages.{$entityName}.login.ok'));

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }
EOT,
            'logout' => <<<EOT
    public function logout()
    {
        auth('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout successfully');

        return redirect()->intended(route('admin.login'));
    }
EOT,
        ];

        if (File::exists($controllerPath)) {
            // If the controller exists, update it
            $content = File::get($controllerPath);

            foreach ($templateMethods as $methodName => $methodCode) {
                if (!Str::contains($content, "public function {$methodName}")) {
                    // Append the method if it doesn't exist
                    $content = preg_replace('/}\s*$/', "\n\n{$methodCode}\n}", $content);
                    $this->info("Added {$methodName} method to {$entityName}Controller.");
                }
            }

            File::put($controllerPath, $content);
            $this->info("Controller {$entityName}Controller updated successfully.");
        } else {
            // If the controller does not exist, create it
            $template = <<<EOT
<?php

namespace App\Http\Controllers\Admins;

use App\Actions\Admins\\{$entityName}Store;
use App\Actions\Admins\\{$entityName}Update;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\\{$entityName}StoreRequest;
use App\Http\Requests\Admins\\{$entityName}UpdateRequest;
use App\Http\Requests\Auth\\{$entityName}LoginRequest;
use App\Isap\Actions\ActionType;
use App\Models\\{$entityName};
use App\Models\Role;
use Illuminate\Support\Facades\Session;

class {$entityName}Controller extends Controller
{
    {$templateMethods['index']}

    {$templateMethods['create']}

    {$templateMethods['store']}

    {$templateMethods['update']}

    {$templateMethods['show']}

    {$templateMethods['edit']}

    {$templateMethods['destroy']}

    {$templateMethods['authenticate']}

    {$templateMethods['logout']}
}
EOT;

            File::put($controllerPath, $template);
            $this->info("Controller {$entityName}Controller created successfully.");
        }
    }
    /**
     * Generate the resource file.
     */
    protected function generateResource($entityName, $fields)
    {
        $resourcePath = app_path("Http/Resources/{$entityName}Resource.php");

        if (File::exists($resourcePath)) {
            $this->error("Resource {$entityName}Resource already exists.");
            return;
        }

        $fieldsMapping = array_map(fn($field) => "'{$field['name']}' => \$this->{$field['name']}", $fields);
        $fieldsString = implode(",\n            ", $fieldsMapping);

        $template = <<<EOT
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class {$entityName}Resource extends JsonResource
{
    public function toArray(\$request)
    {
        return [
            {$fieldsString}
        ];
    }
}
EOT;

        File::put($resourcePath, $template);
        $this->info("Resource {$entityName}Resource created successfully.");
    }
}
