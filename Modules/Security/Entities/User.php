<?php

namespace Modules\Security\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use InvalidArgumentException;
use Spatie\Activitylog\Traits\LogsActivity;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements AuthenticatableUserContract
{
  use Notifiable;
  use LogsActivity;
  use EntrustUserTrait;
  use SoftDeletes { SoftDeletes::restore insteadof EntrustUserTrait; }

  public $incrementing = false;

  // protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $dates = ['deleted_at'];

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
    'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at',
  ];

  /**
   * Many-to-Many relations with the permits model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function permits()
  {
    return $this->belongsToMany(config('entrust.permission'));
  }

  /**
   * Get all roles as collection.
   *
   * @return \Illuminate\Database\Eloquent\Collection
   */
  public function getRoles()
  {
    return (!$this->roles) ? $this->roles = $this->roles()->get() : $this->roles;
  }

  /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();  // Eloquent model method
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
             'user' => [ 
                'id' => $this->id,
             ]
        ];
    }

}
