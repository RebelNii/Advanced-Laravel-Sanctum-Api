<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneralException extends Exception
{
    //
    /**
     * Reports the exceptions
     */
    public function report(){

    }


    /**
     * Returns HTTP response
     */
    public function render(Request $request){
        return new JsonResponse([
            'error' => ['message' => $this->getMessage()]
        ], $this->getCode);
    }
}
