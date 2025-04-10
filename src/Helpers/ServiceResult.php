<?php
namespace SardarBackend\RestfulApiHelper\Helpers;

class ServiceResult
{
    public function __construct(public bool $ok , public mixed  $data =null)
    {
        //dd();
    }
}
