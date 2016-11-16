<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComboDetail extends Model
{
  use SoftDeletes;

  public $incrementing = false;
  
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'quantity', 'unity', 'quantity_available',
  ];

  protected $hidden = [
    'id', 'concept_paysheet', 'combo_id', 'product_id', 'created_at', 'updated_at', 'deleted_at',
  ];

  protected $with = ['product'];

  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  public function combo()
  {
    return $this->belongsTo(Combo::class);
  }
}
