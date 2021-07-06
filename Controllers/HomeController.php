<?php

class HomeController
{
    public function actionIndex()
    {
        if (!empty($_POST)) {
            $user = new Users;
            $isAdmin = $user->isAdmin(htmlentities($_POST['login']), htmlentities($_POST['password']));
            $user->loginAdmin($isAdmin);
        }
        include_once(ROOT.'/Views/home.php');
    }

    public function actionLogout()
    {
        session_destroy();
        header('Location: /');
        die();
    }
}

?>