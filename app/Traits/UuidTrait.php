<?php  
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-22 11:05:34
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-11-22 13:51:58
 */

namespace SISP\Traits;

use SISP\Utils\Helpers;

/**
* 
*/
trait UuidTrait
{

  /**
   * Boot function from laravel
   *
   * @return void
   * @author Javier Alarcon
   **/
  protected static function boot()
  {
    parent::boot();

    static::creating(function ($model) {
      $model->{$model->getKeyName()} = Helpers::uuid($model->hashUuid);
    });
  }
}