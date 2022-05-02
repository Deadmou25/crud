<?php

class UserModel
{
    public string $name;
    public string $email;
    public int $mobile;
    public string $password;
    public int $id;

    /**
     * @param int $id
     * @return UserModel
     */
    public function setId(int $id): UserModel
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @param string $password
     * @return UserModel
     */
    public function setPassword(string $password): UserModel
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @param string $name
     * @return UserModel
     */
    public function setName(string $name): UserModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $email
     * @return UserModel
     */
    public function setEmail(string $email): UserModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param int $mobile
     * @return UserModel
     */
    public function setMobile(int $mobile): UserModel
    {
        $this->mobile = $mobile;
        return $this;
    }
}