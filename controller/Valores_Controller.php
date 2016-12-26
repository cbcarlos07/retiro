<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:03
 */

class Valores_Controller
{

    public function inserir(Valores $valores){
       require_once '../model/Valores_DAO.class.php';
       $valores_dao = new Valores_DAO();
       $retorno = $valores_dao->inserir($valores);
       return $retorno;
    }

    public function update(Valores $valores){
        require_once '../model/Valores_DAO.class.php';
        $valores_dao = new Valores_DAO();
        $retorno = $valores_dao->update($valores);
        return $retorno;
    }


    public function delete($user){
        require_once '../model/Valores_DAO.class.php';
        $valores_dao = new Valores_DAO();
        $retorno = $valores_dao->delete($user);
        return $retorno;
    }

    public function getListaValores($nome){
        require_once 'model/Valores_DAO.class.php';
        $valores_dao = new Valores_DAO();
        $retorno = $valores_dao->getListaValores($nome);
        return $retorno;
    }

    public function getValores($codigo){
        require_once 'model/Valores_DAO.class.php';
        $valores_dao = new Valores_DAO();
        $retorno = $valores_dao->getValores($codigo);
        return $retorno;
    }

    public function getValoresPorIdade($idade){
        require_once '../model/Valores_DAO.class.php';
        $valores_dao = new Valores_DAO();
        $retorno = $valores_dao->getValoresPorIdade($idade);
        return $retorno;
    }



}