<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class PolizaModel extends Model
{
    protected $table = 'poliza';
    protected $allowedFields = [
        'cod_tipo_producto',
        'tipo_producto',
        'importe_mensual',
        'prima',
        'fecha_inicio',
        'fecha_fin'
    ];
    protected $updatedField = 'updated_at';

    public function findPolizaById($id_poliza)
    {
        $poliza = $this
            ->asArray()
            ->where(['id_poliza' => $id_poliza])
            ->first();

        if (!$poliza) throw new Exception('No se encontro el ID especificado');

        return $poliza;
    }
}
