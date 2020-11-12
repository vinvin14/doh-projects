<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 10:41 AM
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class LibSection extends Model
{
    protected $table = 'librarysection';
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $fillable = [
        'section',
    ];
}
