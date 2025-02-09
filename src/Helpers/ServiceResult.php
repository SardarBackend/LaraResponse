<?php
namespace SardarBackend\Helpers;

class ServiceResult
{
    public function __construct(public bool $ok , public mixed  $data =null)
    {

    }
}
