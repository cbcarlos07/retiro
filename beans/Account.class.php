<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 class Account {
    private $username;
    private $password;
    private $checked;
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getChecked() {
        return $this->checked;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setChecked($checked) {
        $this->checked = $checked;
    }

    function __construct($username, $password, $checked) {
        $this->username = $username;
        $this->password = $password;
        $this->checked = $checked;
    }

}

?>