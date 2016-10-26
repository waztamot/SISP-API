<?php

namespace Modules\Security\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use InvalidArgumentException;

class User extends Authenticatable
{
  use Notifiable;
  use LogsActivity;
  use EntrustUserTrait;

  public $incrementing = false;

  // protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected static $logAttributes = ['identification', 'name', 'active'];

  protected $fillable = [
    'id', 'identification', 'name', 'active',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * Get all roles as collection.
   *
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function getRoles()
  {
    return (!$this->roles) ? $this->roles = $this->roles()->get() : $this->roles;
  }


}
