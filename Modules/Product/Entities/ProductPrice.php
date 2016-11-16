<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];
  
  protected $fillable = [
    'price', 
  ];
  
  protected $hidden = [
    'id', 
    'company', 
    'quota', 
    'valid_from',
    'product_id', 
    'created_at', 
    'updated_at', 
    'deleted_at',
  ];

  public function product() 
  {
    return $this->belongsTo(Product::class);
  }
}
