<?php

namespace SardarBackend\RestfulApiHelper\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ApiRequestCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:apirequest {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new API Request class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stub/api-request.stub';
        // بررسی کنید که فایل 'api-request.stub' در مسیر 'stubs/' داخل پکیج شما وجود داشته باشد.
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Requests';
        // '\Http\Requests' مسیر استاندارد برای کلاس‌های Request در لاراول است.
    }
}
