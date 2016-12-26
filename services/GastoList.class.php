<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GastoList {
    private $_gasto = array();
    private $_gastoCount = 0;
    public function __construct() {
    }
    public function getGastoCount() {
      return $this->_gastoCount;
    }
    private function setGastoCount($newCount) {
      $this->_gastoCount = $newCount;
    }
    public function getGasto($_gastoNumberToGet) {
      if ( (is_numeric($_gastoNumberToGet)) && 
           ($_gastoNumberToGet <= $this->getGastoCount())) {
           return $this->_gasto[$_gastoNumberToGet];
         } else {
           return NULL;
         }
    }
    public function addGasto(Gasto $_gasto_in) {
      $this->setGastoCount($this->getGastoCount() + 1);
      $this->_gasto[$this->getGastoCount()] = $_gasto_in;
      return $this->getGastoCount();
    }
    public function removeGasto(Gasto $_gasto_in) {
      $counter = 0;
      while (++$counter <= $this->getGastoCount()) {
        if ($_gasto_in->getAuthorAndTitle() == 
          $this->_gasto[$counter]->getAuthorAndTitle())
          {
            for ($x = $counter; $x < $this->getGastoCount(); $x++) {
              $this->_gasto[$x] = $this->_gasto[$x + 1];
          }
          $this->setGastoCount($this->getGastoCount() - 1);
        }
      }
      return $this->getGastoCount();
    }
}
