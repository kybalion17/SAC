<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;


class ClienteRelationshipController extends AppController
{

    public function index()
    {
        $this->paginate = [
            'contain' => ['Clientes', 'Colas', 'Status'],
        ];
        $clienteRelationship = $this->paginate($this->ClienteRelationship);
        $this->set(compact('clienteRelationship'));
        $this->set('_serialize',['clienteRelationship']);
    }

    public function view($id = null)
    {
        $jsonObject = json_decode(file_get_contents('php://input'), TRUE);
        $response = array("code" => "", "message" => '', "object" => array());
        $response = $this->searchClientRelationship($jsonObject,$response);

        $this->set(compact('response'));
        $this->set('_serialize',['response']);

    }

    public function searchClientRelationship($jsonObject,$response){

        try {
            $clientData = $this->ClienteRelationship->find()
                ->where(array('cliente_id' => $jsonObject['cliente_id']))
                ->andwhere(array('status_id IN (1,2)'))
                ->contain(array('Clientes','Colas','Status'));

            if($clientData->count() > 0){
                $response['code'] = 1;
                $response['message'] = 'The Client Relationship was Founded';
                $response['object'] = $clientData->toarray();
            }else{
                $response['code'] = 3;
                $response['message'] = 'Client Relationship not Found';
            }
        } catch (\Exception $e) {
            Log::error('Problem Search Client Relationship: ' . $e->getMessage());
            $response['code'] = 3;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }



    public function add()
    {

        $jsonObject = json_decode(file_get_contents('php://input'), TRUE);
        $response = array("code" => "", "message" => '', "object" => array());
        $response = $this->insertUpdateClientRelationshipProcess($jsonObject,$response);

        $this->set(compact('response'));
        $this->set('_serialize',['response']);

    }

    public function insertUpdateClientRelationshipProcess($jsonObject,$response){

        try {
            if ($this->request->is('post')) {

                $clienteRelationship = $this->ClienteRelationship->newEntity();
                $clienteRelationship = $this->ClienteRelationship->patchEntity($clienteRelationship, $jsonObject);
                if ($this->ClienteRelationship->save($clienteRelationship)) {
                    $response['code'] = 1;
                    $response['message'] = 'The client Relationship has been saved.';
                    $response['object'] = $clienteRelationship;
                }else{
                    $response['code'] = 3;
                    $response['message'] = 'The client Relationship could not be saved. Please, try again.';

                }

            }else{
                $response['code'] = 3;
                $response['message'] = 'The Method is Incorrect.';
            }
        } catch (\Exception $e) {
            Log::error('Problem Insert or Update ClientRelationship: ' . $e->getMessage());
            $response['code'] = 3;
            $response['message'] = $e->getMessage();

        }
        return $response;
    }


    public function processTicket()
    {
        $jsonObject = json_decode(file_get_contents('php://input'), TRUE);
        $response = array("code" => "", "message" => '', "object" => array());
        $response = $this->processTicketGeneration($jsonObject,$response);

        $this->set(compact('response'));
        $this->set('_serialize',['response']);

    }

    public function processTicketGeneration($jsonObject,$response){

        try {
            $idCliente = null;
            $cliente = new ClientesController();
            $clienteData = $cliente->searchClient($jsonObject,$response);

            if(count($clienteData['object']) > 0){
                $idCliente = $clienteData['object'][0]['id'];
            }else{
                $clienteAdd = $cliente->insertUpdateClientProcess($jsonObject,$response);
                if(count($clienteAdd['object']) > 0){
                    $idCliente = $clienteAdd['object']['id'];
                }
            }

            $jsonObject['cliente_id'] = $idCliente;
            $clientRelationship = $this->searchClientRelationship($jsonObject,$response);

            if(count($clientRelationship['object']) > 0){
                $response['code'] = 3;
                $response['message'] = 'Client With Active Process';
            }else{
                $ticketNumber = $this->generateTicketNumber();
                $jsonObject['ticket_number'] = $ticketNumber;
                $clientRelationshipAdd = $this->insertUpdateClientRelationshipProcess($jsonObject,$response);
                $allClientsActiveWaiting = $this->searchClientRelationshipActive($jsonObject,$response);


                $responseObject = array(
                    "clientAdded" => $clientRelationshipAdd,
                    "allClientListWaiting" => $allClientsActiveWaiting
                );

                $response['code'] = 1;
                $response['message'] = "Ticket Assigned";
                $response['object'] = $responseObject;
            }


        } catch (\Exception $e) {
            Log::error('Problem in Ticket Generation: ' . $e->getMessage());
            $response['code'] = 3;
            $response['message'] = $e->getMessage();

        }
        return $response;
    }


    public function generateTicketNumber()
    {
       $generateTicketNumber = null;
       $generateTicketNumber = rand(100, 999);
       $generateTicketNumber=$generateTicketNumber.''.date("His");

       return $generateTicketNumber;
    }


    public function viewAllClientRelationshipActive()
    {
        $jsonObject = json_decode(file_get_contents('php://input'), TRUE);
        $response = array("code" => "", "message" => '', "object" => array());
        $response = $this->searchClientRelationshipActive($jsonObject,$response);

        $this->set(compact('response'));
        $this->set('_serialize',['response']);

    }

    public function searchClientRelationshipActive($jsonObject,$response){

        try {
            $clientData = $this->ClienteRelationship->find()
                ->where(array('status_id IN (1,2)'))
                ->contain(array('Clientes','Colas','Status'));

            if($clientData->count() > 0) {
                $response['code'] = 1;
                $response['message'] = 'The Client Relationship was Founded';
                $response['object'] = $clientData->toarray();
            }else{
                $response['code'] = 3;
                $response['message'] = 'List Empty';
            }

        } catch (\Exception $e) {
            Log::error('Problem Search Client Relationship: ' . $e->getMessage());
            $response['code'] = 3;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }


    public function changeStatusClientRelationship()
    {
        $jsonObject = json_decode(file_get_contents('php://input'), TRUE);
        $response = array("code" => "", "message" => '', "object" => array());
        $response = $this->changeStatusClientRelationshipProcess($jsonObject,$response);

        $this->set(compact('response'));
        $this->set('_serialize',['response']);

    }


    public function changeStatusClientRelationshipProcess($jsonObject,$response){

        try {
            $clientDataRelationship = $this->ClienteRelationship->find()->where(array('ticket_number' => $jsonObject['ticket_number']));

            if($clientDataRelationship->count() > 0) {
                $cliente = $this->ClienteRelationship->updateAll(array('status_id' => $jsonObject['status_id']), array('ticket_number' => $jsonObject['ticket_number']));
                if ($cliente) {
                    $response['code'] = 1;
                    $response['message'] = 'The Client Relationship Status was updated';
                    $response['object'] = $clientDataRelationship;
                } else {
                    $response['code'] = 3;
                    $response['message'] = 'No Status changed';
                }
            }else{
                $response['code'] = 3;
                $response['message'] = 'Relationship not found';
            }

        } catch (\Exception $e) {
            Log::error('Problem Search Client Relationship: ' . $e->getMessage());
            $response['code'] = 3;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }



}
