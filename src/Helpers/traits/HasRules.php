<?php

namespace SardarBackend\Helpers\traits;


trait HasRules
{

    public static function rules(array $Appends =[]){
        return array_merge(self::$rules , $Appends);
    }
}
