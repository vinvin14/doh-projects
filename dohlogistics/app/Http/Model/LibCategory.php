<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 06/07/2020
 * Time: 1:38 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class libCategory extends Model
{

    protected $table = 'librarycategory';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'category'
    ];

}
