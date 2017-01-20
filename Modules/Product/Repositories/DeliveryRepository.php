<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-12-06 14:30:57
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2017-01-09 08:48:34
 */

namespace Modules\Product\Repositories;

use Modules\Product\Entities\Delivery;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

 /**
  * Class of type Repository by table Delivery
  * @author Francisco Mendoza
  */
class DeliveryRepository implements BaseRepositories
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
   * @return delivery
   * @author Francisco Mendoza
   **/
  public function getEntity()
  {
    return new Delivery;
  }

  /**
   * countDelivery function - Pending delivery counter
   *
   * @param string identification of requisition 
   * @return countDelivery
   * @author Javier Alarcon
   **/
  public function countDelivery($requisitions) {
    return $this->getWithWhereIn('requisition_id', $requisitions, array('details'));
  }

}