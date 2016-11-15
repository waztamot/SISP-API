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
    'name', 'max_quantity', 'type'
  ];

  protected $hidden = [
    'id', 
    'company', 
    'concept_paysheet', 
    'automatic_loading', 
    'parent_id', 
    'created_at', 
    'updated_at', 
    'deleted_at',
  ];

  public function detail() 
  {
    return $this->hasMany(ComboDetail::class)->with('product');
  }

  public function subcombo() 
  {
    return $this->hasMany(Combo::class,'parent_id')->with('detail');
  }

}
