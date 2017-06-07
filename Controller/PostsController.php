<?php
App::uses('AppController', 'Controller');

/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class PostsController extends AppController
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
        $this->Post->recursive = 0;
        $this->set('posts', $this->Paginator->paginate());
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
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }
        $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
        $this->set('post', $this->Post->find('first', $options));
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
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Dodanie postu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie postu'));
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
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Edycja postu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja postu'));
            }
        } else {
            $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
            $this->request->data = $this->Post->find('first', $options);
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
        $this->Post->id = $id;
        if (!$this->Post->exists()) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Post->delete()) {
            $this->Flash->success(__('Usunięcie postu'));
        } else {
            $this->Flash->error(__('Usunięcie postu'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
