<?php

class Users
{
    private $file;

    public function __construct()
    {
        $this->file = 'users.json';
    }

    public function createUser($data)
    {
        $dataJson = json_encode($data);

        if (file_exists($this->file)) {
            file_put_contents($this->file, $dataJson . PHP_EOL, FILE_APPEND);
        }
    }

    public function getUsers()
    {
        $file = fopen($this->file, 'r');

        $usersArr = array();
        while (($line = fgets($file)) !== false) {
            $usersArr[] = json_decode($line);
        }
        fclose($file);
        return $usersArr;
    }

    public function isAdmin($login, $password)
    {
        $file = fopen($this->file, 'r');

        $admin = json_decode(fgets($file));
        if ($login == $admin->login && password_verify($password, $admin->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function loginAdmin($isAdmin)
    {
        if ($isAdmin) {
            $_SESSION['admin'] = true;
            header('Location: /users'); 
        } else {
            header('Location: /');
        }
        die();
    }

    public function checkAdmin()
    {
        if (!$_SESSION['admin']) {
            header('Location: /');
            die();
        }
    }
}

?>