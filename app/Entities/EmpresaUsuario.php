<?php

namespace SISP\Entities;

use Illuminate\Database\Eloquent\Model;

class EmpresaUsuario extends Model
{
    protected $table = 'empresa_usuario';

    protected $fillable = [
        'id', 'usuario_id', 'empresa_id', 'centro_costo_id', 'estado',
    ];
}
