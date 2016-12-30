<?php

namespace Modules\Security\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
  public $incrementing = false;

  protected $primaryKey = 'cedula';

  protected $connection = 'oracle_ex';

  protected $table = 'v_empleados';

  protected $visible = [
    'identification',
    'name',
    'employment',
    'company',
    'cost_center',
  ];

  protected $hidden = [
    'cedulas',
    'tpno',
    'activi',
    'id_cias',
    'ciasdescri',
    'id_ceco',
    'cecodescri',
    /* ************** */
    'admission_date',
    'payroll_type',
  ];

  protected $appends = [
    'identification',
    'name',
    'admission_date',
    'employment',
    'payroll_type',
    'company',
    'company_id',
    'cost_center',
  ];

  protected $attributes = [
    'name',
    'identification',
    'admission_date',
    'employment',
    'payroll_type',
    'company',
    'cost_center',
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

  /**
   * Get the user identification.
   *
   * @param  string  $value
   * @return string
   */
  public function getIdentificationAttribute()
  {
    return $this->attributes['cedula'];
  }

  /**
   * Get the user name.
   *
   * @param  string  $value
   * @return string
   */
  public function getNameAttribute()
  {
    return ucwords(strtolower($this->attributes['nombre']));
  }

  /**
   * Get the user employment.
   *
   * @param  string  $value
   * @return string
   */
  public function getEmploymentAttribute()
  {
      return ucwords(strtolower($this->attributes['cargdescri']));
  }

  /**
   * Get the user admission date.
   *
   * @param  string  $value
   * @return string
   */
  public function getAdmissionDateAttribute()
  {
    return Carbon::parse($this->attributes['fecing'])->format('d-m-Y');;
  }
  
  /**
   * Get the user payroll type.
   *
   * @param  string  $value
   * @return string
   */
  public function getPayrollTypeAttribute()
  {
    return $this->attributes['tpno'];
  }

  /**
   * Get the user company.
   *
   * @param  string  $value
   * @return string
   */
  public function getCompanyAttribute()
  {
    return ucwords(strtolower($this->attributes['ciasdescri']));
  }

  /**
   * Get the user company Id.
   *
   * @param  string  $value
   * @return string
   */
  public function getCompanyIdAttribute()
  {
    return ucwords(strtolower($this->attributes['id_cias']));
  }

  /**
   * Get the user cost center.
   *
   * @param  string  $value
   * @return string
   */
  public function getCostCenterAttribute()
  {
    return ucwords(strtolower($this->attributes['cecodescri']));
  }
}
