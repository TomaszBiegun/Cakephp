<?php
App::uses('AppController', 'Controller');
App::uses('PHPExcel', 'Vendor');
App::uses('Folder', 'Utility');
App::import('Vendor', 'IOFactory', array('file' => 'PHPExcel/IOFactory.php'));

/**
 * Recipes Controller
 *
 * @property Recipe $Recipe
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class RecipesController extends AppController
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
        $this->Auth->allow(array('admin_import', 'api_filter_recipes', 'api_get_recipe', 'api_change_recipe', 'api_get_kcal_today'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->layout = 'admin';
        $this->Paginator->settings = array(
            'recursive' => 0,
            'limit' => 10
        );

        $this->set('recipes', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     *
     * dokladam wartosci kaloryczne i produkty składowe potrawy
     */
    public function admin_view($id = null)
    {

        $this->layout = 'admin';
        $this->loadModel('RecipeProduct');
        $this->loadModel('Product');
        $this->Product->recursive = 0;
        if (!$this->Recipe->exists($id)) {
            throw new NotFoundException(__('Invalid recipe'));
        }
        $options = array('conditions' => array('Recipe.' . $this->Recipe->primaryKey => $id));
        $recipe = $this->Recipe->find('first', $options);
        $recipeProducts = $this->RecipeProduct->find('all', array(
            'conditions' => array(
                'RecipeProduct.recipe_id' => $recipe['Recipe']['id']
            )
        ));
        $summary['Kaloryczność posiłku'] = 0;
        $summary['Węglowodany'] = 0;
        $summary['Białka'] = 0;
        $summary['Tłuszcze'] = 0;
        foreach ($recipeProducts as $key => $recipeProduct) {
            $finalValue = $recipeProduct['RecipeProduct']['value'];
            $product = $this->Product->findByName($recipeProduct['RecipeProduct']['product_name']);
            $summary['Kaloryczność posiłku'] += (($product['Product']['kcal']) * ($finalValue)) / 100;
            $summary['Węglowodany'] += (($product['Product']['carbohydrates']) * ($finalValue)) / 100;
            $summary['Białka'] += (($product['Product']['proteins']) * ($finalValue)) / 100;
            $summary['Tłuszcze'] += (($product['Product']['fats']) * ($finalValue)) / 100;


        }

        foreach ($summary as $key => &$sum) {
            $summary[$key] = round($sum, 0);
            if ($key == 'Kaloryczność posiłku') {
                $summary[$key] = $summary[$key] . ' kcal';
            } else {
                $summary[$key] = $summary[$key] . ' g';
            }
        }


        $this->set(compact('recipe', 'recipeProducts', 'summary'));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        $this->layout = 'admin';
        $this->loadModel('Diet');
        $this->loadModel('Product');
        $products_all = $this->Product->find('all', array(

            'fields' => array('Product.name', 'Product.id')

        ));
        foreach ($products_all as $product) {
            $products[$product['Product']['name']] = $product['Product']['name'];
        }

        $diets = $this->Diet->find('all', array(

            'fields' => array('Diet.id', 'Diet.name')

        ));
        foreach ($diets as $diet) {
            $options[$diet['Diet']['id']] = $diet['Diet']['name'];
        }


        if ($this->request->is('post')) {
            debug($this->request->data);
            die();
            $this->Recipe->create();
            if ($this->Recipe->save($this->request->data)) {
                $this->Flash->success(__('Dodanie przepisu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Dodanie przepisu'));
            }
        }
        $this->set(compact('options', 'products'));
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
        if (!$this->Recipe->exists($id)) {
            throw new NotFoundException(__('Invalid recipe'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Recipe->save($this->request->data)) {
                $this->Flash->success(__('Edycja przepisu'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Edycja przepisu'));
            }
        } else {
            $options = array('conditions' => array('Recipe.' . $this->Recipe->primaryKey => $id));
            $this->request->data = $this->Recipe->find('first', $options);
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
        $this->Recipe->id = $id;
        if (!$this->Recipe->exists()) {
            throw new NotFoundException(__('Invalid recipe'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Recipe->delete()) {
            $this->Flash->success(__('Usunięcie przepisu'));
        } else {
            $this->Flash->error(__('Usunięcie przepisu'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_import method.
     *
     * @return \Cake\Network\Response|null
     * @throws Exception
     * @throws PHPExcel_Exception
     *
     * adjecia wykrywa z automatu, zapisuje je pod nazwa 4_litery_skoroszytu+coords_z_xls+extension
     */
    public function admin_import()
    {

        $this->layout = 'admin';
        $this->loadModel('Recipe');
        $this->loadModel('RecipeProduct');
        $this->loadModel('Product');
        $dataSource = $this->RecipeProduct->getDataSource();
        $confirm = false;

        $recipe = $this->Recipe->find('first');
        if (empty($recipe)) {
            $confirm = true;
        } else {
            $confirm = false;
        }


        if ($this->request->is('post')) {
            set_time_limit(0);
            $currentSheet = 1;
            $inputFileName = $this->request->data['Recipe']['file']['tmp_name'];

            $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
            $names = $objPHPExcel->getSheetNames();


            unset($names[0]);
            unset($names[max(array_keys($names))]);
            $dataSource->begin();
            foreach ($names as $key => $name) {
                $tabela = $objPHPExcel->getSheet($key)->toArray(null, true, true, true);
                foreach ($objPHPExcel->getSheet($key)->getDrawingCollection() as $drawing) {
                    if ($drawing instanceof PHPExcel_Worksheet_MemoryDrawing) {
                        ob_start();
                        call_user_func(
                            $drawing->getRenderingFunction(),
                            $drawing->getImageResource()
                        );
                        $imageContents = ob_get_contents();
                        ob_end_clean();
                        switch ($drawing->getMimeType()) {
                            case PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_PNG :
                                $extension = 'png';
                                break;
                            case PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_GIF:
                                $extension = 'gif';
                                break;
                            case PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_JPEG :
                                $extension = 'jpg';
                                break;
                        }
                    } else {
                        $zipReader = fopen($drawing->getPath(), 'r');
                        $imageContents = '';
                        while (!feof($zipReader)) {
                            $imageContents .= fread($zipReader, 1024);
                        }
                        fclose($zipReader);
                        $extension = $drawing->getExtension();
                    }
                    $cords = $drawing->getCoordinates();
                    if (!is_dir(WWW_ROOT . DS . 'odczyt')) {
                        mkdir(WWW_ROOT . DS . 'odczyt', 0777);
                    }
                    $filename = substr($name, 0, 4);
                    $myFileName = WWW_ROOT . DS . 'odczyt' . DS . $filename . '-' . $cords;
                    file_put_contents($myFileName, $imageContents);
                }


                foreach ($tabela as $keyRow => $row) {

                    $recipe = null;
                    $recipeProduct = null;
                    if ($keyRow > 1) {

                        if ($row['B'] != null) {

                            $recipe['Recipe']['lp'] = $row['A'];
                            $recipe['Recipe']['name'] = $row['B'];
                            $recipe['Recipe']['type'] = $row['C'];
                            $recipe['Recipe']['preparation'] = $row['D'];
                            $recipe['Recipe']['level'] = $row['E'];
                            $recipe['Recipe']['basename'] = $filename . '-I' . $keyRow;
                            $recipe['Recipe']['diet_name'] = $name;

                            $this->Recipe->create($recipe);

                            if ($data = $this->Recipe->save($recipe)) {
                                $recipeProduct['RecipeProduct']['recipe_id'] = $data['Recipe']['id'];
                                $recipeProduct['RecipeProduct']['product_name'] = $row['F'];
                                $product = $this->Product->findByName($row['F']);
                                $recipeProduct['RecipeProduct']['unit'] = $row['G'];
                                $recipeProduct['RecipeProduct']['value'] = $row['H'];
                                if (isset($product) && ($product != null)) {
                                    $recipeProduct['RecipeProduct']['group_id'] = $product['Product']['group_id'];
                                } else {
                                    $recipeProduct['RecipeProduct']['group_id'] = 0;
                                    $recipeProduct['RecipeProduct']['veryfied'] = 0;
                                    $refactor = array(
                                        'id' => $data['Recipe']['id'],
                                        'veryfied' => 0
                                    );
                                    $this->Recipe->create($refactor);
                                    $this->Recipe->save($refactor);

                                }


                                $this->RecipeProduct->create($recipeProduct);
                                $this->RecipeProduct->save($recipeProduct);
                            }


                        }
                        if (($row['B'] == null) && ($row['F'] != null)) {
                            $recipeProduct['RecipeProduct']['recipe_id'] = $data['Recipe']['id'];
                            $recipeProduct['RecipeProduct']['product_name'] = $row['F'];
                            $product = $this->Product->findByName($row['F']);
                            $recipeProduct['RecipeProduct']['unit'] = $row['G'];
                            $recipeProduct['RecipeProduct']['value'] = $row['H'];
                            if (isset($product) && ($product != null)) {
                                $recipeProduct['RecipeProduct']['group_id'] = $product['Product']['group_id'];
                            } else {
                                $recipeProduct['RecipeProduct']['group_id'] = 0;
                                $recipeProduct['RecipeProduct']['veryfied'] = 0;
                                $refactor = array(
                                    'id' => $data['Recipe']['id'],
                                    'veryfied' => 0
                                );
                                $this->Recipe->create($refactor);
                                $this->Recipe->save($refactor);

                            }


                            $this->RecipeProduct->create($recipeProduct);
                            $this->RecipeProduct->save($recipeProduct);
                        }


                    }


                }


            }

            $dataSource->commit();


            $this->Flash->success('Import');
            return $this->redirect(array('admin' => true, 'controller' => 'recipes', 'action' => 'index'));
        }
        $this->set(compact('confirm'));


    }

    public function admin_turncate()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $this->loadModel('Recipe');
        $this->loadModel('RecipeProduct');


        $this->Recipe->query('TRUNCATE TABLE recipes;');
        $this->RecipeProduct->query('TRUNCATE TABLE recipe_product');
        $dir = new Folder(WWW_ROOT . 'odczyt');
        if ($dir->delete()) {
            $this->Flash->success('Opróżnienie bazy przepisów ');
            return $this->redirect($this->referer());
        }

    }

    public function admin_change($id = null)
    {
        $this->layout = 'admin';
        $this->loadModel('RecipeProduct');
        $this->loadModel('Product');
        $recipeProduct = $this->RecipeProduct->findById($id);
        $this->Product->recursive = -1;
        $products = $this->Product->find('all', array(
            'fields' => array(
                'name',
                'id'
            )
        ));
        $options = array();
        $data = array();
        foreach ($products as $product) {
            $options[$product['Product']['id']] = $product['Product']['name'];
        }

        if ($this->request->is(array('post', 'put'))) {

            $product_find = $this->Product->findById($this->request->data['RecipeProduct']['product_id']);
            if (isset($product_find) && !empty($product_find)) {
                $data = array(
                    'id' => $this->request->data['RecipeProduct']['id'],
                    'product_name' => $product_find['Product']['name'],
                    'unit' => $this->request->data['RecipeProduct']['unit'],
                    'value' => $this->request->data['RecipeProduct']['value'],
                    'group_id' => $product_find['Product']['group_id'],
                    'veryfied' => 1

                );
                $this->RecipeProduct->create($data);
                if ($this->RecipeProduct->save($data)) {
                    $recipe_data = array(
                        'id' => $recipeProduct['RecipeProduct']['recipe_id'],
                        'veryfied' => 1
                    );
                    $this->Recipe->create($recipe_data);
                    if ($this->Recipe->save($recipe_data)) {
                        $this->Flash->success('Zmaiana składnika');
                        return $this->redirect(array('admin' => true, 'controller' => 'recipes', 'action' => 'view', $recipeProduct['RecipeProduct']['recipe_id']));
                    }

                }

            }


        }

        $this->set(compact('options', 'recipeProduct'));

    }

    public function api_filter_recipes()
    {
        $this->layout = 'ajax';
        $this->render(false);
        $this->loadModel('User');

        header('Content-Type: application/json; charset=utf-8');
        if ($this->request->query) {
            if (empty($this->request->data)) {
                $postdata = file_get_contents("php://input");
                $this->request->data = json_decode($postdata, true);
            }
            $level = null;
            $user = $this->User->findByHash($this->request->query['session-key']);

            if (isset($user['User'])) {
                if ($this->request->query['Recipe']['level'] == 1) {
                    $level = 'łatwy';
                }
                if ($this->request->query['Recipe']['level'] == 2) {
                    $level = 'średni';
                }
                if ($this->request->query['Recipe']['level'] == 3) {
                    $level = 'trudny';
                }
                $recipes = $this->Recipe->find('all', array(
                    'conditions' => array(
                        'Recipe.level' => $level,
                        'Recipe.diet_name' => $this->request->query['Diet']['name']
                    )
                ));

                echo json_encode(array('msg' => 'Portawy dostosowane do twoich potrzeb', 'recipes' => $recipes, 'session-key' => $user['User']['hash'], 'user' => $user));
            } else {
                echo json_encode(array('errors' => 'Użytkownik niezalogowany'));
            }

        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }


        die();
    }

    public function api_get_recipe()
    {
        $this->layout = 'ajax';
        $this->render(false);
        header('Content-Type: application/json; charset=utf-8');
        $this->loadModel('User');
        $this->loadModel('Product');
        $this->loadModel('Quiz');
        $this->loadModel('RecipeProduct');
        $this->loadModel('Replacement');
        if ($this->request->query) {
            if (empty($this->request->query)) {
                $postdata = file_get_contents("php://input");
                $this->request->query = json_decode($postdata, true);
            }
            $user = $this->User->findByHash($this->request->query['session-key']);
            if ((isset($user['User'])) && (!empty($user))) {


                $recipe = $this->Recipe->findById($this->request->query['recipe_id']);


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
                        'Quiz.user_mail' => $user['User']['mail']
                    ),
                    'recursive' => -1
                ));


                foreach ($quizzes as $quiz) {
                    $TDEG_count += $quiz['Quiz']['tdeg'];
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
                echo json_encode(array('session-key' => $user['User']['hash'], 'user' => $user, 'recipe' => $recipe, 'recipe_products' => $recipeProducts, 'summary' => $summary, 'replacements' => $all_replacements));


            }
        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }
        die();
    }

    public function api_change_recipe()
    {
        $this->layout = 'ajax';
        $this->render(false);
        header('Content-Type: application/json; charset=utf-8');
        $this->loadModel('User');
        if ($this->request->query) {
            if (empty($this->request->query)) {
                $postdata = file_get_contents("php://input");
                $this->request->query = json_decode($postdata, true);
            }
            $user = $this->User->findByHash($this->request->query['session-key']);
            if ((isset($user['User'])) && (!empty($user))) {
                $old_recipe = $this->Recipe->findById($this->request->query['recipe_id']);
                $recipes = $this->Recipe->find('all', array(
                    'conditions' => array(
                        'AND' => array(
                            'Recipe.id !=' => $old_recipe['Recipe']['id'],
                            'Recipe.level' => $old_recipe['Recipe']['level'],
                            'Recipe.diet_name' => $old_recipe['Recipe']['diet_name'],
                            'Recipe.type' => $old_recipe['Recipe']['type'],
                        )
                    )
                ));
                echo json_encode(array('session-key' => $user['User']['hash'], 'user' => $user, 'recipes' => $recipes));
            }
        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }

        die();
    }

    public function api_get_kcal_today()
    {
        $this->layout = 'ajax';
        $this->render(false);
        header('Content-Type: application/json; charset=utf-8');
        $this->loadModel('User');
        $this->loadModel('UserRecipe');
        $this->loadModel('RecipeProduct');
        $this->loadModel('Product');
        if ($this->request->query) {
            if (empty($this->request->query)) {
                $postdata = file_get_contents("php://input");
                $this->request->query = json_decode($postdata, true);
            }
            $user = $this->User->findByHash($this->request->query['session-key']);
            if ((isset($user['User'])) && (!empty($user))) {
                $user_recipes = $this->UserRecipe->find('all', array(
                    'conditions' => array(
                        'AND' => array(
                            'UserRecipe.user_mail' => $user['User']['mail'],
                            'UserRecipe.date' => date('Y-m-d')

                        )
                    )
                ));
                if (isset($user_recipes) && !empty($user_recipes)) {
                    $recipe_ids = array();
                    foreach ($user_recipes as $user_recipe) {
                        $recipe_ids[] = $user_recipe['UserRecipe']['recipe_id'];
                    }

                    $recipe_products = $this->RecipeProduct->find('all', array(
                        'conditions' => array(
                            'RecipeProduct.recipe_id IN' => $recipe_ids
                        )
                    ));
                    if (isset($recipe_products) && !empty($recipe_products)) {
                        $kcal = 0;
                        foreach ($recipe_products as $recipe_product) {
                            $this->Product->recursive = -1;
                            $product = $this->Product->findByName($recipe_product['RecipeProduct']['product_name']);

                            $kcal += round((($product['Product']['kcal'] * $recipe_product['RecipeProduct']['value']) / 100), 0);

                        }
                        echo json_encode(array('session-key' => $user['User']['hash'], 'user' => $user, 'kcal' => $kcal));
                    }
                }
            }
        } else {
            echo json_encode(array('errors' => 'Błędny request'));
        }
        die();
    }
}
