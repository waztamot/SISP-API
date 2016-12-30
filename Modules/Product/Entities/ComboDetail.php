<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-11 11:48:30
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-22 12:08:21
 */

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\Combo;
use Modules\Product\Entities\Product;
use SISP\Traits\UuidTrait;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class of type Model by table ComboDetail
 * @author Javier Alarcon
 */
class ComboDetail extends Model
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
  protected $hashUuid = 'comboDetail';

  /**
   * protected class variable
   *
   * @var fillable      - store the fields of table
   **/
  protected $fillable = [
    'quantity', 
    'unity', 
    'quantity_available',
  ];

  /**
   * protected class variable
   *
   * @var visible       - the visible fields of table
   **/
  protected $visible = [
    'quantity', 
    'unity', 
    'quantity_available',
    'product',
    'combo'
  ];
  
  /**
   * protected class variable
   *
   * @var hidden        - the not visible fields of table
   **/
  protected $hidden = [
    'id', 
    'concept_paysheet', 
    'combo_id', 
    'product_id', 
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
   * @var with          - auto relationships fields of the table
   **/
  protected $with = ['product'];

  /**
   * product function - relationship with product table
   *
   * @return product
   * @author Javier Alarcon
   **/
  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  /**
   * combo function - relationship with combo table
   *
   * @return combo
   * @author Javier Alarcon
   **/
  public function combo()
  {
    return $this->belongsTo(Combo::class);
  }
}
