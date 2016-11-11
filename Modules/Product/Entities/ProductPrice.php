<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];
  
  protected $fillable = [
    'id', 'company', 'price', 'quota', 'product_id', 'valid_from', 
  ];
  
  protected $hidden = [
    'created_at', 'updated_at', 'deleted_at',
  ];
}
