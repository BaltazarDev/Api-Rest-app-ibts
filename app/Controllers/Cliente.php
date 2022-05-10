<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Cliente extends BaseController
{
    /**
     * Get all Clientes
     * @return Response
     */
    public function index()
    {
        $model = new ClienteModel();
        return $this->getResponse(
            [
                'message' => 'Clientes retrieved successfully',
                'clientes' => $model->findAll()
            ]
        );
    }

    /**
     * Get a single client by ID
     */
    public function show($id_cliente)
    {
        try {

            $model = new ClienteModel();
            $cliente = $model->findClienteById($id_cliente);

            return $this->getResponse(
                [
                    'message' => 'Cliente retrieved successfully',
                    'cliente' => $cliente
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find cliente for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($id_cliente)
    {
        try {

            $model = new ClienteModel();
            $model->findClienteById($id_cliente);

          $input = $this->getRequestInput($this->request);

          

            $model->update($id_cliente, $input);
            $cliente = $model->findClienteById($id_cliente);

            return $this->getResponse(
                [
                    'message' => 'Cliente updated successfully',
                    'cliente' => $cliente
                ]
            );

        } catch (Exception $exception) {

            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function destroy($id_cliente)
    {
        try {

            $model = new ClienteModel();
            $cliente = $model->findClienteById($id_cliente);
            $model->delete($cliente);

            return $this
                ->getResponse(
                    [
                        'message' => 'Cliente deleted successfully',
                    ]
                );

        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

}
