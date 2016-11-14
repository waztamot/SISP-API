<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\Product;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class ProductRepository implements BaseRepositories
{
  
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new Product;
  }
}