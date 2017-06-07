<?php
App::uses('AppController', 'Controller');

/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CommentsController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('add'));
    }

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session');

    public function add()
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->response->type('json');
        if ($this->request->is('ajax')) {


            $this->Comment->create();
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->success('Dodanie komentarza');
                echo json_encode(array('save' => true));
            }

        }
    }
}
