<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-14 13:44:39
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-30 11:42:35
 */

namespace Modules\Product\Repositories;

use Modules\Product\Entities\ComboLapse;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
 * Class of type Repository by table ComboLapse
 * @author Javier Alarcon
 */
class ComboLapseRepository implements BaseRepositories
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
    return new ComboLapse;
  }
}