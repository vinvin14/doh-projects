<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 28/07/2020
 * Time: 1:25 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class LibProgram extends Model
{
    protected $table = 'libraryprogram';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'program'
    ];
}
