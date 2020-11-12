<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:22 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class LibDivision extends Model
{
    protected $table = 'librarydivision';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'division',
    ];
}
