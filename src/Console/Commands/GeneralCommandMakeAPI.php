<?php

namespace SardarBackend\RestfulApiHelper\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class GeneralCommandMakeAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:general {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new API service, resources, controller, and route';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the name of the service from the argument
        $name = $this->argument('name');

        Artisan::call('make:request Api' . $name . 'Request');
        $this->info('Request created successfully.');

        // ایجاد دو Resource
        Artisan::call('make:resource ' . $name . 'ListResource');
        Artisan::call('make:resource ' . $name . 'DetailsResource');
        $this->info('Resources created successfully.');

        // ایجاد Service
        $this->createService($name);

        // ایجاد کنترلر با استفاده از stub
        $this->createCustomControllerFromStub($name);

        // ایجاد Route در web.php
        $this->createResourceRoute($name);
    }

    protected function createService($name)
    {
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
        $this->info("Service {$name}Service created successfully.");
    }

    protected function createCustomControllerFromStub($name)
    {
        $stubPath = __DIR__  .  '/stub/custom-controller.stub';
        $controllerPath = app_path("Http/Controllers/Api{$name}Controller.php");

        if (!file_exists($controllerPath)) {
            $stub = File::get($stubPath);
            $controllerContent = str_replace('{{ name }}', $name, $stub);
            File::put($controllerPath, $controllerContent);
            $this->info('Custom Controller created successfully from stub.');
        } else {
            $this->info('Custom Controller already exists.');
        }
    }

    protected function createResourceRoute($name)
    {
        $routeFile = base_path('routes/web.php');
        $routeDefinition = "\nRoute::resource('" . strtolower($name) . "', App\Http\Controllers\\Api" . $name . "Controller::class);";

        // اگر فایل web.php وجود نداشته باشد، ایجاد می‌شود
        if (!File::exists($routeFile)) {
            File::put($routeFile, "<?php\n\nuse Illuminate\Support\Facades\Route;\n\n" . $routeDefinition);
            $this->info('Route file created and route added successfully.');
            return;
        }

        // بررسی کنیم که این روت قبلاً اضافه نشده باشد
        $existingRoutes = File::get($routeFile);
        if (str_contains($existingRoutes, $routeDefinition)) {
            $this->info('Route already exists in web.php.');
            return;
        }

        // اضافه کردن مسیر به web.php
        File::append($routeFile, $routeDefinition);
        $this->info('Route added successfully to web.php.');
    }


    protected function getStub()
    {
        return __DIR__ . '/stub/service.stub';
    }
}
