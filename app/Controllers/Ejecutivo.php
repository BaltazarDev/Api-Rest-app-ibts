<?php

namespace App\Controllers;

use App\Models\EjecutivoModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Ejecutivo extends BaseController
{
    /**
     * Get all Ejecutivos
     * @return Response
     */
    public function index()
    {
        $model = new EjecutivoModel();
        return $this->getResponse(
            [
                'message' => 'Ejecutivo retrieved successfully',
                'ejecutivo' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Ejecutivo
     */
    public function store()
    {
        $rules = [
            'nombre' => 'required|min_length[3]|max_length[40]',
            'apellido1' => 'required|min_length[3]|max_length[40]',
            'telefono' => 'required|min_length[10]|max_length[15]'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $EjecutivoInser = $input['nombre'];

        $model = new EjecutivoModel();
        $model->save($input);
        

        $ejecutivo = $model->where('nombre', $EjecutivoInser)->first();

        return $this->getResponse(
            [
                'message' => 'Ejecutivo added successfully',
                'ejecutivo' => $ejecutivo
            ]
        );
    }

    /**
     * Get a single ejecutivo by ID
     */
    public function show($id_ejecutivo)
    {
        try {

            $model = new EjecutivoModel();
            $ejecutivo = $model->findEjecutivoById($id_ejecutivo);

            return $this->getResponse(
                [
                    'message' => 'Ejecutivo retrieved successfully',
                    'ejecutivo' => $ejecutivo
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find ejecutivo for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($id_ejecutivo)
    {
        try {

            $model = new EjecutivoModel();
            $model->findEjecutivoById($id_ejecutivo);

            $input = $this->getRequestInput($this->request);

          

            $model->update($id_ejecutivo, $input);
            $ejecutivo = $model->findEjecutivoById($id_ejecutivo);

            return $this->getResponse(
                [
                    'message' => 'Ejecutivo updated successfully',
                    'ejecutivo' => $ejecutivo
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

    public function destroy($id_ejecutivo)
    {
        try {

            $model = new EjecutivoModel();
            $ejecutivo = $model->findEjecutivoById($id_ejecutivo);
            $model->delete($ejecutivo);

            return $this
                ->getResponse(
                    [
                        'message' => 'Ejecutivo deleted successfully',
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
