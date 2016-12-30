<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-11 13:34:54
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-22 15:44:51
 */

namespace Modules\Product\Repositories;

use Modules\Product\Entities\Combo;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
 * Class of type Repository by table Combo
 * @author Javier Alarcon
 */
class ComboRepository implements BaseRepositories
{
  /**
   * Trait class
   *
   * @var BaseRepositoryTrait  - Manage basic of repository
   **/
  use BaseRepositoriesTrait;

  /**
   * getEntity function - control entity of baseRepositoryTrait
   *
   * @return product
   * @author Javier Alarcon
   **/
  public function getEntity()
  {
    return new Combo;
  }

  /**
   * list function - list of combo by company
   *
   * @param string company identification of the company
   * @return combos
   * @author Javier Alarcon
   **/
  public function list($company)
  {
    $list = $this->entity->whereHas('lapse', function ($query) {
                            $query->where(array(['date_start', '<=', date('Y/m/d')], 
                                                ['date_end', '>=', date('Y/m/d')]));
                          })
                         ->with(['details', 'subcombo', 'lapse'])
                         ->where(array(['max_quantity','>','0'],
                                       ['company','=',$company]))
                         ->get();
    return $list;
  }

  /**
   * find function - Look for a combo that meets the conditions
   *
   * @param string company identification of the company
   * @param uuid id identification of combo
   * @return combo
   * @author Javier Alarcon
   **/
  public function find($company, $id)
  {
    $combo = $this->entity->whereHas('lapse', function ($query) {
                            $query->where(array(['date_start', '<=', date('Y/m/d')], 
                                                ['date_end', '>=', date('Y/m/d')]));
                          })
                         ->with(['details', 'subcombo', /*'lapse'*/])
                         ->where(array(['max_quantity','>','0'],
                                       ['company','=',$company]))
                         ->find($id)/*->makeVisible('id')*/;
    return $combo;
  }

}