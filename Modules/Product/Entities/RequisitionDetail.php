<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Product\Entities\Requisition;

class RequisitionDetail extends Model
{

  public $incrementing = false;

  protected $fillable = [
    'quantity',
    'amount',
  ];

  protected $hidden = [
    'id',
    'requisition_id',
    'product_id',
    'created_at',
    'updated_at', 
  ];

  public function requisition()
  {
    return $this->belognsTo(Requisition::class);
  }

  public function product()
  {
    return $this->belognsTo(Product::class);
  }
}
