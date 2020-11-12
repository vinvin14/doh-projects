<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:41 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class LibType extends Model
{
    protected $table = 'librarytype';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'type',
    ];
}
