<?php

class HomeController extends Controller
{  
    public function actionIndex()
    {
        $this->getViewsContent();

        if (!empty($_POST)) {
            $user = new Users;
            $isAdmin = $user->isAdmin(htmlentities($_POST['login']), htmlentities($_POST['password']));
            $user->loginAdmin($isAdmin);
        }
        return $this->view;
    }

    public function actionLogout()
    {
        session_destroy();
        header('Location: /');
        die();
    }
}

?>