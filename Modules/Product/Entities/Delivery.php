<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-12-01 15:13:13
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2017-01-04 15:36:26
 */

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\DeliveryDetail;
use Modules\Product\Entities\requisition;
use Modules\Security\Entities\Staff;
use Modules\Security\Entities\User;
use SISP\Traits\UuidTrait;
use Spatie\Activitylog\Traits\LogsActivity;


class Delivery extends Model
{
  /**
   * Trait class
   *
   * @var LogsActivity - Logs of activities
   **/
  use LogsActivity;

  /**
   * Trait class
   *
   * @var SoftDeletes  - Logical delete
   **/
  use SoftDeletes;

  /**
   * Trait class
   *
   * @var UuidTrait    - Using Uuid field
   **/
  use UuidTrait;

  /**
   * public class variable
   *
   * @var incrementing  - primary key of table is autoincremental or no
   **/
  public $incrementing = false;

  /**
   * protected class variable
   *
   * @var primaryKey    - primary key of table
   **/
  protected $primaryKey = 'id';
  
  /**
   * protected class variable
   *
   * @var hashUuid    - hash uuid of table
   **/
  protected $hashUuid = 'delivery';

  /**
   * protected class variable
   *
   * @var hashUuid    - hash uuid of table
   **/
  // protected $table = 'deliveries';
  
  /**
   * protected class variable
   *
   * @var fillable      - store the fields of table
   **/
  protected $fillable = [
    'id', 
    'identification',
    'requisition_id',
    'user_id'
  ];

  /**
   * protected class variable
   *
   * @var visible       - the visible fields of table
   **/
  protected $visible = [
    'id',
    'identification', 
    'status',
    'requisition_id',
    'user_id',
    'requisition',
    'user',
    'employee',
    'details'
  ];

  /**
   * protected class variable
   *
   * @var hidden        - the not visible fields of table
   **/
  protected $hidden = [
    'created_at', 
    'updated_at', 
    'deleted_at',
  ];

  /**
   * protected class variable
   *
   * @var dates         - field of table by logic delete
   **/
  protected $dates = ['deleted_at'];

  /**
   * protected class variable
   *
   * @var logAttributes - fields of log activity 
   **/
  protected static $logAttributes = [
    'id', 
    'identification', 
    'requisition_id',
    'user_id'
  ];

/**
   * details function - relationship with DeleviryDetail table
   *
   * @return DeleviryDetail
   * @author Francisco Mendoza
   **/
  public function details() 
  {
    return $this->hasMany(DeliveryDetail::class);
  }

  /**
   * requisition function - relationship with Requisition table
   *
   * @return Requisition
   * @author Francisco Mendoza
   **/
  public function requisition()
  {
    return $this->belongsTo(Requisition::class);
  }

  /**
   * user function - relationship with Requisition table
   *
   * @return User
   * @author Francisco Mendoza
   **/
   public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * employee function - relationship with Requisition table
   *
   * @return employee
   * @author Francisco Mendoza
   **/
  public function employee()
  {
    return $this->hasOne(Staff::class, 'cedula', 'identification');
  }

}
