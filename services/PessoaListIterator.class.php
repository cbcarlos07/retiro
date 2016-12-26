<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of PessoaIterator
 *
 * @author CARLOS
 */
class PessoaListIterator {
    protected $pessoaList;
    protected $currentPessoa = 0;

    public function __construct(PessoaList $pessoaList_in) {
      $this->pessoaList = $pessoaList_in;
    }
    public function getCurrentPessoa() {
      if (($this->currentPessoa > 0) && 
          ($this->pessoaList->getPessoaCount() >= $this->currentPessoa)) {
        return $this->pessoaList->getPessoa($this->currentPessoa);
      }
    }
    public function getNextPessoa() {
      if ($this->hasNextPessoa()) {
        return $this->pessoaList->getPessoa(++$this->currentPessoa);
      } else {
        return NULL;
      }
    }
    public function hasNextPessoa() {
      if ($this->pessoaList->getPessoaCount() > $this->currentPessoa) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}