<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Requisition;
use SISP\Traits\UuidTrait;

class RequisitionDetail extends Model
{

  use UuidTrait;

  public $incrementing = false;

  protected $hashUuid = 'requisition details';

  protected $fillable = [
    'quantity',
    'amount',
    'requisition_id',
    'product_id',
    'combo_id'
  ];

  protected $hidden = [
    'id',
    'created_at',
    'updated_at', 
  ];

  // protected $with = ['product'];

  public function requisition()
  {
    return $this->belongsTo(Requisition::class);
  }

  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}
