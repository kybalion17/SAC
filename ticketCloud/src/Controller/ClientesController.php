<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;


class ClientesController extends AppController
{

    public function index()
    {
        $clientes = $this->paginate($this->Clientes);
        $this->set(compact('clientes'));
        $this->set('_serialize',['clientes']);
    }

    public function searchClient($jsonObject,$response){

        try {
            $clientData = $this->Clientes->find()->where(array('dni' => $jsonObject['dni']));

            if($clientData->count() > 0){
                $response['code'] = 1;
                $response['message'] = 'The Client was Founded';
                $response['object'] = $clientData->toarray();
            }else{
                $response['code'] = 3;
                $response['message'] = 'Record not Found';
            }
        } catch (\Exception $e) {
            Log::error('Problem Search Client: ' . $e->getMessage());
            $response['code'] = 3;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }


    public function insertUpdateClientProcess($jsonObject,$response){

        try {
                $clientData = $this->Clientes->find()->where(array('dni' => $jsonObject['dni']));

                if($clientData->count() > 0){
                    $cliente = $this->Clientes->updateAll(array('dni' => $jsonObject['dni'],'nombre' => $jsonObject['nombre']), array('dni' => $jsonObject['dni']));
                    if ($cliente) {
                        $response['code'] = 1;
                        $response['message'] = 'The Client was updated';
                        $response['object'] = $clientData;
                    }else{
                        $response['code'] = 3;
                        $response['message'] = 'No Updates';
                    }
                }else{
                    $cliente = $this->Clientes->newEntity();
                    $cliente = $this->Clientes->patchEntity($cliente, $jsonObject);
                    if ($this->Clientes->save($cliente)) {
                        $response['code'] = 1;
                        $response['message'] = 'The client has been saved.';
                        $response['object'] = $cliente->toarray();
                    }else{
                        $response['code'] = 3;
                        $response['message'] = 'The client could not be saved. Please, try again.';

                    }
                }

        } catch (\Exception $e) {
            Log::error('Problem Insert or Update Client: ' . $e->getMessage());
            $response['code'] = 3;
            $response['message'] = $e->getMessage();

        }
        return $response;
    }

}
