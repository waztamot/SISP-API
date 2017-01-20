<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-11 08:36:35
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2017-01-03 14:01:11
 */

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\ComboLapse;
use SISP\Traits\UuidTrait;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class of type Model by table Combo
 * @author Javier Alarcon
 */
class Combo extends Model
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
  protected $hashUuid = 'combo';

  /**
   * protected class variable
   *
   * @var fillable      - store the fields of table
   **/
  protected $fillable = [
    'name', 
    'max_quantity', 
    'type'
  ];

  /**
   * protected class variable
   *
   * @var visible       - the visible fields of table
   **/
  protected $visible = [
    'id',
    'name', 
    'max_quantity', 
    'type',
    'buy',
    'requisition_id',
    'details',
    'subcombo',
    'lapse',
    'quantity',
    'deliveryDetail'
  ];

  /**
   * protected class variable
   *
   * @var hidden        - the not visible fields of table
   **/
  protected $hidden = [
    'company', 
    'concept_paysheet', 
    'automatic_loading', 
    'parent_id', 
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
    'company',
    'name',
    'max_quantity', 
    'type',
    'concept_paysheet', 
    'parent_id',
  ];

  /**
   * details function - relationship with Combo_Detail table
   *
   * @return comboDetails
   * @author Javier Alarcon
   **/
  public function details() 
  {
    return $this->hasMany(ComboDetail::class);
  }

  /**
   * subcombo function - relationship with combo table
   *
   * @return combo
   * @author Javier Alarcon
   **/
  public function subcombo()
  {
    return $this->hasMany(Combo::class,'parent_id')->with('details');
  }

  /**
   * lapse function - relationship with Combo_Lapse table
   *
   * @return comboLapse
   * @author Javier Alarcon
   **/
  public function lapse() 
  {
    return $this->hasOne(ComboLapse::class);
  }

  /**
   * deliverydetail function - relationship with Requisition table
   *
   * @return deliverydetail
   * @author Francisco Mendoza
   **/
  public function deliveryDetail()
  {
    return $this->belongsTo(DeliveryDetail::class);
  }
}
