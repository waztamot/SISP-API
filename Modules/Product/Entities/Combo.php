<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Combo extends Model
{
  use SoftDeletes;

  public $incrementing = false;
  
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'id', 'company', 'name', 'max_quantity', 'concept_paysheet', 'automatic_loading',
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'deleted_at', 'parent_id'
  ];
}
