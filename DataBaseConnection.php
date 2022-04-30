<?php

class DataBaseConnection
{
    protected PDO $pdo;

    public function connect()
    {
        try {
            $this->pdo = new PDO('mysql:dbname=crudoperation;host=localhost', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getPDO():PDO
    {
        return $this->pdo;
    }
}