<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 06/07/2020
 * Time: 2:15 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class libItem extends Model
{
    protected $table = 'libraryItem';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'firstCategory', 'secondCategory', 'description', 'updated', 'branch'
    ];

}
