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
    $list = $this->entity->whereHas('lapse', function ($query) {
                            $query->where(array(['date_start', '<=', date('Y/m/d')], 
                                                ['date_end', '>=', date('Y/m/d')]));
                          })
                         ->with(['details', 'subcombo', 'lapse'])
                         ->where(array(['max_quantity','>','0'],
                                       ['company','=',$company]))
                         ->get()->makeVisible('id');
    return $list;
  }

  public function find($company, $id)
  {
    $combo = $this->entity->whereHas('lapse', function ($query) {
                            $query->where(array(['date_start', '<=', date('Y/m/d')], 
                                                ['date_end', '>=', date('Y/m/d')]));
                          })
                         ->with(['details', 'subcombo', /*'lapse'*/])
                         ->where(array(['max_quantity','>','0'],
                                       ['company','=',$company]))
                         ->find($id)->makeVisible('id');
    return $combo;
  }

}