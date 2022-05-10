<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class EntidadModel extends Model
{
    protected $table = 'entidad';
    protected $allowedFields = [
        'cod_entidad',
        'nombre'
    ];
    protected $updatedField = 'updated_at';

    public function findEntidadById($cod_entidad)
    {
        $entidad = $this
            ->asArray()
            ->where(['cod_entidad' => $cod_entidad])
            ->first();

        if (!$entidad) throw new Exception('No se encontro el ID especificado');

        return $entidad;
    }
}
