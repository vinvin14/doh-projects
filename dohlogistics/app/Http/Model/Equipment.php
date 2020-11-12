<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:55 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'libItem', 'quantity', 'dateAdded', 'category', 'propertyNum',  'branch'
    ];

}
