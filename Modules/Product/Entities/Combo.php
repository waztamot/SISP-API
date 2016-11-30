<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\ComboLapse;

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

  public function details() 
  {
    return $this->hasMany(ComboDetail::class);
  }

  public function subcombo() 
  {
    return $this->hasMany(Combo::class,'parent_id')->with('details');
  }

  public function lapse() 
  {
    return $this->hasOne(ComboLapse::class);
  }

}
