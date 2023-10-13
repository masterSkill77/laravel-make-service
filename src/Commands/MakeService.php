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
    protected $description = 'Cette commande crée automatiquement un service Laravel dans le dossier app\Services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('name');

        // Séparez le nom de classe et le chemin du namespace s'ils sont fournis dans le format "Namespace/NomDeClasse"
        $segments = explode('/', $filename);
        $className = end($segments);
        $namespace = count($segments) > 1 ? implode('\\', array_slice($segments, 0, -1)) : 'App\Services';
        $folder = count($segments) > 1 ? implode('\\', array_slice($segments, 0, -1)) : DIRECTORY_SEPARATOR;

        $directoryPath = app_path('Services') . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $folder);

        // Créez le répertoire si nécessaire
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        // Générez le chemin complet du fichier en utilisant le namespace et le nom de classe
        $filePath = $directoryPath . DIRECTORY_SEPARATOR . $className . '.php';

        $classContent = <<<'PHP'
            <?php

            namespace {{Namespace}};

            class {{ClassName}}
            {
                public function __construct()
                {
                    // Constructeur de la classe
                }
            }
            PHP;

        $classContent = str_replace('{{Namespace}}', $namespace, $classContent);
        $classContent = str_replace('{{ClassName}}', $className, $classContent);

        if (file_put_contents($filePath, $classContent)) {
            $this->info("Le service $filePath a été créé avec succès.");
            $this->success("Enjoy your development :)");
        } else {
            $this->error("Une erreur est survenue lors de la création du service.");
        }
    }
}
