<?php
App::uses('AppController', 'Controller');

/**
 * Policies Controller
 *
 * @property Policy $Policy
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class PoliciesController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session');

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->layout = 'admin';
        $this->Policy->recursive = 0;
        $this->set('policies', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->layout = 'admin';
        if (!$this->Policy->exists($id)) {
            throw new NotFoundException(__('Invalid policy'));
        }
        $options = array('conditions' => array('Policy.' . $this->Policy->primaryKey => $id));
        $this->set('policy', $this->Policy->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        $this->layout = 'admin';
        if ($this->request->is('post')) {
            $this->Policy->create();
            if ($this->Policy->save($this->request->data)) {
                $this->Flash->success(__('Dodanie informacji'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie informacji'));
            }
        }
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->layout = 'admin';
        if (!$this->Policy->exists($id)) {
            throw new NotFoundException(__('Invalid policy'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Policy->save($this->request->data)) {
                $this->Flash->success(__('Edycja informacji'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja informacji'));
            }
        } else {
            $options = array('conditions' => array('Policy.' . $this->Policy->primaryKey => $id));
            $this->request->data = $this->Policy->find('first', $options);
        }
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        $this->layout = 'admin';
        $this->render(false);
        $this->Policy->id = $id;
        if (!$this->Policy->exists()) {
            throw new NotFoundException(__('Invalid policy'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Policy->delete()) {
            $this->Flash->success(__('Usunięcie informacji'));
        } else {
            $this->Flash->error(__('Usunięcie informacji'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
