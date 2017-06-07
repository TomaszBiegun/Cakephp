<?php
App::uses('AppController', 'Controller');

/**
 * Abouts Controller
 *
 * @property About $About
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class AboutsController extends AppController
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
        $this->About->recursive = 0;
        $this->set('abouts', $this->Paginator->paginate());
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
        if (!$this->About->exists($id)) {
            throw new NotFoundException(__('Invalid about'));
        }
        $options = array('conditions' => array('About.' . $this->About->primaryKey => $id));
        $this->set('about', $this->About->find('first', $options));
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
            $this->About->create();
            if ($this->About->save($this->request->data)) {
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
        if (!$this->About->exists($id)) {
            throw new NotFoundException(__('Invalid about'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->About->save($this->request->data)) {
                $this->Flash->success(__('Edycja informacji'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja informacji'));
            }
        } else {
            $options = array('conditions' => array('About.' . $this->About->primaryKey => $id));
            $this->request->data = $this->About->find('first', $options);
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
        $this->About->id = $id;
        if (!$this->About->exists()) {
            throw new NotFoundException(__('Invalid about'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->About->delete()) {
            $this->Flash->success(__('Usunięcie informacji'));
        } else {
            $this->Flash->error(__('Usunięcie informacji'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
