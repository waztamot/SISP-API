<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\ComboDetail;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class ComboDetailRepository implements BaseRepositories
{
  
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new ComboDetail;
  }
}