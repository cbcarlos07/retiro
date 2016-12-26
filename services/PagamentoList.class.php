<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class PagamentoList {
    private $_pagamento = array();
    private $_pagamentoCount = 0;
    public function __construct() {
    }
    public function getPagamentoCount() {
      return $this->_pagamentoCount;
    }
    private function setPagamentoCount($newCount) {
      $this->_pagamentoCount = $newCount;
    }
    public function getPagamento($_pagamentoNumberToGet) {
      if ( (is_numeric($_pagamentoNumberToGet)) && 
           ($_pagamentoNumberToGet <= $this->getPagamentoCount())) {
           return $this->_pagamento[$_pagamentoNumberToGet];
         } else {
           return NULL;
         }
    }
    public function addPagamento(Pagamentos $_pagamento_in) {
      $this->setPagamentoCount($this->getPagamentoCount() + 1);
      $this->_pagamento[$this->getPagamentoCount()] = $_pagamento_in;
      return $this->getPagamentoCount();
    }
    public function removePagamento(Pagamentos $_pagamento_in) {
      $counter = 0;
      while (++$counter <= $this->getPagamentoCount()) {
        if ($_pagamento_in->getAuthorAndTitle() == 
          $this->_pagamento[$counter]->getAuthorAndTitle())
          {
            for ($x = $counter; $x < $this->getPagamentoCount(); $x++) {
              $this->_pagamento[$x] = $this->_pagamento[$x + 1];
          }
          $this->setPagamentoCount($this->getPagamentoCount() - 1);
        }
      }
      return $this->getPagamentoCount();
    }
}
