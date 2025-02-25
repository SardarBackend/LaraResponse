<?php

namespace SardarBackend\Helpers\RestfulApiHelper\traits;


trait HasRules
{

    public static function rules(array $Appends =[]){
        return array_merge(self::$rules , $Appends);
    }
}
