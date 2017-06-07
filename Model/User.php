<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 */
class User extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    var $actsAs = array('Media.Transfer', 'Media.Coupler', 'Media.Meta', 'Media.Generator');
//    public function months($month = null)
//    {
//
//    }

    public function passGenerate()
    {
        $password = '';
        $special = array("*", "!", "-", "@", "$");
        for ($i = 0; $i < 2; $i++) {
            $password .= chr(rand(65, 90));
            $specialChar = $special[array_rand($special)];
            $password .= $specialChar[0];
            $password .= chr(rand(48, 57));
            $password .= chr(rand(97, 122));
        }

        return $password;
    }

    public function beforeSave($options = array())
    {

        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'mail' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'To pole nie może pozostać puste',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Niepoprawny adres e-mail',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Podany adres e-mail jest już zajęty',
            ),
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'To pole nie może pozostać puste',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'correct' => array(
                'rule' => array('checkPwd'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password-repeat' => array(
            'To pole nie może pozostać puste' => 'notBlank',
            'match' => array(
                'rule' => 'matchConfirm',
                'message' => 'Hasła się nie zgadzają'

            ),
        ),
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'To pole nie może pozostać puste',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'onlyLetters' => array(
                'rule' => '/^[a-zA-ZąęćżźńłóśĄĆĘŁŃÓ_ŚŹŻ\s]+$/',
                'message' => 'To pole może zawierać tylko litery',
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),

        ),
        'surname' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),

//            'notBlank' => array(
//                'rule' => array('notBlank'),
        //'message' => 'Your custom message here',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),

    );

    public function checkPwd($field)
    {
        $errors = array();
        $password = $field['password'];
        $response = array();
        $i = 0;
        if (strlen($password) >= 6) {
            preg_match_all("/[A-Z]/", $password, $response);

            if (count($response) < 1) {
                $errors [] = "Pole musi zawierać minimum jedną dużą literę";
                $i++;
                $response = array();
            }
            preg_match_all("/[0-9]/", $password, $response);
            if ((count($response) < 1) && ($i < 1)) {
                $errors [] = "Pole musi zawierać minimum jedną cyfrę";
                $i++;
                $response = array();
            }
            preg_match_all("/[^0-9a-zA-ZąęćżźńłóśĄĆĘŁŃÓŚŹŻ]/", $password, $response);
            if ((count($response) < 1) && ($i < 1)) {
                $errors [] = "Pole musi zawierać minimum jeden znak specjalny";
                $i++;
                $response = array();
            }
        } else {
            $errors [] = "Pole musi zawierać minimum 6 znaków.";
        }
//        debug($errors);die();


        if (!empty($errors)) {
//            debug(implode("\n", $errors));die();
            return implode("\n", $errors);
        }
        return true;
    }

    public function matchConfirm($data)
    {
//        debug($this->data);
//        debug($data);
//        die();
        if ($this->data['User']['password'] == $data['password-repeat']) {
            return true;
        } else {
            return false;
        }

    }

    public $hasMany = array(
        'Quiz' => array(
            'className' => 'Quiz',
            'foreignKey' => 'user_mail',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
}
