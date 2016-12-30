<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-11 13:33:55
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-21 14:48:16
 */

namespace Modules\Product\Repositories;

use Modules\Product\Entities\Product;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
 * Class of type Repository by table Product
 * @author Javier Alarcon
 */
class ProductRepository implements BaseRepositories
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
    return new Product;
  }
}