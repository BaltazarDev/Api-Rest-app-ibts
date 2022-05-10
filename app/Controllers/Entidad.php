<?php

namespace App\Controllers;

use App\Models\EntidadModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Entidad extends BaseController
{
    /**
     * Get all Entidades
     * @return Response
     */
    public function index()
    {
        $model = new EntidadModel();
        return $this->getResponse(
            [
                'message' => 'Entidad retrieved successfully',
                'entidad' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Entidad
     */
    public function store()
    {
        $rules = [
            'nombre' => 'required|min_length[3]|max_length[60]',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $entidadWH = $input['nombre'];

        $model = new EntidadModel();
        $model->save($input);
        

        $entidad = $model->where('nombre', $entidadWH)->first();

        return $this->getResponse(
            [
                'message' => 'Entidad added successfully',
                'entidad' => $entidad
            ]
        );
    }

    /**
     * Get a single entidad by ID
     */
    public function show($cod_entidad)
    {
        try {

            $model = new EntidadModel();
            $entidad = $model->findEntidadById($cod_entidad);

            return $this->getResponse(
                [
                    'message' => 'Entidad retrieved successfully',
                    'entidad' => $entidad
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find entidad for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($cod_entidad)
    {
        try {

            $model = new EntidadModel();
            $model->findEntidadById($cod_entidad);

          $input = $this->getRequestInput($this->request);

          

            $model->update($cod_entidad, $input);
            $entidad = $model->findEntidadById($cod_entidad);

            return $this->getResponse(
                [
                    'message' => 'Entidad updated successfully',
                    'entidad' => $entidad
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

    public function destroy($cod_entidad)
    {
        try {

            $model = new EntidadModel();
            $entidad = $model->findEntidadById($cod_entidad);
            $model->delete($entidad);

            return $this
                ->getResponse(
                    [
                        'message' => 'Entidad deleted successfully',
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
