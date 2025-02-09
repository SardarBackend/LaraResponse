<?php

namespace SardarBackend\RestfulApi\Fecades;
use Illuminate\Support\Facades\Facade;

class ApiResponseFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'ApiResponseFacade';
    }
}
