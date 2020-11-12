<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:23 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class LibForm extends Model
{
    protected $table = 'libraryform';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'form',
    ];
}
