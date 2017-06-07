<?php
App::uses('AppController', 'Controller');

/**
 * Faqs Controller
 *
 * @property Faq $Faq
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class FaqsController extends AppController
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
        $this->Faq->recursive = 0;
        $this->set('faqs', $this->Paginator->paginate());
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
        if (!$this->Faq->exists($id)) {
            throw new NotFoundException(__('Invalid faq'));
        }
        $options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
        $this->set('faq', $this->Faq->find('first', $options));
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
            $this->Faq->create();
            if ($this->Faq->save($this->request->data)) {
                $this->Flash->success(__('Dodanie FAQ'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie FAQ'));
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
        if (!$this->Faq->exists($id)) {
            throw new NotFoundException(__('Invalid faq'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Faq->save($this->request->data)) {
                $this->Flash->success(__('Edycja FAQ'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja FAQ'));
            }
        } else {
            $options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
            $this->request->data = $this->Faq->find('first', $options);
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
        $this->Faq->id = $id;
        if (!$this->Faq->exists()) {
            throw new NotFoundException(__('Invalid faq'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Faq->delete()) {
            $this->Flash->success(__('Usunięcie FAQ'));
        } else {
            $this->Flash->error(__('Usunięcie FAQ'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
