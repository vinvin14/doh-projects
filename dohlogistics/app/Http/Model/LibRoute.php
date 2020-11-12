<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:40 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class LibRoute extends Model
{
    protected $table = 'libraryroute';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'route',
    ];
}
