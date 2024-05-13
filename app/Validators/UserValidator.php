<?php
namespace App\Validators;
use PDO;

class UserValidator
{
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    public function validateCreateRequest(array $data)
    {
        $user = [];
        $name = $data['name'];
        $auth = $data['auth'];
        $password = $data['password'];
        $passRepeat = $data['passwordRepeat'];
        $user = array_merge($user, $this->validateName($name, 'create'));
        $user =  array_merge($user, $this->validateAuth($auth, 'create'));
        $user =  array_merge($user, $this->validatePassword($password, 'create'));
        if (!$password === $passRepeat) {
            $_SESSION['erros']='password and repeat not matching';
        }
        if (isset($_SESSION['errors'])) {
            $this->redirectBack($data, '/userCreate');
        }
        return $user;
    }
    public function validateLoginRequest(array $data)
    {
        $user = [];
        $auth = $data['auth'];
        $password = $data['password'];
        $user = array_merge($user, $this->validateAuth($auth, 'create'));
        $user = array_merge($user, $this->validatePassword($password, 'create'));
        return $this->findUser($user);
    }
    private function findUser(array $data)
    {
        $params = implode("= ? OR ", array_keys($data));
        $values =  array_values($data);
        $query= "SELECT * FROM users WHERE $params = ?";
        $statement = $this->connection->prepare($query);
        $statement->execute($values);
        return $statement->fetch();
    }
    private function redirectBack(array $data, string $url)
    {
        $_SESSION['data']=$data;
        header("Location:$url");
        exit();
    }
    private function validatePassword(?string $password,string $group)
    {
        //        В планах было сделать несколько групп поэтому оставил switch
        switch ($group){
        case 'create':
            if (!$password) {
                $_SESSION['errors'][]='password is required';
            };
        }
        return ['password'=>$password];
    }
    private function validateName(?string $name,string $group)
    {
        switch ($group){
        case 'create':
            if(!$name) {
                $_SESSION['errors'][]='user name required';
            } else {
                if (mb_strlen($name)<5) {
                    $_SESSION['errors'][]='min name length is 5';
                }
            }
        }
        return ['name'=>$name];
    }
    private function validateAuth(?string $auth,string $group)
    {
        switch ($group){
        case 'create':
            if (!$auth) {
                $_SESSION['errors'][]='mail or phone number is required';
            } else {
                if (filter_var($auth, FILTER_VALIDATE_EMAIL)) {
                    return ['mail'=>$auth];
                } else{
                    if (!str_starts_with($auth, '8') and mb_strlen($auth)!==11) {
                        $_SESSION['errors'][]='please write phone number in format 8XXXXXXXXXX';
                    }
                    return ['phone'=>$auth];
                }
            }
        }
        throw new \Exception('something went wrong with auth');
    }
}