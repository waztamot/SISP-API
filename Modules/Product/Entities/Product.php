<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

  use SoftDeletes;

  public $incrementing = false;
  
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'id', 'barcode', 'name', 'description', 'available', 'image', 'product_type_id',
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'deleted_at',
  ];

}
