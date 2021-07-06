<?php

class UsersController extends Controller
{
    private $users;
    
    public function __construct($viewsFile)
    {
        parent::__construct($viewsFile);
        $this->getViewsContent();
        $this->users = new Users;
        $this->users->checkAdmin();
    }

    public function actionIndex()
    {
        $users = $this->users->getUsersHtml();
        $this->view = str_replace('%usersTable%', $users, $this->view);
        return $this->view;
    }
    
    public function actionCreate()
    {  
        if (!empty($_POST)) {
            if (!$this->users->checkUsersData($_POST)) {
                $data = array(
                    'name' => htmlentities($_POST['name']),
                    'surname' => htmlentities($_POST['surname']),
                    'age' => htmlentities($_POST['age']),
                    'login' => htmlentities($_POST['login']),
                    'password' => password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT)
                );
               
                $this->users->createUser($data);
                header('Location: /users');
                die();
            } else {
                throw new Exception('One of the fields is empty!');
            }
        } 
        return $this->view;
    }
}

?>