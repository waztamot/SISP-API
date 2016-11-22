<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\Requisition;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class RequisitionRepository implements BaseRepositories
{
  
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new Requisition;
  }
}