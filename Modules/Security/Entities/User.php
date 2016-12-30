<?php

namespace Modules\Security\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use InvalidArgumentException;
use Modules\Product\Entities\Requisition;
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
    'id', 
    'identification', 
    'image',
    'name', 
    'active', 
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'payroll_type',
    'password', 
    'remember_token',
    'api_token', 
    'company_id',
    'cost_center_id', 
    'created_at',
    'updated_at', 
    'deleted_at',
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

  public function company()
  {
    return $this->belongsTo(Company::class);
  }

  public function costCenter()
  {
    return $this->belongsTo(CostCenter::class);
  }

  public function requisitions()
  {
    return $this->hasMany(Requisition::class);
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

  public function getActiveAttribute()
  {
    if ($this->attributes['active'])
    {
      return true;
    } else {
      return false;
    }
  }

}
