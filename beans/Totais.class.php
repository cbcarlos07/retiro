<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 24/12/2016
 * Time: 22:43
 */
class Totais
{
private $receber;
private $gasto;
private $atual;
private $recebido;

    /**
     * @return mixed
     */
    public function getReceber()
    {
        return $this->receber;
    }

    /**
     * @param mixed $receber
     */
    public function setReceber($receber)
    {
        $this->receber = $receber;
    }

    /**
     * @return mixed
     */
    public function getGasto()
    {
        return $this->gasto;
    }

    /**
     * @param mixed $gasto
     */
    public function setGasto($gasto)
    {
        $this->gasto = $gasto;
    }

    /**
     * @return mixed
     */
    public function getAtual()
    {
        return $this->atual;
    }

    /**
     * @param mixed $atual
     */
    public function setAtual($atual)
    {
        $this->atual = $atual;
    }

    /**
     * @return mixed
     */
    public function getRecebido()
    {
        return $this->recebido;
    }

    /**
     * @param mixed $recebido
     */
    public function setRecebido($recebido)
    {
        $this->recebido = $recebido;
    }
    
    
}