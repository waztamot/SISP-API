<?php

/*
 * This file is part of SISP.
 *
 * (c) Javier Alarcon <javier.alarcon25@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SISP\Traits;

trait BaseRepositoriesTrait
{

  /**
   * Attributes of trait.
   *
   **/
  public $entity;

  /**
   * Contructor trait.
   *
   **/
  public function __construct()
  {
    $this->entity = $this->getEntity();
  }

  /**
   * Get the object of the entity to be managed in repositories according to their 
   * id.
   *  
   * @param   Object id - Id of the entity.
   * @return  Object - Result of SQL statement.
   * @author  Javier Alarcón.
   **/
  public function find($id)
  {
    //  Result
    return $this->entity->find($id);
  }

  /**
   * Get the object of the entity to be managed in repositories according to their 
   * id with its relations.
   *
   * @param   Object id - Id of the entity.
   * @param   Array relationship - Array of table relationship ['relationship', ..].
   * @return  Object - Result of SQL statement.
   * @author  Javier Alarcón.
   **/
  public function findWith($id, array $relationship)
  {
    //  Result
    return $this->entity->with($relationship)->find($id);
  }

  /**
   * Get the object logical delete of the entity to be managed in repositories according to their 
   * id.
   *  
   * @param   Object id - Id of the entity.
   * @return  Object - Result of SQL statement.
   * @author  Javier Alarcón.
   **/
  public function findTrash($id)
  {
    //  Result
    return $this->entity->onlyTrashed()->find($id);
  }

  /**
   * Get the object logical delete of the entity to be managed in repositories according to their 
   * id with its relations.
   *
   * @param   Object id - Id of the entity.
   * @param   Array relationship - Array of table relationship ['relationship', ..].
   * @return  Object - Result of SQL statement.
   * @author  Javier Alarcón.
   **/
  public function findTrashWith($id, array $relationship)
  {
    //  Result
    return $this->entity->with($relationship)->onlyTrashed()->find($id);
  }

  /**
   * Create a new object of the entity that will manage repositories.
   *
   * @param   Object data - Data of the entity.
   * @return  Object - new object created.
   * @author  Javier Alarcón.
   **/
  public function create($data)
  {
    //  Result
    return $this->entity->create($data)->makeVisible('id');
  }

  /**
   * Update a object of the entity that will manage repositories.
   *
   * @param   Object id - Id of the entity.
   * @param   Object data - Data of the entity.
   * @return  Object - Object updated.
   * @author  Javier Alarcón.
   **/
  public function update($id, $data)
  {
    //  Process
    $query  = $this->find($id);
    $result = $query->update($data);

    //  Result
    return $result;
  }

  /**
   * Update the objects of the entity that will manage repositories.
   *
   * @param   Array condition - array of array [['field','operator','value'],[..],..]
   * @param   Array data      - associative array ['field' => 'value', ..]
   * @return  Object - Objects updated.
   * @author  Javier Alarcón.
   **/
  public function updateWhere(array $condition, array $data)
  {
    //  Process
    $result  = $this->entity->where($condition)->update($data);
    //  Result
    return $result;
  }

  /**
   * Delete a object logically of the DB that will manage repositories.
   *
   * @param   Object id - Id of the entity.
   * @return  boolean - True delete | false not delete.
   * @author  Javier Alarcón.
   **/
  public function logicDeleteId($id)
  {
    //  Result
    return $this->entity->where('id', $id)->delete();
  }

  /**
   * Delete a object logically of the DB that will manage repositories.
   *
   * @param   Array condition - array of array [['field','operator','value'],[..],..]
   * @return  boolean - True delete | false not delete.
   * @author  Javier Alarcón.
   **/
  public function logicDeleteWhere(array $condition)
  {
    //  Result
    return $this->entity->where($condition)->delete();
  }

  /**
   * Restere a object logically delete of the DB that will manage repositories.
   *
   * @param   Object id - Id of the entity.
   * @return  boolean - True delete | false not delete.
   * @author  Javier Alarcón.
   **/
  public function logicRestoreId($id)
  {
    //  Result
    return $this->entity->where('id', $id)->restore();
  }

  /**
   * Restore a object logically delete of the DB that will manage repositories.
   *
   * @param   Array condition - array of array [['field','operator','value'],[..],..]
   * @return  boolean - True restore | false not restore.
   * @author  Javier Alarcón.
   **/
  public function logicRestoreWhere(array $condition)
  {
    //  Result
    return $this->entity->where($condition)->restore();
  }

  /**
   * Delete a object of the DB that will manage repositories.
   *
   * @param   Object id - Id of the entity.
   * @return  Object - Object updated.
   * @author  Javier Alarcón.
   **/
  public function destroy($id)
  {
    //  Result
    return $this->entity->destroy($id);
  }

  /**
   * Get all objects of an entity.
   *
   * @param   Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return  ListObjects - Result of SQL statement
   * @author  Javier Alarcón
   **/
  public function all(array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->withTrashed();

    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return $query->get();
  }

  /**
   * Get all objects of an entity with its relations.
   *
   * @param  Array relationship - array of table relationship ['relationship', ..]
   * @param  Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return ListObjects - Result of SQL statement
   * @author Javier Alarcón
   **/
  public function allWith(array $relationship, array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->with($relationship)->withTrashed();
    
    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return  $query->get();
  }

  /**
   * Get all objects active of an entity.
   *
   * @param   Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return  ListObjects - Result of SQL statement
   * @author  Javier Alarcón
   **/
  public function allActive(array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity;

    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return $query->get();
  }

  /**
   * Get all objects active of an entity with its relations.
   *
   * @param  Array relationship - array of table relationship ['relationship', ..]
   * @param  Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return ListObjects - Result of SQL statement
   * @author Javier Alarcón
   **/
  public function allActiveWith(array $relationship, array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->with($relationship);
    
    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return  $query->get();
  }

  /**
   * Get all objects logical delete of an entity.
   *
   * @param   Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return  ListObjects - Result of SQL statement
   * @author  Javier Alarcón
   **/
  public function allTrash(array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->onlyTrashed();

    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return $query->get();
  }

  /**
   * Get all objects logical delete of an entity with its relations.
   *
   * @param  Array relationship - array of table relationship ['relationship', ..]
   * @param  Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return ListObjects - Result of SQL statement
   * @author Javier Alarcón
   **/
  public function allTrashWith(array $relationship, array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->with($relationship)->onlyTrashed();
    
    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return  $query->get();
  }

  /**
   * Get list of objects active of an entity with condition.
   *
   * @param   Array condition - array of array [['field','operator','value'],[..],..]
   * @param   Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return  ListObjects - Result of SQL statement
   * @author  Javier Alarcón
   **/
  public function getActiveWhere(array $condition, array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->where($condition);

    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return $query->get();
  }

  /**
   * Get list of objects active of an entity with condition and relationship.
   *
   * @param   Array relationship - array of table relationship ['relationship', ..]
   * @param   Array condition - array of array [['field','operator','value'],[..],..]
   * @param   Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return  ListObjects - Result of SQL statement
   * @author  Javier Alarcón
   **/
  public function getActiveWhereWith(array $relationship, array $condition, array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->with($relationship)->where($condition);

    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return $query->get();
  }

  /**
   * Get list of objects logical delete of an entity with condition.
   *
   * @param   Array condition - array of array [['field','operator','value'],[..],..]
   * @param   Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return  ListObjects - Result of SQL statement
   * @author  Javier Alarcón
   **/
  public function getTrashWhere(array $condition, array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->onlyTrashed()->where($condition);

    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return $query->get();
  }

  /**
   * Get list of objects logical delete of an entity with condition and relationship.
   *
   * @param   Array condition - array of array [['field','operator','value'],[..],..]
   * @param   Array relationship - array of table relationship ['relationship', ..]
   * @param   Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return  ListObjects - Result of SQL statement
   * @author  Javier Alarcón
   **/
  public function getTrashWhereWith(array $condition, array $relationship, array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->with($relationship)->onlyTrashed()->where($condition);

    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return $query->get();
  }

  /**
   * Get list of all objects of an entity with condition.
   *
   * @param   Array condition - array of array [['field','operator','value'],[..],..]
   * @param   Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return  ListObjects - Result of SQL statement
   * @author  Javier Alarcón
   **/
  public function getAllWhere(array $condition, array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->withTrashed()->where($condition);

    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return $query->get();
  }

  /**
   * Get list of all objects of an entity with condition and relationship.
   *
   * @param   Array condition - array of array [['field','operator','value'],[..],..]
   * @param   Array relationship - array of table relationship ['relationship', ..]
   * @param   Array orderBy (optional) - associative array ['field' => 'sort', ..]
   * @return  ListObjects - Result of SQL statement
   * @author  Javier Alarcón
   **/
  public function getAllWhereWith(array $condition, array $relationship, array $orderBy = null)
  {
    //  Variable initialization
    $query = $this->entity->with($relationship)->withTrashed()->where($condition);

    //  Process
    if ($orderBy !== null) {
      $query = $this->orderBy($query, $orderBy);
    }

    //  Result
    return $query->get();
  }

  /**
   * Sort data from bd
   *  
   * @param   Object sql - SQL statement
   * @param   Array orderBy - associative array ['field' => 'sort', ..]
   * @return  Object Sql - SQL statement modified
   * @author  Javier Alarcón
   **/
  private function orderBy($sql, array $orderBy)
  {
    //  Process
    if (count($orderBy) > 0) {

      foreach ($orderBy as $key => $value) {
        $sql->orderBy($key, $value);
      }

    }

    //  Result
    return $sql;
  }

}