<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class EjecutivoModel extends Model
{
    protected $table = 'ejecutivo';
    protected $allowedFields = [
        'nombre',
        'apellido1',
        'telefono'
    ];
    protected $updatedField = 'updated_at';

    public function findEjecutivoById($id_ejecutivo)
    {
        $ejecutivo = $this
            ->asArray()
            ->where(['id_ejecutivo' => $id_ejecutivo])
            ->first();

        if (!$ejecutivo) throw new Exception('No se encontro el ID especificado');

        return $ejecutivo;
    }
}
