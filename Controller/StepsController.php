<?php
App::uses('AppController', 'Controller');

/**
 * Steps Controller
 *
 * @property Step $Step
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class StepsController extends AppController
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
        $this->Step->recursive = 0;
        $this->set('steps', $this->Paginator->paginate());
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
        if (!$this->Step->exists($id)) {
            throw new NotFoundException(__('Invalid step'));
        }
        $options = array('conditions' => array('Step.' . $this->Step->primaryKey => $id));
        $this->set('step', $this->Step->find('first', $options));
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
            $this->Step->create();
            if ($this->Step->save($this->request->data)) {
                $this->Flash->success(__('Dodanie kroku'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie kroku'));
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
        if (!$this->Step->exists($id)) {
            throw new NotFoundException(__('Invalid step'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Step->save($this->request->data)) {
                $this->Flash->success(__('Edycja kroku'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja kroku'));
                debug($this->Step->validationErrors);
                die();
            }
        } else {
            $options = array('conditions' => array('Step.' . $this->Step->primaryKey => $id));
            $this->request->data = $this->Step->find('first', $options);
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
        $this->Step->id = $id;
        if (!$this->Step->exists()) {
            throw new NotFoundException(__('Invalid step'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Step->delete()) {
            $this->Flash->success(__('Usunięcie kroku'));
        } else {
            $this->Flash->error(__('Usunięcie kroku'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
