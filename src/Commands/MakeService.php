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
    protected $signature = 'make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');
        $classContent = <<<'PHP'
        <?php

        class {{ClassName}}
        {
            public function __construct()
            {
                // Constructeur de la classe
            }

            public function maMethode()
            {
                // Méthode de la classe
            }
        }
        PHP;

        $classContent = str_replace('{{ClassName}}', $filename, $classContent);

        $filePath = app_path('Services') . DIRECTORY_SEPARATOR . $filename . '.php';

        if (file_put_contents($filePath, $classContent)) {
            $this->info("Le fichier $filePath a été créé avec succès.");
        } else {
            $this->error("Une erreur est survenue lors de la création du fichier.");
        }
    }
}
