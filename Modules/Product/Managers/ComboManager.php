<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-29 14:42:00
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-11-30 11:40:09
 */

namespace Modules\Product\Managers;

use Modules\Product\Repositories\ComboRepository;
use Modules\Product\Repositories\RequisitionRepository;
use SISP\Managers\BaseManager;

class ComboManager extends BaseManager
{

  protected $comboRepo;
  protected $requisitionRepo;
  protected $user;

  public function __construct()
  {
    $this->comboRepo = new ComboRepository();
    $this->requisitionRepo = new RequisitionRepository();
    parent::__construct($this->comboRepo);
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
   * undocumented function
   *
   * @return void
   * @author 
   **/
  public function constructorOne($combo_id)
  {
    //  Variable declaration|initialization
    $combo = array();

    //  Process data
    $combo = $this->comboRepo->find($this->user->company_id, $combo_id);
    if (!empty($combo)) {
      if ($combo->type == 'SubCombo-Estatico' || $combo->type == "SubCombo-Dinamico") {
        unset($combo['details']);
        $combo->details = $combo->subcombo;
      }
      unset($combo['subcombo']);
    }

    //  Result
    return $combo;
  }

  /**
   * undocumented function
   *
   * @return void
   * @author 
   **/
  public function constructorMany()
  {
    //  Variable declaration|initialization
    $combo_list = array();

    //  Process data
    $combo_list = $this->comboRepo->list($this->user->company_id);

    if (!empty($combo_list)) {
      foreach ($combo_list as $key_combo => $value_combo) {

        if ($value_combo->type == 'SubCombo-Estatico' || $value_combo->type == 'SubCombo-Dinamico') {
          unset($combo_list[$key_combo]['details']);
          $combo_list[$key_combo]->details = $value_combo->subcombo;
        }

        unset($combo_list[$key_combo]['subcombo']);
      }
    }

    //  Result
    return $combo_list;
  }

  /**
   * undocumented function
   *
   * @return void
   * @author 
   **/
  public function addRequisition($combos)
  {
    foreach ($combos as $key_combo => $value_combo) {

        $requisition = $this->requisitionRepo->checkBuy($this->user->identification, $value_combo->id, $value_combo->lapse->id);

        if ($requisition->count()) {
          $combos[$key_combo]->buy = true;
          $combos[$key_combo]->requisition_id = $requisition[0]->id;
          
          foreach ($combos[$key_combo]->details as $key => $value) {

            foreach ($requisition[0]->details as $detail) {

              if ($combos[$key_combo]->details[$key]->product->id === $detail->product_id && $detail->quantity > 0) {
                $combos[$key_combo]->details[$key]->quantity = $detail->quantity;
              }

            }
          }

        } else {
          $combos[$key_combo]->buy = false;
          $combos[$key_combo]->requisition_id = null;
        }
    }

    return $combos;
  }

}
