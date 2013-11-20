<?php

namespace Spomky\CoovachilliBundle\Form\Model;

class Login {
    
    protected $username;
    protected $password;


    public function getUsername() {

        return $this->username;
    }

    public function setUsername($username) {

        $this->username = $username;
        return $this
    }

    public function getPassword() {

        return $this->password;
    }

    public function setPassword($password) {

        $this->password = $password;
        return $this
    }
}
