<?php

namespace Masterskill\ServicePackage\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

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

        $directory = Config::get('service-package.service_directory');
        $defaultNamespace = Config::get('service-package.namespace');

        // Separate the class name and namespace path if provided in the format "Namespace/ClassName."
        $segments = explode('/', $filename);
        $className = end($segments);
        $namespace = count($segments) > 1 ? implode('\\', array_slice($segments, 0, -1)) : $defaultNamespace;
        $folder = count($segments) > 1 ? implode(DIRECTORY_SEPARATOR, array_slice($segments, 0, -1)) : '';

        $directoryPath = ($folder == '') ? $directory : $directory . DIRECTORY_SEPARATOR . $folder;

        // Create the directory if necessary.
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }
        if (!str_starts_with($namespace, $defaultNamespace)) {
            $namespace = $defaultNamespace . '\\' . $namespace;
        }

        // Generate the complete file path using the namespace and class name.
        $filePath = $directoryPath . DIRECTORY_SEPARATOR . $className . '.php';

        // Generate the content of the class file.
        $classContent = "<?php\n\nnamespace $namespace;\n\nclass $className\n{\n    public function __construct()\n    {\n        // Constructor of the class\n    }\n}\n";

        if (file_put_contents($filePath, $classContent)) {
            $this->info("The service $filePath has been created successfully.");
            $this->info("Enjoy your development :)");
        } else {
            $this->error("An error occurred while creating the service.");
        }
    }
}
