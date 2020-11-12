<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:25 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class LibDM extends Model
{
    protected $table = 'librarydm';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'firstCategory', 'secondCategory', 'description', 'updated', 'type', 'route', 'form', 'entryBy',
    ];
}
