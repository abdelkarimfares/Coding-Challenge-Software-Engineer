<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_category extends Model
{
    protected $fillable = ['product_id', 'category_id'];
    use HasFactory, SoftDeletes;
}
