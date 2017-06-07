<?php
App::uses('AppController', 'Controller');

/**
 * Quizzes Controller
 *
 * @property Quiz $Quiz
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class QuizzesController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash', 'Session');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('add', 'test', 'pre_load_quiz_page', 'create_diet_plan', 'logged_have_quiz'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->layout = 'admin';
        $this->Quiz->recursive = 0;
        $this->set('quizzes', $this->Paginator->paginate());
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
        if (!$this->Quiz->exists($id)) {
            throw new NotFoundException(__('Invalid quiz'));
        }
        $options = array('conditions' => array('Quiz.' . $this->Quiz->primaryKey => $id));
        $this->set('quiz', $this->Quiz->find('first', $options));
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
            $this->Quiz->create();
            if ($this->Quiz->save($this->request->data)) {
                $this->Flash->success(__('Dodanie quizu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie quizu'));
            }
        }
        $users = $this->Quiz->User->find('list');
        $this->set(compact('users'));
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
        if (!$this->Quiz->exists($id)) {
            throw new NotFoundException(__('Invalid quiz'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Quiz->save($this->request->data)) {
                $this->Flash->success(__('Edycja quizu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja quizu'));

            }
        } else {
            $options = array('conditions' => array('Quiz' . $this->Quiz->primaryKey => $id));
            $this->request->data = $this->Quiz->find('first', $options);
        }
        $users = $this->Quiz->User->find('list');
        $this->set(compact('users'));
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
        $this->Quiz->id = $id;
        if (!$this->Quiz->exists()) {
            throw new NotFoundException(__('Invalid quiz'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Quiz->delete()) {
            $this->Flash->success(__('Usunięcie quizu'));
        } else {
            $this->Flash->error(__('Usunięcie quizu'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * add method.
     *
     * ustalenie jakich produktow nie chcemy, uporzadkowanie requesta z quizu i zapis do sesji
     * po tej akcji kieruje do podsumowania na kalkulatorze
     *
     * tutaj tez rozpatruje czy jedna osoba czy dwie w quizie sa
     *
     * jezeli sa wczesniejsze quizy z tego maila to je usuwam
     */
    public function add()
    {
        $this->loadModel('Group');
        $this->loadModel('Nowantedproduct');
        $this->loadModel('UserRecipe');
        $this->loadModel('Recipe');
        $this->loadModel('Diet');
        $this->loadModel('User');
        $user_mail = $this->Session->read('user_mail');
//        $logged_have_quiz = $this->logged_have_quiz();
//        $logged_have_quiz = $this->logged_have_quiz();

        if ($this->Auth->user()) {
            $user_quiz = $this->Quiz->find('first', array(
                'conditions' => array(
                    'Quiz.user_mail' => $user_mail
                ),
                'order' => array(
                    'Quiz.created' => 'desc'
                )
            ));

            if (isset($user_quiz['Quiz']['id'])) {
                $logged_have_quiz = true;
            } else {
                $logged_have_quiz = false;
            }
            $no_products = null;
            if (!empty($user_quiz['Nowantedproduct'])) {
                foreach ($user_quiz['Nowantedproduct'] as $key => $one) {
                    $no_products[$key] = $one['product_id'];
                }
            }
        }


        if ($this->request->is('post')) {

            $this->render(false);
            $this->layout = 'ajax';
            $data1 = array();
            foreach ($this->request->data['quiz1'] as $tmp) {
                $data1[$tmp['name']] = $tmp['value'];
            }
            foreach ($this->request->data['quiz2'] as $tmp) {
                $data2[$tmp['name']] = $tmp['value'];
            }

            if ($data1['goal_question'] == '2') {
                $data1['goal'] = '0';
            }
            if ($data1['activity'] == '0') {
                $data1['activity'] = '';
            }
            if ($data2['activity'] == '0') {
                $data2['activity'] = '';
            }
            if ($data1['diet_id'] == 0) {
                $data1['diet_id'] = '';
            }
            if ($data1['meal_count'] == 0) {
                $data1['meal_count'] = '';
            }
            if ($data1['level'] == 0) {
                $data1['level'] = '';
            }
            if ($data1['adult_count'] == 0 || $data1['adult_count'] == '') {
                $data1['adult_count'] = 1;
            }

            $this->Quiz->create($data1);
            $this->Quiz->set($data1);
            if ($this->Quiz->validates($data1)) {
                if ($data1['adult_count'] == 2) {
                    $this->Quiz->create($data2);
                    $this->Quiz->set($data2);
                    if ($this->Quiz->validates($data2)) {
                        //jezeli dwie osoby wypelniaja quiz

                        $quiz_data_2 = $data2;
                        $quiz_data = $data1;
                        $this->Session->write('quiz_data', $quiz_data);
                        $this->Session->write('quiz_data_2', $quiz_data_2);

                        $this->clear_before_create($quiz_data['user_mail']);


                        echo json_encode('done');
                        die();


                    } else {

                        echo json_encode(array('error-2' => $this->Quiz->validationErrors));
                        die();
                    }
                } else {
                    //jezeli jedna osoba wypelnia quiz

                    $quiz_data = $data1;
                    $this->Session->write('quiz_data', $quiz_data);
//                    $quiz_data['meal_count'] = $this->meal_count[$quiz_data['meal_count']];
                    $this->clear_before_create($quiz_data['user_mail']);
                    echo json_encode('done');
                    die();

                }
//                $groups = $this->request->data['Group'];


            } else {

                echo json_encode(array('error' => $this->Quiz->validationErrors));
                die();

            }


        }


        $groups = $this->Group->find('all', array(
            'conditions' => array(
                'Group.name !=' => '-'
            ),
            'fields' => array(
                'Group.name',
                'Group.id'
            )
        ));

        $this->set(compact('groups', 'user_mail', 'user_quiz', 'no_products', 'logged_have_quiz'));


    }

    /**
     * create_diet_plan method.
     *
     * najwazniejsza funkcja - cale mięcho
     * w sesji mam dane z quizu, czytam je
     * w zaleznosci od wszystkich uwarunkowan wyszukuje przepisy
     * ustawiam je w kolejnosci sniadanie,sniadanie2,obiad,podwieczorek,kolacja
     * sprawdzam czy zostalo oplacone konto
     *
     * i na koniec zapisuje pierwszy wpis do tabeli charts to jest zarejestrowanie pierwszej wagi uzytkownika do wykresu
     * @return \Cake\Network\Response|null
     * @throws Exception
     */
    public function create_diet_plan()
    {


        $this->loadModel('Diet');
        $this->loadModel('Recipe');
        $this->loadModel('Nowantedproduct');
        $this->loadModel('RecipeProduct');
        $this->loadModel('UserRecipe');
        $this->loadModel('Chart');
        $this->loadModel('Payment');
        $this->layout = 'ajax';
        $this->render(false);
        $quiz_data = $this->Session->read('quiz_data');
        $quiz_data_2 = $this->Session->read('quiz_data_2');
        $quiz_data_2['user_mail'] = $quiz_data['user_mail'];
        $quiz_data_2['meal_count'] = $quiz_data['meal_count'];
        $quiz_data_2['goal'] = $quiz_data['goal'];
        $quiz_data['user_name'] = $quiz_data['name'];

        $quiz_data['tdeg'] = $this->TDEG($quiz_data);


        if (isset($quiz_data_2['height']) && $quiz_data_2['height'] != null) {
            $quiz_data_2['tdeg'] = $this->TDEG($quiz_data_2);
        }


        $groups = array();
        foreach ($quiz_data as $key => $item) {
            if (strpos($key, 'Group') !== false) {
//                $groups[] = $this->Nowantedproduct->find('all',array(
//                    'conditions'=>array(
//                        'Nowantedproduct.id'
//                    )
//                ));
                $groups[] = $item;
            }


        }


        $diet = $this->Diet->find('first', array(
            'conditions' => array(
                'Diet.id' => $quiz_data['diet_id']
            )
        ));


        $quiz_meal_count = $this->meal_count[$quiz_data['meal_count']];


        $recipes['breckfast'] = null;
        $recipes['breckfast2'] = null;
        $recipes['dinner'] = null;
        $recipes['supper'] = null;
        $recipes['tea'] = null;

        $level = $quiz_data['level'] - 1;


        $recipes['breckfast'] = $this->Recipe->find('all', array(
            'conditions' => array(
                'AND' => array(
                    array('Recipe.diet_name' => $diet['Diet']['name']),
                    array('Recipe.type' => 'śniadanie'),
                    array('Recipe.level' => $level),
                    array('Recipe.veryfied' => 1)
                )

            ),
            'fields' => 'Recipe.id'
        ));

        $recipes['dinner'] = $this->Recipe->find('all', array(
            'conditions' => array(
                'AND' => array(
                    array('Recipe.diet_name' => $diet['Diet']['name']),
                    array('Recipe.type' => 'obiad'),
                    array('Recipe.level' => $level),
                    array('Recipe.veryfied' => 1)
                )

            ),
            'fields' => 'Recipe.id'
        ));
//        $recipes['dinner']['Recipe']['tmp_lp'] = 3;
        $recipes['supper'] = $this->Recipe->find('all', array(
            'conditions' => array(
                'AND' => array(
                    array('Recipe.diet_name' => $diet['Diet']['name']),
                    array('Recipe.type' => 'kolacja'),
                    array('Recipe.level' => $level),
                    array('Recipe.veryfied' => 1)
                )

            ),
            'fields' => 'Recipe.id'
        ));


//        $recipes['supper']['Recipe']['tmp_lp'] = 5;

        if ($quiz_meal_count > 3) {
            $recipes['breckfast2'] = $this->Recipe->find('all', array(
                'conditions' => array(
                    'AND' => array(
                        array('Recipe.diet_name' => $diet['Diet']['name']),
                        array('Recipe.type' => 'śniadanie2'),
                        array('Recipe.level' => $level),
                        array('Recipe.veryfied' => 1)
                    )

                ),
                'fields' => 'Recipe.id'
            ));
//            $recipes['breckfast2']['Recipe']['tmp_lp'] = 2;
            if ($quiz_meal_count > 4) {
                $recipes['tea'] = $this->Recipe->find('all', array(
                    'conditions' => array(
                        'AND' => array(
                            array('Recipe.diet_name' => $diet['Diet']['name']),
                            array('Recipe.type' => 'podwieczorek'),
                            array('Recipe.level' => $level),
                            array('Recipe.veryfied' => 1)
                        )

                    ),
                    'fields' => 'Recipe.id'
                ));
//                $recipes['tea']['Recipe']['tmp_lp'] = 4;
            } else {
                unset($recipes['tea']);
            }
        } else {
            unset($recipes['breckfast2']);
            unset($recipes['tea']);
        }


        $wanted_ids = array();

        if (empty($recipes['breckfast']) || empty($recipes['dinner']) || empty($recipes['supper'])) {
            $this->Session->write('error', true);
            $this->Flash->error('Zapisanie quizu');
            return $this->redirect(array('controller' => 'users', 'action' => 'mydiet'));
        }

        foreach ($recipes as $key => $recipe) {
            $wanted_ids[$key] = array();
            foreach ($recipe as $item) {
                array_push($wanted_ids[$key], $item['Recipe']['id']);
            }
        }


//        $groups[4]=6;


//        die();


        foreach ($wanted_ids as $key => $wanted_id) {
            if (isset($groups[0])) {
                $final_filtered_recipe_ids = $this->RecipeProduct->query('
SELECT DISTINCT(RecipeProduct.recipe_id)  FROM recipe_product AS RecipeProduct WHERE RecipeProduct.recipe_id NOT IN
 (SELECT DISTINCT(recipe_product.recipe_id) FROM recipe_product WHERE recipe_product.group_id IN (' . implode(',', $groups) . ')) AND RecipeProduct.recipe_id IN (' . implode(',', $wanted_id) . ')');

            } else {
                $final_filtered_recipe_ids = $this->RecipeProduct->find('all', array(
                    'conditions' => array(
                        'RecipeProduct.recipe_id IN' => $wanted_ids[$key]
                    ),
                    'fields' => 'RecipeProduct.recipe_id',
                    'group' => array('RecipeProduct.recipe_id')
                ));
            }

            if ($final_filtered_recipe_ids == null || empty($final_filtered_recipe_ids)) {
                $this->Session->write('error', true);
                $this->Flash->error('Zapisanie quizu');
                return $this->redirect(array('controller' => 'users', 'action' => 'mydiet'));
            }


            $final_ids[$key] = array();
            foreach ($final_filtered_recipe_ids as $iterator => $filtered_recipe_id) {

                array_push($final_ids[$key], $filtered_recipe_id['RecipeProduct']['recipe_id']);

            }

        }



        $tmp_lp['breckfast'] = 1;
        $tmp_lp['breckfast2'] = 2;
        $tmp_lp['dinner'] = 3;
        $tmp_lp['tea'] = 4;
        $tmp_lp['supper'] = 5;


//        die();
        $payment = $this->Payment->find('first', array(
                'conditions' => array(
                    'Payment.user_mail' => $quiz_data['user_mail']
                ),
                'order' => array(
                    'Payment.created' => 'desc'
                )
            )
        );
        $days = 31;
        if (!empty($payment) && ($payment['Payment'] != null)) {
            $quiz_data['active'] = 1;
            $seconds = strtotime($payment['Payment']['due_date']) - strtotime($payment['Payment']['created']);
            $days = $seconds / 86400;
            $days++;
        }


        $dataSource = $this->Quiz->getDataSource();
        set_time_limit(0);

        $dataSource->begin();


        $this->Quiz->create($quiz_data);
        if ($data = $this->Quiz->save($quiz_data)) {
            $chart_data = array(
                'user_mail' => $quiz_data['user_mail'],
                'weight' => $quiz_data['weight'],
                'bmi' => $quiz_data['bmi']
            );
            $this->Chart->create($chart_data);
            $this->Chart->save($chart_data);


            if (isset($quiz_data_2['height']) && $quiz_data_2['height'] != null) {
                $this->Quiz->create($quiz_data_2);
                $this->Quiz->save($quiz_data_2);
            }


            $quiz_id = $data['Quiz']['id'];
            foreach ($groups as $group_id) {
                $this->Nowantedproduct->query('INSERT INTO nowantedproducts (quiz_id, product_id) VALUES (' . $quiz_id . ',' . $group_id . ')');
            }


            for ($i = 0; $i < $days; $i++) {
                foreach ($final_ids as $key => $final_id) {
                    if ($final_ids[$key] != null && !empty($final_ids[$key])) {
                        $userRecipe = array(
                            'user_mail' => $data['Quiz']['user_mail'],
                            'recipe_id' => $final_ids[$key][array_rand($final_ids[$key], 1)],
                            'lp' => $tmp_lp[$key],
                            'date' => date('Y-m-d', strtotime(' +' . $i . ' day'))
                        );


                        $this->UserRecipe->create($userRecipe);
                        $this->UserRecipe->save($userRecipe);
                    }

                }

            }


            $this->Session->delete('quiz_data');
            $this->Session->delete('quiz_data_2');

            $dataSource->commit();
            $this->Flash->success('Zapisanie quizu');
            return $this->redirect(array('controller' => 'users', 'action' => 'mydiet'));

        }

        $this->Flash->error('Zapisanie quizu');
        return $this->redirect($this->referer());
//        } catch (Exception $e) {

//
//        }
    }

    /**
     * pre_load_quiz_page method.
     *
     * nie wiem po co to ale jest i ma sie dobrze
     * zapis maila do sesji
     * @param null $mail
     */
    public function pre_load_quiz_page($mail = null)
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->Session->write('user_mail', $mail);
        $this->redirect(array('controller' => 'quizzes', 'action' => 'add'));
    }


}
