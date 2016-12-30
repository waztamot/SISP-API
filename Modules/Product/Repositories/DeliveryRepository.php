<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\Delivery;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class DeliveryRepository implements BaseRepositories
{
  
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new Delivery;
  }
}