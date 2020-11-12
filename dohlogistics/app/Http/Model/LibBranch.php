<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 07/07/2020
 * Time: 1:25 PM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class libBranch extends Model
{
    protected $table = 'librarybranch';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'branch',
    ];

}
