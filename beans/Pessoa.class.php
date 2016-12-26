<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 17:38
 */
require_once 'Valores.class.php';
class Pessoa extends Valores
{
private $codigo_pessoa;
private $nm_pessoa;
private $nr_cpf;
private $nr_telefone;
private $ds_email;
private $sn_chale;
private $retiro;
private $valor_pagar;
private $valor_falta;
private $valor_pago;
private $dt_nascimento;

    /**
     * @return mixed
     */
    public function getCodigoPessoa()
    {
        return $this->codigo_pessoa;
    }

    /**
     * @param mixed $codigo_pessoa
     */
    public function setCodigoPessoa($codigo_pessoa)
    {
        $this->codigo_pessoa = $codigo_pessoa;
    }

    /**
     * @return mixed
     */
    public function getNmPessoa()
    {
        return $this->nm_pessoa;
    }

    /**
     * @param mixed $nm_pessoa
     */
    public function setNmPessoa($nm_pessoa)
    {
        $this->nm_pessoa = $nm_pessoa;
    }

    /**
     * @return mixed
     */
    public function getNrCpf()
    {
        return $this->nr_cpf;
    }

    /**
     * @param mixed $nr_cpf
     */
    public function setNrCpf($nr_cpf)
    {
        $this->nr_cpf = $nr_cpf;
    }

    /**
     * @return mixed
     */
    public function getNrTelefone()
    {
        return $this->nr_telefone;
    }

    /**
     * @param mixed $nr_telefone
     */
    public function setNrTelefone($nr_telefone)
    {
        $this->nr_telefone = $nr_telefone;
    }

    /**
     * @return mixed
     */
    public function getDsEmail()
    {
        return $this->ds_email;
    }

    /**
     * @param mixed $ds_email
     */
    public function setDsEmail($ds_email)
    {
        $this->ds_email = $ds_email;
    }

    /**
     * @return mixed
     */
    public function getSnChale()
    {
        return $this->sn_chale;
    }

    /**
     * @param mixed $sn_chale
     */
    public function setSnChale($sn_chale)
    {
        $this->sn_chale = $sn_chale;
    }

    /**
     * @return mixed
     */
    public function getRetiro()
    {
        return $this->retiro;
    }

    /**
     * @param mixed $retiro
     */
    public function setRetiro(Retiro $retiro)
    {
        $this->retiro = $retiro;
    }

    /**
     * @return mixed
     */
    public function getValorPagar()
    {
        return $this->valor_pagar;
    }

    /**
     * @param mixed $valor_pagar
     */
    public function setValorPagar($valor_pagar)
    {
        $this->valor_pagar = $valor_pagar;
    }

    /**
     * @return mixed
     */
    public function getValorFalta()
    {
        return $this->valor_falta;
    }

    /**
     * @param mixed $valor_falta
     */
    public function setValorFalta($valor_falta)
    {
        $this->valor_falta = $valor_falta;
    }

    /**
     * @return mixed
     */
    public function getValorPago()
    {
        return $this->valor_pago;
    }

    /**
     * @param mixed $valor_pago
     */
    public function setValorPago($valor_pago)
    {
        $this->valor_pago = $valor_pago;
    }

    /**
     * @return mixed
     */
    public function getDtNascimento()
    {
        return $this->dt_nascimento;
    }

    /**
     * @param mixed $dt_nascimento
     */
    public function setDtNascimento($dt_nascimento)
    {
        $this->dt_nascimento = $dt_nascimento;
    }



}