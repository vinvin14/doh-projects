<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 14/01/2020
 * Time: 3:34 PM
 */

namespace App\Services;


class NotificationServices
{
    public function wrap($type, $message)
    {
        switch ($type)
        {
            case 'error':
                $message = '<div class="alert-danger pr-2 pl-2 pt-1 pb-2">'.$message.'</div>';
            break;

            case 'info':
                $message = '<div class="alert-info pr-2 pl-2 pt-1 pb-2">'.$message.'</div>';
            break;

            case 'success':
                $message = '<div class="alert-success pr-2 pl-2 pt-1 pb-2">'.$message.'</div>';
            break;
        }

        return $message;
    }
}
