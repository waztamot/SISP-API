<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-10 10:07:10
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-23 15:15:34
 */

namespace Modules\Product\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SISP\Traits\UuidTrait;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class of type Model by table Product
 * @author Javier Alarcon
 */
class Product extends Model
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
  protected $hashUuid = 'product';

  /**
   * protected class variable
   *
   * @var fillable      - store the fields of table
   **/
  protected $fillable = [
    'id', 
    'name',
    'description',
    'available',
    'image', 
  ];

  /**
   * protected class variable
   *
   * @var visible       - the visible fields of table
   **/
  protected $visible = [
    'id', 
    'name',
    'description',
    'available',
    'image',
    'comboDetail',
    'productType',
    'price'
  ];

  /**
   * protected class variable
   *
   * @var hidden        - the not visible fields of table
   **/
  protected $hidden = [
    'barcode', 
    'product_type_id',
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
  protected $with = ['price'];

  /**
   * protected class variable
   *
   * @var logAttributes - fields of log activity 
   **/
  protected static $logAttributes = [
    'id', 
    'name',
    'available',
    'barcode', 
    'product_type_id'
  ];

  /**
   * comboDetail function - relationship with Combo_Detail table
   *
   * @return comboDetail
   * @author Javier Alarcon
   **/
  public function comboDetail()
  {
    return $this->hasMany(ComboDetail::class);
  }

  /**
   * productType function - relationship with product_type table
   *
   * @return productType
   * @author Javier Alarcon
   **/
  public function productType() 
  {
    return $this->belongsTo(ProductType::class);
  }

  /**
   * price function - relationship with product_price table
   *
   * @return productPrice
   * @author Javier Alarcon
   **/
  public function price() 
  {
    return $this->hasOne(ProductPrice::class)->where('valid_from', '<=', Carbon::now()->format('Y-m-d'))
                                             ->orderBy('valid_from', 'desc');
  }

  /**
   * getAvailableAttribute function - field available in format boolean
   *
   * @return available (true|false)
   * @author Javier Alarcon
   **/
  public function getAvailableAttribute()
  {
    if ($this->attributes['available'])
    {
      return true;
    } else {
      return false;
    }
  }

}
