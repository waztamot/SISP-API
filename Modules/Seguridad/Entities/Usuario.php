<?php

namespace Modules\Seguridad\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use InvalidArgumentException;

class Usuario extends Authenticatable
{
  use Notifiable;
  use LogsActivity;
  use EntrustUserTrait;

  public $incrementing = false;

  // protected $table = 'usuarios';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected static $logAttributes = ['cedula', 'nombre', 'active'];

  protected $fillable = [
    'id', 'cedula', 'nombre', 'active',
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
