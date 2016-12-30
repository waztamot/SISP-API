<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-14 11:36:06
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-30 11:26:44
 */

namespace Modules\Product\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\Requisition;
use SISP\Traits\UuidTrait;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class of type Model by table ComboLapse
 * @author Javier Alarcon
 */
class ComboLapse extends Model
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
  protected $hashUuid = 'comboLapse';
  
  /**
   * protected class variable
   *
   * @var fillable      - store the fields of table
   **/
  protected $fillable = [
    'id', 
    'date_start', 
    'date_end',
  ];

  /**
   * protected class variable
   *
   * @var visible       - the visible fields of table
   **/
  protected $visible = [
    'id',
    'date_start', 
    'date_end',
    'combo',
    'requisition',
  ];

  /**
   * protected class variable
   *
   * @var hidden        - the not visible fields of table
   **/
  protected $hidden = [
    'combo_id',
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
    'date_start', 
    'date_end',
    'combo_id'
  ];

  /**
   * combo function - relationship with combo table
   *
   * @return combo
   * @author Francisco Mendoza
   **/
  public function combo()
  {
    return $this->belongsTo(Combo::class);
  }

  /**
   * requisition function - relationship with requisition table
   *
   * @return requisition
   * @author Francisco Mendoza
   **/
  public function requisition() 
  {
    return $this->hasMany(Requisition::class);
  }


  /**
   * getDateStart - convert start date formart ('d-m-Y')
   *
   * @return strat date
   * @author Francisco Mendoza
   **/
  public function getDateStartAttribute()
  {
    return Carbon::parse($this->attributes['date_start'])->format('d-m-Y');
  }

  /**
   * getDateEnd - convert End date formart ('d-m-Y')
   *
   * @return End date
   * @author Francisco Mendoza
   **/
  public function getDateEndAttribute()
  {
    return Carbon::parse($this->attributes['date_end'])->format('d-m-Y');
  }
}
