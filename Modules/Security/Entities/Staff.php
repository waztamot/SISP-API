<?php

namespace Modules\Security\Entities;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
  public $incrementing = false;

  protected $connection = 'oracle_ex';

  protected $table = 'v_empleados';

  protected $fillable = [
    'cedula',
    'nombre',
    'fecing',
    'tpno',
    'carg',
    'cargdescri',
    'cedulas',
    'activi',
  ];

  protected $hidden = [
    'id_cias',
    'ciasdescri',
    'id_ceco',
    'cecodescri',
  ];

  public function company()
  {
    return $this->hasOne(Company::class, 'id', 'id_cias');
  }

  public function costCenter()
  {
    return $this->hasOne(CostCenter::class, 'id', 'id_ceco');
  }

  public function scopeActive($query)
  {
    return $query->where(array(['activi', '!=', 0], ['activi', '!=', 9]));
  }
  
}
