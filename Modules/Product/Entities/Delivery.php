<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SISP\Traits\UuidTrait;

class Delivery extends Model
{

  use SoftDeletes;
  use UuidTrait;

  public $incrementing = false;

  /**
   * protected class variable
   *
   * @var hashUuid    - hash uuid of table
   **/
  protected $hashUuid = 'delivery';
  
  protected $fillable = [];
}
