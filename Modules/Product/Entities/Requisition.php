<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\Combo;
use Modules\Product\Entities\ComboLapse;
use Modules\Security\Entities\Staff;
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
    'combo_lapse_id',
  ];

  protected $visible = [
    'id',
    'identification',
    'date_requesition',
    'status',
    'user_id',
    'combo_id',
    'combo_lapse_id',
    'details',
    'combo',
    'comboLapse',
    'user',
    'employee',
    'deliveries'
  ];

  protected $hidden = [
    'comment',
    'created_at',
    'updated_at', 
    'deleted_at',
  ];

  public function details()
  {
    return $this->hasMany(RequisitionDetail::class);
  }

  public function combo()
  {
    return $this->belongsTo(Combo::class);
  }

  public function comboLapse()
  {
    return $this->belongsTo(ComboLapse::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function employee()
  {
    return $this->hasOne(Staff::class, 'cedula', 'identification');
  }

  public function deliveries()
  {
    return $this->hasMany(Delivery::class);
  }
}
