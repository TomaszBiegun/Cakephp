<?php
App::uses('AppController', 'Controller');

/**
 * Diets Controller
 *
 * @property Diet $Diet
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class DietsController extends AppController
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
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('api_get_diets'));
    }

    public function admin_index()
    {
        $this->loadModel('Recipe');
        $this->layout = 'admin';
        $this->Diet->recursive = 0;
        $diets = $this->Paginator->paginate();
        foreach ($diets as &$diet) {
            $recipes = $this->Recipe->find('all', array(
                'conditions' => array(
                    'Recipe.diet_name' => $diet['Diet']['name']
                )
            ));
            $diet['Diet']['count'] = count($recipes);


        }


        $this->set(compact('diets'));
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
        $this->loadModel('Recipe');
        $this->layout = 'admin';
        if (!$this->Diet->exists($id)) {
            throw new NotFoundException(__('Invalid diet'));
        }
        $options = array('conditions' => array('Diet.' . $this->Diet->primaryKey => $id));
        $diet = $this->Diet->find('first', $options);
        $recipes = $this->Recipe->find('all', array(
            'conditions' => array(
                'Recipe.diet_name' => $diet['Diet']['name']
            )
        ));
        $this->set(compact('diet', 'recipes'));
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
            $this->Diet->create();
            if ($this->Diet->save($this->request->data)) {
                $this->Flash->success(__('Dodanie diety'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie diety'));
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
        if (!$this->Diet->exists($id)) {
            throw new NotFoundException(__('Invalid diet'));
        }
        if ($this->request->is(array('post', 'put'))) {
//            debug($this->request->data);die();
            if ($this->Diet->save($this->request->data)) {
                $this->Flash->success(__('Edycja diety'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja diety'));
            }
        } else {
            $options = array('conditions' => array('Diet.' . $this->Diet->primaryKey => $id));
            $this->request->data = $this->Diet->find('first', $options);
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
        $this->Diet->id = $id;
        if (!$this->Diet->exists()) {
            throw new NotFoundException(__('Invalid diet'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Diet->delete()) {
            $this->Flash->success(__('Usunięcie diety'));
        } else {
            $this->Flash->error(__('Usunięcie diety'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    /**
     * api_get_diets method.
     *
     * opis w active collab
     */
    public function api_get_diets()
    {
        $this->layout = 'ajax';
        $this->render(false);

        header('Content-Type: application/json; charset=utf-8');
        $diets = $this->Diet->find('all');
        echo json_encode(array('diets' => $diets));


        die();
    }
}
