<?php
include_once 'DataBaseConnection.php';
include_once 'UserModel.php';
include_once 'helpers/helpers.php';

class UserRepository
{

    private DataBaseConnection $connector;

    public function __construct(DataBaseConnection $connector)
    {
        $this->connector = $connector;
    }

    public function insert(string $name, string $email, int $mobile, string $password)
    {
        $sql = ("INSERT INTO user (`name`, `email`, `mobile`,`password`) VALUES(?,?,?,?)");
        $query = $this->connector->getPDO()->prepare($sql);
        $query->execute([$name, $email, $mobile, $password]);
    }

    public function insertToken(int $userId): string
    {
        $sql = ("INSERT INTO auth_tokens (token,user_id) VALUES(?,?)");
        $query = $this->connector->getPDO()->prepare($sql);
        //TODO хэшировать токен
        $token = guid();
        $tokenHash = password_hash($token,PASSWORD_DEFAULT);
        $query->execute([$tokenHash, $userId]);
        return $tokenHash;
    }


    public function auth (string $token): ?int
    {
        //TODO Обработать хэширование
        $sql = "SELECT user_id FROM auth_tokens WHERE token = ?";
        $query = $this->connector->getPDO()->prepare($sql);
        $tokenHash = $this->insertToken($token);
        $query->execute([$tokenHash]);
        $result = $query->fetchObject();
        if (!$result) {
            return null;
        }
        return $result->user_id;
    }

    public function getById(int $userId): ?UserModel
    {
        $sql = "SELECT id,name, email, mobile, password FROM user WHERE id = ?";
        $query = $this->connector->getPDO()->prepare($sql);
        $query->execute([$userId]);
        $result = $query->fetchObject();
        if (!$result) {
            return null;
        }
        $userModel = new UserModel();
        $userModel->setId($result->id);
        $userModel->setName($result->name);
        $userModel->setEmail($result->email);
        $userModel->setMobile($result->mobile);
        $userModel->setPassword($result->password);
        return $userModel;
    }

    public function getByEmail(string $email): ?UserModel
    {
        $sql = "SELECT id,name, email, mobile, password FROM user WHERE email = ?";
        $query = $this->connector->getPDO()->prepare($sql);
        $query->execute([$email]);
        $result = $query->fetchObject();
        if (!$result) {
            return null;
        }
        $userModel = new UserModel();
        $userModel->setId($result->id);
        $userModel->setName($result->name);
        $userModel->setEmail($result->email);
        $userModel->setMobile($result->mobile);
        $userModel->setPassword($result->password);
        return $userModel;
    }

}
