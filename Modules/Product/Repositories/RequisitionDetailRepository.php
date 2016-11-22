<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\RequisitionDetail;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class RequisitionDetailRepository implements BaseRepositories
{
  
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new RequisitionDetail;
  }
}