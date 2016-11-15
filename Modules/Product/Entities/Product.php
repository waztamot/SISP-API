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
    'name', 'description', 'available', 'image', 
  ];

  protected $hidden = [
    'id', 
    'barcode', 
    'product_type_id',
    'created_at', 
    'updated_at', 
    'deleted_at',
  ];

  public function comboDetail() 
  {
    return $this->hasMany(ComboDetail::class);
  }

  public function type() 
  {
    return $this->belongsTo(ProductType::class);
  }

  public function getAvailableAttribute()
  {

    if ($this->attributes['available'])
    {
      return true;
    } else {
      return false;
    }

  }

}
