<?php

/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 27.05.2016
 * Time: 10:59
 */
class BasketsController extends AppController
{
    public $components = array('Paginator', 'Flash', 'Session');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('add', 'get', 'session_destroy', 'subtract', 'delete', 'delivery', 'save_before_pay'));
    }

    public function admin_index()
    {
        $this->layout = 'admin';
        $this->Paginator->settings = array(
            'limit' => 10
        );

        $baskets = $this->Paginator->paginate();
        foreach ($baskets as &$basket) {
            $basket['Basket']['products'] = unserialize($basket['Basket']['products']);

        }
        $this->set(compact('baskets'));
    }

    /**
     * save_before_pay method.
     *
     * przed platnoscia zapisuje koszyk do bazy
     */
    public function save_before_pay()
    {
        $this->layout = 'ajax';
        $this->render(false);
        if ($this->request->is('post')) {
            $data = $this->request->data['Basket'];
            $this->Basket->create();
            if ($this->Basket->save($data)) {
                echo json_encode(array('success' => true));
                die();
            }
        }
    }

    /**
     * get method
     *
     * pobiera basket_id z sesji jezeli jest
     * renderuje widok koszyka z elementu o nazwie items
     */
    public function get()
    {
        $this->layout = 'ajax';
        $this->render(false);
        if ($this->request->is('post')) {
            if ($this->Session->check('basket_id')) {
                $basket_id = $this->Session->read('basket_id');
                if (($basket_id) != null && !empty($basket_id)) {
                    $basket = $this->Basket->findById($basket_id);
                    $products = unserialize($basket['Basket']['products']);
                    $view = new View($this, false);
                    $content = $view->element('items', array('items' => $products, 'delivery_name' => $basket['Basket']['delivery_name'], 'total_price' => $basket['Basket']['total_price'], 'basket_id' => $basket['Basket']['id']));
                    echo $content;

                }
                die();


            } else {
                echo 'empty-basket';
                die();
            }
        }
    }

    /**
     * add method.
     *
     * dodanie produktu do koszyka
     * jezeli produkt nie istnieje w koszyku to go dodaje oraz edytuje koszyk w bazie
     * jezeli produkt jest juz w koszyku to dodaje counta do produktu oraz zwieksza total price
     * jezeli koszyk nie istnieje to go tworzy, dodaje wybrany produkt i zapisuje do bazy
     */
    public function add()
    {
        $this->render(false);
        $this->layout = 'ajax';
        $this->loadModel('Item');


        if ($this->request->is('post')) {
            $products = array();
            $product_exist = false;
            $total_price = 0;
            $product_id = $this->request->data['product_id'];

            $product = $this->Item->findById($product_id);

            if (($product != null) && !empty($product)) {
                //jest produkt
                if ($this->Session->check('basket_id')) {
                    //jest koszyk
                    $basket_id = $this->Session->read('basket_id');
                    if (($basket_id) != null && !empty($basket_id)) {
                        $basket = $this->Basket->findById($basket_id);
                        $products = unserialize($basket['Basket']['products']);
                        //ponizej sprawdzam czy produkt istnieje juz w koszyku jezeli tak to zwiekszam count 0 1 i wychodze
                        foreach ($products as &$one_product) {
                            if ($one_product['id'] == $product_id) {
                                $one_product['count']++;
                                $product_exist = true;
                                break;
                            }
                        }
                        //jezeli produkt nie istnieje to go dodaje
                        if (!$product_exist) {
                            $product_data = array(
                                'id' => $product_id,
                                'count' => 1,
                                'amount' => $product['Item']['price'],
                                'dirname' => $product['Item']['dirname'],
                                'basename' => $product['Item']['basename'],
                                'title' => $product['Item']['title']
                            );
                            array_push($products, $product_data);
                        }
                        foreach ($products as $item) {
                            $total_price += $item['count'] * $item['amount'];
                        }
                        $total_price += $basket['Basket']['delivery_price'];
                        $data = array(
                            'id' => $basket['Basket']['id'],
                            'products' => serialize($products),
                            'total_price' => $total_price
                        );
                        $this->Basket->create($data);
                        $this->Basket->save($data);
                    }

                } else {
                    //nie ma koszyka
                    $products[0] = array(
                        'id' => $product_id,
                        'count' => 1,
                        'amount' => $product['Item']['price'],
                        'dirname' => $product['Item']['dirname'],
                        'basename' => $product['Item']['basename'],
                        'title' => $product['Item']['title']
                    );
                    $basket = array(
                        'products' => serialize($products),
                        'total_price' => $product['Item']['price'],
                        'payment_status' => 'W trakcie realizacji'
                    );
                    $this->Basket->create();
                    if ($saved_basket = $this->Basket->save($basket)) {
                        $this->Session->write('basket_id', $saved_basket['Basket']['id']);
                    }
                }
            }
            echo json_encode('success');
        }
    }

    /**
     * sybstract method.
     *
     * odejmuje liczbe jednego przedmiotu z koszyka, minimalna wartosc to 1 i jest blokada na forncie wiec nie mozna dalej odejmowac
     */
    public function subtract()
    {
        $this->render(false);
        $this->layout = 'ajax';
        $total_price = 0;
        if ($this->request->is('post')) {
            if ($this->Session->check('basket_id')) {
                //jest koszyk
                $basket_id = $this->Session->read('basket_id');
                $product_id = $this->request->data['product_id'];

                $basket = $this->Basket->findById($basket_id);
                $products = unserialize($basket['Basket']['products']);

                foreach ($products as &$product) {
                    if ($product['id'] == $product_id) {
                        $product['count']--;
                        break;
                    }
                }
                foreach ($products as $item) {
                    $total_price += $item['count'] * $item['amount'];
                }
                $total_price += $basket['Basket']['delivery_price'];
                $data = array(
                    'id' => $basket_id,
                    'products' => serialize($products),
                    'total_price' => $total_price
                );
                $this->Basket->create($data);
                $this->Basket->save($data);
            }
        }

    }

    /**
     * delete method.
     *
     * usuwa caly produkt z koszyka oraz oblicza total price po jego usunieciu, zapisuje zmiany w bazie
     *
     */
    public function delete()
    {
        $this->render(false);
        $this->layout = 'ajax';
        $total_price = 0;
        $product_to_delete = 0;
        if ($this->request->is('post')) {
            if ($this->Session->check('basket_id')) {
                //jest koszyk
                $basket_id = $this->Session->read('basket_id');
                $product_id = $this->request->data['product_id'];
                $basket = $this->Basket->findById($basket_id);
                $products = unserialize($basket['Basket']['products']);
                foreach ($products as $key => $product) {
                    if ($product['id'] == $product_id) {
                        $product_to_delete = $key;
                        break;
                    }
                }

                unset($products[$product_to_delete]);

                foreach ($products as $item) {
                    $total_price += $item['count'] * $item['amount'];
                }
                $data = array(
                    'id' => $basket_id,
                    'products' => serialize($products),
                    'total_price' => $total_price
                );
                $this->Basket->create($data);
                $this->Basket->save($data);
            }
        }
    }

    /**
     * session_destroy
     *
     * do testow z koszykiem , usuwa sesje
     */
    public function session_destroy()
    {
        $this->render(false);
        $this->layout = 'ajax';
        $this->Session->destroy();
        $this->redirect($this->referer());
    }

    /**
     * delivery method.
     *
     * wybor mozliwosci przewoznika w koszyku, edytuje wpis koszyka w bazie
     */
    public function delivery()
    {
        $this->render(false);
        $this->layout = 'ajax';
        $total_price = 0;
        if ($this->request->is('post')) {
            if ($this->Session->check('basket_id')) {
                //jest koszyk
                $basket_id = $this->Session->read('basket_id');
                $basket = $this->Basket->findById($basket_id);
                $products = unserialize($basket['Basket']['products']);

                foreach ($products as $product) {
                    $total_price += $product['count'] * $product['amount'];
                }
                $total_price += $this->request->data['delivery_price'];


                $data = array(
                    'id' => $basket_id,
                    'delivery_name' => $this->request->data['delivery_name'],
                    'delivery_price' => $this->request->data['delivery_price'],
                    'total_price' => $total_price
                );
                $this->Basket->create($data);
                $this->Basket->save($data);
            }
        }
    }

}