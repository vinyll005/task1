<?php

class UsersController
{
    private $usersObj;
    
    public function __construct()
    {
        $this->usersObj = new Users;
        $this->usersObj->checkAdmin();
    }

    public function actionIndex()
    {
        $users = $this->usersObj->getUsers();
        include_once(ROOT.'/Views/user.php');
    }
    
    public function actionCreate()
    {   
        if (!empty($_POST)) {
            try {
                $data = array(
                    'name' => htmlentities($_POST['name']),
                    'surname' => htmlentities($_POST['surname']),
                    'age' => htmlentities($_POST['age']),
                    'login' => htmlentities($_POST['login']),
                    'password' => password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT)
                );
            } catch (Exception $e) {
                echo 'Error find '. $e->getMessage();
            }

            
            $this->usersObj->createUser($data);
            header('Location: /users');
            die();
        }
        include_once(ROOT.'/Views/userCreate.php');
    }
}

?>