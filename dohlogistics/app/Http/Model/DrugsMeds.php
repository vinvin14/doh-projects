<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:52 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class DrugsMeds extends Model
{
    protected $table = 'dm';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'libItem', 'unitCost', 'unit', 'quantity', 'dateAdded', 'dmAllocation', 'origin'
    ];
}
