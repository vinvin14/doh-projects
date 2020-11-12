<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 07/07/2020
 * Time: 4:28 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    //    protected $table = 'items';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'user', 'module', 'details'
    ];


    protected $hidden = [
        'password',
    ];
}
