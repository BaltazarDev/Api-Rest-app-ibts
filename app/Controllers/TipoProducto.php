<?php

namespace App\Controllers;

use App\Models\TipoProductoModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class TipoProducto extends BaseController
{
    /**
     * Get all Tipo Producto
     * @return Response
     */
    public function index()
    {
        $model = new TipoProductoModel();
        return $this->getResponse(
            [
                'message' => 'TipoProducto retrieved successfully',
                'tipo producto' => $model->findAll()
            ]
        );
    }

    /**
     * Create a new Tipo Producto
     */
    public function store()
    {
        $rules = [
            'cod_entidad' => 'required|min_length[1]|max_length[11]',
            'descripcion' => 'required|min_length[3]|max_length[100]',
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $tipo_productoWH = $input[''];

        $model = new TipoProductoModel();
        $model->save($input);
        

        $tipo_producto = $model->where('cod_tipo_producto', $tipo_productoWH)->first();

        return $this->getResponse(
            [
                'message' => 'Tipo Producto added successfully',
                'tipo producto' => $tipo_producto
            ]
        );
    }

    /**
     * Get a single Tipo Producto by ID
     */
    public function show($cod_tipo_producto)
    {
        try {

            $model = new TipoProductoModel();
            $tipo_producto = $model->findTipoProductoById($cod_tipo_producto);

            return $this->getResponse(
                [
                    'message' => 'Tipo Producto retrieved successfully',
                    'tipo producto' => $tipo_producto
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Tipo Producto for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($cod_tipo_producto)
    {
        try {

            $model = new TipoProductoModel();
            $model->findTipoProductoById($cod_tipo_producto);

            $input = $this->getRequestInput($this->request);

          

            $model->update($id, $input);
            $tipo_producto = $model->findTipoProductoById($id);

            return $this->getResponse(
                [
                    'message' => 'Tipo Producto updated successfully',
                    'tipo producto' => $tipo_producto
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

    public function destroy($cod_tipo_producto)
    {
        try {

            $model = new TipoProductoModel();
            $tipo_producto = $model->findTipoProductoById($cod_tipo_producto);
            $model->delete($tipo_producto);

            return $this
                ->getResponse(
                    [
                        'message' => 'Tipo Producto deleted successfully',
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
