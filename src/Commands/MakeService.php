<?php

namespace Masterskill\ServicePackage\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name : Le nom de la classe et le chemin du namespace}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('name');

        $directory = config('service-package.service_directory');
        $defaultNamespace = config('service-package.namespace');

        // Separate the class name and namespace path if provided in the format "Namespace/ClassName."
        $segments = explode('/', $filename);
        $className = end($segments);
        $namespace = count($segments) > 1 ? implode('\\', array_slice($segments, 0, -1)) : $defaultNamespace;
        $folder = count($segments) > 1 ? implode('\\', array_slice($segments, 0, -1)) : DIRECTORY_SEPARATOR;

        $directoryPath = $directory . str_replace('\\', DIRECTORY_SEPARATOR, $folder);

        // Create the directory if necessary.
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }
        if (!str_starts_with($namespace, $defaultNamespace)) {
            $namespace = $defaultNamespace . $namespace;
        }

        // Generate the complete file path using the namespace and class name.
        $filePath = $directoryPath . DIRECTORY_SEPARATOR . $className . '.php';

        $classContent = <<<'PHP'
            <?php

            namespace {{Namespace}};

            class {{ClassName}}
            {
                public function __construct()
                {
                    // Constructor of the class
                }
            }
            PHP;

        $classContent = str_replace('{{Namespace}}', $namespace, $classContent);
        $classContent = str_replace('{{ClassName}}', $className, $classContent);

        if (file_put_contents($className, $classContent)) {
            $this->info("The service $filePath has been created successfully.");
            $this->info("Enjoy your development :)");
        } else {
            $this->error("Une erreur est survenue lors de la création du service.");
        }
    }
}
