<?php

namespace App\Helpers\Routes;


class RoutesHelper
{
    public static function includeRouteFiles(string $folder)
    {
        //we can iterate through folders with laravel
        $dirIterator = new \RecursiveDirectoryIterator( $folder);

        /** @var \RecursiveDirectoryIterator | \RecursiveIteratorIterator $iT */
        $iT = new \RecursiveIteratorIterator($dirIterator);

        while($iT->valid()){
            if(!$iT->isDot() 
            && $iT->isFile() 
            && $iT->isReadable() 
            && $iT->current()->getExtension() === 'php'){
                require $iT->key();
                // $iT->current()->getPathName();
            }
            $iT->next();
        }
    }
}