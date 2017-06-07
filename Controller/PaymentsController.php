<?php

/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 26.05.2016
 * Time: 23:18
 */
class PaymentsController extends AppController
{
    public $components = array('Paginator', 'Flash', 'Session');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('add', 'check', 'shop_add', 'shop_check'));
    }

    /**
     * add method.
     *
     * platnosc za pakiet, ta "ukryta" przez dotpay
     */
    public function add()
    {
        $this->layout = 'ajax';
        $this->render(false);

//        die();
        $this->loadModel('Pack');
        $this->loadModel('Quiz');
        $allow_server = array('217.17.41.5', '195.150.9.37');


//Sprawdzamy czy w/w tablica zawiera numer IP klienta który właśnie się z nami łączy
        if (!in_array($_SERVER['REMOTE_ADDR'], $allow_server)) {
            exit('You are not authorized to do this operation!'); //Jeśli nie, to kończymy skrypt
        }

//Jeśli wszystko jest OK, to zaczynamy księgowanie
        if ($_POST['control'] != '') {
            $control = $_POST['control'];
            $amount = $_POST['amount'];
            $user_mail = $_POST['email'];
            $amount = $_POST['amount'];
            $dotpay_id = $_POST['t_id'];
            $pack = $this->Pack->findById($control);
            if (isset($pack['Pack'])) {
                $data = array(
                    'user_mail' => $user_mail,
                    'pack_id' => $pack['Pack']['id'],
                    'due_date' => date('Y-m-d', strtotime(' +' . $pack['Pack']['per'] . ' month')),
                    'amount' => $amount,
                    'dotpay_id' => $dotpay_id

                );
                $quiz = $this->Quiz->find('first', array(
                    'conditions' => array(
                        'Quiz.user_mail' => $user_mail
                    ),
                    'recursive' => -1
                ));
                $this->Payment->create($data);
                $this->Payment->save($data);


                if (!empty($quiz) && ($quiz != null)) {
                    $quiz['Quiz']['active'] = 1;
                    $this->Quiz->create($quiz);
                    $saved_quiz = $this->Quiz->save($quiz);


                }


//                if ($this->Payment->save($data)) {
//                    if (($this->Auth->user() != null) && !empty($this->Auth->user())) {
//                        $this->Flash->success('Płatność za pakiet - ' . $pack['Pack']['title']);
//                        return $this->redirect(array('controller' => 'users', 'action' => 'account'));
//                    } else {
//                        $this->Flash->mymessage('Płatność za pakiet - ' . $pack['Pack']['title'] . ' została przyjęta, prosimy o zalogowanie się lub zarejestrowanie.');
//                        return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
//                    }
//
//                }
            }
            echo "OK";
//
        }
    }

    /**
     * check method.
     *
     * tu kieruje po powrocie do greencook z dotpay.
     * @return \Cake\Network\Response|null
     */
    public function check()
    {
        $this->layout = 'ajax';
        $this->render(false);
        if ($_POST['status'] == 'OK') {
//            var_dump($this->Auth->user());
            if ($this->Auth->user() != null) {
                $this->Flash->success('Płatność za pakiet');
                return $this->redirect(array('controller' => 'users', 'action' => 'account'));
            } else {
                $this->Flash->mymessage('Płatność za pakiet została przyjęta, prosimy o zalogowanie się lub zarejestrowanie.');
                return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
            }
        } else {
            $this->Flash->error('Płatność za pakiet');
            return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }


    }

    /**
     * shop_add method.
     *
     * ukryta funkcja przez dotpay zapisuje dane do koszyka
     */
    public function shop_add()
    {
        $this->layout = 'ajax';
        $this->render(false);

//        die();
        $this->loadModel('Basket');

        $allow_server = array('217.17.41.5', '195.150.9.37', '127.0.0.1');


//Sprawdzamy czy w/w tablica zawiera numer IP klienta który właśnie się z nami łączy
        if (!in_array($_SERVER['REMOTE_ADDR'], $allow_server)) {
            exit('You are not authorized to do this operation!'); //Jeśli nie, to kończymy skrypt
        }

//Jeśli wszystko jest OK, to zaczynamy księgowanie
        if ($_POST['control'] != '') {
            $control = $_POST['control'];
            $amount = $_POST['amount'];
            $user_mail = $_POST['email'];
            $dotpay_id = $_POST['t_id'];
//            $basket = $this->Basket->findById($control);
            $data = array(
                'id' => $control,
                'user_mail' => $user_mail,
                'payment_status' => 'Wykonano',
                'dotpay_id' => $dotpay_id
            );


//            if ($amount >= $basket['Basket']['total_price']) {
            $this->Session->write('basket_id', null);
            $this->Session->delete('basket_id');
            $this->Basket->create();
            $this->Basket->save($data, false);

//            }


        }
        echo "OK";
    }

    /**
     * shop_check method.
     *
     * @return \Cake\Network\Response|null
     *
     * tu kieruje po przekierowaniu na greencooka po platnosci dotyczy koszyka
     */
    public function shop_check()
    {
        $this->layout = 'ajax';
        $this->render(false);
        if ($_POST['status'] == 'OK') {
//            var_dump($this->Auth->user());

            $this->Flash->mymessage('Płatność za produkty została przyjęta');
            return $this->redirect(array('controller' => 'pages', 'action' => 'home'));

        } else {
            $this->Flash->error('Płatność za pakiet');
            return $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
    }

}