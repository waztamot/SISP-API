<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-11 13:33:11
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-21 14:52:11
 */

namespace Modules\Product\Repositories;

use Modules\Product\Entities\ProductPrice;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
 * Class of type Repository by table ProductPrice
 * @author Javier Alarcon
 */
class ProductPriceRepository implements BaseRepositories
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
    return new ProductPrice;
  }
}