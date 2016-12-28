<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:03
 */
//include ("../model/Gasto_DAO.class.php");
class Gasto_Controller
{

    public function inserir(Gasto $gasto){
       require_once ("../model/Gasto_DAO.class.php");
       $gasto_dao = new Gasto_DAO();
       $retorno = $gasto_dao->inserir($gasto);
       return $retorno;
    }

    public function update(Gasto $gasto){
        require_once ("../model/Gasto_DAO.class.php");
        $gasto_dao = new Gasto_DAO();
        $retorno = $gasto_dao->update($gasto);
        return $retorno;
    }


    public function delete($user){
        require_once ("../model/Gasto_DAO.class.php");
        $gasto_dao = new Gasto_DAO();
        $retorno = $gasto_dao->delete($user);
        return $retorno;
    }

    public function getListaGasto($nome){
        require_once ("model/Gasto_DAO.class.php");
        $gasto_dao = new Gasto_DAO();
        $retorno = $gasto_dao->getListaGasto($nome);
        return $retorno;
    }

    public function getGasto($codigo){
        require_once ("model/Gasto_DAO.class.php");
        $gasto_dao = new Gasto_DAO();
        $retorno = $gasto_dao->getGasto($codigo);
        return $retorno;
    }



}