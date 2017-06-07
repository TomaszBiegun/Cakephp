<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $active = array(
        0 => 'Nieaktywny',
        1 => 'Aktywny'
    );
    public $role = array(
        0 => 'Użytkownik',
        1 => 'Administrator'
    );
    public $gender = array(
        0 => 'Kobieta',
        1 => 'Mężczyzna'
    );
    public $diet = array(
        0 => 'Wybierz dietę',
        1 => 'Zbilansowana',
        2 => 'Wegetariańska',
        3 => 'Wegańska',
        4 => 'Bezglutenowa',
        5 => 'Beznabiałowa',
        6 => 'Paleo',
        7 => 'Niskowęglowodanowa',
        8 => 'Wysokobiałkowa'
    );
    public $level = array(
        0 => 'Wybierz stopień trudności',
        1 => 'łatwy',
        2 => 'średni',
        3 => 'trudny'

    );
    public $activity = array(

        0 => 'Wybierz aktywność',
        1 => 'Bardzo niska - siedzący tryb pracy/ brak aktywności fizycznej',
        2 => 'Niska – mało aktywny tryb pracy/ lekka aktywność fizyczna 1-2 razy w tygodniu',
        3 => 'Średnia – umiarkowany tryb pracy/ćwiczenia lub treningi sportowe 3-4 razy w tygodniu',
        4 => 'Wysoka – praca fizyczna/ ćwiczenia/treningi sportowe 5-6 razy w tygodniu',
        5 => 'Bardzo wysoka – ciężki wysiłek dzienny/ wymagające ćwiczenia/treningi sportowe codzienne',
    );
    public $meal_count = array(
        0 => '-',
        1 => '3',
        2 => '4',
        3 => '5'

    );
    public $person_count = array(
        0 => '-',
        1 => 'dorośli (1-4 os)',
        2 => 'dzieci (1-4 os)'
    );

    public function beforeFilter()
    {
        parent::beforeFilter();

        $log = $this->isLogged();
        $verify = $this->verify();
        if ($this->params['prefix'] == 'admin') {
            $import = $this->isAvalible();
            $this->set('import', $import);
        }

        if ($log) {
            $user = $this->Auth->user();
            $this->set(compact('user'));
        }
        $this->set(compact('log'));
        $this->set('active', $this->active);
        $this->set('role', $this->role);
        $this->set('gender', $this->gender);
        $this->set('diet', $this->diet);
        $this->set('level', $this->level);
        $this->set('activity', $this->activity);
        $this->set('meal_count', $this->meal_count);
        $this->set('person_count', $this->person_count);


//        debug(WWW_ROOT);die();
    }

    public $helpers = array('Media.Media');
    public $components = array(
        'Paginator',
        'Session',
        'DebugKit.Toolbar',
        'Flash',
        'Auth' => array(
            'loginRedirect' => array(
                'admin' => true,
                'controller' => 'users',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'admin' => false,
                'controller' => 'pages',
                'action' => 'home'
            ),

            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                    'fields' => array('username' => 'mail')
                )
            )

        )
    );

    public function isLogged()
    {


        if ($this->Auth->user()) {
            return true;
        } else {

            return false;
        }
    }

    /**
     * isAvalible method.
     *
     * sprawdzam czy istnieje w ogole jakis produkt, jezeli nie to nie mozna importowac przepisow, najpierw produkty
     * @return bool
     */
    public function isAvalible()
    {
        $check = false;
        $this->loadModel('Product');
        $product = $this->Product->find('first');
        if (!empty($product)) {
            $check = true;
        } else {
            $check = false;
        }
        return $check;
    }

    /**
     * verify method.
     *
     * sprawdzam prefixy, admin nie moze chodzic po froncie i user nie moze wejsc w admina
     */
    public function verify()
    {

        $isUser = $this->Auth->user();

        if (($isUser != null) && (!empty($isUser))) {

            if ($this->params['prefix'] == 'admin') {

                if ($this->Auth->user('role') == 0) {

                    $this->redirect(array('admin' => false, 'controller' => 'pages', 'action' => 'missing'));
                }

            }
            if ($this->params['prefix'] != 'admin') {

                if ($this->Auth->user('role') == 1) {
                    $this->redirect(array('admin' => true, 'controller' => 'pages', 'action' => 'missing'));
                }

            }
        }

    }

    /**
     * TDEG method.
     *
     * @param null $data
     * @return float|null
     *
     * licze wspolczynnik tdeg zgodnie z wzorem ze specyfikacji
     */
    public function TDEG($data = null)
    {
        $bmr = null;
        $E = null;
        $F = null;
        $L = null;
        $TDEG = null;

        if ($data['gender'] == 0) {
            $bmr = 9.99 * ($data['weight']) + 6.25 * ($data['height']) - 4.92 * ($data['age']) - 161;
        } else {
            $bmr = 9.99 * ($data['weight']) + 6.25 * ($data['height']) - 4.92 * ($data['age']) + 5;
        }
        if ($data['activity'] == 1) {
            $E = 1.2;
        }
        if ($data['activity'] == 2) {
            $E = 1.375;
        }
        if ($data['activity'] == 3) {
            $E = 1.55;
        }
        if ($data['activity'] == 4) {
            $E = 1.725;
        }
        if ($data['activity'] == 5) {
            $E = 1.9;
        }
        if ($data['meal_count'] == 1) {
            $L = 1.54;
        }
        if ($data['meal_count'] == 2) {
            $L = 1.25;
        }
        if ($data['meal_count'] == 3) {
            $L = 1;
        }
        $F = $data['goal'];
        $TDEG = ($bmr * $E - 250 * $F) * $L;
        return $TDEG;

    }

    /**
     * clear_before_create method.
     *
     * czyszcze quiz uzytkownika,
     * uzytkownik moze miec tylko jeden quiz, wiec jezeli juz ma a wypelnia ponownie to
     * wyswietla mu sie dane z poprzedniego, natomiast przed samym zapisem odpali sie ta funkcja ktora usunie poprzedni quiz
     * @param null $mail
     */
    public function clear_before_create($mail = null)
    {
        $if_quizzes = $this->Quiz->find('all', array(
            'conditions' => array(
                'Quiz.user_mail' => $mail
            ),
            'recursive' => -1,
            'order' => array(
                'Quiz.id' => 'asc'
            )
        ));

        if (isset($if_quizzes[0])) {

            $this->Nowantedproduct->deleteAll(array(
                'Nowantedproduct.quiz_id' => $if_quizzes[0]['Quiz']['id']
            ));
            $this->UserRecipe->deleteAll(array(
                'UserRecipe.user_mail' => $if_quizzes[0]['Quiz']['user_mail']
            ));
            $this->Quiz->deleteAll(array(
                'Quiz.user_mail' => $if_quizzes[0]['Quiz']['user_mail']
            ));
        }
    }

    /**
     * nice_day method.
     *
     * @param null $date
     * @return string
     *
     * zamienia date na format wymagany do wykresu
     */
    public function nice_day($date = null)
    {
//        $date = explode("-", $date);
        $datetime = DateTime::createFromFormat('Y-m-d', $date);
        $day = $datetime->format('N');
        $day_number = $datetime->format('d');
        $month = $datetime->format('n');
        $year = $datetime->format('Y');
        if ($day == 1) {
            $day = 'Poniedziałek';
        }
        if ($day == 2) {
            $day = 'Wtorek';
        }
        if ($day == 3) {
            $day = 'Środa';
        }
        if ($day == 4) {
            $day = 'Czwartek';
        }
        if ($day == 5) {
            $day = 'Piątek';
        }
        if ($day == 6) {
            $day = 'Sobota';
        }
        if ($day == 7) {
            $day = 'Niedziela';
        }

        if ($month == 1) {
            $month = 'Styczeń';
        }
        if ($month == 2) {
            $month = 'Luty';
        }
        if ($month == 3) {
            $month = 'Marzec';
        }
        if ($month == 4) {
            $month = 'Kwiecień';
        }
        if ($month == 5) {
            $month = 'Maj';
        }
        if ($month == 6) {
            $month = 'Czerwiec';
        }
        if ($month == 7) {
            $month = 'Lipiec';
        }
        if ($month == 8) {
            $month = 'Sierpień';
        }
        if ($month == 9) {
            $month = 'Wrzesień';
        }
        if ($month == 10) {
            $month = 'Październik';
        }
        if ($month == 11) {
            $month = 'Listopad';
        }
        if ($month == 12) {
            $month = 'Grudzień';
        }
        $final_date = $day . ' ' . $day_number . ' ' . $month . ' ' . $year;

        return $final_date;
    }

}
