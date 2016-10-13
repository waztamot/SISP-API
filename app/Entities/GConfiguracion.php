<?php

namespace SISP\Entities;

use Illuminate\Database\Eloquent\Model;

class GConfiguracion extends Model
{
    protected $table = 'gconfiguraciones';

    protected $fillable = [
        'id', 'clave', 'valor', 'estado',
    ];
}
