<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-10 14:11:59
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-22 12:13:29
 */

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class of type Model by table ProductPrice
 * @author Javier Alarcon
 */
class ProductPrice extends Model
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
   * protected class variable
   *
   * @var primaryKey    - primary key of table
   **/
  protected $primaryKey = 'id';

  /**
   * protected class variable
   *
   * @var fillable      - store the fields of table
   **/
  protected $fillable = [
    'price',
    'valid_from',
  ];

  /**
   * protected class variable
   *
   * @var visible       - the visible fields of table
   **/
  protected $visible = [
    'price',
    'product'
  ];
  
  /**
   * protected class variable
   *
   * @var hidden        - the not visible fields of table
   **/
  protected $hidden = [
    'id', 
    'company', 
    'quota', 
    'valid_from',
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
   * @var logAttributes - fields of log activity 
   **/
  protected static $logAttributes = [
    'id', 
    'price',
    'company',
    'quota',
    'valid_from',
    'product_id',
  ];

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

}
