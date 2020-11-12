<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:57 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class FirstCategory extends Model
{
    protected $table = 'firstcategory';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];


    protected $hidden = [
        'password',
    ];
}
