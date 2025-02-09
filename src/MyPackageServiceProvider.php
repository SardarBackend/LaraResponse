<?php

namespace SardarBackend\Providers;

use Illuminate\Support\ServiceProvider;
use SardarBackend\RestfulApi\AppendsBuilder;
use SardarBackend\Console\Commands\ServiceModelCommand;
use SardarBackend\Console\Commands\ApiRequestCommand;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            $this->commands([
                ApiRequestCommand::class,
                ServiceModelCommand::class,
            ]);
            
        }
    }
}
