<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ValoresList {
    private $_valores = array();
    private $_valoresCount = 0;
    public function __construct() {
    }
    public function getValoresCount() {
      return $this->_valoresCount;
    }
    private function setValoresCount($newCount) {
      $this->_valoresCount = $newCount;
    }
    public function getValores($_valoresNumberToGet) {
      if ( (is_numeric($_valoresNumberToGet)) && 
           ($_valoresNumberToGet <= $this->getValoresCount())) {
           return $this->_valores[$_valoresNumberToGet];
         } else {
           return NULL;
         }
    }
    public function addValores(Valores $_valores_in) {
      $this->setValoresCount($this->getValoresCount() + 1);
      $this->_valores[$this->getValoresCount()] = $_valores_in;
      return $this->getValoresCount();
    }
    public function removeValores(Valores $_valores_in) {
      $counter = 0;
      while (++$counter <= $this->getValoresCount()) {
        if ($_valores_in->getAuthorAndTitle() == 
          $this->_valores[$counter]->getAuthorAndTitle())
          {
            for ($x = $counter; $x < $this->getValoresCount(); $x++) {
              $this->_valores[$x] = $this->_valores[$x + 1];
          }
          $this->setValoresCount($this->getValoresCount() - 1);
        }
      }
      return $this->getValoresCount();
    }
}
