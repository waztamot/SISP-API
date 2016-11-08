<?php 
namespace Modules\Security\Repositories;

use Modules\Security\Entities\Permit;
use SISP\Contracts\BaseRepositories;
use SISP\Traits\BaseRepositoriesTrait;

/**
* 
*/
class PermitRepository implements BaseRepositories
{
  use BaseRepositoriesTrait;

  public function getEntity()
  {
    return new Permit;
  }

}