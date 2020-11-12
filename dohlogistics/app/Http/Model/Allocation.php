<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:50 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $table = 'allocation';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'program', 'details', 'dateOfAllocation', 'quantity',
    ];
}
