<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-21 10:37:06
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-11-30 11:19:58
 */

namespace Modules\Product\Managers;

use DB;
use Modules\Product\Managers\ComboManager;
use Modules\Product\Repositories\ComboDetailRepository;
use Modules\Product\Repositories\ComboRepository;
use Modules\Product\Repositories\RequisitionDetailRepository;
use Modules\Product\Repositories\RequisitionRepository;
use SISP\Exceptions\SISPException;
use SISP\Managers\BaseManager;

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
  protected $comboRepo;
  protected $comboDetailRepo;
  protected $requisitionRepo;
  protected $requisitionDetailRepo;
  protected $user;
  protected $comboManager;

  /**
   * Contruct function
   *
   * @author Javier Alarcon
   **/
  public function __construct()
  {
    $this->comboRepo = new ComboRepository();
    $this->comboDetailRepo = new ComboDetailRepository();
    $this->requisitionRepo = new RequisitionRepository();
    $this->requisitionDetailRepo = new RequisitionDetailRepository();
    $this->comboManager = new ComboManager();
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
    $this->comboManager->init($data);
  }

  /**
   * validateData function - Validate entity data before the function store() is executed
   *
   * @return  Bool    true|new Exception  -> Data correct (true) or incorrect (New Exception)
   * @author  Javier Alarcon
   **/
  public function validateData()
  {
    $requisitions = $this->requisitionRepo->countWhere(
                      array(['user_id','=',$this->user->id], 
                            ['combo_id', '=', $this->data->get('combo_id')],
                      )
                    );

    if ($requisitions > 0) {
      throw new SISPException('Ya se encuentra realizado el pedido', 601);
    } else {
      $this->validateQuantity();
      return true;
    }
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
        $data = $this->requisitionRepo->create($this->prepareData());
        $data_detail = $this->prepareDetailData($data);
        $this->requisitionDetailRepo->create($data_detail);
        $result = ['result' => true, 'data' => $data];
      } catch (QueryException $e) {
        DB::rollBack();
        abort(601, 'Los datos no fueron almacenados en la BD');
      }
    } else {
      abort(601, 'Los datos suministrados son incompletos');
    }
    DB::commit();

    //  Result
    return $result;
  }

  private function prepareDetailData($requisition) {
    //  Variable declaration|initialization
    $data =  array();

    //  Process
    if ($products = $this->data->get('products')) {
      foreach ($products as $key_product => $value_product) {
        $combo_detail = $this->comboDetailRepo
                                ->getActiveWhere(array (['combo_id', '=', $requisition->combo_id],
                                                        ['product_id', '=', $products[$key_product]['id']])
                                                );
        array_push($data, [
          'quantity' => $products[$key_product]['quantity'],
          'amount' => /*$products[$key_product]['quantity'] **/ $combo_detail[0]->product->price->price,
          'requisition_id' => $requisition->id,
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
   * @author Javier Alarcon
   **/
  private function validateQuantity()
  {
    //  Variable declaration|initialization
    $products =  array();
    $combo = array();
    $combo_id = $this->data->get('combo_id');
    $quantity_total = 0;

    //  Process
    if ($products = $this->data->get('products')) {
      if ($combo = $this->comboManager->constructorOne($combo_id)) {
        if ($combo->type == 'Estatico' or $combo->type == 'SubCombo-Estatico') {
          foreach ($products as $key_product => $value_product) {
            foreach ($combo->details as $key_detail => $value_detail) {
              if ($value_product['id'] == $value_detail->product->id && 
                  $value_product['quantity'] != $value_detail->quantity) {
                throw new SISPException("La cantidad de los productos solicitados no es correcta", 601);
              }
            }
          }
        } else {
          foreach ($products as $key_product => $value_product) {
            $quantity_total += $value_product['quantity'];
          }
          if ($quantity_total > $combo->max_quantity) {
            throw new SISPException("La cantidad de los productos solicitados no es correcta", 601);
          }
        }
      } else {
        throw new SISPException("Combo bloqueado por periodo", 601);
      }
    }
  }

  /**
   * prepareData function - Prepares the entity's data before it is stored
   *
   * @return  data          Ready entity data
   * @author  Javier Alarcon
   **/
  protected function prepareData()
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
        'combo_lapse_id' => $this->data->get('lapse_id'),
      ];
    } else {
      throw new SISPException('Los datos suministrados son incompletos', 601);
    }

    //  Result
    return $data;
  }

}