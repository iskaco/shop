<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class MakeIsapResource extends Command
{
    protected $signature = 'make:isap-resource {name} {--json= : Path to JSON definition file}';

    protected $description = 'Create ISAP resource files from a JSON definition or basic template.';

    protected $actions = [
        ['action' => 'store', 'actionName' => 'Store'],
        ['action' => 'update', 'actionName' => 'Update'],
        ['action' => 'index', 'actionName' => 'Index'],
        ['action' => 'show', 'actionName' => 'Show'],
        ['action' => 'destroy', 'actionName' => 'Destroy'],
    ];

    protected $request_actions = [
        ['action' => 'store', 'actionName' => 'Store'],
        ['action' => 'update', 'actionName' => 'Update'],
        ['action' => 'destroy', 'actionName' => 'Destroy'],
    ];

    private $pluralModelName = '';

    private $lowerPluralModelName = '';

    private $modelName = '';

    private $resourceDefinition = null;

    private $availableLocales = [];

    public function handle()
    {
        $name = $this->argument('name');
        $jsonPath = $this->option('json');

        $this->modelName = Str::singular($name);
        $this->pluralModelName = Str::plural($this->modelName);
        $this->lowerPluralModelName = Str::lower($this->pluralModelName);
        $this->availableLocales = config('app.available_locales', ['en']);

        if ($jsonPath) {
            if (! file_exists($jsonPath)) {
                $this->error("JSON definition file not found: {$jsonPath}");

                return Command::FAILURE;
            }

            $jsonContent = file_get_contents($jsonPath);
            $this->resourceDefinition = json_decode($jsonContent, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->error('Invalid JSON file: '.json_last_error_msg());

                return Command::FAILURE;
            }

            if (! isset($this->resourceDefinition['name']) || ! isset($this->resourceDefinition['fields'])) {
                $this->error("JSON must contain 'name' and 'fields' properties");

                return Command::FAILURE;
            }
        }

        $this->createModel();
        $this->createController();
        $this->createModelResource();
        $this->createActions();
        $this->createRequests();
        $this->createMigration();
        $this->createActivities();

        $this->info('Panel model, controller, actions, requests, migration and resource created successfully.');

        return Command::SUCCESS;
    }

    protected function createModel()
    {
        $modelPath = app_path("Models/{$this->modelName}.php");

        if (file_exists($modelPath)) {
            $this->error("Model {$this->modelName} already exists.");

            return Command::FAILURE;
        }

        $fillable = [];
        $casts = [];
        $translatable = [];
        $appends = [];
        $translationAccessors = [];

        if ($this->resourceDefinition) {
            foreach ($this->resourceDefinition['fields'] as $field) {
                $fieldName = $field['name'];

                if (isset($field['translatable']) && $field['translatable']) {
                    // Add base field name to translatable array
                    $translatable[] = $fieldName;
                    // Add translated field names to fillable
                    foreach ($this->availableLocales as $locale) {
                        $fillable[] = "{$fieldName}_{$locale}";
                    }
                    // Add translated field to appends
                    $appends[] = "{$fieldName}_translated";
                    // Add translation accessor
                    $translationAccessors[] = $this->createTranslationAccessor($fieldName);
                } else {
                    $fillable[] = $fieldName;
                }

                if (isset($field['type'])) {
                    switch ($field['type']) {
                        case 'boolean':
                            $casts[$fieldName] = 'boolean';
                            break;
                        case 'integer':
                            $casts[$fieldName] = 'integer';
                            break;
                        case 'decimal':
                            $casts[$fieldName] = 'decimal:2';
                            break;
                        case 'json':
                            $casts[$fieldName] = 'array';
                            break;
                    }
                }
            }
        }

        $fillableStr = "['".implode("', '", $fillable)."']";
        $castsStr = "[\n            '".implode("',\n            '", array_map(fn ($k, $v) => "$k' => '$v", array_keys($casts), $casts))."'\n        ]";
        $translatableStr = "['".implode("', '", $translatable)."']";
        $appendsStr = "['".implode("', '", $appends)."']";
        $translationAccessorsStr = implode("\n\n    ", $translationAccessors);

        $this->createFileWithParams(
            $modelPath,
            $this->getStub('model'),
            [
                ['src' => '{{pluralModelName}}', 'val' => $this->pluralModelName],
                ['src' => '{{modelName}}', 'val' => $this->modelName],
                ['src' => '{{fillable}}', 'val' => $fillableStr],
                ['src' => '{{casts}}', 'val' => $castsStr],
                ['src' => '{{translatable}}', 'val' => $translatableStr],
                ['src' => '{{appends}}', 'val' => $appendsStr],
                ['src' => '{{translationAccessors}}', 'val' => $translationAccessorsStr],
            ]
        );
    }

    protected function createTranslationAccessor($fieldName)
    {
        $accessor = "public function get{$fieldName}TranslatedAttribute()\n    {\n";
        $accessor .= "        \$locale = app()->getLocale();\n";
        $accessor .= "        \$fallbackLocale = config('app.fallback_locale');\n\n";
        $accessor .= "        // Try to get the translation in the current locale\n";
        $accessor .= "        \$translation = \$this->getTranslation('{$fieldName}', \$locale);\n\n";
        $accessor .= "        // If no translation exists in the current locale, try the fallback locale\n";
        $accessor .= "        if (empty(\$translation)) {\n";
        $accessor .= "            \$translation = \$this->getTranslation('{$fieldName}', \$fallbackLocale);\n";
        $accessor .= "        }\n\n";
        $accessor .= "        return \$translation;\n";
        $accessor .= '    }';

        return $accessor;
    }

    protected function createMigration()
    {
        $now = Carbon::now()->format('Y_m_d_his');
        $tableName = Str::lower(Str::snake($this->pluralModelName));
        $migrationPath = database_path("migrations/{$now}_create_{$tableName}_table.php");

        $fields = [];
        if ($this->resourceDefinition) {
            foreach ($this->resourceDefinition['fields'] as $field) {
                $fieldDefinitions = $this->getMigrationFieldDefinitions($field);
                $fields = array_merge($fields, $fieldDefinitions);
            }
        }

        $fieldsStr = implode("\n            ", $fields);

        $this->createFileWithParams(
            $migrationPath,
            $this->getStub('migration'),
            [
                ['src' => '{{tableName}}', 'val' => $tableName],
                ['src' => '{{fields}}', 'val' => $fieldsStr],
            ]
        );
    }

    protected function getMigrationFieldDefinitions($field)
    {
        $name = $field['name'];
        $type = $field['type'] ?? 'string';
        $required = $field['required'] ?? false;
        $unique = $field['unique'] ?? false;
        $default = $field['default'] ?? null;
        $length = $field['length'] ?? null;
        $isTranslatable = $field['translatable'] ?? false;

        $definitions = [];

        if ($isTranslatable) {
            foreach ($this->availableLocales as $locale) {
                $fieldName = "{$name}_{$locale}";
                $definition = $this->createMigrationFieldDefinition($fieldName, $type, $required, $unique, $default, $length);
                $definitions[] = $definition;
            }
        } else {
            $definition = $this->createMigrationFieldDefinition($name, $type, $required, $unique, $default, $length);
            $definitions[] = $definition;
        }

        return $definitions;
    }

    protected function createMigrationFieldDefinition($name, $type, $required, $unique, $default, $length)
    {
        $definition = '$table->';

        switch ($type) {
            case 'string':
                $definition .= "string('{$name}'".($length ? ", {$length}" : '').')';
                break;
            case 'text':
                $definition .= "text('{$name}')";
                break;
            case 'integer':
                $definition .= "integer('{$name}')";
                break;
            case 'decimal':
                $precision = $field['precision'] ?? 8;
                $scale = $field['scale'] ?? 2;
                $definition .= "decimal('{$name}', {$precision}, {$scale})";
                break;
            case 'boolean':
                $definition .= "boolean('{$name}')";
                break;
            case 'json':
                $definition .= "json('{$name}')";
                break;
            case 'date':
                $definition .= "date('{$name}')";
                break;
            case 'datetime':
                $definition .= "dateTime('{$name}')";
                break;
            case 'timestamp':
                $definition .= "timestamp('{$name}')";
                break;
            default:
                $definition .= "string('{$name}')";
        }

        if ($required) {
            $definition .= '->nullable(false)';
        } else {
            $definition .= '->nullable()';
        }

        if ($unique) {
            $definition .= '->unique()';
        }

        if ($default !== null) {
            if (is_bool($default)) {
                $default = $default ? 'true' : 'false';
            } elseif (is_string($default)) {
                $default = "'{$default}'";
            }
            $definition .= "->default({$default})";
        }

        $definition .= ';';

        return $definition;
    }

    protected function createModelResource()
    {
        $resourcePath = app_path("Isap/Resources/{$this->modelName}Resource.php");

        if (file_exists($resourcePath)) {
            $this->error("Resource {$this->modelName}Resource already exists.");

            return Command::FAILURE;
        }

        $formSections = [];
        $tableColumns = [];
        $translatableFields = [];

        if ($this->resourceDefinition) {
            // Group fields by section
            $sections = [];
            foreach ($this->resourceDefinition['fields'] as $field) {
                $fieldName = $field['name'];
                $section = $field['section'] ?? 'general';

                if (! isset($sections[$section])) {
                    $sections[$section] = [];
                }

                if (isset($field['translatable']) && $field['translatable']) {
                    $translatableFields[] = $fieldName;
                    $sections[$section][] = $field;
                } else {
                    $sections[$section][] = $field;
                }
            }

            // Create form sections
            foreach ($sections as $sectionName => $fields) {
                $sectionFields = [];
                foreach ($fields as $field) {
                    $fieldName = $field['name'];
                    $fieldType = $field['type'] ?? 'string';
                    $isRequired = $field['required'] ?? false;
                    $isTranslatable = $field['translatable'] ?? false;

                    if ($isTranslatable) {
                        // Translatable fields are handled by createTranslatableSections
                        continue;
                    }

                    if ($fieldType === 'boolean') {
                        $sectionFields[] = "ToggleInput::make('{$fieldName}', __('resources.{$this->pluralModelName}.{$fieldName}'))";
                    } else {
                        $inputType = $this->getInputType($fieldType);
                        $validation = $isRequired ? '->isRequired()' : '';
                        $sectionFields[] = "TextInput::make('{$fieldName}', __('resources.{$this->pluralModelName}.{$fieldName}'))->{$inputType}{$validation}";
                    }
                }

                if (! empty($sectionFields)) {
                    $formSections[] = "FormSection::make('{$sectionName}', __('resources.{$this->pluralModelName}.{$sectionName}'))->children([\n                ".implode(",\n                ", $sectionFields)."\n            ])";
                }
            }

            // Add translatable sections if any
            if (! empty($translatableFields)) {
                array_unshift($formSections, "...parent::orderByLocale([\n                ...DynamicResource::createTranslatableSections('general', '{$this->pluralModelName}', ".json_encode($translatableFields).")\n            ])");
            }

            // Create table columns
            foreach ($this->resourceDefinition['fields'] as $field) {
                $fieldName = $field['name'];
                $fieldType = $field['type'] ?? 'string';
                $isTranslatable = $field['translatable'] ?? false;

                if ($isTranslatable) {
                    $tableColumns[] = "TextColumn::make('{$fieldName}_translated', __('resources.{$this->pluralModelName}.{$fieldName}'))";
                } else {
                    $columnType = $this->getColumnType($fieldType);
                    $tableColumns[] = "{$columnType}::make('{$fieldName}', __('resources.{$this->pluralModelName}.{$fieldName}'))";
                }
            }
        }

        $formSectionsStr = implode(",\n            ", $formSections);
        $tableColumnsStr = implode(",\n                ", $tableColumns);

        $this->createFileWithParams(
            $resourcePath,
            $this->getStub('model_resource'),
            [
                ['src' => '{{pluralModelName}}', 'val' => $this->pluralModelName],
                ['src' => '{{modelName}}', 'val' => $this->modelName],
                ['src' => '{{formSections}}', 'val' => $formSectionsStr],
                ['src' => '{{tableColumns}}', 'val' => $tableColumnsStr],
                ['src' => '{{resourceName}}', 'val' => Str::lower(Str::snake($this->modelName))],
            ]
        );
    }

    protected function getInputType($fieldType)
    {
        return match ($fieldType) {
            'integer' => 'isNumber()',
            'decimal' => 'isCurrency()',
            'text' => 'isTextarea()',
            'image' => 'isImage()',
            'gallery' => 'isGallery()',
            default => 'isText()',
        };
    }

    protected function getColumnType($fieldType)
    {
        return match ($fieldType) {
            'boolean' => 'ToggleColumn',
            'image' => 'ImageColumn',
            'gallery' => 'ImageColumn',
            default => 'TextColumn',
        };
    }

    protected function createController()
    {
        $controllerPath = app_path("Http/Controllers/Admins/{$this->modelName}Controller.php");
        if (! file_exists($controllerPath)) {
            $this->createFileWithParams(
                $controllerPath,
                $this->getStub('controller'),
                [
                    ['src' => '{{pluralModelName}}', 'val' => $this->pluralModelName],
                    ['src' => '{{modelName}}', 'val' => $this->modelName],
                ]
            );
        } else {
            $this->error("Controller {$this->modelName}Controller already exists.");

            return Command::FAILURE;
        }
    }

    protected function createActions()
    {
        foreach ($this->actions as $action) {
            $actionName = $action['actionName'];
            $actionPath = app_path("Actions/{$this->pluralModelName}/{$this->modelName}{$actionName}.php");
            $this->createFileWithParams(
                $actionPath,
                $this->getStub('action'),
                [
                    ['src' => '{{pluralModelName}}', 'val' => $this->pluralModelName],
                    ['src' => '{{modelName}}', 'val' => $this->modelName],
                    ['src' => '{{actionName}}', 'val' => $actionName],
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
                    ['src' => '{{thisAction}}', 'val' => Str::lower($this->pluralModelName).'.'.$request['action']],
                ]
            );
        }
    }

    protected function createFileWithParams($path, $template, $params = [])
    {
        foreach ($params as $param) {
            $template = str_replace($param['src'], $param['val'], $template);
        }
        $this->createDirectory($path);
        file_put_contents($path, $template);
        $this->info("Created -> {$path} successfully!");
    }

    protected function createDirectory($path)
    {
        $directory = dirname($path);
        if (! is_dir($directory)) {
            if (! mkdir($directory, 0755, true)) {
                exit('Error creating directory: '.$directory);
            }
        }
    }

    public function createActivities()
    {
        $this->call(
            'make:isap-model-activity',
            [
                'name' => $this->modelName,
                '--all' => true,
            ]
        );
    }

    protected function getStub($type)
    {
        $stubPath = resource_path("stubs/{$type}.stub");
        if (! file_exists($stubPath)) {
            $this->error("Stub file not found: {$stubPath}");

            return '';
        }

        return file_get_contents($stubPath);
    }
}
