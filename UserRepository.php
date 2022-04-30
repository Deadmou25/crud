<?php
include 'DataBaseConnection.php';
require('UserModel.php');

class UserRepository
{

    private DataBaseConnection $connector;

    public function __construct(DataBaseConnection $connector)
    {
        $this->connector = $connector;
    }

    public function signUp(string $name, string $email, int $mobile, string $password)
    {

        $existingUser = $this->getByEmail($email);
        if(!is_null($existingUser)){
            echo "Пользователь уже существует";
            return;
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = ("INSERT INTO user (`name`, `email`, `mobile`,`password`) VALUES(?,?,?,?)");
        $query = $this->connector->getPDO()->prepare($sql);
        $query->execute([$name, $email, $mobile, $password]);
        echo "Пользователь создан";
    }

    public function singIn()
    {

    }

    public function getByEmail(string $email): ?UserModel
    {
        $sql = "SELECT name, email, mobile, password FROM user WHERE email = ?";
        $query = $this->connector->getPDO()->prepare($sql);
        $query->execute([$email]);
        $result = $query->fetchObject();
        if(!$result){
            return null;
        }
        $userModel = new UserModel();
        $userModel->setName($result->name);
        $userModel->setEmail($result->email);
        $userModel->setMobile($result->mobile);
        return $userModel;
    }

}
