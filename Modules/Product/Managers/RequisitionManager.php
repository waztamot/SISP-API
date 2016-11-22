<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-21 10:37:06
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-11-22 13:39:50
 */

namespace Modules\Product\Managers;

use Modules\Product\Repositories\RequisitionRepository;

/**
* Requisition class for data handling
*/
class RequisitionManager extends BaseManager
{

  /**
   * Protected class variable
   *
   * @var RequisitionRepo -> Object Repository (requisition)
   * @var user            -> Object user (logged in)
   **/
  protected $requisitionRepo;
  protected $user;

  /**
   * Contruct function
   *
   * @author Javier Alarcon
   **/
  public function __construct()
  {
    $this->requisitionRepo = new RequisitionRepository();
    parent::__construct($this->requisitionRepo);
  }

  /**
   * init function - Initializes the data of the manager
   *
   * @param   array data  -> Data of the requisition
   * @author Javier Alarcon
   **/
  public function init(array $data)
  {
    parent::init($data);
    $this->user = $data['user'];
  }

  /**
   * isValid function - Validate entity data before the function store() is executed
   *
   * @param   data    -> Data of the requisition
   * @return  Bool    true|false  -> Data correct (true) or incorrect (false)
   * @author  Javier Alarcon
   **/
  public function isValid($data)
  {
    return true;
  }

  /**
   * prepareData function - Prepares the entity's data before it is stored
   *
   * @return  data          Ready entity data
   * @author  Javier Alarcon
   **/
  public function prepareData()
  {
    //  Variable declaration|initialization
    $data =  array();

    //  Process data
    if ($this->data) {
      $data = [
        'identification' => $this->user->identification,
        'date_requesition' => date('Y-m-d'),
        'user_id' => $this->user->id,
        'combo_id' => $this->data->get('combo_id'),
      ];
    } else {
      // throw new Exception('No hay data'/*, code, previous*/);
      abort(602);
    }

    //  Result
    return $data;
  }

}