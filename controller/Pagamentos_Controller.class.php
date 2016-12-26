<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 24/12/2016
 * Time: 22:31
 */
include ("../model/Pagamentos_DAO.class.php");
class Pagamentos_Controller
{
    public function inserir(Pagamentos $pagamentos){
        $pd = new Pagamentos_DAO();
        $teste = $pd->inserir($pagamentos);
        return $teste;
    }

    public function update(Pagamentos $pagamentos){
        $pd = new Pagamentos_DAO();
        $teste = $pd->update($pagamentos);
        return $teste;
    }

    public function delete($pagamentos){
        $pd = new Pagamentos_DAO();
        $teste = $pd->delete($pagamentos);
        return $teste;
    }

    public function deletePessoa($pagamentos){
        $pd = new Pagamentos_DAO();
        $teste = $pd->deletePessoa($pagamentos);
        return $teste;
    }

    public function getListaPagamentos($nome, $pessoa){
        $pd = new Pagamentos_DAO();
        $teste = $pd->getListaPagamentos($nome, $pessoa);
        return $teste;
    }

    public function getPagamentos($codigo){
        $pd = new Pagamentos_DAO();
        $teste = $pd->getPagamentos($codigo);
        return $teste;
    }
}