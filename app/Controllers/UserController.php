<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Services\YandexCapchaService;

class UserController extends Controller
{
    private UserService $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function create()
    {
        return $this->render('User/create');
    }
    public function login()
    {
        return $this->render('User/login');
    }
    public function auth(array $data)
    {
        $this->userService->auth($data);
        header('Location: /');
        exit();
    }
    public function edit()
    {
        //        Проверка на авторизацию
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit();
        } else {
            $id = $_SESSION['user']['id'];
            $user = $this->userService->findUserByParams(['id'=>$id]);
        }
        return $this->render('User/edit', ['user'=>$user]);
    }
    public function update(array $data)
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit();
        } else {
            $id = $_SESSION['user']['id'];
            $this->userService->updateUser($id, $data);
            $_SESSION['message']='You have updated you record';
        }
        header('Location: /userEdit');
        exit();

    }
    public function logout()
    {
        if (isset($_SESSION['auth'])) {
            session_destroy();
        }
        header('Location: /login');
        exit();
    }
    public function save(array $data)
    {
        $smartToken = $data['smart-token'];
        $captchaService = new YandexCapchaService('YOUR_YANDEX_SERVER_KEY', $smartToken);
        unset($data['smart-token']);
        $captchaCheck = $captchaService->check_captcha();
        if (!$captchaCheck) {
            header('Location: /login');
            $_SESSION['message']='You have not beaten captcha...';
            exit();
        }
        $this->userService->create($data);
        $_SESSION['message']='You have successfully registered, now log in';
        header('Location: /login');
        exit();
    }
}