<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:03
 */

class Retiro_Controller
{

    public function inserir(Retiro $retiro){
       require_once '../model/Retiro_DAO.class.php';
       $retiro_dao = new Retiro_DAO();
       $retorno = $retiro_dao->inserir($retiro);
       return $retorno;
    }

    public function update(Retiro $retiro){
        require_once '../model/Retiro_DAO.class.php';
        $retiro_dao = new Retiro_DAO();
        $retorno = $retiro_dao->update($retiro);
        return $retorno;
    }


    public function delete($user){
        include_once '../model/Retiro_DAO.class.php';
        $retiro_dao = new Retiro_DAO();
        $retorno = $retiro_dao->delete($user);
        return $retorno;
    }

    public function getListaRetiro($nome){
        include_once 'model/Retiro_DAO.class.php';
        $retiro_dao = new Retiro_DAO();
        $retorno = $retiro_dao->getListaRetiro($nome);
        return $retorno;
    }

    public function getRetiro($codigo){
        require_once 'model/Retiro_DAO.class.php';
        $retiro_dao = new Retiro_DAO();
        $retorno = $retiro_dao->getRetiro($codigo);
        return $retorno;
    }



}