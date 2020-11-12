<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:58 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class SecondCategory extends Model
{
    protected $table = 'secondcategory';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
