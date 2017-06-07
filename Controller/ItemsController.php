<?php

/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 27.05.2016
 * Time: 10:59
 */
class ItemsController extends AppController
{
    public $components = array('Paginator', 'Flash', 'Session');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'view', 'basket_add', 'basket_update', 'basket_delete'));
    }

    public function index()
    {
        $this->Item->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10
        );

        $items = $this->Paginator->paginate();
        $this->set(compact('items'));
    }

    public function view($id = null)
    {
        $item = $this->Item->findById($id);

        $this->set(compact('item'));
    }

//    public function basket_add()
//    {
//        $this->render(false);
//        $this->layout = 'ajax';
//        if ($this->request->is('post')) {
//
//            $item_id = $this->request->data['item_id'];
//            $basket = $this->Session->read('basket');
//
//            if (($basket == null) || empty($basket)) {
//                $basket = array();
//
//            }
//
//            if (!in_array($item_id, $basket)) {
//                array_push($basket, $item_id);
//            }
//            $this->Session->write('basket', $basket);
//            echo json_encode('done');
//            die();
//        }
//    }
//
//    public function basket_update()
//    {
////        $this->render(false);
//        $this->layout = 'ajax';
//        if ($this->request->is('post')) {
//            $basket = $this->Session->read('basket');
//            $items = array();
//            if ($basket != null) {
//                $items = $this->Item->find('all', array(
//                    'conditions' => array(
//                        'Item.id IN' => $basket
//                    )
//                ));
//            }
//
//
//            $view = new View($this, false);
//
//            $content = $view->element('items', array('items' => $items));
////            $this->set(compact('items'));
//
//            echo $content;
//
//            die();
//        }
//    }
//
//    public function basket_delete()
//    {
//        $this->render(false);
//        $this->layout = 'ajax';
//        if ($this->request->is('post')) {
//            $item_id = $this->request->data['item_id'];
//            $basket = $this->Session->read('basket');
//            if (($key = array_search($item_id, $basket)) !== false) {
//                unset($basket[$key]);
//            }
//            $this->Session->write('basket', $basket);
//        }
//    }

    public function admin_index()
    {
        $this->layout = 'admin';
        $this->Item->recursive = 0;
        $this->set('items', $this->Paginator->paginate());
    }

    public function admin_add()
    {
        $this->layout = 'admin';
        if ($this->request->is('post')) {
            $this->Item->create();
            if ($this->Item->save($this->request->data)) {
                $this->Flash->success(__('Dodanie przedmiotu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie przedmiotu'));
            }
        }
    }

    public function admin_view($id = null)
    {
        $this->layout = 'admin';
        $item = $this->Item->findById($id);

        $this->set(compact('item'));
    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin';
        if (!$this->Item->exists($id)) {
            throw new NotFoundException(__('Invalid step'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Item->save($this->request->data)) {
                $this->Flash->success(__('Edycja przedmiotu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja przedmiotu'));
            }
        } else {
            $options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
            $this->request->data = $this->Item->find('first', $options);
        }
    }

    public function admin_delete($id = null)
    {
        $this->layout = 'admin';
        $this->render(false);
        $this->Item->id = $id;
        if (!$this->Item->exists()) {
            throw new NotFoundException(__('Invalid item'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Item->delete()) {
            $this->Flash->success(__('Usunięcie przedmiotu'));
        } else {
            $this->Flash->error(__('Usunięcie przedmiotu'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}