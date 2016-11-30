<?php

namespace Modules\Product\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\Requisition;

class ComboLapse extends Model
{
  use SoftDeletes;

  public $incrementing = false;
  
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'id', 
    'date_start', 
    'date_end',
  ];

  protected $hidden = [
    'combo_id',
    'created_at', 
    'updated_at', 
    'deleted_at', 
  ];

  public function combo()
  {
    return $this->belongsTo(Combo::class);
  }

  public function requisition() 
  {
    return $this->belongsTo(Requisition::class);
  }

  public function getDateStartAttribute()
  {
    return Carbon::parse($this->attributes['date_start'])->format('d-m-Y');
  }

  public function getDateEndAttribute()
  {
    return Carbon::parse($this->attributes['date_end'])->format('d-m-Y');
  }
}
