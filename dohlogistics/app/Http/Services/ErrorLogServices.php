<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 16/07/2020
 * Time: 2:48 PM
 */

namespace App\Http\Services;


use App\Http\Model\Error;

class ErrorLogServices
{
    public function init($error)
    {
        Error::create($error);
    }
}
