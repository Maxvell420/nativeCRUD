<?php
namespace App\Services;
use App\Models\User;
use App\Validators\UserValidator;

class UserService
{
    private User $user;
    private object $validator;
    public function __construct()
    {
        $this->user = User::getInstance();
        $this->validator = new UserValidator($this->user->getConnection());
    }
    public function create(array $data)
    {
        $validated = $this->validator->validateCreateRequest($data);
        $this->user->create($validated);
        return true;
    }
    public function updateUser(string|int $id, array $data)
    {
        $this->user->update($id,$data);
    }
    public function auth(array $data)
    {
        $user = $this->validator->validateLoginRequest($data);
        $name = $user['name']??throw new \Exception('name is not provided');
        $id = $user['id']??throw new \Exception('id is not provided');
        $_SESSION['auth']=true;
        $_SESSION['user']['name']=$name;
        $_SESSION['user']['id']=$id;
        return true;
    }
    public function findUserByParams(array $data)
    {
        return $this->user->find($data);
    }
}