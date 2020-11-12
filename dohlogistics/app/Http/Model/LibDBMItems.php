<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 07/07/2020
 * Time: 10:48 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class libDBMItems extends Model
{
    protected $table = 'librarydbmitems';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'item', 'unit', 'type', 'part', 'price'
    ];

}
