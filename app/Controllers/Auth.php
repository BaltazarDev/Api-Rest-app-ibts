<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use ReflectionException;

class Auth extends BaseController
{
    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */
    public function register()
    {
        $rules = [
            'nif' => 'requrid|min_length[1]|max_length[11]|is_unique[cliente.nif]',
            'email' => 'required|min_length[6]|max_length[100]|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[8]|max_length[255]',
            'nombre' => 'required|min_length[3]|max_length[40]',
            'apillido1' => 'required|min_length[3]|max_length[40]',
            'apellido2' => 'required|min_length[3]|max_length[40]',
            'fecha_nacimiento' => 'required',
            'domicilio' => 'required|min_length[3]|max_length[60]',
            'cp' => 'required|min_length[4]|max_length[10]',
            'localidad' => 'required|min_length[4]|max_length[50]',
            'provincia' => 'required|min_length[4]|max_length[50]',
            'telefono' => 'required|min_length[10]|max_length[15]',
        ];

        $input = $this->getRequestInput($this->request);
        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $clienteModel = new ClienteModel();
        $clienteModel->save($input);
     

       

return $this
            ->getJWTForUser(
                $input['email'],
                ResponseInterface::HTTP_CREATED
            );

    }

    /**
     * Authenticate Existing User
     * @return Response
     */
    public function login()
    {
        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email, password]'
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

        $input = $this->getRequestInput($this->request);


        if (!$this->validateRequest($input, $rules, $errors)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }
       return $this->getJWTForUser($input['email']);

       
    }

    private function getJWTForUser(
        string $emailAddress,
        int $responseCode = ResponseInterface::HTTP_OK
    )
    {
        try {
            $model = new ClienteModel();
            $cliente = $model->findUserByEmailAddress($emailAddress);
            unset($cliente['password']);

            helper('jwt');

            return $this
                ->getResponse(
                    [
                        /* Información que aparece al logearse con exito */
                        'message' => 'Cliente logeado correctamente',
                        'cliente' => $cliente,
                        'access_token' => getSignedJWTForUser($emailAddress)
                    ]
                );
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
}
