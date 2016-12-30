<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-21 10:37:06
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-29 08:09:13
 */

namespace Modules\Product\Managers;

use DB;
use Modules\Product\Managers\ComboManager;
use Modules\Product\Repositories\DeliveryRepository;
use Modules\Product\Repositories\RequisitionRepository;
use SISP\Exceptions\SISPException;
use SISP\Managers\BaseManager;

/**
* Requisition class for data handling
*/
class DeliveryManager extends BaseManager
{

  /**
   * Protected class variable
   *
   * @var DeliveryRepo        -> Object Repository (delivery)
   * @var user                -> Object user (logged in)
   * @var RequisitionRepo     -> Object Repository (requisition)
   * @var RequisitionManager  -> Object Manager (requisition)
   **/
  protected $deliveryRepo;
  protected $user;
  protected $requisitionRepo;
  protected $requisitionManager;

  /**
   * Contruct function
   *
   * @author Javier Alarcon
   **/
  public function __construct()
  {
    $this->deliveryRepo = new DeliveryRepository();
    parent::__construct($this->deliveryRepo);
    
    $this->requisitionRepo = new RequisitionRepository();
    $this->requisitionManager = new RequisitionManager();
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

    $this->requisitionManager->init($data);
  }

  /**
   * validateData function - Validate entity data before the function store() is executed
   *
   * @return  Bool    true|new Exception  -> Data correct (true) or incorrect (New Exception)
   * @author  Javier Alarcon
   **/
  public function validateData()
  {
    /*$requisitions = $this->requisitionRepo->countWhere(
                      array(['user_id','=',$this->user->id], 
                            ['combo_id', '=', $this->data->get('combo_id')],
                      )
                    );

    if ($requisitions > 0) {
      throw new SISPException('Ya se encuentra realizado el pedido', 601);
    } else {
      $this->validateQuantity();
      return true;
    }*/

    return true;
  }

  public function getRequisitions($identification)
  {
    return $this->requisitionRepo->getRequisitionsByIdentification($identification);
  }

  public function getCombos($employee)
  {
    $comboManager = new ComboManager();
    $comboManager->init(['data' => [], 'user' => $this->user]);

    $requisitions = $this->requisitionRepo->getRequisitionsByIdentification($employee->identification);
    $combos = array();
    foreach ($requisitions as $requisition_key => $requisition_value) {
      array_push($combos, $comboManager->constructorOne($requisition_value->combo_id, $employee->company_id));
    }
    $combos = $comboManager->addRequisition($combos, $employee->identification);
    
    return $combos;
  }

}