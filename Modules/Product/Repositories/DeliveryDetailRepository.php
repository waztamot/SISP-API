<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-12-06 14:30:57
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2017-01-04 15:22:14
 */

namespace Modules\Product\Repositories;

use Modules\Product\Entities\DeliveryDetail;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

 /**
  * Class of type Repository by table DeliveryDetail
  * @author Javier Alarcon
  */
class DeliveryDetailRepository implements BaseRepositories
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
   * @return deliveryDetail
   * @author Javier Alarcon
   **/
  public function getEntity()
  {
    return new DeliveryDetail;
  }

  /**
   * Create a new object of the entity that will manage repositories.
   *
   * @param   Object data - Data of the entity.
   * @return  void.
   * @author  Javier Alarcon
   **/
  public function create ($data) {
    foreach ($data as $value) {
      $this->entity->create($value);
    }
  }

}