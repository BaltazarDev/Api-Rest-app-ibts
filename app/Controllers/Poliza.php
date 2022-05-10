<?php

namespace App\Controllers;

use App\Models\PolizaModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Poliza extends BaseController
{
    /**
     * Get all Poliza
     * @return Response
     */
    public function index()
    {
        $model = new PolizaModel();
        return $this->getResponse(
            [
                'message' => 'Polizas retrieved successfully',
                'poliza' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Poliza
     */
    public function store()
    {
        $rules = [
            'cod_tipo_producto' => 'required|min_length[1]|max_length[11]',
            'tipo_producto' => 'required|min_length[3]|max_length[50]',
            'importe_menusal' => 'required|min_length[1]|max_length[11]',
            'prima' => 'required|min_length[1]|max_length[11]',
            'fecha_inicio' => 'required|min_length[10]|max_length[10]',
            'fecha_fin' => 'required|min_length[10]|max_length[10]',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $clientePoliza = $input[''];

        $model = new PolizaModel();
        $model->save($input);
        

        $poliza = $model->where('id_poliza', $clientePoliza)->first();

        return $this->getResponse(
            [
                'message' => 'Poliza added successfully',
                'poliza' => $poliza
            ]
        );
    }

    /**
     * Get a single poliza by ID
     */
    public function show($id_poliza)
    {
        try {

            $model = new PolizaModel();
            $poliza = $model->findPolizaById($id_poliza);

            return $this->getResponse(
                [
                    'message' => 'Poliza retrieved successfully',
                    'poliza' => $poliza
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find poliza for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($id_poliza)
    {
        try {

            $model = new PolizaModel();
            $model->findPolizaById($id_poliza);

          $input = $this->getRequestInput($this->request);

          

            $model->update($id_poliza, $input);
            $poliza = $model->findPolizaById($id_poliza);

            return $this->getResponse(
                [
                    'message' => 'Poliza updated successfully',
                    'poliza' => $poliza
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

    public function destroy($id_poliza)
    {
        try {

            $model = new PolizaModel();
            $poliza = $model->findPolizaById($id_poliza);
            $model->delete($poliza);

            return $this
                ->getResponse(
                    [
                        'message' => 'Poliza deleted successfully',
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
