<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class UsersController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $helpers = array('Media.Media');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('chart_change_scale', 'api_get_history', 'admin_login', 'api_get_weight', 'api_set_weight', 'forgot', 'register', 'confirm', 'api_get_mydiet', 'api_edit_account', 'get_shoppinglist', 'login', 'test_pay', 'login_facebook', 'myscore', 'shoppinglist', 'vote', 'generate_pdf', 'api_register', 'api_login', 'api_logout', 'api_login_facebook'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->layout = 'admin';
        $this->User->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10
        );

        $users = $this->Paginator->paginate();
        $this->set(compact('users'));
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
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
            $this->request->data['User']['hash'] = md5($this->request->data['User']['name'] . $this->request->data['User']['mail'] . time());
            $this->request->data['User']['active'] = 1;

//            $this->request->data['User']['file']="";
            unset($this->User->validate['password']);

//            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $Email = new CakeEmail('smtp');
                $Email->to($this->request->data['User']['mail']);
                $Email->template('confirm', 'default');
                $Email->emailFormat('html');
                $Email->subject('GreenCook - Aktywacja konta');
                $Email->viewVars(array('user_name' => $this->request->data['User']['name'], 'link' => 'http://' . $_SERVER['SERVER_NAME'] . '/users/confirm/' . $this->request->data['User']['hash']));
                $Email->send();
                $this->Flash->success('Wysłanie linku aktywacyjnego na podany adres e-mail');
                return $this->redirect(array('action' => 'index'));
            } else {
                debug($this->User->validationErrors);
                die();
                $this->Flash->error('Dodanie nowego użytkownika');
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success("Edycja użytkownika");
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error('Edycja użytkownika');
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
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
        $this->autoRender = false;
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $this->Flash->success('Usunięcie użytkownika');
        } else {
            $this->Flash->error('Usunięcie użytkownika');
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_login()
    {
        $this->layout = 'login';
        if ($this->request->is('post')) {

            $user = $this->User->findByMail($this->request->data['User']['mail']);
            if ($user['User']['role'] == 1) {
                if ($this->Auth->login()) {
                    $this->Flash->login('log', array('params' => array('status' => 0, 'role' => 1)));
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->login('log', array('params' => array('status' => 1, 'role' => 1)));
            } else {
                $this->Flash->login('log', array('params' => array('status' => 1, 'role' => 1)));
                return $this->redirect($this->referer());
            }

        }
    }


    /**
     * Login method
     *
     *  Funkcja sprawdza czy logowanie nastąpiło po wypełnieniu quizu
     * jezeli tak to przenosi do /quizzes/create_diet_plan
     * jezeli zalogowal sie admin to wyswietla komunikat ze konto typu administratora i uniemozliwia zalogowanie
     * jezeli wszystko sie udalo to loguje
     * jezeli wystapil jakis blad to wyswietla komunikat o blednych danych
     */
    public function login()
    {
        $this->loadModel('Chart');
        $this->layout = 'ajax';
        $this->render(false);

        if ($this->request->is('post')) {

            $referer = $this->referer();
            $referer = substr($referer, 10, strlen($referer));

            $ctrl = null;
            $act = null;


            $referer = explode('/', $referer);
            if (isset($referer[1]) && isset($referer[2])) {
                $ctrl = $referer[1];
                $act = $referer[2];
            }


            $user = $this->User->findByMail($this->request->data['User']['mail']);


            $this->User->create($this->request->data);


            if (isset($user['User'])) {

//                if ($this->User->validates($this->request->data)) {

                if ($user['User']['active'] == 1) {
                    if ($user['User']['role'] == 0) {
                        if ($this->Auth->login()) {
                            $this->Flash->login('log', array('params' => array('status' => 0, 'role' => 0)));
                            if (($ctrl == 'pages') && ($act == 'calculator')) {
                                echo json_encode(array('logged' => 'afterQuiz'));
                            } else {

                                echo json_encode(array('logged' => true));
                            }
                        } else {
                            echo json_encode(array('logged' => false));
                        }
                    } else {
                        echo json_encode(array('logged' => 'admin'));

                    }


                } else {
                    echo json_encode(array('logged' => 'nonactive'));
                }

//                } else {
//                    debug($this->User->validationErrors);
//                    die();
//                    echo json_encode(array('logged' => false));
//                }
            } else {
                echo json_encode(array('error' => 'mail'));
            }

        }


    }


    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function admin_logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * register method.
     *
     * przy rejestracju robi hasha uzytkownika - md5 z imienia,maila oraz czasu
     * wysyla maila z linkiem aktywacyjnym
     * funkcja, ktora aktywuje zaweira wygenerowanego hasha i odnosi sie do users/confirm
     *
     */
    public function register()
    {
        $this->layout = 'ajax';
        $this->render(false);
//        $this->User->Behaviors->unload('Translate');
        if ($this->request->is('post')) {
//            debug($this->request->data);die();
            $this->request->data['User']['active'] = 0;
            $this->request->data['User']['role'] = 0;
            $this->request->data['User']['hash'] = md5($this->request->data['User']['name'] . $this->request->data['User']['mail'] . time());
            $this->User->create($this->request->data);
            if ($this->User->validates($this->request->data)) {
                if ($this->User->save($this->request->data)) {
                    $Email = new CakeEmail('smtp');
                    $Email->to($this->request->data['User']['mail']);
                    $Email->template('confirm', 'default');
                    $Email->emailFormat('html');
                    $Email->subject('GreenCook - Aktywacja konta');
                    $Email->viewVars(array('user_name' => $this->request->data['User']['name'], 'link' => 'http://' . $_SERVER['SERVER_NAME'] . '/users/confirm/' . $this->request->data['User']['hash']));
                    $Email->send();
                    $this->Flash->success('Wysłanie linku aktywacyjnego na podany adres e-mail');
                    echo json_encode(true);
                } else {
                    $this->Flash->error('Wysłanie linku aktywacyjnego na podany adres e-mail');

                }
            } else {
//                debug($this->User->validationErrors);
//                die();
                $errors = $this->User->validationErrors;
//                if (!empty($errors['password'])) {
//                    unset ($errors['password']);
//                }

                echo json_encode($errors);
            }


        }


    }

    /**
     * confirm method.
     *
     * @param null $hash
     * @return \Cake\Network\Response|null
     *
     * funkcja wywolywana z maila uzytkownika po rejestracji
     * sprawdzam czy hash wystepuje w bazie jezeli tak to zmieniam pole active na 1
     */
    public function confirm($hash = null)
    {
        $this->layout = 'ajax';
        $this->render(false);
        $user = $this->User->findByHash($hash);


        if (!empty($user)) {
            $this->User->query('UPDATE users SET active = 1 WHERE id = ' . $user['User']['id']);
            $this->Flash->success('Aktywacja konta');
        } else {
            $this->Flash->error('Aktywacja konta');
        }

        return $this->redirect(array('controller' => 'pages', 'action' => 'home'));


    }

    /**
     * forgot method.
     *
     * @return \Cake\Network\Response|null
     *
     * wykonywana po kliknieciu zapomnialem hasla na froncie w modalu logowania
     * ustawia nowe haslo, z funkcji passGenerate w modelu User
     * wysyla maila uzytkownikowi z potwierdzenie zmiany hasla oraz wygenerowanym haslem
     */
    public function forgot()
    {

        $this->layout = 'ajax';
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $mail = $this->request->data['mail'];
            $user = $this->User->findByMail($mail);


            if (!empty($user) && $user != null) {

                $user['User']['password'] = $this->User->passGenerate();
                $password = $user['User']['password'];
                if (isset($user['User']['file']) && (!empty($user['User']['file']))) {
                    unset($user['User']['file']);
                }
                $this->User->save($user, false);
                $Email = new CakeEmail('smtp');
                $Email->to($mail);
                $Email->template('forgot', 'default');
                $Email->emailFormat('html');
                $Email->subject('GreenCook - przypomnienie hasła');
                $Email->viewVars(array('user_name' => $user['User']['name'], 'link' => 'http://' . $_SERVER['SERVER_NAME'], 'password' => $password));
                $Email->send();
                $this->Flash->success('Wysłanie wiadomości e-mail z hasłem');

            } else {
                $this->Flash->error('Wysłanie wiadomości e-mail z hasłem');
            }

            return $this->redirect($this->referer());

        }

    }

    /**
     * account method
     *
     * @return \Cake\Network\Response|null
     *
     * funkcja pobiera informacje na temat wplat uzytkownika z koszyka oraz za pakiety
     * obsługuje edycje danych konta użytkownika
     *
     */
    public function account()
    {
        $this->loadModel('Payment');
        $this->loadModel('Pack');
        $this->loadModel('Basket');
        if (!$this->User->exists($this->Auth->user('id'))) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {

            if ($this->User->save($this->request->data)) {
                $this->Flash->success("Edycja użytkownika");
                return $this->redirect(array('controller' => 'users', 'action' => 'account'));
            } else {
                $this->Flash->error('Edycja użytkownika');
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id')));
            $acc = $this->request->data = $this->User->find('first', $options);

            $payment = $this->Payment->find('first', array(
                'conditions' => array(
                    'Payment.user_mail' => $this->Auth->user('mail')
                ),
                'order' => array('Payment.created' => 'desc')
            ));
            $payments = $this->Payment->find('all', array(
                'conditions' => array(
                    'Payment.user_mail' => $this->Auth->user('mail')
                ),
                'order' => array('Payment.created' => 'desc')
            ));
            $baskets = $this->Basket->find('all', array(
                'conditions' => array(
                    'Basket.user_mail' => $this->Auth->user('mail')
                )
            ));
            if (!empty($payment['Payment']['id']) && $payment['Payment']['id'] != null) {
                $pack = $this->Pack->findById($payment['Payment']['pack_id']);
                $this->set(compact('pack', 'payment', 'payments'));
            }
            $this->set(compact('acc', 'baskets'));
        }
    }


    /**
     * login_facebook method.
     *
     * @param null $user_name
     * @param null $user_surname
     * @param null $fb_id
     * @param null $user_email
     * @return \Cake\Network\Response|null
     *
     * jezeli dany uzytkownik juz logowal sie z facebookiem i w ten sposob zostalo utworzone konto to loguje go odrazu
     * jezeli uzytkownika nie ma w bazie i loguje sie w facebookiem to zakladam konto i go loguje
     */
    public function login_facebook($user_name = null, $user_surname = null, $fb_id = null, $user_email = null)
    {
        $this->layout = 'ajax';
        $this->render(false);

        $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.mail' => $user_email
                )
            )
        );


        if (!empty($user)) {
            $user = array_shift($user);
            if ($this->Auth->login($user)) {
                $this->Flash->success("Zalogowanie przez Facebook");
                return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
            }

        } else {
            $user['mail'] = $user_email;
            $user['fb_id'] = $fb_id;
            $user['name'] = $user_name;
            $user['surname'] = $user_surname;
            $user['active'] = 1;
            $this->User->create();
            if ($id = $this->User->save($user)) {
                $user['id'] = $id['User']['id'];
                if ($this->Auth->login($user)) {

                    $this->Flash->success("Zalogowanie przez Facebook");
                    return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
                }

            }

        }

    }

    /**
     * mydiet method.
     *
     * dostep ma tylko uzytkownik z oplaconym pakietem oraz zalogowany
     * sprawdzam czy uzytkownik jest zalgoowany nastepnie pobieram przepisy mu przypisane po zrobieniu quizu
     * dopasowuje date do bardziej przyjaznej wersji - funkcja nice_day
     *
     * zmienna now wyswietla dzisiejsza date
     *
     * zmienna diff to roznica daty wykupienia pakietu oraz odpowiednio daty wygasniecia waznosci
     * roznica pomiedzy nimi to strona w paginacji aby uzytkownik widzial zawsze przepisy na terazniejszy dzien
     *
     */
    public function mydiet()
    {

        $mail = $this->Auth->user('mail');

        $this->loadModel('UserRecipe');
        $this->loadModel('Recipe');
        $this->loadModel('Vote');
        $this->loadModel('Payment');
        $this->loadModel('Quiz');
        $error = $this->Session->read('error');

        if ($this->Auth->user()) {
            $payment = $this->Payment->find('first', array(
                'conditions' => array(
                    'Payment.user_mail' => $this->Auth->user('mail')
                )
            ));
            if (isset($payment['Payment'])) {
                $start_date = $payment['Payment']['created'];
                $diff = ((strtotime(date('Y-m-d')) - strtotime($start_date)) / 86400) + 1;
            } else {
                $diff = 0;
            }


        }
        $quiz = $this->Quiz->find('first', array(
            'conditions' => array(
                'Quiz.user_mail' => $mail
            )
        ));
        if (isset($quiz['Quiz'])) {
            $this->Paginator->settings = array(
                'conditions' => array('UserRecipe.user_mail' => $mail),
                'limit' => $this->meal_count[$quiz['Quiz']['meal_count']],
                'order' => array(
                    'UserRecipe.date' => 'asc'
                ),
                'page' => $diff
            );
        }


        $userRecipe = $this->Paginator->paginate('UserRecipe');
        if ($userRecipe != null && !empty($userRecipe)) {
            $date = $this->nice_day($userRecipe[0]['UserRecipe']['date']);
        } else {
            $date = $this->nice_day(date('Y-m-d'));
        }


        $now = $currentPage = $this->request->paging['UserRecipe']['page'];


        foreach ($userRecipe as $key => $item) {
            $recipe = $this->Recipe->find('first', array(
                'conditions' => array(
                    'Recipe.id' => $item['UserRecipe']['recipe_id']
                )
            ));

            $permissions = $this->Vote->find('all', array(
                'conditions' => array(
                    'AND' => array(
                        'Vote.user_id' => $this->Auth->user('id'),
                        'Vote.recipe_id' => $item['UserRecipe']['recipe_id']
                    )

                )
            ));

            if ((!empty($permissions)) && $permissions != null) {
                $recipe['Recipe']['permission'] = 'denied';
            } else {
                $recipe['Recipe']['permission'] = 'agree';
            }
            $recipe['Recipe']['date'] = $date;
            $recipes[$key] = $recipe;
        }


        if ($error) {
            $this->set(array('error' => true));
        } else {
            $this->set(array('error' => false));
        }
        $this->Session->delete('error');
        $this->set(compact('recipes', 'quiz', 'date', 'now'));
    }

    /**
     * myscore method.
     *
     * cel postawiony przez uzytkownika podczas quizu, dana do wykresu
     */
    public function myscore()
    {
        $this->loadModel('Quiz');
        $quiz_data = $this->Quiz->find('first', array(
            'conditions' => array(
                'Quiz.user_mail' => $this->Auth->user('mail')
            ),
            'recursive' => -1
        ));
        $goal = 0;
        if (!empty($quiz_data) && ($quiz_data != null)) {
            $goal = $quiz_data['Quiz']['weight'] - $quiz_data['Quiz']['goal'];

        }

        $this->set(compact('goal'));

    }

    /**
     * chart_save_data method.
     *
     * przyjmuje wage wpisana z wykresu
     * z racji tego ze dostep ma tylko zalogowany uzytkownik szukam usera po mailu z autha
     *
     * obliczam bmi sciagajac jego wzrost z danych w quizie
     * sprawdzam czy dzisiaj juz dane byly wprowadzane, jezeli nie to je tworze jezeli byly to je edytuje
     */
    public function chart_save_data()
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->loadModel('Quiz');
        $this->loadModel('Chart');
        if ($this->request->is('post')) {
            $weight_today = $this->request->data['weight'];
            $quiz_data = $this->Quiz->find('first', array(
                'conditions' => array(
                    'Quiz.user_mail' => $this->Auth->user('mail')
                ),
                'recursive' => -1
            ));
            $bmi = ($weight_today / (($quiz_data['Quiz']['height'] / 100) * ($quiz_data['Quiz']['height'] / 100)));
            $bmi = round($bmi, 2);
            $chart_data = $this->Chart->find('first', array(
                'conditions' => array(
                    'Chart.user_mail' => $this->Auth->user('mail'),
                    'Chart.created' => date('Y-m-d')
                )
            ));
            if (!empty($chart_data) && ($chart_data != null)) {
                $chart_data['Chart']['weight'] = $weight_today;
                $chart_data['Chart']['bmi'] = $bmi;
                $this->Chart->create();
                $this->Chart->save($chart_data);
            } else {
                $data = array(
                    'weight' => $weight_today,
                    'bmi' => $bmi,
                    'user_mail' => $this->Auth->user('mail')
                );
                $this->Chart->create();
                $this->Chart->save($data);
            }
            echo json_encode(array('weight' => $weight_today, 'bmi' => $bmi));


        }
    }

    /**
     * get_chart_data method.
     *
     * na podstawie wykupionego pakietu mam date wyjsciowa oraz date konca
     * pobieram dni do wykresu na osi
     * szukam pierwszego wpisu w tabelu charts dla danego uzytkownika po mailu
     * zawsze bedzie chciazby jeden wpis, poniewaz przy sapisie quizu uzupelniam juz, bo mam dane
     * luki uzupelniam powielajac poprzedni wpi
     *
     */
    public function get_chart_data()
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->loadModel('Chart');
        $this->loadModel('Payment');
        $months = array('Jan' => 'Styczeń',
            'Feb' => 'Luty',
            'Mar' => 'Marzec',
            'Apr' => 'Kwiecień',
            'May' => 'Maj',
            'Jun' => 'Czerwiec',
            'Jul' => 'Lipiec',
            'Aug' => 'Sierpień',
            'Sep' => 'Wrzesień',
            'Oct' => 'Październik',
            'Nov' => 'Listopad',
            'Dec' => 'Grudzień'
        );
        $payment = $this->Payment->find('first', array(
            'conditions' => array(
                'Payment.user_mail' => $this->Auth->user('mail')
            ),
            'order' => array(
                'Payment.created' => 'desc'
            )


        ));

        $weights = array();
        $bmis = array();
        $days = array();
        if (!empty($payment) && ($payment != null)) {
            $due_date = $payment['Payment']['due_date'];
            $start_date = $payment['Payment']['created'];

            $final_it = strtotime($due_date) - strtotime($start_date);
            $final_it = ($final_it / 86400) + 1;


            for ($i = 0; $i < $final_it; $i++) {
                $pieces = explode(" ", date('d M', strtotime($start_date . ' +' . $i . ' days')));

                $days[$i] = $pieces[0] . ' ' . $months[$pieces[1]];
                if (date('Y-m-d', strtotime($start_date . ' +' . $i . ' days')) <= date('Y-m-d')) {


                    $chart_data = $this->Chart->find('first', array(
                        'conditions' => array(
                            'Chart.user_mail' => $this->Auth->user('mail'),
                            'Chart.created' => date('Y-m-d', strtotime($start_date . ' +' . $i . ' days'))
                        )
                    ));


                    if (isset($chart_data['Chart'])) {
                        $weights[] = $chart_data['Chart']['weight'];
                        $bmis[] = $chart_data['Chart']['bmi'];

                    } else {
                        $weights[] = $weights[$i - 1];
                        $bmis[] = $bmis[$i - 1];
                    }
                }


            }
        } else {
            $pieces = explode(" ", date('d M'));
            $days[] = $pieces[0] . ' ' . $months[$pieces[1]];
            $weights[] = 0;
            $bmis[] = 0;
        }


        echo json_encode(array('x' => $days, 'weights' => $weights, 'bmis' => $bmis));


    }

    /**
     * get_shoppinglist method.
     * z widoku listy zakupow zbieram
     */
    public function get_shoppinglist()
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->loadModel('UserRecipe');
        $this->loadModel('RecipeProduct');
        $this->loadModel('Group');
        $this->loadModel('Product');
        $ingredients = array();
        $plan_per_day = array();

        $today = date('Y-m-d');
        if ($this->request->is('post')) {
            $from_date = date("Y-m-d", strtotime($this->request->data('from_date')));
            $due_date = date("Y-m-d", strtotime($this->request->data('due_date')));

            $user_recipe = $this->UserRecipe->find('all', array(
                'conditions' => array(
                    'AND' => array(
                        'UserRecipe.user_mail' => $this->Auth->user('mail'),
                        'UserRecipe.date >=' => $from_date,
                        'UserRecipe.date <=' => $due_date
                    )

                )
            ));


            if (!empty($user_recipe)) {
                foreach ($user_recipe as $key => $one) {
                    $recipe_product[$key] = $this->RecipeProduct->find('all', array(
                        'conditions' => array(
                            'RecipeProduct.recipe_id' => $one['UserRecipe']['recipe_id']
                        )
                    ));
                }

                foreach ($recipe_product as $one_recipe_products) {
//            $plan[]
                    foreach ($one_recipe_products as $key => $one_product) {
                        if (!in_array($one_product['RecipeProduct']['product_name'], $ingredients)) {
                            $this->Product->recursive = -1;
                            $group = $this->Product->find('first', array(
                                'conditions' => array(
                                    'Product.name' => $one_product['RecipeProduct']['product_name']
                                ),
                                'fields' => 'Product.shoplist'
                            ));

                            $ingredients[] = $one_product['RecipeProduct']['product_name'];
                            $plan_per_day[$one_product['RecipeProduct']['product_name']]['unit'] = $one_product['RecipeProduct']['unit'];
                            $plan_per_day[$one_product['RecipeProduct']['product_name']]['value'] = $one_product['RecipeProduct']['value'];
                            $plan_per_day[$one_product['RecipeProduct']['product_name']]['group'] = $group['Product']['shoplist'];


                        } else {
                            $plan_per_day[$one_product['RecipeProduct']['product_name']]['value'] += $one_product['RecipeProduct']['value'];
                        }


                    }

                }
            }
            $output = array();
            foreach ($plan_per_day as $key => $item) {
                if (!isset($output[$item['group']])) {
                    $output[$item['group']] = array($key => $item);
                } else {
                    $output[$item['group']][$key] = array();
                    $output[$item['group']][$key] = $item;
                }
            }

            $view = new View($this, false);
            $content = $view->element('shoppinglist', array('output' => $output));
            echo $content;
            die();
        }


    }

    /**
     * shoppinglist method.
     *
     * wyswietlam liste zakupow defaultowo na starcie na jeden dzien
     * przechodze przez wszystkie przepisy i szukam produktow, nie powielam
     * na koniec tworze array output porzadkuje tam wzgledem grupy
     *
     */
    public function shoppinglist()
    {
        $this->loadModel('UserRecipe');
        $this->loadModel('RecipeProduct');
        $this->loadModel('Group');
        $this->loadModel('Product');
        $ingredients = array();
        $plan_per_day = array();
//        $user=$this->User->findByMail($this->Auth->user('mail'));
        $user_recipe = $this->UserRecipe->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'UserRecipe.user_mail' => $this->Auth->user('mail'),
                    'UserRecipe.date' => date('Y-m-d')
                )

            )
        ));


        if (!empty($user_recipe)) {
            foreach ($user_recipe as $key => $one) {
                $recipe_product[$key] = $this->RecipeProduct->find('all', array(
                    'conditions' => array(
                        'RecipeProduct.recipe_id' => $one['UserRecipe']['recipe_id']
                    )
                ));
            }

            foreach ($recipe_product as $one_recipe_products) {
//            $plan[]
                foreach ($one_recipe_products as $key => $one_product) {
                    if (!in_array($one_product['RecipeProduct']['product_name'], $ingredients)) {
                        $this->Product->recursive = -1;
                        $group = $this->Product->find('first', array(
                            'conditions' => array(
                                'Product.name' => $one_product['RecipeProduct']['product_name']
                            ),
                            'fields' => 'Product.shoplist'
                        ));

                        $ingredients[] = $one_product['RecipeProduct']['product_name'];
                        $plan_per_day[$one_product['RecipeProduct']['product_name']]['unit'] = $one_product['RecipeProduct']['unit'];
                        $plan_per_day[$one_product['RecipeProduct']['product_name']]['value'] = $one_product['RecipeProduct']['value'];
                        $plan_per_day[$one_product['RecipeProduct']['product_name']]['group'] = $group['Product']['shoplist'];


                    } else {
                        $plan_per_day[$one_product['RecipeProduct']['product_name']]['value'] += $one_product['RecipeProduct']['value'];
                    }


                }

            }
        }
        $output = array();
        foreach ($plan_per_day as $key => $item) {
            if (!isset($output[$item['group']])) {
                $output[$item['group']] = array($key => $item);
            } else {
                $output[$item['group']][$key] = array();
                $output[$item['group']][$key] = $item;
            }
        }

        $this->set(compact('output'));


    }

    /**
     *
     * vote method.
     *
     * uzytkownik gloduje tylko raz na jeden przepis
     * lcize srednia z oceny ktora przepis juz ma oraz tej dodanej przez uzytkownika
     */
    public function vote()
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->loadModel('Vote');
        $this->loadModel('Recipe');
        $count = 0;
        $summary = 0;
        $final = 0;
        if ($this->request->is('post')) {

            $user_id = $this->Auth->user('id');
            $this->request->data['Vote']['user_id'] = $user_id;
            $data = $this->request->data;
            $this->Vote->create($data);
            if ($this->Vote->save($data)) {
                $votes = $this->Vote->find('all', array(
                    'conditions' => array(
                        'Vote.recipe_id' => $data['Vote']['recipe_id']
                    )
                ));
                $count = count($votes);

                foreach ($votes as $vote) {
                    $summary += $vote['Vote']['mark'];
                }
                $final = round($summary / $count, 0);

                $recipe['Recipe']['id'] = $data['Vote']['recipe_id'];
                $recipe['Recipe']['vote'] = $final;
                $this->Recipe->create($recipe);
                if ($this->Recipe->save($recipe)) {
                    $this->Flash->success('Oddanie głosu');
                    echo json_encode(array('vote' => $final, 'id' => $data['Vote']['recipe_id']));
                }


            }
        }
    }

    /**
     * change method.
     *
     * @param null $number
     * @param null $where_to_place
     *
     * zmiana przepisu
     * szukam innego przepisu z danego typu - sniadanie, obiad, kolacja, podwieczorek, sniadnie2 niz ten ktory wybral uzytkownik
     *
     * where_to_place to pozycja wybranego przepisu widziana na froncie, od 0 do ostatniego
     */
    public function change($number = null, $where_to_place = null)
    {


        $this->layout = 'ajax';
        $this->loadModel('Recipe');
        $this->loadModel('Vote');
        $this->Session->write('old_recipe_id', $number);

//        $type = "";
        $tmp = $this->Recipe->findById($number);
        $type = $tmp['Recipe']['type'];
        $summary = 0;
        $count = 0;
        $final = 0;


        $recipes = $this->Recipe->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'Recipe.type' => $type,
                    'Recipe.id !=' => $number,
                    'Recipe.level' => $tmp['Recipe']['level'],
                    'Recipe.diet_name' => $tmp['Recipe']['diet_name'],
                    'Recipe.veryfied' => 1

                )

            ),
            'limit' => 3,
            'order' => 'rand()'
        ));


        foreach ($recipes as &$recipe) {


            $votes = $this->Vote->find('all', array(
                'conditions' => array(
                    'Vote.recipe_id' => $recipe['Recipe']['id']
                )
            ));
            if ((!empty($votes)) && ($votes != null)) {
                $count = count($votes);

                foreach ($votes as $vote) {
                    $summary += $vote['Vote']['mark'];

                }
                $final = round($summary / $count, 0);

                $recipe['Recipe']['mark'] = $final;

            } else {
                $recipe['Recipe']['mark'] = 0;
            }
            $recipe['Recipe']['permission'] = 'denied';
            $recipe['Recipe']['where_to_place'] = $where_to_place;

        }


        $this->set(compact('recipes'));
    }

    /**
     * addChosen metod.
     *
     * @param null $id
     * @param null $key
     *
     * dodaje wybrany przepis w miejsce tego ktory uzytkownik chce zamienic
     * licze jego ocene i sprawdam czy uzytkownik juz keidys glosowal na dany przepis jezeli tak to zmienna permission = denied jezeli nie to agree
     *
     */
    public function addChosen($id = null, $key = null)
    {
        $this->layout = 'ajax';
        $this->loadModel('Recipe');
        $this->loadModel('Vote');
        $this->loadModel('UserRecipe');
        $type = "";
        $summary = 0;
        $count = 0;
        $final = 0;


        $old_recpe_id = $this->Session->read('old_recipe_id');
        $user_recipe = $this->UserRecipe->find('first', array(
            'conditions' => array(
                'AND' => array(
                    'UserRecipe.user_mail' => $this->Auth->user('mail'),
                    'UserRecipe.recipe_id' => $old_recpe_id

                )
            )
        ));

        $this->UserRecipe->query('UPDATE user_recipes SET recipe_id = ' . $id . ' WHERE id = ' . $user_recipe['UserRecipe']['id']);


        $recipe = $this->Recipe->find('first', array(
            'conditions' => array(
                'Recipe.id' => $id
            )
        ));

        $votes = $this->Vote->find('all', array(
            'conditions' => array(
                'Vote.recipe_id' => $recipe['Recipe']['id']
            )
        ));
        if ((!empty($votes)) && ($votes != null)) {
            $count = count($votes);

            foreach ($votes as $vote) {
                $summary += $vote['Vote']['mark'];

            }
            $final = round($summary / $count, 0);

            $recipe['Recipe']['mark'] = $final;

        } else {
            $recipe['Recipe']['mark'] = 0;
        }
        $permission = $this->Vote->find('first', array(
            'conditions' => array(
                'AND' => array(
                    'Vote.recipe_id' => $recipe['Recipe']['id'],
                    'Vote.user_id !=' => $this->Auth->user('id')
                )
            )
        ));
        if ((!empty($permission)) && ($permission != null)) {
            $recipe['Recipe']['permission'] = 'denied';
        } else {
            $recipe['Recipe']['permission'] = 'agree';
        }

        $this->set(compact('recipe', 'key'));

    }

    /**
     * generate_pdf method.
     *
     * generuje pdfa z danych z frontu na temat listy zakupow
     */
    public function generate_pdf()
    {
        $this->layout = 'ajax';


        $list = $this->Session->read('list');

        $this->set(compact('list'));


        ob_start();
        include(APP . 'View' . DS . 'Users' . DS . 'generate_pdf.ctp');
        $content = ob_get_clean();


        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
            $html2pdf->setDefaultFont('freeserif');

            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output('Lista_zakupow.pdf');
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }


    }

    /**
     * pre_generate method.
     *
     * tutaj odrazu po kliknieciu generowania pdfa zapisuje do sesji liste produktow ktore maja byc na liscie zakupow
     */
    public function pre_generate()
    {
        $this->layout = 'ajax';
        $this->render(false);
        if ($this->request->is('post')) {
            $list = $this->request->data['List'];
            $this->Session->write('list', $list);
            echo json_encode(array('success' => true));

        }
    }

    /**
     * recipe_list method.
     *
     * wyszukiwarka przepisow, dane z inputow to poziom trudnosci, rodzaj diety oraz produkty ktorych nie chce uzytkownik
     *
     *sprawdzam czy jest oplata uiszczona
     */
    public function recipe_list()
    {
        $this->loadModel('Recipe');
        $this->loadModel('Vote');
        $this->loadModel('Group');
        $this->loadModel('Payment');

        $conditions = array();
        $access = false;
        if ($this->request->query) {
            if (($this->request->query['level'] != 'Wszystkie') && ($this->request->query['level'] != '')) {
                $conditions[] = array('Recipe.level' => $this->request->query['level']);

            }
            if ($this->request->query['preferences'] != '') {
                $conditions[] = array('Recipe.diet_name' => $this->request->query['preferences']);

            }
            if ($this->request->query['diet'] != 'Wszystkie') {
                $conditions[] = array('Recipe.diet_name' => $this->request->query['diet']);

            }


        }

        $this->Paginator->settings = array(
            'limit' => 5,
            'conditions' => $conditions
        );


        $recipes = $this->Paginator->paginate('Recipe');
        foreach ($recipes as &$recipe) {
            $count = 0;
            $summary = 0;
            $final = 0;
            $votes = $this->Vote->find('all', array(
                'conditions' => array(
                    'Vote.recipe_id' => $recipe['Recipe']['id']
                )
            ));
            $count = count($votes);
            if ($count != 0) {
                foreach ($votes as $vote) {
                    $summary += $vote['Vote']['mark'];

                }
                $final = round(($summary / $count), 0);
                $recipe['Recipe']['mark'] = $final;
            } else {
                $recipe['Recipe']['mark'] = 0;
            }
            $payment = $this->Payment->find('first', array(
                'conditions' => array(
                    'Payment.user_mail' => $this->Auth->user('mail')
                )
            ));
            if (isset($payment['Payment']) && $payment != null) {
                $access = true;
            }

        }
        $level = $this->level;
//        debug($level);
        $level[0] = 'Wszystkie';
        foreach ($level as $lev) {
            $tmp[$lev] = $lev;
        }
        $level = $tmp;
        $tmp = array();
        $groups_all = $this->Group->find('all');
        foreach ($groups_all as $groups) {
            $group[$groups['Group']['id']] = $groups['Group']['name'];
        }

        $diets = $this->diet;
        $diets[0] = 'Wszystkie';
        foreach ($diets as $diet) {
            $tmp[$diet] = $diet;
        }
        $diets = $tmp;


        $this->set(compact('access', 'recipes', 'level', 'group', 'diets'));

    }

    /**
     * api_register method.
     *
     * opis w active collab.
     */
    public function api_register()
    {
        $this->layout = 'ajax';
        $this->render(false);

        header('Content-Type: application/json; charset=utf-8');
        if ($this->request->is(array('post', 'put'))) {
            if (empty($this->request->data)) {
                $postdata = file_get_contents("php://input");
                $this->request->data = json_decode($postdata, true);
            }


            $this->request->data['User']['hash'] = md5($this->request->data['User']['name'] . $this->request->data['User']['mail'] . time());
            $this->User->create();

            if ($user = $this->User->save($this->request->data)) {
                echo json_encode(array('msg' => 'Zarejestrowano', 'session-key' => $this->request->data['User']['hash'], 'user' => $user));
            } else {

                echo json_encode(array('errors' => $this->User->validationErrors));
            }


        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }


        die();
    }

    /**
     * api_login method.
     *
     * opsi w active collab.
     */
    public function api_login()
    {
        $this->layout = 'ajax';
        $this->render(false);

        header('Content-Type: application/json; charset=utf-8');
        if ($this->request->is(array('post', 'put'))) {
            $this->Auth->logout();
            if (empty($this->request->data)) {
                $postdata = file_get_contents("php://input");
                $this->request->data = json_decode($postdata, true);
            }

            $this->User->recursive = -1;
            $user = $this->User->findByMail($this->request->data['User']['mail']);

            if (isset($user['User'])) {

                if ($user['User']['active'] == 1) {
                    if ($user['User']['role'] == 0) {
                        if ($this->Auth->login()) {
                            echo json_encode(array('msg' => 'Zalogowano', 'session-key' => $user['User']['hash'], 'user' => $user));
                        } else {
                            echo json_encode(array('errors' => array('password' => 'Błędne hasło')));

                        }
                    } else {
                        echo json_encode(array('errors' => 'Konto typu administrator'));
                    }


                } else {
                    echo json_encode(array('errors' => 'Zweryfikuj adres e-mail'));
                }
            } else {
                echo json_encode(array('errors' => array('mail' => 'Błędny adres e-mail')));
            }


        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }


        die();
    }

    /**
     * api_login_facebook method.
     *
     * opis w active collab
     */
    public function api_login_facebook()
    {
        $this->layout = 'ajax';
        $this->render(false);
        header('Content-Type: application/json; charset=utf-8');

        if ($this->request->is(array('post', 'put'))) {

            if (empty($this->request->data)) {
                $postdata = file_get_contents("php://input");
                $this->request->data = json_decode($postdata, true);
            }
            debug($this->request->data);

            $user = $this->User->find('first', array(
                'conditions' => array(
                    'OR' => array(
                        'User.mail' => $this->request->data['mail'],
                        'User.fb_id' => $this->request->data['fb_id']

                    )
                ),
                'recursive' => -1
            ));
            if (isset($user['User'])) {
                if (!empty($user['User']['fb_id']) && ($user['User']['fb_id'] != null)) {
                    echo json_encode(array('msg' => 'Zalogowano z facebookiem', 'session-key' => $user['User']['hash'], 'user' => $user));
                } else {
                    $user['User']['fb_id'] = $this->request->data['fb_id'];
                    $this->User->create($user);
                    if ($this->User->save($user)) {
                        echo json_encode(array('msg' => 'Zalogowano z facebookiem', 'session-key' => $user['User']['hash'], 'user' => $user));
                    }

                }
            } else {
                $this->request->data['hash'] = md5($this->request->data['name'] . $this->request->data['mail'] . time());
                $this->request->data['active'] = 1;
                $this->User->create($this->request->data);

                if ($user = $this->User->save($this->request->data)) {
                    echo json_encode(array('msg' => 'Zalogowano z facebookiem', 'session-key' => $user['User']['hash'], 'user' => $user));
                }
            }


        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }

        die();
    }

    /**
     * api_edit_account method.
     *
     * opis w active collab
     */
    public function api_edit_account()
    {
        $this->layout = 'ajax';
        $this->render(false);
        header('Content-Type: application/json; charset=utf-8');
        $this->loadModel('Quiz');
        $this->loadModel('UserRecipe');
        if ($this->request->is(array('post', 'put'))) {

            if (empty($this->request->data)) {
                $postdata = file_get_contents("php://input");
                $this->request->data = json_decode($postdata, true);
            }
            $this->User->recursive = -1;
            $user = $this->User->findByHash($this->request->data['session-key']);
            $this->User->create($this->request->data['User']);


            unset($this->User->validate['mail']['unique']);
            if ($this->User->validates($this->request->data['User'])) {
                $others_check = $this->User->find('first', array(
                    'conditions' => array(
                        'AND' => array(
                            'User.mail' => $this->request->data['User']['mail'],
                            'User.hash !=' => $this->request->data['session-key']
                        )
                    )
                ));
                if (isset($others_check['User'])) {
                    echo json_encode(array('errors' => array('mail' => 'Podany adres e-mail jest już zajęty')));
                } else {
                    if ($user['User']['mail'] != $this->request->data['User']['mail']) {
                        $this->Quiz->query('UPDATE quizzes SET user_mail="' . $this->request->data['User']['mail'] . '" WHERE user_mail="' . $user['User']['mail'] . '"');
                        $this->UserRecipe->query('UPDATE user_recipes SET user_mail="' . $this->request->data['User']['mail'] . '" WHERE user_mail="' . $user['User']['mail'] . '"');

                    }
                    $this->request->data['User']['id'] = $user['User']['id'];
                    $this->User->create($this->request->data['User']);
                    if ($user = $this->User->save($this->request->data['User'])) {
                        echo json_encode(array('msg' => 'Edycja konta zakończona pomyślnie', 'session-key' => $this->request->data['session-key'], 'user' => $user));

                    }
                }


            } else {
                echo json_encode(array('errors' => $this->User->validationErrors));
            }

        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }

        die();
    }

    public function api_get_weight()
    {
        $this->layout = 'ajax';
        $this->render(false);
        header('Content-Type: application/json; charset=utf-8');
        $this->loadModel('Chart');
        $this->loadModel('Payment');

        $months = array('Jan' => 'Styczeń',
            'Feb' => 'Luty',
            'Mar' => 'Marzec',
            'Apr' => 'Kwiecień',
            'May' => 'Maj',
            'Jun' => 'Czerwiec',
            'Jul' => 'Lipiec',
            'Aug' => 'Sierpień',
            'Sep' => 'Wrzesień',
            'Oct' => 'Październik',
            'Nov' => 'Listopad',
            'Dec' => 'Grudzień'
        );
        if ($this->request->query) {

            if (empty($this->request->query)) {
                $postdata = file_get_contents("php://input");
                $this->request->query = json_decode($postdata, true);
            }
            $user = $this->User->findByHash($this->request->query['session-key']);
            if ((isset($user['User'])) && (!empty($user))) {


                $payment = $this->Payment->find('first', array(
                    'conditions' => array(
                        'Payment.user_mail' => $user['User']['mail']
                    ),
                    'order' => array(
                        'Payment.created' => 'desc'
                    )


                ));

                $weights = array();
                $bmis = array();
                $days = array();
                if (!empty($payment) && ($payment != null)) {
                    $due_date = $payment['Payment']['due_date'];
                    $start_date = $payment['Payment']['created'];

                    $final_it = strtotime($due_date) - strtotime($start_date);
                    $final_it = ($final_it / 86400) + 1;


                    for ($i = 0; $i < $final_it; $i++) {
                        $pieces = explode(" ", date('d M', strtotime($start_date . ' +' . $i . ' days')));

                        $days[$i] = $pieces[0] . ' ' . $months[$pieces[1]];
                        if (date('Y-m-d', strtotime($start_date . ' +' . $i . ' days')) <= date('Y-m-d')) {


                            $chart_data = $this->Chart->find('first', array(
                                'conditions' => array(
                                    'Chart.user_mail' => $user['User']['mail'],
                                    'Chart.created' => date('Y-m-d', strtotime($start_date . ' +' . $i . ' days'))
                                )
                            ));


                            if (isset($chart_data['Chart'])) {
                                $weights[] = $chart_data['Chart']['weight'];
                                $bmis[] = $chart_data['Chart']['bmi'];

                            } else {
                                $weights[] = $weights[$i - 1];
                                $bmis[] = $bmis[$i - 1];
                            }
                        }


                    }
                } else {
                    $pieces = explode(" ", date('d M'));
                    $days[] = $pieces[0] . ' ' . $months[$pieces[1]];
                    $weights[] = 0;
                    $bmis[] = 0;
                }


                echo json_encode(array('x' => $days, 'weights' => $weights, 'bmis' => $bmis));
            } else {
                echo json_encode(array('errors' => 'Błędny request'));
            }


        }

        die();
    }

    public function api_get_history()
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->loadModel('Basket');
        $this->loadModel('Payment');
        $this->loadModel('Pack');
        header('Content-Type: application/json; charset=utf-8');
        if ($this->request->query) {
            if (empty($this->request->query)) {
                $postdata = file_get_contents("php://input");
                $this->request->query = json_decode($postdata, true);
            }
            $user = $this->User->findByHash($this->request->query['session-key']);
            if ((isset($user['User'])) && (!empty($user))) {
                $active_payment = $this->Payment->find('first', array(
                    'conditions' => array(
                        'Payment.user_mail' => $user['User']['mail'],
                    ),
                    'order' => array(
                        'Payment.created' => 'desc'
                    )
                ));
                if (isset($active_payment['Payment']) && !empty($active_payment)) {
                    $pack = $this->Pack->find('first', array(
                        'conditions' => array(
                            'Pack.id' => $active_payment['Payment']['pack_id']
                        ),
                        'fields' => 'title'
                    ));
                    $active_payment['Payment']['pack_name'] = $pack['Pack']['title'];
                    $active_payment['Payment']['days'] = (strtotime($active_payment['Payment']['due_date']) - strtotime($active_payment['Payment']['created'])) / (60 * 60 * 24);


                }
                $payments_history = $this->Payment->find('all', array(
                    'conditions' => array(
                        'Payment.user_mail' => $user['User']['mail']
                    ),
                    'order' => array(
                        'Payment.created' => 'desc'
                    )
                ));
                $baskets_history = $this->Basket->find('all', array(
                    'conditions' => array(
                        'AND' => array(
                            'Basket.user_mail' => $user['User']['mail'],
                            'Basket.payment_status' => 'Wykonano'
                        )

                    ),
                    'order' => array(
                        'Basket.modified' => 'desc'
                    )
                ));
                echo json_encode(array('session-key' => $this->request->query['session-key'], 'user' => $user, 'active_payment' => $active_payment, 'payments_history' => $payments_history, 'baskets_history' => $baskets_history));


            } else {
                echo json_encode(array('errors' => 'Błędny session-key'));
            }

        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }
        die();
    }

    public function api_get_mydiet()
    {

        $this->layout = 'ajax';
        $this->render(false);
        header('Content-Type: application/json; charset=utf-8');
        $this->loadModel('UserRecipe');
        $this->loadModel('Recipe');
        $this->loadModel('Vote');
        $this->loadModel('Payment');
        $this->loadModel('Quiz');

        if ($this->request->query) {
            if (empty($this->request->query)) {
                $postdata = file_get_contents("php://input");
                $this->request->query = json_decode($postdata, true);
            }
            $user = $this->User->findByHash($this->request->query['session-key']);
            if ((isset($user['User'])) && (!empty($user))) {
                $payment = $this->Payment->find('first', array(
                    'conditions' => array(
                        'Payment.user_mail' => $user['User']['mail']
                    )
                ));

                if (isset($payment['Payment'])) {
                    $start_date = $payment['Payment']['created'];
                    $diff = ((strtotime(date('Y-m-d')) - strtotime($start_date)) / 86400) + 1;
                } else {
                    $diff = 0;
                }

                $this->Paginator->settings = array(
                    'conditions' => array('UserRecipe.user_mail' => $user['User']['mail']),
                    'limit' => 3,
                    'order' => array(
                        'UserRecipe.date' => 'asc'
                    ),
                    'page' => $diff
                );

                $userRecipe = $this->Paginator->paginate('UserRecipe');

                if ($userRecipe != null && !empty($userRecipe)) {
                    $date = $this->nice_day($userRecipe[0]['UserRecipe']['date']);
                } else {
                    $date = $this->nice_day(date('Y-m-d'));
                }


                $now = $currentPage = $this->request->paging['UserRecipe']['page'];

                $quiz = $this->Quiz->find('first', array(
                    'conditions' => array(
                        'Quiz.user_mail' => $user['User']['mail']
                    )
                ));

                foreach ($userRecipe as $key => $item) {
                    $recipe = $this->Recipe->find('first', array(
                        'conditions' => array(
                            'Recipe.id' => $item['UserRecipe']['recipe_id']
                        )
                    ));

                    $permissions = $this->Vote->find('all', array(
                        'conditions' => array(
                            'AND' => array(
                                'Vote.user_id' => $this->Auth->user('id'),
                                'Vote.recipe_id' => $item['UserRecipe']['recipe_id']
                            )

                        )
                    ));

                    if ((!empty($permissions)) && $permissions != null) {
                        $recipe['Recipe']['permission'] = 'denied';
                    } else {
                        $recipe['Recipe']['permission'] = 'agree';
                    }
                    $recipe['Recipe']['date'] = $date;
                    $recipes[$key] = $recipe;
                }

                echo json_encode(array('session-key' => $this->request->query['session-key'], 'user' => $user, 'recipes' => $recipes));

            }
        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }
        die();


    }

    public function api_set_weight()
    {
        $this->layout = 'ajax';
        $this->render(false);
        header('Content-Type: application/json; charset=utf-8');
        $this->loadModel('Chart');
        $this->loadModel('Quiz');
        if ($this->request->query) {
            if (empty($this->request->query)) {
                $postdata = file_get_contents("php://input");
                $this->request->query = json_decode($postdata, true);
            }
            $user = $this->User->findByHash($this->request->query['session-key']);
            if ((isset($user['User'])) && (!empty($user))) {
                $today = $this->Chart->find('first', array(
                    'conditions' => array(
                        'AND' => array(
                            'Chart.user_mail' => $user['User']['mail'],
                            'Chart.created' => $this->request->query['date']
                        )
                    )
                ));
                $this->Quiz->recursive = -1;
                $height = $this->Quiz->find('first', array(
                    'conditions' => array(
                        'Quiz.user_mail' => $user['User']['mail']
                    ),
                    'fields' => 'Quiz.height'
                ));

                if ((isset($today)) && (!empty($today))) {
                    $data = array(
                        'id' => $today['Chart']['id'],
                        'weight' => $this->request->query['weight'],
                        'bmi' => round(($this->request->query['weight']) / (($height['Quiz']['height'] / 100) * ($height['Quiz']['height'] / 100)), 2)
                    );

                } else {
                    $data = array(
                        'created' => date('Y-m-d'),
                        'weight' => $this->request->query['weight'],
                        'bmi' => round(($this->request->query['weight']) / (($height['Quiz']['height'] / 100) * ($height['Quiz']['height'] / 100)), 2),
                        'user_mail' => $user['User']['mail']
                    );


                }
                $this->Chart->create();
                $this->Chart->save($data);
                echo json_encode(array('session-key' => $this->request->query['session-key'], 'user' => $user, 'data' => $data));
            }
        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }
        die();
    }
}
