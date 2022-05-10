<?php

namespace App\Controllers;

use App\Models\PropuestaModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Propuesta extends BaseController
{
    /**
     * Get all Propuesta
     * @return Response
     */
    public function index()
    {
        $model = new PropuestaModel();
        return $this->getResponse(
            [
                'message' => 'Propuesta retrieved successfully',
                'propuesta' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Propuesta
     */
    public function store()
    {
        $rules = [
            'cod_tipo_producto' => 'required|min_length[1]|max_length[11]',
            'tipo_producto' => 'required|min_length[3]|max_length[100]',
            'importe' => 'required|min_length[1]|max_length[11]',
        ];

 $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $clientePropuesta = $input[''];

        $model = new PropuestaModel();
        $model->save($input);
        

        $propuesta = $model->where('propuesta', $clientePropuesta)->first();

        return $this->getResponse(
            [
                'message' => 'Propuesta added successfully',
                'propuesta' => $propuesta
            ]
        );
    }

    /**
     * Get a single propuesta by ID
     */
    public function show($id_propuesta)
    {
        try {

            $model = new PropuestaModel();
            $propuesta = $model->findPropuestaById($id_propuesta);

            return $this->getResponse(
                [
                    'message' => 'Propuesta retrieved successfully',
                    'propuesta' => $propuesta
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find propuesta for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($id_propuesta)
    {
        try {

            $model = new PropuestaModel();
            $model->findClientById($id_propuesta);

            $input = $this->getRequestInput($this->request);

            $model->update($id_propuesta, $input);
            $propuesta = $model->findPropuestaById($id_propuesta);

            return $this->getResponse(
                [
                    'message' => 'Propuesta updated successfully',
                    'propuesta' => $propuesta
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

    public function destroy($id_propuesta)
    {
        try {

            $model = new PropuestaModel();
            $propuesta = $model->findPropuestaById($id_propuesta);
            $model->delete($propuesta);

            return $this
                ->getResponse(
                    [
                        'message' => 'Propuesta deleted successfully',
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
