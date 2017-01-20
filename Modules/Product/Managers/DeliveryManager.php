<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-21 10:37:06
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2017-01-10 15:30:17
 */

namespace Modules\Product\Managers;

use DB;
use Modules\Product\Managers\ComboManager;
use Modules\Product\Repositories\DeliveryDetailRepository;
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
  protected $deliveryDetailRepo;
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
    
    $this->deliveryDetailRepo = new DeliveryDetailRepository();
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
    return true;
  }

  /**
   * prepareData function - Prepares the entity's data before it is stored
   *
   * @return  data            Ready entity data
   * @author  Javier Alarcon
   **/
  protected function prepareData() {
     //  Variable declaration|initialization
    $data =  array();

    //  Process data
    if ($this->data) {
      $data = [
        'identification' => $this->data->get('identification'),
        'requisition_id' => $this->data->get('requisition_id'),
        'user_id' => $this->user->id,
      ];
    } else {
      throw new SISPException('Los datos suministrados son incompletos', 601);
    }

    //  Result
    return $data;
  }

  private function prepareDetailData($delivery) {
    //  Variable declaration|initialization
    $data =  array();
    $combo_id = null;
    $combo_child_id = $this->data->get('combo_child_id');
    $type_combo = $this->data->get('type_combo');

    //  Process
    if ($products = $this->data->get('products')) {
      foreach ($products as $key_product => $value_product) {
        if ($type_combo == 'Estatico' or $type_combo == 'Dinamico') {
          $combo_id = $delivery->requisition->combo_id;
        } else {
          $combo_id = $combo_child_id;
        }
        if (array_key_exists('weight', $products[$key_product])) {
          $weight = $value_product['weight'];
        } else {
          $weight = 0;
        }
        array_push($data, [
          'quantity' => $products[$key_product]['quantity'],
          'weight' => $weight,
          'unity' => $products[$key_product]['unity'],
          'delivery_id' => $delivery->id,
          'combo_id' => $combo_id, 
          'product_id' => $products[$key_product]['id'],
          ]);
      }
    } else {
      throw new SISPException('Los datos suministrados son incompletos', 601);
    }

    //  Result
    return $data;
  }

  /**
   * undocumented function
   *
   * @return void
   * @author 
   **/
  public function getRequisitions($identification)
  {
    return $this->requisitionRepo->getRequisitionsByIdentification($identification);
  }

  /**
   * undocumented function
   *
   * @return void
   * @author 
   **/
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

  /**
   * countDeliveryAvailable function - 
   *
   * @return void
   * @author Javier Alarcon
   **/
  public function countDeliveryAvailable($identification, $requisition_id = null)
  {
    $countRequisition = $this->getRequisitions($identification);

    $requisitions_id = array();
    foreach ($countRequisition as $key_requisition => $requisition) {
      array_push($requisitions_id, $requisition->id);
    }
    
    $countDelivery = $this->deliveryRepo->countDelivery($requisitions_id);

    if ($countDelivery->count()) {
      foreach ($countRequisition as $key_requisition => $requisition) {
        foreach ($countDelivery as $key_delivery => $delivery) {

          if ($requisition->id === $delivery->requisition_id) {

            foreach ($requisition->details as $key_detail => $requisitionDetail) {
              foreach ($delivery->details as $key_deliveryDetail => $deliveryDetail) {

                if ($deliveryDetail->product_id == $requisitionDetail->product->id) {
                  if ($deliveryDetail->quantity <= $requisitionDetail->quantity) {

                    $valor = $requisitionDetail->quantity - $deliveryDetail->quantity;
                    $countRequisition[$key_requisition]->details[$key_detail]->quantity = "$valor";
                    
                  }
                }
              }
            }

          }
        }
      }
      foreach ($countRequisition as $key_requisition => $requisition) {
        $reqDetail_var = array();
        foreach ($requisition->details as $key_detail => $requisitionDetail) {
          if ($requisitionDetail->quantity == 0) {
            $requisition->details->pull($key_detail);
          } else {
            array_push($reqDetail_var, $requisitionDetail->toArray());
          }
        }
          unset($requisition->details);
          $requisition->details = $reqDetail_var;
      }

    }

    return $countRequisition;
  }

  /**
   * Store function - Save data to database
   *
   * @return  array true|false  -> Data store correctly (true) or incorrectly (false)
   * @author  Javier Alarcon
   **/
  public function store() {
    //  Variable declaration|initialization
    $data = array();
    $result = array();

    //  Process data
    DB::beginTransaction();
    if ($this->validateData()) {
      try {
        $data = $this->deliveryRepo->create($this->prepareData());
        $data_detail = $this->prepareDetailData($data);
        $this->deliveryDetailRepo->create($data_detail);
        $result = ['result' => true, 'data' => $data];
        $this->requisitionRepo->updateStatus($data->requisition_id, 'Entregado');
      } catch (QueryException $e) {
        DB::rollBack();
        throw new SISPException('Los datos no fueron almacenados en la BD', 601);
      }
    } else {
      throw new SISPException('Los datos suministrados son incompletos', 601);
    }
    DB::commit();

    //  Result
    return $result;
  }

  

}