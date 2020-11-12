<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:38 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class LibFundsource extends Model
{
    protected $table = 'libfundsource';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'fundSource',
    ];
}
