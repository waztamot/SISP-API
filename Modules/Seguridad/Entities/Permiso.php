<?php

namespace Modules\Seguridad\Entities;

// use Illuminate\Database\Eloquent\Model;
// use Johnnymn\Sim\Roles\Models\Permission;
use Zizaco\Entrust\EntrustPermission;

class Permiso extends EntrustPermission
{
    // protected $table = 'permisos';

  protected $hidden = [
    'created_at', 'updated_at',
  ];

  /**
   * Permission belongs to many users.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function usuarios()
  {
    return $this->belongsToMany(config('auth.providers.users.model'))->withTimestamps();
  }
}
