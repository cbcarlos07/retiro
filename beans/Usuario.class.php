<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author carlos.brito
 */
class Usuario {
    private $cd_usuario;
    private $nm_usuario;
    private $ds_login;
    private $ds_senha;
    private $sn_atual;
    
    public function getCd_usuario() {
        return $this->cd_usuario;
    }

    public function getNm_usuario() {
        return $this->nm_usuario;
    }

    public function getDs_login() {
        return $this->ds_login;
    }

    public function getDs_senha() {
        return $this->ds_senha;
    }

    public function getSn_atual() {
        return $this->sn_atual;
    }

    public function setCd_usuario($cd_usuario) {
        $this->cd_usuario = $cd_usuario;
        return $this;
    }

    public function setNm_usuario($nm_usuario) {
        $this->nm_usuario = $nm_usuario;
        return $this;
    }

    public function setDs_login($ds_login) {
        $this->ds_login = $ds_login;
        return $this;
    }

    public function setDs_senha($ds_senha) {
        $this->ds_senha = $ds_senha;
        return $this;
    }

    public function setSn_atual($sn_atual) {
        $this->sn_atual = $sn_atual;
        return $this;
    }


            
}
