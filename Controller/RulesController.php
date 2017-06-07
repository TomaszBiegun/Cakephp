<?php
App::uses('AppController', 'Controller');

/**
 * Rules Controller
 *
 * @property Rule $Rule
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class RulesController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('delete'));
    }

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
        $this->Rule->recursive = 0;
        $this->set('rules', $this->Paginator->paginate());
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
        if (!$this->Rule->exists($id)) {
            throw new NotFoundException(__('Invalid rule'));
        }
        $options = array('conditions' => array('Rule.' . $this->Rule->primaryKey => $id));
        $this->set('rule', $this->Rule->find('first', $options));
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
//            debug($this->request->data);die();
            $this->Rule->create();
            if ($this->Rule->save($this->request->data)) {
                $this->Flash->success(__('Dodanie zasad'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie zasad'));
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
        if (!$this->Rule->exists($id)) {
            throw new NotFoundException(__('Invalid rule'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Rule->save($this->request->data)) {
                $this->Flash->success(__('Edycja zasad'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja zasad'));
            }
        } else {
            $options = array('conditions' => array('Rule.' . $this->Rule->primaryKey => $id));
            $this->request->data = $this->Rule->find('first', $options);
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
        $this->Rule->id = $id;

        if (!$this->Rule->exists()) {
            throw new NotFoundException(__('Invalid rule'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Rule->delete()) {
            $this->Flash->success(__('Usunięcie zasad'));
        } else {
            $this->Flash->error(__('Usunięcie zasad'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
