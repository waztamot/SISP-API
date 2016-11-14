<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\ProductPrice;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class ProductPriceRepository implements BaseRepositories
{
  
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new ProductPrice;
  }
}