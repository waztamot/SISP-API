<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{

  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = [
    'id', 'name', 'description'
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'deleted_at',
  ];

}
