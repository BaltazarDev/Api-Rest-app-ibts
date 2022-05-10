<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ClienteModel extends Model
{
    protected $table = 'cliente';
    protected $allowedFields = [
        'nif',
        'email',
        'password',
        'nombre',
        'apellido1',
        'apellido2',
        'fecha_nacimiento',
        'domicilio',
        'cp',
        'localidad',
        'provincia',
        'telefono'
    ];
    protected $updatedField = 'updated_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = $this->hashPassword($plaintextPassword);
        }
        return $data;
    }

    private function hashPassword(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }
                                      
    public function findUserByEmailAddress(string $emailAddress)
    {
        $cliente = $this
            ->asArray()
            ->where(['email' => $emailAddress])
            ->first();

        if (!$cliente) 
            throw new Exception('El cliente con el email no existe');

        return $cliente;
    }
}
