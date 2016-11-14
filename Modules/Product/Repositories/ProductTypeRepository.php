<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\ProductType;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class ProductTypeRepository implements BaseRepositories
{
  
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new ProductType;
  }
}