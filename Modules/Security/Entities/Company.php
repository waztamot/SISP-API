<?php

namespace Modules\Security\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

  protected $connection = 'oracle_ex';

  protected $table = 'v_cias';

  protected $fillable = [
    'descripcion',   //  Description Company
  ];

  protected $hidden = [
    'id',            //  Id - Company
  ];

  public function costCenters()
  {
    return $this->hasMany(CostCenter::class, 'id_cias');
  }

  public function users()
  {
    return $this->hasMany(User::class, 'company_id');
  }

}
