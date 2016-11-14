<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\ComboLapse;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class ComboLapseRepository implements BaseRepositories
{
  
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new ComboLapse;
  }
}