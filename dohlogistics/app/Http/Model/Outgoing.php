<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:46 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model
{
    protected $table = 'outgoing';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'quantity', 'unit', 'purpose', 'dateReleased', 'origin', 'entryBy', 'remarks',
    ];
}
