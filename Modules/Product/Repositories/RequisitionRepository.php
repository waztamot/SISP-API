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

  /**
   * checkBuy function
   *
   * @return void
   * @author Javier Alarcon | Oscar Guevara
   **/
  public function checkBuy($identification, $combo_id, $lapse_id)
  {
    return $this->getActiveWhereWith(array('details'), 
                                     array(['identification', '=', $identification],
                                           ['combo_id', '=', $combo_id],
                                           ['combo_lapse_id', '=', $lapse_id]));
  }

}