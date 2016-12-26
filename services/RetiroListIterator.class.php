<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of RetiroIterator
 *
 * @author CARLOS
 */
class RetiroListIterator {
    protected $retiroList;
    protected $currentRetiro = 0;

    public function __construct(RetiroList $retiroList_in) {
      $this->retiroList = $retiroList_in;
    }
    public function getCurrentRetiro() {
      if (($this->currentRetiro > 0) && 
          ($this->retiroList->getRetiroCount() >= $this->currentRetiro)) {
        return $this->retiroList->getRetiro($this->currentRetiro);
      }
    }
    public function getNextRetiro() {
      if ($this->hasNextRetiro()) {
        return $this->retiroList->getRetiro(++$this->currentRetiro);
      } else {
        return NULL;
      }
    }
    public function hasNextRetiro() {
      if ($this->retiroList->getRetiroCount() > $this->currentRetiro) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}