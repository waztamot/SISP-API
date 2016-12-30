<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-11 13:35:36
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-21 15:13:17
 */

namespace Modules\Product\Repositories;

use Modules\Product\Entities\ComboDetail;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
 * Class of type Repository by table ComboDetail
 * @author Javier Alarcon
 */
class ComboDetailRepository implements BaseRepositories
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
   * @return comboDetail
   * @author Javier Alarcon
   **/
  public function getEntity()
  {
    return new ComboDetail;
  }
}