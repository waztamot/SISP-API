<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-08 11:31:59
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-23 15:15:48
 */

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class of type Model by table ProductType
 * @author Javier Alarcon
 */
class ProductType extends Model
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
    'id',
    'name',
    'description'
  ];

  /**
   * protected class variable
   *
   * @var visible       - the visible fields of table
   **/
  protected $visible = [
    'name',
    'description',
    'products'
  ];

  /**
   * protected class variable
   *
   * @var hidden        - the not visible fields of table
   **/
  protected $hidden = [
    'id',
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
    'name'
  ];

  /**
   * products function - relationship with products table
   *
   * @return products
   * @author Javier Alarcon
   **/
  public function products()
  {
    return $this->hasMany(Product::class);
  }

}
