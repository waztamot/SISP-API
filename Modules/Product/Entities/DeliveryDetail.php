<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use SISP\Traits\UuidTrait;

class DeliveryDetail extends Model
{

  use UuidTrait;

  public $incrementing = false;

  protected $hashUuid = 'delivery details';

  protected $fillable = [
    'id',
    'weight',
    'quantity',
    'unity',
    'delivery_id',
    'combo_id',
    'product_id'
  ];

  protected $visible = [
    'weight',
    'quantity',
    'delivery_id',
    'combo_id',
    'product_id'
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
  ];
}
