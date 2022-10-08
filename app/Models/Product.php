<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    // use HasFactory;

    protected $primaryKey = 'code';
    protected $hidden     = ['id','created_at','updated_at'];
    protected $connection = 'mongodb';
    protected $collection = 'product';

    protected $fillable = [
                            'code',
                            'barcode',
                            'status',
                            'imported_t',
                            'url',
                            'product_name',
                            'quantity',
                            'categories',
                            'packaging',
                            'brands',
                            'image_url'
                        ];
}
