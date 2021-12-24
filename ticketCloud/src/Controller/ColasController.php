<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Colas Controller
 *
 * @property \App\Model\Table\ColasTable $Colas
 *
 * @method \App\Model\Entity\Cola[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ColasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $colas = $this->paginate($this->Colas);

        $this->set(compact('colas'));
    }

    /**
     * View method
     *
     * @param string|null $id Cola id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cola = $this->Colas->get($id, [
            'contain' => ['ClienteRelationship', 'VwDetalle'],
        ]);

        $this->set('cola', $cola);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cola = $this->Colas->newEntity();
        if ($this->request->is('post')) {
            $cola = $this->Colas->patchEntity($cola, $this->request->getData());
            if ($this->Colas->save($cola)) {
                $this->Flash->success(__('The cola has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cola could not be saved. Please, try again.'));
        }
        $this->set(compact('cola'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cola id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cola = $this->Colas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cola = $this->Colas->patchEntity($cola, $this->request->getData());
            if ($this->Colas->save($cola)) {
                $this->Flash->success(__('The cola has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cola could not be saved. Please, try again.'));
        }
        $this->set(compact('cola'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cola id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cola = $this->Colas->get($id);
        if ($this->Colas->delete($cola)) {
            $this->Flash->success(__('The cola has been deleted.'));
        } else {
            $this->Flash->error(__('The cola could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
