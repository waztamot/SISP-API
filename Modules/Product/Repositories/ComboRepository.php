<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\Combo;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class ComboRepository implements BaseRepositories
{
  
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new Combo;
  }

  public function list($company)
  {
    $list = $this->getActiveWhereWith(array('details', 'subcombo'),
                                      array(
                                        ['max_quantity','>','0'],
                                        ['company','=',$company]
                                      ))->makeVisible('id');
    return $list;
  }

}