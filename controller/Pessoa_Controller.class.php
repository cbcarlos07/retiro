<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 25/12/2016
 * Time: 00:00
 */

class Pessoa_Controller
{
    public function inserir(Pessoa $pessoa){
        $pd = new Pessoa_DAO();
        $teste = $pd->inserir($pessoa);
        return $teste;
    }

    public function update(Pessoa $pessoa){
        $pd = new Pessoa_DAO();
        $teste = $pd->update($pessoa);
        return $teste;
    }

    public function delete(Pessoa $pessoa){
        $pd = new Pessoa_DAO();
        $teste = $pd->delete($pessoa);
        return $teste;
    }

    public function getListaPessoa($pessoa){
        include_once 'model/Pessoa_DAO.class.php';
        $pd = new Pessoa_DAO();
        $teste = $pd->getListaPessoa($pessoa);
        return $teste;
    }

    public function getPessoa($pessoa){
        $pd = new Pessoa_DAO();
        $teste = $pd->getPessoa($pessoa);
        return $teste;
    }

    public function getListaPessoaDesistente($pessoa){
        $pd = new Pessoa_DAO();
        $teste = $pd->getListaPessoaDesistente($pessoa);
        return $teste;
    }

    public function getPessoaDesistente($pessoa){
        $pd = new Pessoa_DAO();
        $teste = $pd->getPessoaDesistente($pessoa);
        return $teste;
    }

    public function deleteDesistente($pessoa){
        $pd = new Pessoa_DAO();
        $teste = $pd->deleteDesistente($pessoa);
        return $teste;
    }

    public function inserirValor($pessoa, $valor){
        $pd = new Pessoa_DAO();
        $teste = $pd->inserirValor($pessoa, $valor);
        return $teste;
    }

    public function getValor($pessoa){
        $pd = new Pessoa_DAO();
        $teste = $pd->getValor($pessoa);
        return $teste;
    }

    public function inserirRetornarDesistente($pessoa){
        $pd = new Pessoa_DAO();
        $teste = $pd->inserirRetornarDesistente($pessoa);
        return $teste;
    }

    public function inserirDesistente($pessoa){
        $pd = new Pessoa_DAO();
        $teste = $pd->inserirDesistente($pessoa);
        return $teste;
    }
    
    
    
    
}