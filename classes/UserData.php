<?php

class UserData
{
    public int $id;
    public string $username;

    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
}