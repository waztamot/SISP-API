<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-21 10:02:53
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-11-29 14:36:05
 */

namespace SISP\Managers;

use Illuminate\Database\QueryException;
use DB;

/**
* Parent abstract class for data handling
*/
abstract class BaseManager
{
  /**
   * Protected class variable
   *
   * @var repo    -> Object repository
   * @var data    -> Data of the entity
   **/
  protected $repo;
  protected $data;

  /**
   * Contruct function
   *
   * @author Javier Alarcon
   **/
  public function __construct($repo)
  {
    $this->repo = $repo;
  }

  /**
   * validateData function - Validate entity data before the function store() is executed
   *
   * @return  Bool    true|false  -> Data correct (true) or incorrect (false)
   * @author  Javier Alarcon
   **/
  abstract public function validateData();

  /**
   * init function - Initializes the data of the entity
   *
   * @param   data    -> Data of the entity
   * @author  Javier Alarcon
   **/
  public function init(array $data) {
    $this->data = $data['data'];
  }

  /**
   * prepareData function - Prepares the entity's data before it is stored
   *
   * @return  data            Ready entity data
   * @author  Javier Alarcon
   **/
  protected function prepareData() {
    return $this->data;
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
        $data = $this->repo->create($this->prepareData());
        $result = ['result' => true, 'data' => $data];
      } catch (QueryException $e) {
        DB::rollBack();
        abort(601, 'Los datos no fueron almacenados en la BD');
      }
    } else {
      DB::rollBack();
      abort(601, 'Los datos suministrados son incompletos');
    }
    DB::commit();

    //  Result
    return $result;
  }

}