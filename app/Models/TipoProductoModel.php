<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class TipoProductoModel extends Model
{
    protected $table = 'tipo_producto';
    protected $allowedFields = [
        'cod_tipo_producto',
        'cod_entidad',
        'descripcion'
    ];
    protected $updatedField = 'updated_at';

    public function findTipoProductoById($cod_tipo_producto)
    {
        $tipo_producto = $this
            ->asArray()
            ->where(['cod_tipo_producto' => $cod_tipo_producto])
            ->first();

        if (!$tipo_producto) throw new Exception('No se encontro el ID especificado');

        return $tipo_producto;
    }
}
