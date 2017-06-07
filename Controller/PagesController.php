<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array();
    public $components = array('Paginator', 'Flash', 'Session');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('home', 'intro', 'pre_print_recipe', 'print_recipe', 'about', 'diet', 'faq_message', 'faq', 'how', 'pack', 'blog', 'policy', 'singlediet', 'join_us', 'change_ingredients', 'turncateall', 'terms', 'singleblog', 'calc', 'calc2', 'calculator', 'singlepack', 'search', 'contact', 'bmi', 'bmr', 'api_calc_bmi', 'api_calc_tdee'));
    }

    /**
     * search method.
     *
     * Displays a view
     *
     * @return void
     * @throws NotFoundException When the view file could not be found
     *   or MissingViewException in debug mode.
     *
     * wyszukiwarka na stronie wyszukuje w dietach oraz w blogach-posts
     */
    public function search()
    {
        $word = $this->request->query['search'];

        $this->loadModel('Post');
        $this->loadModel('Diet');
        $this->loadModel('Product');
        $this->loadModel('Recipe');


        $results = array(
            'Blog' => $this->Post->find('all', array('conditions' => array('Post.title LIKE  "%' . $word . '%" OR Post.body LIKE "%' . $word . '%"'))),
            'Diet' => $this->Diet->find('all', array('conditions' => array('Diet.name LIKE  "%' . $word . '%" OR Diet.body LIKE "%' . $word . '%"')))
        );
        $this->set(compact('results', 'word'));

    }

    public function display()
    {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        $this->set(compact('page', 'subpage', 'title_for_layout'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingViewException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    /**
     * home method.
     *
     * pobieram instrukcje krokowa, wyswietla
     */
    public function home()
    {
        $this->loadModel('Step');

        $steps = $this->Step->find('all');

//        debug($steps);die();
        $this->set(compact('steps'));
    }

    /**
     * about method
     *
     * pobiera about na front
     */
    public function about()
    {
        $this->loadModel('About');
        $abouts = $this->About->find('all');
        $this->set(compact('abouts'));
    }

    /**
     * faq method.
     *
     * pobiera wpisy faq na front
     */
    public function faq()
    {

        $this->loadModel('Faq');
        $faqs = $this->Faq->find('all', array(
            'conditions' => array(
                'Faq.active' => 1
            )
        ));
        $this->set(compact('faqs'));
    }

    /**
     * how method
     *
     * pobiera liste krokow na front
     */
    public function how()
    {
        $this->loadModel('Step');

        $steps = $this->Step->find('all');

//        debug($steps);die();
        $this->set(compact('steps'));
    }


    /**
     * diet method.
     *
     * pobranie wszsytkich diet na front
     */
    public function diet()
    {
        $this->loadModel('Diet');
        $diets = $this->Diet->find('all');
//        debug($diets);
//        die();
        $this->set(compact('diets'));
    }

    /**
     *
     * pack method.
     *
     * pobranie wszystkich pakietow na front
     */
    public function pack()
    {
        $this->loadModel('Pack');
        $packs = $this->Pack->find('all');
        $this->set(compact('packs'));
    }

    /**
     * blog method.
     *
     * pobranie wszystkich postow na front do podstrony blog
     */
    public function blog()
    {
        $this->loadModel('Post');
        $this->Paginator->settings = array(
            'limit' => 5,
            'order' => array('Post.created' => 'desc')
        );


        $posts = $this->Paginator->paginate('Post');


        $this->set(compact('posts'));
    }

    /**
     * singleblog method.
     *
     * widok pojedynczego wpisu na froncie i pobiera komentarze
     *komentarze renderuje w elemencie
     * @param null $id
     * @return CakeResponse
     */
    public function singleblog($id = null)
    {

        $this->loadModel('Post');
        $this->loadModel('Comment');

        $post = $this->Post->findById($id);

        if ($this->request->is('post')) {
            $this->layout = 'ajax';

            $this->Paginator->settings = array(
                'limit' => 3,
                'page' => $this->request->data('page'),
                'order' => array('Comment.created' => 'desc'),
                'conditions' => array(
                    'Comment.post_id' => $id

                )
            );

            $comments = $this->Paginator->paginate('Comment');

            $this->set(compact('comments'));


            return $this->render('/Elements/comment');

        }


        $this->Paginator->settings = array(
            'limit' => 3,
            'page' => 1,
            'order' => array('Comment.created' => 'desc'),
            'conditions' => array(
                'Comment.post_id' => $id

            )
        );


        $comments = $this->Paginator->paginate('Comment');
        $count = $this->Comment->find('count', array(
            'conditions' => array(
                'Comment.post_id' => $id
            )
        ));
        $max_pages = ceil($count / 3);


        $this->set(compact('post', 'comments', 'max_pages'));
    }

    /**
     * terms method.
     *
     * pobiera zasady na front
     */
    public
    function terms()
    {
        $this->loadModel('Rule');
        $rule = $this->Rule->find('first');
        $this->set(compact('rule'));
    }

    /**
     * policy method.
     *
     * pobiera polityke prywatnosci na front
     */
    public
    function policy()
    {
        $this->loadModel('Policy');
        $policy = $this->Policy->find('first');
        $this->set(compact('policy'));
    }

    /**
     * singlepack method.
     *
     * pobiera pojedynczy pakiet
     * @param null $id
     */
    public function singlepack($id = null)
    {
        $this->loadModel('Pack');
        $pack = $this->Pack->findById($id);
        $packs = $this->Pack->find('all');


        $this->set(compact('pack', 'packs', 'id'));

    }

    /**
     * contact method.
     *
     * formularz kontaktowy - posyla maila
     * @return \Cake\Network\Response|null
     */
    public function contact()
    {
        if ($this->request->is('post')) {
            $Email = new CakeEmail('smtp');
            $Email->to('tbiegun@180creative.pl');
            $Email->template('message', 'default');
            $Email->emailFormat('html');
            $Email->subject('GreenCook - Wiadomość od użytkownika');
            $Email->viewVars(array(
                'name' => $this->request->data['name'],
                'mail' => $this->request->data['mail'],
                'content' => $this->request->data['message'],
                'link' => 'http://' . $_SERVER['SERVER_NAME']));
            $Email->send();
            $this->Flash->success('Wysłanie wiadomości e-mail');
            return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
    }

    /**
     * bmi method.
     *
     * liczy bmi z podsumowaniem slownym summary
     */
    public function bmi()
    {
        $this->layout = 'ajax';
        $this->render(false);
        if ($this->request->is('post')) {
            $summary = 'Nieokreślono';
            $weight = $this->request->data['Bmi']['weight'];
            $height = $this->request->data['Bmi']['height'];
            $bmi = ($weight / (($height / 100) * ($height / 100)));
            $bmi = round($bmi, 2);
            if ($bmi <= 16) {
                $summary = 'Wygłodzenie';
            }
            if (($bmi > 16) && ($bmi <= 17)) {
                $summary = 'Wychudzenie';
            }
            if (($bmi > 17) && ($bmi <= 18.5)) {
                $summary = 'Niedowaga';
            }
            if (($bmi > 18.5) && ($bmi <= 25)) {
                $summary = 'Prawidłowe';
            }
            if (($bmi > 25) && ($bmi <= 30)) {
                $summary = 'Nadwaga';
            }
            if (($bmi > 30) && ($bmi <= 35)) {
                $summary = 'I stopień otyłości';
            }
            if (($bmi > 35) && ($bmi <= 40)) {
                $summary = 'II stopień otyłości';
            }
            if ($bmi > 40) {
                $summary = 'III stopień otyłości';
            }
            echo json_encode(array('bmi' => $bmi, 'summary' => $summary));
        }
    }

    /**
     * bmr method.
     *
     * wylicza wspolczynnik bmr
     */
    public function bmr()
    {
        $this->layout = 'ajax';
        $this->render(false);

        if ($this->request->is('post')) {
            $E = 1.55;
            $G = 5;


            if ($this->request->data['Bmr']['activity'] == "Bardzo niska") {
                $E = 1.2;
            } else if ($this->request->data['Bmr']['activity'] == "Niska") {
                $E = 1.375;
            } else if ($this->request->data['Bmr']['activity'] == "Średnia") {
                $E = 1.55;
            } else if ($this->request->data['Bmr']['activity'] == "Wysoka") {
                $E = 1.725;
            } else if ($this->request->data['Bmr']['activity'] == "Bardzo wysoka") {
                $E = 1.9;
            } else {
                return;
            }


            if ($this->request->data['Bmr']['gender'] == 0) {
                $G = -161;
            }

            $bmr = (9.99 * $this->request->data['Bmr']['weight']) + (6.25 * $this->request->data['Bmr']['height']) - (4.92 * $this->request->data['Bmr']['age']) + $G;

            $TDEE = ($bmr * $E) - (250 * $this->request->data['Bmr']['personalGoal']);
            $bmr = round($TDEE, 2);


            echo json_encode(array('bmr' => $bmr));

        }
    }

    /**
     * meal method.
     *
     * pobiera jeden posilek, przypisuje mu podsumowanie bialek tluszczy wartosci kalorycznych na podstawie
     * produktow z ktorych jest zlozony
     *
     * @param null $id
     */
    public function meal($id = null)
    {
        $this->loadModel('Recipe');
        $this->loadModel('Product');
        $this->loadModel('Quiz');
        $this->loadModel('RecipeProduct');
        $this->loadModel('Replacement');
        $this->loadModel('Vote');
        $recipe = $this->Recipe->findById($id);


        $recipeProducts = $this->RecipeProduct->find('all', array(
            'conditions' => array(
                'RecipeProduct.recipe_id' => $recipe['Recipe']['id']
            )
        ));


        $summary['Kaloryczność posiłku'] = 0;
        $summary['Węglowodany'] = 0;
        $summary['Białka'] = 0;
        $summary['Tłuszcze'] = 0;
        $TDEG_summary = 0;
        $TDEG_count = 0;
        $names = array();
        $control = 0;


        if ($this->Auth->user()) {


            $quizzes = $this->Quiz->find('all', array(
                'conditions' => array(
                    'Quiz.user_mail' => $this->Auth->user('mail')
                ),
                'recursive' => -1
            ));


            foreach ($quizzes as $quiz) {
                if ($quiz['Quiz']['tdeg'] < 1000) {
                    $TDEG_count += 1000;
                } else {
                    $TDEG_count += $quiz['Quiz']['tdeg'];
                }
                $names[] = $quiz['Quiz']['user_name'];
            }
            $control = count($names);
            $TDEG_summary = $TDEG_count / 1500;

            $all_replacements = array();
            foreach ($recipeProducts as $key => &$recipeProduct) {
                $recipeProduct['RecipeProduct']['value'] = round($recipeProduct['RecipeProduct']['value'] * $TDEG_summary, 0);
                $finalValue = $recipeProduct['RecipeProduct']['value'];
                $product = $this->Product->findByName($recipeProduct['RecipeProduct']['product_name']);
                $summary['Kaloryczność posiłku'] += (($product['Product']['kcal']) * ($finalValue)) / 100;
                $summary['Węglowodany'] += (($product['Product']['carbohydrates']) * ($finalValue)) / 100;
                $summary['Białka'] += (($product['Product']['proteins']) * ($finalValue)) / 100;
                $summary['Tłuszcze'] += (($product['Product']['fats']) * ($finalValue)) / 100;

//                debug($recipeProduct);die();
                $replacements = $this->Replacement->find('first', array(
                    'conditions' => array(
//                        'Replacement.body LIKE' => '%' . $recipeProduct['RecipeProduct']['product_name'] . '%'
                        'Replacement.body LIKE' => '%' . $recipeProduct['RecipeProduct']['product_name'] . '%'
                    )
                ));
                if ($replacements != null && !empty($replacements)) {
                    $pieces = explode('#', $replacements['Replacement']['body']);
                    $replacement_key = array_search($recipeProduct['RecipeProduct']['product_name'], $pieces);

                    $all_replacements[$pieces[$replacement_key]] = $pieces;
                    unset($all_replacements[$pieces[$replacement_key]][$replacement_key]);
                }


            }


        } else {
            foreach ($recipeProducts as $key => $recipeProduct) {

                $finalValue = $recipeProduct['RecipeProduct']['value'];
                $product = $this->Product->findByName($recipeProduct['RecipeProduct']['product_name']);
                $summary['Kaloryczność posiłku'] += (($product['Product']['kcal']) * ($finalValue)) / 100;
                $summary['Węglowodany'] += (($product['Product']['carbohydrates']) * ($finalValue)) / 100;
                $summary['Białka'] += (($product['Product']['proteins']) * ($finalValue)) / 100;
                $summary['Tłuszcze'] += (($product['Product']['fats']) * ($finalValue)) / 100;


            }
        }


        $final = 0;

        foreach ($summary as $key => $sum) {
//            $summary[$key] = round($sum, 0);
            if ($key == 'Kaloryczność posiłku') {
            } else {

                $final += $summary[$key];


            }
        }

        foreach ($summary as $key => $sum) {

            if ($key != 'Kaloryczność posiłku') {

                $summary[$key . '_proc'] = round((($summary[$key] * 100) / $final), 0);

            }
        }
        $permission = $this->Vote->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'Vote.user_id' => $this->Auth->user('id'),
                    'Vote.recipe_id' => $id
                )

            )
        ));

        if ((!empty($permission)) && $permission != null) {
            $recipe['Recipe']['permission'] = 'denied';
        } else {
            $recipe['Recipe']['permission'] = 'agree';
        }

        $this->set(compact('control', 'names', 'recipe', 'recipeProducts', 'summary', 'all_replacements'));


    }

    /**
     * faq_message method.
     *
     * wyslanie pytania z formularza faq na froncie
     */
    public function faq_message()
    {
        $this->loadModel('Faq');
        $this->layout = 'ajax';
        $this->render(false);
        if ($this->request->is('post')) {
            $data = array(
                'title' => 'Pytanie',
                'body' => $this->request->data['message']
            );
            $this->Faq->create();
            if ($this->Faq->save($data)) {

                $Email = new CakeEmail('smtp');
                $Email->to('tbiegun@180creative.pl');
                $Email->template('faq', 'default');
                $Email->emailFormat('html');
                $Email->subject('GreenCook - Pytanie');
                $Email->viewVars(array(
                    'content' => $this->request->data['message'],
                    'link' => 'http://' . $_SERVER['SERVER_NAME']));
                $Email->send();
                $this->Flash->success('Wysłanie wiadomości e-mail');

            } else {
                $this->Flash->error('Wysłanie wiadomości e-mail');
            }
            $this->redirect($this->referer());


        }

    }

    /**
     * calc method.
     *
     * bmi kalkulator na glownej
     */
    public function calc()
    {

    }

    /**
     * calc2 method.
     *
     * tdee kalkulator na glownej
     */
    public function calc2()
    {
        $options = array(
            'Wybierz aktywność',
            'Bardzo niska - siedzący tryb pracy/ brak aktywności fizyczne',
            'Niska - mało aktywny tryb pracy/ lekka aktywność fizyczna 1-2 razy w tygodniu',
            'Średnia - umiarkowany tryb pracy/ćwiczenia lub treningi sportowe 3-4 razy w tygodniu',
            'Wysoka - praca fizyczna/ ćwiczenia/treningi sportowe 5-6 razy w tygodniu',
            'Bardzo wysoka - ciężki wysiłek dzienny/ wymagające ćwiczenia/treningi sportowe codzienne'

        );
        $this->set(compact('options'));
    }

    /**
     *  method.
     *
     * kalkulator - podsumowanie po zatwierdzeniu quizu przez uzytkownika
     */
    public function calculator()
    {
        $options = array(
            'Bardzo niska - siedzący tryb pracy/ brak aktywności fizyczne',
            'Niska - mało aktywny tryb pracy/ lekka aktywność fizyczna 1-2 razy w tygodniu',
            'Średnia - umiarkowany tryb pracy/ćwiczenia lub treningi sportowe 3-4 razy w tygodniu',
            'Wysoka - praca fizyczna/ ćwiczenia/treningi sportowe 5-6 razy w tygodniu',
            'Bardzo wysoka - ciężki wysiłek dzienny/ wymagające ćwiczenia/treningi sportowe codzienne'

        );
        $quiz_data = $this->Session->read('quiz_data');


        $this->set(compact('quiz_data', 'options'));
    }

    /**
     * join_us method.
     *
     * wysylka maila z newslettera
     */
    public function join_us()
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->loadModel('Newsletter');
        if ($this->request->is('post')) {
            $data = array(
                'user_mail' => $this->request->data['mail'],
                'user_name' => $this->request->data['name']

            );
            $this->Newsletter->create();
            if ($this->Newsletter->save($data)) {
                $Email = new CakeEmail('smtp');
                $Email->to('tbiegun@180creative.pl');
                $Email->template('message', 'default');
                $Email->emailFormat('html');
                $Email->subject('GreenCook - Newsletter');
                $Email->viewVars(array(
                    'name' => $data['user_name'],
                    'mail' => $data['user_mail'],
                    'content' => 'Nowy użytkownik pragnie dołączyć do Naszego newslettera!',
                    'link' => 'http://' . $_SERVER['SERVER_NAME']));
                $Email->send();
                $this->Flash->success('Zapisanie do newslettera');
                $this->redirect($this->referer());
            }

        }
    }

    /**
     * turncateall method
     * bardzo przydatna funkcyjka, uzywa jej sobie zeby wszstko czyscic ladnie
     */
    public function turncateall()
    {
        $this->render(false);
        $this->layout = 'ajax';
        $this->loadModel('UserRecipe');
        $this->loadModel('Vote');
        $this->loadModel('Quiz');
        $this->loadModel('Nowantedproducts');
        $this->loadModel('Payment');
        $this->loadModel('Chart');
        $this->UserRecipe->query('TRUNCATE TABLE user_recipes;');
        $this->Vote->query('TRUNCATE TABLE votes;');
        $this->Quiz->query('TRUNCATE TABLE quizzes;');
        $this->Payment->query('TRUNCATE TABLE payments;');
        $this->Nowantedproducts->query('TRUNCATE TABLE nowantedproducts;');
        $this->Chart->query('TRUNCATE TABLE charts;');
        $this->redirect($this->referer());

    }

    /**
     * change_ingredients method.
     *
     * oblicza wartosci kaloryczne dla zmienionego przepisu.
     */
    public function change_ingredients()
    {
        $this->layout = 'ajax';

//        $body = $this->render('Elements/ingredients');
        $this->loadModel('RecipeProduct');
        $this->loadModel('Quiz');
        $this->loadModel('Product');
        $summary['Kaloryczność posiłku'] = 0;
        $summary['Węglowodany'] = 0;
        $summary['Białka'] = 0;
        $summary['Tłuszcze'] = 0;
        $TDEG_summary = 0;


        if ($this->request->is('post')) {
            if ($this->request->data('name') == 'Razem') {
                $quizzes = $this->Quiz->find('all', array(
                    'conditions' => array(
                        'Quiz.user_mail' => $this->Auth->user('mail')
                    ),
                    'recursive' => -1
                ));

                foreach ($quizzes as $quizze) {
                    $TDEG_summary += $quizze['Quiz']['tdeg'];
                }

            } else {
                $quiz = $this->Quiz->find('first', array(
                    'conditions' => array(
                        'Quiz.user_mail' => $this->Auth->user('mail'),
                        'Quiz.user_name' => $this->request->data('name')
                    ),
                    'recursive' => -1
                ));
                $TDEG_summary = $quiz['Quiz']['tdeg'];
            }

            $recipeProducts = $this->RecipeProduct->find('all', array(
                'conditions' => array(
                    'RecipeProduct.recipe_id' => $this->request->data('recipe_id')
                )
            ));
            foreach ($recipeProducts as $key => &$recipeProduct) {
                $recipeProduct['RecipeProduct']['value'] = round($recipeProduct['RecipeProduct']['value'] * $TDEG_summary / 1500, 0);
                $finalValue = $recipeProduct['RecipeProduct']['value'];
                $product = $this->Product->findByName($recipeProduct['RecipeProduct']['product_name']);
                $summary['Kaloryczność posiłku'] += (($product['Product']['kcal']) * ($finalValue)) / 100;
                $summary['Węglowodany'] += (($product['Product']['carbohydrates']) * ($finalValue)) / 100;
                $summary['Białka'] += (($product['Product']['proteins']) * ($finalValue)) / 100;
                $summary['Tłuszcze'] += (($product['Product']['fats']) * ($finalValue)) / 100;


            }
        }

        $this->set(compact('recipeProducts'));
    }

    /**
     * api_calc_bmi method.
     *
     * opis w collabie
     */
    public function api_calc_bmi()
    {
        $this->layout = 'ajax';
        $this->render(false);

        header('Content-Type: application/json; charset=utf-8');
        if ($this->request->query) {
            if (empty($this->request->data)) {
                $postdata = file_get_contents("php://input");
                $this->request->data = json_decode($postdata, true);
            }


            $summary = 'Nieokreślono';
            $weight = $this->request->query['weight'];
            $height = $this->request->query['height'];
            $bmi = ($weight / (($height / 100) * ($height / 100)));
            $bmi = round($bmi, 2);
            if ($bmi <= 16) {
                $summary = 'Wygłodzenie';
            }
            if (($bmi > 16) && ($bmi <= 17)) {
                $summary = 'Wychudzenie';
            }
            if (($bmi > 17) && ($bmi <= 18.5)) {
                $summary = 'Niedowaga';
            }
            if (($bmi > 18.5) && ($bmi <= 25)) {
                $summary = 'Prawidłowe';
            }
            if (($bmi > 25) && ($bmi <= 30)) {
                $summary = 'Nadwaga';
            }
            if (($bmi > 30) && ($bmi <= 35)) {
                $summary = 'I stopień otyłości';
            }
            if (($bmi > 35) && ($bmi <= 40)) {
                $summary = 'II stopień otyłości';
            }
            if ($bmi > 40) {
                $summary = 'III stopień otyłości';
            }

            echo json_encode(array('bmi' => $bmi, 'bmi_summary' => $summary));
        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }


        die();
    }

    /**
     * api_calc_tdee
     *
     * opis w collabie
     */
    public function api_calc_tdee()
    {
        $this->layout = 'ajax';
        $this->render(false);

        header('Content-Type: application/json; charset=utf-8');
        if ($this->request->query) {
            if (empty($this->request->data)) {
                $postdata = file_get_contents("php://input");
                $this->request->data = json_decode($postdata, true);
            }

            $bmr = 0;
            $E = 0;
            $TDEE = 0;

            if ($this->request->query['activity'] == 1) {
                $E = 1.2;
            }
            if ($this->request->query['activity'] == 2) {
                $E = 1.375;
            }
            if ($this->request->query['activity'] == 3) {
                $E = 1.55;
            }
            if ($this->request->query['activity'] == 4) {
                $E = 1.725;
            }
            if ($this->request->query['activity'] == 5) {
                $E = 1.9;
            }
            if ($this->request->query['gender'] == 1) {
                $bmr = 9.99 * ($this->request->query['weight']) + 6.25 * ($this->request->query['height']) - 4.92 * ($this->request->query['age']) + 5;
            } else {
                $bmr = 9.99 * ($this->request->query['weight']) + 6.25 * ($this->request->query['height']) - 4.92 * ($this->request->query['age']) - 161;
            }
            if ($this->request->is('post', 'put')) {
                debug($this->request->data());
                die();
                if ($this->request->data['Quiz']['activity'] == '1') {
                    debug($this->request);
                    die();


                }
            }


            $TDEE = round(($bmr * $E - 250 * $this->request->query['goal']), 0);
            echo json_encode(array('tdee' => $TDEE, 'unit' => 'kcal'));


        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }


        die();
    }

    /**
     * singlediet method.
     *
     * @param null $id
     *
     * pobiera jedna diete na front
     */
    public function singlediet($id = null)
    {
        $this->loadModel('Diet');
        $diet = $this->Diet->findById($id);
        $this->set(compact('diet'));

    }

    public function intro()
    {

    }

    public function pre_print_recipe()
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->loadModel('Recipe');
        $this->loadModel('Product');
        $this->loadModel('Quiz');
        $this->loadModel('RecipeProduct');
        $this->loadModel('Replacement');
        $this->loadModel('Vote');
        $recipes = $this->Recipe->find('all', array(
            'conditions' => array(
                'Recipe.id IN' => $this->request->data['Recipe']['elements']
            )
        ));


        foreach ($recipes as $step => &$recipe) {
            $recipeProducts = $this->RecipeProduct->find('all', array(
                'conditions' => array(
                    'RecipeProduct.recipe_id' => $recipe['Recipe']['id']
                )
            ));


            $summary['Kaloryczność posiłku'] = 0;
            $summary['Węglowodany'] = 0;
            $summary['Białka'] = 0;
            $summary['Tłuszcze'] = 0;
            $TDEG_summary = 0;
            $TDEG_count = 0;
            $names = array();
            $control = 0;


            $quizzes = $this->Quiz->find('all', array(
                'conditions' => array(
                    'Quiz.user_mail' => $this->Auth->user('mail')
                ),
                'recursive' => -1
            ));


            foreach ($quizzes as $quiz) {
                if ($quiz['Quiz']['tdeg'] < 1000) {
                    $TDEG_count += 1000;
                } else {
                    $TDEG_count += $quiz['Quiz']['tdeg'];
                }
                $names[] = $quiz['Quiz']['user_name'];
            }
            $control = count($names);
            $TDEG_summary = $TDEG_count / 1500;

            $all_replacements = array();
            foreach ($recipeProducts as $key => &$recipeProduct) {
                $recipeProduct['RecipeProduct']['value'] = round($recipeProduct['RecipeProduct']['value'] * $TDEG_summary, 0);
                $finalValue = $recipeProduct['RecipeProduct']['value'];
                $product = $this->Product->findByName($recipeProduct['RecipeProduct']['product_name']);
                $summary['Kaloryczność posiłku'] += (($product['Product']['kcal']) * ($finalValue)) / 100;
                $summary['Węglowodany'] += (($product['Product']['carbohydrates']) * ($finalValue)) / 100;
                $summary['Białka'] += (($product['Product']['proteins']) * ($finalValue)) / 100;
                $summary['Tłuszcze'] += (($product['Product']['fats']) * ($finalValue)) / 100;


                $replacements = $this->Replacement->find('first', array(
                    'conditions' => array(

                        'Replacement.body LIKE' => '%' . $recipeProduct['RecipeProduct']['product_name'] . '%'
                    )
                ));
                if ($replacements != null && !empty($replacements)) {
                    $pieces = explode('#', $replacements['Replacement']['body']);
                    $replacement_key = array_search($recipeProduct['RecipeProduct']['product_name'], $pieces);

                    $all_replacements[$pieces[$replacement_key]] = $pieces;
                    unset($all_replacements[$pieces[$replacement_key]][$replacement_key]);
                }


            }


            $final = 0;

            foreach ($summary as $key => $sum) {
                if ($key == 'Kaloryczność posiłku') {
                } else {

                    $final += $summary[$key];


                }
            }

            foreach ($summary as $key => $sum) {

                if ($key != 'Kaloryczność posiłku') {

                    $summary[$key . '_proc'] = round((($summary[$key] * 100) / $final), 0);

                }
            }
            $recipes[$step]['RecipeProduct'] = $recipeProducts;
            $recipes[$step]['Replacements'] = $all_replacements;
            $recipes[$step]['Summary'] = $summary;


        }
        $this->Session->write(array('print_recipe' => $recipes));
        echo json_encode('done');


    }

    public function print_recipe()
    {
        $this->layout = 'ajax';
        $recipes = $this->Session->read('print_recipe');
        $this->set(compact('recipes'));


        ob_start();
        include(APP . 'View' . DS . 'Pages' . DS . 'print_recipe.ctp');
        $content = ob_get_clean();


        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8');
            $html2pdf->setDefaultFont('freeserif');

            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output('Przepisy.pdf');
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }


}
