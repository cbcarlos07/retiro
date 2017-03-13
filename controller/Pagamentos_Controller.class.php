<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 24/12/2016
 * Time: 22:31
 */

class Pagamentos_Controller
{
    public function inserir(Pagamentos $pagamentos){
        require_once '../model/Pagamentos_DAO.class.php';
        $pd = new Pagamentos_DAO();
        $teste = $pd->inserir($pagamentos);
        return $teste;
    }

    public function update(Pagamentos $pagamentos){
        require_once '../model/Pagamentos_DAO.class.php';
        $pd = new Pagamentos_DAO();
        $teste = $pd->update($pagamentos);
        return $teste;
    }

    public function delete($pagamentos){
        require_once '../model/Pagamentos_DAO.class.php';
        $pd = new Pagamentos_DAO();
        $teste = $pd->delete($pagamentos);
        return $teste;
    }

    public function deletePessoa($pagamentos){
        require_once '../model/Pagamentos_DAO.class.php';
        $pd = new Pagamentos_DAO();
        $teste = $pd->deletePessoa($pagamentos);
        return $teste;
    }

    public function getListaPagamentos($nome, $pessoa){
        require_once 'model/Pagamentos_DAO.class.php';
        $pd = new Pagamentos_DAO();
        $teste = $pd->getListaPagamentos($nome, $pessoa);
        return $teste;
    }

    public function getPagamentos($codigo){
        require_once 'model/Pagamentos_DAO.class.php';
        $pd = new Pagamentos_DAO();
        $teste = $pd->getPagamentos($codigo);
        return $teste;
    }
}