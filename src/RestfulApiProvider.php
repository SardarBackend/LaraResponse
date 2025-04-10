<?php

namespace SardarBackend\RestfulApiHelper;

use Illuminate\Support\ServiceProvider;
use SardarBackend\RestfulApiHelper\RestfulApi\AppendsBuilder;

use SardarBackend\RestfulApiHelper\Console\Commands\ServiceModelCommand;
use SardarBackend\RestfulApiHelper\Console\Commands\GeneralCommandMakeAPI;

class RestfulApiProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('ApiResponseFacade', function(){
            return new AppendsBuilder ;
        });

        if ($this->app->runningInConsole()) {

            $this->commands([
                ServiceModelCommand::class,
                GeneralCommandMakeAPI::class
            ]);

        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
