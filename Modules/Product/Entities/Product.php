<?php

namespace Modules\Product\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

  use SoftDeletes;

  public $incrementing = false;
  
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'id', 
    'name',
    'description',
    'available',
    'image', 
  ];

  protected $hidden = [
    'barcode', 
    'product_type_id',
    'created_at', 
    'updated_at', 
    'deleted_at',
  ];

  protected $with = ['price'];

  public function comboDetail()
  {
    return $this->hasMany(ComboDetail::class);
  }

  public function type() 
  {
    return $this->belongsTo(ProductType::class);
  }

  public function price() 
  {
    return $this->hasOne(ProductPrice::class)->where('valid_from','<=', Carbon::now()->format('Y-m-d'))
                                             ->orderBy('valid_from','desc');
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
