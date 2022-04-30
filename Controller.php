<?php
include_once 'DataBaseConnection.php';
include_once 'UserRepository.php';

class Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

    }

    public function signUp(): array
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_NUMBER_INT);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


        $existingUser = $this->userRepository->getByEmail($email);
        if (!is_null($existingUser)) {
            return [
                'message' => 'Пользователь уже существует',
                'status' => 409
            ];
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->userRepository->insert($name, $email, $mobile, $password);
        echo "";
        return [
            'message' => 'Пользователь создан',
            'status' => 201
        ];
    }

    public function singIn()
    {

    }
}