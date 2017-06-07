<?php
App::uses('PHPExcel', 'Vendor');
App::import('Vendor', 'IOFactory', array('file' => 'PHPExcel/IOFactory.php'));

/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 24.03.2016
 * Time: 08:42
 */
class ExcelsController extends AppController
{

    public $components = array('Paginator', 'Flash', 'Session');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('admin_index', 'admin_import', 'admin_export', 'admin_turncate', 'admin_download', 'admin_replacements', 'admin_downloadreplacements', 'admin_replacements'));
    }


    public function admin_index()
    {
        $this->layout = 'admin';
    }

    /**
     * admin_import method.
     *
     * @return \Cake\Network\Response|null
     * @throws PHPExcel_Exception
     *
     * przejscie foreach'ami przez wiersze/kolumny
     */
    public function admin_import()
    {

        $this->loadModel('Product');
        $this->loadModel('Componnent');
        $this->loadModel('Group');
        $this->layout = 'admin';
        $confirm = false;
        $product = $this->Product->find('first');
        $dataSource = $this->Componnent->getDataSource();


        if (empty($product)) {
            $confirm = true;
        } else {
            $confirm = false;
        }


        if ($this->request->is('post')) {
            set_time_limit(0);

            $inputFileName = $this->request->data['Excels']['file']['tmp_name'];

            $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

//        $lastRow = $objPHPExcel->getSheet(0)->getHighestDataColumn();


            $tabela = $objPHPExcel->getSheet(0)->toArray(null, true, true, true);
//        $sheetData = $objPHPExcel->getSheet(0)->rangeToArray('A1:CK3');
//debug($tabela);die();

            $iterator = 0;
            $dataSource->begin();
            foreach ($tabela as $keyRow => $row) {

                $product = null;
                $componnent = null;

                if (($keyRow >= 4) && ($tabela[$keyRow]['A'] != null)) {
                    $product['Product']['Lp'] = $tabela[$keyRow]['A'];
                    $product['Product']['name'] = $tabela[$keyRow]['C'];
                    $product['Product']['shoplist'] = $tabela[$keyRow]['D'];

                    $product['Product']['kcal'] = $tabela[$keyRow]['G'];
                    $product['Product']['carbohydrates'] = $tabela[$keyRow]['M'];
                    $product['Product']['proteins'] = $tabela[$keyRow]['I'];
                    $product['Product']['fats'] = $tabela[$keyRow]['L'];

                    $group = $this->Group->findByName($tabela[$keyRow]['B']);
                    if (!empty($group) && isset($group)) {
                        $product['Product']['group_id'] = $group['Group']['id'];

                    } else {
                        $this->Group->create();
                        $group_data = $this->Group->save(array('Group' => array('name' => $tabela[$keyRow]['B'])));
                        $product['Product']['group_id'] = $group_data['Group']['id'];
                    }

                    $this->Product->create($product);

                    if ($saved = $this->Product->save($product)) {

                        foreach ($row as $keyCol => $cell) {
                            $iterator++;

                            if (($iterator >= 5) && ($tabela[1][$keyCol] != null)) {

                                $componnent['Componnent']['product_id'] = $saved['Product']['id'];
                                $componnent['Componnent']['category'] = $tabela[1][$keyCol];
                                $componnent['Componnent']['name'] = $tabela[2][$keyCol];
                                $componnent['Componnent']['unit'] = $tabela[3][$keyCol];
                                $componnent['Componnent']['value'] = $cell;
                                $this->Componnent->create($componnent);
                                $this->Componnent->save($componnent);
                            }


                        }
                        $iterator = 0;


                    }


                }


            }
            $dataSource->commit();


            $this->Flash->success('Import');
            return $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'index'));
        }
        $this->set(compact('confirm'));


    }

    /**
     * admin_turncate method.
     * @return \Cake\Network\Response|null
     *
     * czysci produkty i komponenty
     * nie uzywam tego z cmsa ani z frontu, dla wlasnych potrzeb
     */
    public function admin_turncate()
    {
        $this->layout = 'admin';
        $this->render(false);
        $this->loadModel('Product');
        $this->loadModel('Componnent');
        $this->Product->query('TRUNCATE TABLE products;');
        $this->Componnent->query('TRUNCATE TABLE componnents');
        $this->Flash->success('Opróżnienie bazy produktów ');
        return $this->redirect($this->referer());
    }

//    public function admin_export()
//    {
//        $this->layout = 'admin';
//        $this->render(false);
//        $objExcel = new PHPExcel();
//        $objExcel->getProperties()->setCreator('Tomasz Biegun');
//        $objExcel->getProperties()->setLastModifiedBy('Tomasz Biegun');
//        $objExcel->getProperties()->setTitle('Test Tytułu Tomasza Bieguna');
//        $objExcel->getProperties()->setSubject('Tytuł Pliku');
//        $objExcel->getProperties()->setDescription('Testowy opis');
//
//
//        $objExcel->setActiveSheetIndex(0);
//        $objExcel->getActiveSheet()->setCellValue('A1', 'Siemanko2');
//        $objExcel->getActiveSheet()->setCellValue('A2', 'Testy testy2');
//
//
//        $objWrite = new PHPExcel_Writer_Excel2007($objExcel);
//        $objWrite->save(WWW_ROOT . DS . 'odczyt' . DS . 'moje.xlsx');
//        $this->Flash->success('Export');
//        return $this->redirect($this->referer());
//    }
    /**
     * admin_download method.
     *
     * pobiera przykladowy plik z takimi wartosciami jakie akceptuje algorytm importu
     */
    public function admin_download()
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->response->file(WWW_ROOT . DS . 'template' . DS . 'baza.xlsx', array('download' => true, 'name' => 'template.xlsx'));
    }

    /**
     * admin_replacement method.
     *
     * @return \Cake\Network\Response|null
     * @throws PHPExcel_Exception
     *
     * pobiera zamienniki z jednego rzedu traktujac je jako zamienniki kazdy-z kazdym w obrebie jednego rzedu
     * oddzielam zamienniki pomiedzy soba # bo , wystepuje w nazwach produktow np mleko UHT 3,5% tluszczu
     */
    public function admin_replacement()
    {
        $this->layout = 'admin';
        $this->loadModel('Replacement');
        $dataSource = $this->Replacement->getDataSource();


        if ($this->request->is('post')) {
            set_time_limit(0);

            $inputFileName = $this->request->data['Excels']['file']['tmp_name'];

            $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

//        $lastRow = $objPHPExcel->getSheet(0)->getHighestDataColumn();


            $tabela = $objPHPExcel->getSheet(0)->toArray(null, true, true, true);
//        $sheetData = $objPHPExcel->getSheet(0)->rangeToArray('A1:CK3');


            $dataSource->begin();
            $replacements = "";

            foreach ($tabela as $keyRow => $row) {
                $iterator = 0;

                foreach ($row as $keyCol => $item) {

                    if ($item != null && !empty($item) && ($item != " ")) {
                        if ($iterator < 1) {
                            $replacements .= $item;
                        } else {
                            $replacements .= '#' . $item;
                        }
                    }
                    $iterator++;

                }


                if ($replacements != null && !empty($replacements)) {
                    $data = array(
                        'body' => $replacements
                    );
                    $this->Replacement->create();
                    $this->Replacement->save($data);
                }
                $replacements = '';
            }
            $dataSource->commit();
            $this->Flash->success('Import');
            return $this->redirect(array('admin' => true, 'controller' => 'excels', 'action' => 'replacement'));
        }
    }

    /**
     * admin_replacements method.
     *
     * wyswietla zamienniki w cmsie
     */
    public function admin_replacements()
    {
        $this->loadModel('Replacement');
        $this->layout = 'admin';
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $replacements = $this->Paginator->paginate('Replacement');
        $this->set(compact('replacements'));

    }

    /**
     * admin_downloadreplacemets
     *
     * pobiera przykladowy plik z zamiennikami
     */
    public function admin_downloadreplacements()
    {
        $this->layout = 'ajax';
        $this->render(false);

        $this->response->file(WWW_ROOT . DS . 'template' . DS . 'zamienniki.xlsx', array('download' => true, 'name' => 'zamienniki.xlsx'));


    }
}