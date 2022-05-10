<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class PropuestaModel extends Model
{
    protected $table = 'propuesta';
    protected $allowedFields = [
        'cod_tipo_producto',
        'tipo_producto',
        'importe'
    ];
    protected $updatedField = 'updated_at';

    public function findPropuestaById($id_propuesta)
    {
        $propuesta = $this
            ->asArray()
            ->where(['id_propuesta' => $id_propuesta])
            ->first();

        if (!$propuesta) throw new Exception('No se encontro el ID especificado');

        return $propuesta;
    }
}
