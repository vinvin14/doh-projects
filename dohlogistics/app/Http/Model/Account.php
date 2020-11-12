<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 06/07/2020
 * Time: 9:50 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
//    protected $table = 'items';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'token', 'logAttempt', 'maxLogAttempt'
    ];


    protected $hidden = [
        'password',
    ];
}
