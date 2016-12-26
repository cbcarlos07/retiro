<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of PagamentosIterator
 *
 * @author CARLOS
 */
class PagamentosListIterator {
    protected $pagamentosList;
    protected $currentPagamentos = 0;

    public function __construct(PagamentoList $pagamentosList_in) {
      $this->pagamentosList = $pagamentosList_in;
    }
    public function getCurrentPagamentos() {
      if (($this->currentPagamentos > 0) && 
          ($this->pagamentosList->getPagamentoCount() >= $this->currentPagamentos)) {
        return $this->pagamentosList->getPagamento($this->currentPagamentos);
      }
    }
    public function getNextPagamentos() {
      if ($this->hasNextPagamentos()) {
        return $this->pagamentosList->getPagamento(++$this->currentPagamentos);
      } else {
        return NULL;
      }
    }
    public function hasNextPagamentos() {
      if ($this->pagamentosList->getPagamentoCount() > $this->currentPagamentos) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}