<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class PessoaList {
    private $_pessoa = array();
    private $_pessoaCount = 0;
    public function __construct() {
    }
    public function getPessoaCount() {
      return $this->_pessoaCount;
    }
    private function setPessoaCount($newCount) {
      $this->_pessoaCount = $newCount;
    }
    public function getPessoa($_pessoaNumberToGet) {
      if ( (is_numeric($_pessoaNumberToGet)) && 
           ($_pessoaNumberToGet <= $this->getPessoaCount())) {
           return $this->_pessoa[$_pessoaNumberToGet];
         } else {
           return NULL;
         }
    }
    public function addPessoa(Pessoa $_pessoa_in) {
      $this->setPessoaCount($this->getPessoaCount() + 1);
      $this->_pessoa[$this->getPessoaCount()] = $_pessoa_in;
      return $this->getPessoaCount();
    }
    public function removePessoa(Pessoa $_pessoa_in) {
      $counter = 0;
      while (++$counter <= $this->getPessoaCount()) {
        if ($_pessoa_in->getAuthorAndTitle() == 
          $this->_pessoa[$counter]->getAuthorAndTitle())
          {
            for ($x = $counter; $x < $this->getPessoaCount(); $x++) {
              $this->_pessoa[$x] = $this->_pessoa[$x + 1];
          }
          $this->setPessoaCount($this->getPessoaCount() - 1);
        }
      }
      return $this->getPessoaCount();
    }
}
