<?php

namespace Modules\Security\Entities;

// use Illuminate\Database\Eloquent\Model;
// use Johnnymn\Sim\Roles\Models\Role as Role_jwt;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    // protected $table = 'roles';

  protected $fillable = [
    'id', 'name', 'display_name', 'description',
  ];

  protected $hidden = [
    'created_at', 'updated_at',
  ];
}
