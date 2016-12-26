<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of UsuarioIterator
 *
 * @author CARLOS
 */
class UsuarioListIterator {
    protected $usuarioList;
    protected $currentUsuario = 0;

    public function __construct(UsuarioList $usuarioList_in) {
      $this->usuarioList = $usuarioList_in;
    }
    public function getCurrentUsuario() {
      if (($this->currentUsuario > 0) && 
          ($this->usuarioList->getUsuarioCount() >= $this->currentUsuario)) {
        return $this->usuarioList->getUsuario($this->currentUsuario);
      }
    }
    public function getNextUsuario() {
      if ($this->hasNextUsuario()) {
        return $this->usuarioList->getUsuario(++$this->currentUsuario);
      } else {
        return NULL;
      }
    }
    public function hasNextUsuario() {
      if ($this->usuarioList->getUsuarioCount() > $this->currentUsuario) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}