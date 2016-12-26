<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 24/12/2016
 * Time: 22:15
 */
class Valores
{
 private $valor_codigo;
 private $valor_valor;
 private $descricao;
 private $idade_inicial;
 private $idade_final;

    /**
     * @return mixed
     */
    public function getValorCodigo()
    {
        return $this->valor_codigo;
    }

    /**
     * @param mixed $valor_codigo
     */
    public function setValorCodigo($valor_codigo)
    {
        $this->valor_codigo = $valor_codigo;
    }

    /**
     * @return mixed
     */
    public function getValorValor()
    {
        return $this->valor_valor;
    }

    /**
     * @param mixed $valor_valor
     */
    public function setValorValor($valor_valor)
    {
        $this->valor_valor = $valor_valor;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getIdadeInicial()
    {
        return $this->idade_inicial;
    }

    /**
     * @param mixed $idade_inicial
     */
    public function setIdadeInicial($idade_inicial)
    {
        $this->idade_inicial = $idade_inicial;
    }

    /**
     * @return mixed
     */
    public function getIdadeFinal()
    {
        return $this->idade_final;
    }

    /**
     * @param mixed $idade_final
     */
    public function setIdadeFinal($idade_final)
    {
        $this->idade_final = $idade_final;
    }
    
    

}