<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-11 13:28:19
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-21 14:52:56
 */

namespace Modules\Product\Repositories;

use Modules\Product\Entities\ProductType;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
 * Class of type Repository by table ProductType
 * @author Javier Alarcon
 */
class ProductTypeRepository implements BaseRepositories
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
   * @return productType
   * @author Javier Alarcon
   **/
  public function getEntity()
  {
    return new ProductType;
  }
}