<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:42 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class LibUnit extends Model
{
    protected $table = 'libraryunit';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'unit'
    ];
}
