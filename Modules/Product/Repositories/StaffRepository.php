<?php

namespace Modules\Product\Repositories;

use Modules\Security\Entities\Staff;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class StaffRepository implements BaseRepositories
{
  
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new Staff;
  }
}