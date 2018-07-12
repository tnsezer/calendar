<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 12.07.2018
 * Time: 22:19
 */
namespace App\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;

trait ErrorHandler
{
    public function validationError($message){
        return new JsonResponse(
            $message,
            JsonResponse::HTTP_METHOD_NOT_ALLOWED
        );
    }
}