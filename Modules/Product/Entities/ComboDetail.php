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
    'id', 'quantity', 'concept_paysheet', 'quantity_available',
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'deleted_at', 'combo_id', 'product_id',
  ];
}
