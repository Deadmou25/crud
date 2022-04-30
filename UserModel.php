<?php

class UserModel
{
    public string $name;
    public string $email;
    public int $mobile;

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