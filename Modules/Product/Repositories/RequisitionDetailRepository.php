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

  /**
   * Create a new object of the entity that will manage repositories.
   *
   * @param   Object data - Data of the entity.
   * @return  void.
   * @author  Javier Alarcón.
   **/
  public function create ($data) {
    foreach ($data as $value) {
      $this->entity->create($value);
    }
  }

}