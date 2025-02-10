<?php

namespace SardarBackend\RestfulApiHelper\Console\Commands;

use Illuminate\Console\Command;

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

        // Create the path where the service will be stored
        $path = app_path('Services/' . $name . 'Services.php');

        // Check if the file already exists
        if (file_exists($path)) {
            $this->error('Service already exists!');
            return;
        }

        // Create the service file from the stub
        $stub = file_get_contents($this->getStub());

        // Replace the {{namespace}} and {{class}} placeholders
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        $stub = str_replace('{{class}}', $class, $stub);

        // Write the stub to the file
        file_put_contents($path, $stub);

        // Output success message
        $this->info('Service created successfully.');
    }

    protected function getStub()
    {
        return __DIR__ . '/stub/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\Services';
    }
}
