<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 17:32
 */
class Pagamentos
{
private $cd_pgto;
private $pessoa;
private $valor_pgto;
private $valor_data;

    /**
     * @return mixed
     */
    public function getCdPgto()
    {
        return $this->cd_pgto;
    }

    /**
     * @param mixed $cd_pgto
     */
    public function setCdPgto($cd_pgto)
    {
        $this->cd_pgto = $cd_pgto;
    }

    /**
     * @return mixed
     */
    public function getPessoa()
    {
        return $this->pessoa;
    }

    /**
     * @param mixed $pessoa
     */
    public function setPessoa($pessoa)
    {
        $this->pessoa = $pessoa;
    }

    /**
     * @return mixed
     */
    public function getValorPgto()
    {
        return $this->valor_pgto;
    }

    /**
     * @param mixed $valor_pgto
     */
    public function setValorPgto($valor_pgto)
    {
        $this->valor_pgto = $valor_pgto;
    }

    /**
     * @return mixed
     */
    public function getValorData()
    {
        return $this->valor_data;
    }

    /**
     * @param mixed $valor_data
     */
    public function setValorData($valor_data)
    {
        $this->valor_data = $valor_data;
    }

    
}