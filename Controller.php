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

        if (!$name || !$email || !$mobile || !$password) {
            return [
                'message' => 'Заполните поля',
                'status' => 400
            ];
        }

        $existingUser = $this->userRepository->getByEmail($email);
        if (!is_null($existingUser)) {
            return [
                'message' => 'Пользователь уже существует',
                'status' => 409
            ];
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->userRepository->insert($name, $email, $mobile, $password);
        return [
            'message' => 'Пользователь создан',
            'status' => 201
        ];
    }

    public function singIn():array
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if (!$email || !$password) {
            return [
                'message' => 'Заполните поля',
                'status' => 400
            ];
        }

        $existingUser = $this->userRepository->getByEmail($email);
        if (is_null($existingUser)) {
            return [
                'message' => 'Пользователя не существует',
                'status' => 404
            ];
        }

        if (!password_verify($password, $existingUser->password)) {
            return [
                'message' => 'Неверный логин или пароль',
                'status' => 403
            ];
        }

        $token =  $this->userRepository->insertToken($existingUser->id);
        $_COOKIE["token"] = $token;



        header("Location: page.php");

        //TODO Вернуть токен или записать его в куки
        return [
            'message' => 'В вас успешно вошли',
            'status' => 200
        ];
    }
}