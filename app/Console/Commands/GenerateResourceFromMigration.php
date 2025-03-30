<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateResourceFromMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:resource-from-migration {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generates resource on an model in Http\Resources path.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $entityName = $this->argument('name');
        $migrationFile = $this->findMigrationFile($entityName);

        if (! $migrationFile) {
            $this->error("Migration file for {$entityName} not found.");

            return Command::FAILURE;
        }

        $fields = $this->extractFieldsFromMigration($migrationFile);

        if (empty($fields)) {
            $this->error("No fields found in the migration file for {$entityName}.");

            return Command::FAILURE;
        }

        $this->generateResource($entityName, $fields);

        $this->info("Resorce Code for {$entityName} generated successfully.");

        return Command::SUCCESS;

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

        $fieldsMapping = array_map(fn ($field) => "'{$field['name']}' => \$this->{$field['name']}", $fields);
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
