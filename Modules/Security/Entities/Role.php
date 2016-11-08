<?php

namespace Modules\Security\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;
// use Johnnymn\Sim\Roles\Models\Role as Role_jwt;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    // protected $table = 'roles';

  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = [
    'id', 'name', 'display_name', 'description',
  ];

  protected $hidden = [
    'created_at', 'updated_at', 'deleted_at',
  ];
}
