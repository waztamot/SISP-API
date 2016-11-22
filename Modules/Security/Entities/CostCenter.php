<?php

namespace Modules\Security\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Security\Entities\User;

class CostCenter extends Model
{

  public $incrementing = false;

  protected $connection = 'oracle_ex';

  protected $table = 'v_cecos';

  protected $fillable = [
    'descripcion',   //   Description Cost Center
  ];

  protected $hidden = [
    'id',            //   Id - Cost Center
    'id_cias',       //   Id - Company
  ];

  public function company()
  {
    return $this->belongsTo(Company::class, 'id_cias');
  }

  public function users()
  {
    return $this->hasMany(User::class);
  }
}
