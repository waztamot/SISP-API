<?php

namespace Modules\Security\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\EntrustPermission;

class Permit extends EntrustPermission
{
    // protected $table = 'permits';

  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $hidden = [
    'created_at', 'updated_at', 'deleted_at',
  ];

  /**
   * Permission belongs to many users.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function users()
  {
    return $this->belongsToMany(config('auth.providers.users.model'));
    // return $this->belongsToMany(config('auth.providers.users.model'))->withTimestamps();
  }
}
