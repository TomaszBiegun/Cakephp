<?php
App::uses('AppController', 'Controller');

/**
 * Packs Controller
 *
 * @property Pack $Pack
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class PacksController extends AppController
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
        $this->Pack->recursive = 0;
        $this->set('packs', $this->Paginator->paginate());
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
        if (!$this->Pack->exists($id)) {
            throw new NotFoundException(__('Invalid pack'));
        }
        $options = array('conditions' => array('Pack.' . $this->Pack->primaryKey => $id));
        $this->set('pack', $this->Pack->find('first', $options));
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
            $this->Pack->create();
            if ($this->Pack->save($this->request->data)) {
                $this->Flash->success(__('Dodanie pakietu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie pakietu'));
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
        if (!$this->Pack->exists($id)) {
            throw new NotFoundException(__('Invalid pack'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Pack->save($this->request->data)) {
                $this->Flash->success(__('Edycja pakietu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja pakietu'));
            }
        } else {
            $options = array('conditions' => array('Pack.' . $this->Pack->primaryKey => $id));
            $this->request->data = $this->Pack->find('first', $options);
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
        $this->Pack->id = $id;
        if (!$this->Pack->exists()) {
            throw new NotFoundException(__('Invalid pack'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Pack->delete()) {
            $this->Flash->success(__('Usunięcie pakietu'));
        } else {
            $this->Flash->error(__('Usunięcie pakietu'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_saldo method.
     *
     * wyswietla w cmsie wszystkie transakcje dotyczace platnosci za pakiety
     */
    public function admin_saldo()
    {
        $this->loadModel('Payment');
        $this->layout = 'admin';
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $payments = $this->Paginator->paginate('Payment');
        $this->set(compact('payments'));

    }
}
