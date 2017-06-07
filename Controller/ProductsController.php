<?php
App::uses('AppController', 'Controller');

/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class ProductsController extends AppController
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
        $this->loadModel('Group');
        $this->Product->recursive = 0;
        $products = $this->Paginator->paginate();
        foreach ($products as &$product) {
            $tmp = $this->Group->findById($product['Product']['group_id']);
            $product['Product']['group_name'] = $tmp['Group']['name'];

        }

        $this->set(compact('products'));
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
        $this->loadModel('Componnent');
        $this->layout = 'admin';
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }

        $product = $this->Product->find('first', array('conditions' => array('Product.id' => $id), 'recursive' => -1));
        $this->Paginator->settings = array(
            'conditions' => array(
                'Componnent.product_id' => $id
            ),
            'limit' => 20,
            'order' => array('Componnent.id' => 'asc')

        );
        $components = $this->Paginator->paginate('Componnent');
        $this->set(compact('product', 'components'));
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
            $this->Product->create();
            if ($this->Product->save($this->request->data)) {
                $this->Flash->success(__('Dodanie produktu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie produktu'));
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
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Product->save($this->request->data)) {
                $this->Flash->success(__('Edycja produktu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja produktu'));
            }
        } else {
            $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $this->request->data = $this->Product->find('first', $options);
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
        $this->reder('false');
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Product->delete()) {
            $this->Flash->success(__('Usunięcie produktu'));
        } else {
            $this->Flash->error(__('Usunięcie produktu'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
