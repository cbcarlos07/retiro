<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of GastoIterator
 *
 * @author CARLOS
 */
class GastoListIterator {
    protected $gastoList;
    protected $currentGasto = 0;

    public function __construct(GastoList $gastoList_in) {
      $this->gastoList = $gastoList_in;
    }
    public function getCurrentGasto() {
      if (($this->currentGasto > 0) && 
          ($this->gastoList->getGastoCount() >= $this->currentGasto)) {
        return $this->gastoList->getGasto($this->currentGasto);
      }
    }
    public function getNextGasto() {
      if ($this->hasNextGasto()) {
        return $this->gastoList->getGasto(++$this->currentGasto);
      } else {
        return NULL;
      }
    }
    public function hasNextGasto() {
      if ($this->gastoList->getGastoCount() > $this->currentGasto) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}