<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComboLapse extends Model
{
  use SoftDeletes;

  public $incrementing = false;
  
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'id', 'date_start', 'date_end',
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'deleted_at', 'combo_id'
  ];
}
