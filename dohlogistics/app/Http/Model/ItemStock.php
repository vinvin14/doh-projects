<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:59 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    protected $table = 'itemstock';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'pnStockNumber', 'libItem', 'quantity', 'unit', 'unitCost', 'dateReceived' , 'entryBy' , 'motherItem' , 'iarLotNum', 'remarks'
        , 'category' , 'expiryDate', 'isBufferStock', 'brand', 'responsibility', 'fundSource'
    ];

}
