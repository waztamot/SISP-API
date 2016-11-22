<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\Combo;
use Modules\Security\Entities\User;
use SISP\Traits\UuidTrait;

class Requisition extends Model
{
  use SoftDeletes;
  use UuidTrait;

  public $incrementing = false;

  protected $hashUuid = 'requisition';
  
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'identification',
    'date_requesition',
    'status',
    'user_id',
    'combo_id',
  ];

  protected $hidden = [
    'id',
    'comment',
    'created_at',
    'updated_at', 
    'deleted_at',
  ];

  public function requisitionDetails()
  {
    return $this->hasMany(RequisitionDetail::class);
  }

  public function combo()
  {
    return $this->hasOne(Combo::class);
  }

  public function user()
  {
    return $this->hasOne(User::class);
  }

  public function employee()
  {
    return $this->hasOne(Staff::class, 'identification', 'cedula');
  }

}
