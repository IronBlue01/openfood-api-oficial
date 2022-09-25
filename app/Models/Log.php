<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Log extends Eloquent
{
    // use HasFactory;

    protected $fillable   = ['tipo','data','sucesso','mensagem'];
    protected $connection = 'mongodb';
    protected $collection = 'log';
 


}
