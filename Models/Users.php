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
        $users = $this->getUsers();
        $users[] = $data;
        $dataJson = json_encode($users);

        try {
            if (file_exists($this->file)) {
                file_put_contents($this->file, $dataJson);
            }
        } catch(Throwable $e) {
            'Error on insert user: '. $e->getMessage();
        }
    }

    public function getUsers()
    {
        try {
            $usersArr = json_decode(file_get_contents($this->file));
        } catch(Throwable $e) {
            'Error on get users: '. $e->getMessage();
        }
        return $usersArr;
    }

    public function getUsersHtml()
    {
        $users = $this->getUsers();

        $usersTable = '';
        foreach ($users as $user) { 
            $usersTable .= "<tr>
                <td>$user->name</td>
                <td>$user->surname</td>
                <td>$user->age</td>
            </tr>";
        }
        return $usersTable;
    }

    public function isAdmin($login, $password)
    {
        $users = $this->getUsers();
        $admin = $users[0];

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

    public function checkUsersData($data)
    {
        $requiredFields = ['name', 'surname', 'age', 'login', 'password'];

        $error = false;
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $error = true;
            }
        }
        return $error;
    }
}

?>