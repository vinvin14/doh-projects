<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:39 AM
 */

namespace App\Http\Model;


class LibPurpose
{
    protected $table = 'librarypurpose';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'purpose',
    ];
}
