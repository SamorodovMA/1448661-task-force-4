<?php

namespace tf\models;

class User
{
private string $name;
private string $mail;
private int $pass;
private int $age;


    public function __construct()
    {

    }


    public function getAge(): int
    {
        return $this->age;
    }


    public function setAge(int $age): void
    {
        $this->age = $age;
    }

}
