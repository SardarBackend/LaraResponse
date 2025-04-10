<?php

namespace SardarBackend\RestfulApiHelper\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ServiceModelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the name of the service from the argument
        $name = $this->argument('name');

        // Define the namespace and class name
        $namespace = 'App\\Services';
        $class = $name;

        // Define the directory and file path
        $directory = app_path('Services');
        $path = $directory . '/' . $name . 'Services.php';

        // Check if the directory exists, if not, create it
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
            $this->info('Directory "Services" created successfully.');
        }

        // Check if the file already exists
        if (File::exists($path)) {
            $this->error('Service already exists!');
            return;
        }

        // Get the stub content and replace placeholders
        $stub = file_get_contents($this->getStub());
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        $stub = str_replace('{{class}}', $class, $stub);

        // Write the stub to the file
        File::put($path, $stub);

        // Output success message
        $this->info("Service {$name}Services created successfully.");
    }

    protected function getStub()
    {
        return __DIR__ . '/stub/service.stub';
    }
}
