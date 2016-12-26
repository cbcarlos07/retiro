<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of ValoresIterator
 *
 * @author CARLOS
 */
class ValoresListIterator {
    protected $valoresList;
    protected $currentValores = 0;

    public function __construct(ValoresList $valoresList_in) {
      $this->valoresList = $valoresList_in;
    }
    public function getCurrentValores() {
      if (($this->currentValores > 0) && 
          ($this->valoresList->getValoresCount() >= $this->currentValores)) {
        return $this->valoresList->getValores($this->currentValores);
      }
    }
    public function getNextValores() {
      if ($this->hasNextValores()) {
        return $this->valoresList->getValores(++$this->currentValores);
      } else {
        return NULL;
      }
    }
    public function hasNextValores() {
      if ($this->valoresList->getValoresCount() > $this->currentValores) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}