<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-29 14:42:00
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-23 14:09:12
 */

namespace Modules\Product\Managers;

use Modules\Product\Repositories\ComboRepository;
use Modules\Product\Repositories\RequisitionRepository;
use SISP\Managers\BaseManager;

/**
 * Class of type Manager by table Combo
 * @author Javier Alarcon
 */
class ComboManager extends BaseManager
{

  /**
   * protected class variable
   *
   * @var comboRepo    - Connection with bd for combo table
   **/
  protected $comboRepo;

  /**
   * protected class variable
   *
   * @var requisitionRepo    - Connection with bd for requisition table
   **/
  protected $requisitionRepo;

  /**
   * protected class variable
   *
   * @var user    - user loggend
   **/
  protected $user;

  /**
   * Constructor class
   *
   **/
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
   * ConstructorOne function - view data prepare of one combo
   *
   * @return array combo Find one combo and prepared data
   * @author Javier Alarcon
   **/
  public function constructorOne($combo_id, $company_id = null)
  {
    //  Variable declaration|initialization
    $combo = array();
    $company = ($company_id == null) ? $this->user->company_id : $company_id;

    //  Process data
    $combo = $this->comboRepo->find($company, $combo_id);
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
   * * ConstructorMany function - view data prepare of all combos
   *
   * @return combos
   * @author Javier Alarcon
   **/
  public function constructorMany($company_id = null)
  {
    //  Variable declaration|initialization
    $combo_list = array();
    $company = ($company_id == null) ? $this->user->company_id : $company_id;

    //  Process data
    $combo_list = $this->comboRepo->list($company);
    
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
   * addRequisition function - add data requisition of combo
   *
   * @return combos
   * @author Javier Alarcon | Oscar Guevara
   **/
  public function addRequisition($combos, $identification = null)
  {
    //  Variable declaration|initialization
    $identification = ($identification == null) ? $this->user->identification : $identification;

    //  Process data
    foreach ($combos as $key_combo => $value_combo) {

        $requisition = $this->requisitionRepo->checkBuy($identification, $value_combo->id, $value_combo->lapse->id);

        if ($requisition->count()) {
          $combos[$key_combo]->buy = true;
          $combos[$key_combo]->requisition_id = $requisition[0]->id;
          
          foreach ($combos[$key_combo]->details as $key => $value) {
            foreach ($requisition[0]->details as $detail) {

              if ($value_combo->type == 'SubCombo-Estatico' || $value_combo->type == 'SubCombo-Dinamico') {
                if ($combos[$key_combo]->details[$key]->id == $detail->combo_id) {
                  $combos[$key_combo]->details[$key]->quantity = 1; // Mejorar

                  foreach ($combos[$key_combo]->details[$key]->details as $key2 => $value2) {
                    if ($combos[$key_combo]->details[$key]->details[$key2]->product->id === $detail->product_id 
                        && $detail->quantity > 0) {
                      $combos[$key_combo]->details[$key]->details[$key2]->quantity = $detail->quantity;
                    }
                  }
                } else {
                  $combos[$key_combo]->details[$key]->quantity = 0;
                }

              } else {
                if ($combos[$key_combo]->details[$key]->product->id === $detail->product_id && $detail->quantity > 0) {
                  $combos[$key_combo]->details[$key]->quantity = $detail->quantity;
                }
              }

            }
          }

        } else {
          $combos[$key_combo]->buy = false;
          $combos[$key_combo]->requisition_id = null;
        }
    }

    //  Result
    return $combos;
  }

}
