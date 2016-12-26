<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class RetiroList {
    private $_retiro = array();
    private $_retiroCount = 0;
    public function __construct() {
    }
    public function getRetiroCount() {
      return $this->_retiroCount;
    }
    private function setRetiroCount($newCount) {
      $this->_retiroCount = $newCount;
    }
    public function getRetiro($_retiroNumberToGet) {
      if ( (is_numeric($_retiroNumberToGet)) && 
           ($_retiroNumberToGet <= $this->getRetiroCount())) {
           return $this->_retiro[$_retiroNumberToGet];
         } else {
           return NULL;
         }
    }
    public function addRetiro(Retiro $_retiro_in) {
      $this->setRetiroCount($this->getRetiroCount() + 1);
      $this->_retiro[$this->getRetiroCount()] = $_retiro_in;
      return $this->getRetiroCount();
    }
    public function removeRetiro(Retiro $_retiro_in) {
      $counter = 0;
      while (++$counter <= $this->getRetiroCount()) {
        if ($_retiro_in->getAuthorAndTitle() == 
          $this->_retiro[$counter]->getAuthorAndTitle())
          {
            for ($x = $counter; $x < $this->getRetiroCount(); $x++) {
              $this->_retiro[$x] = $this->_retiro[$x + 1];
          }
          $this->setRetiroCount($this->getRetiroCount() - 1);
        }
      }
      return $this->getRetiroCount();
    }
}
