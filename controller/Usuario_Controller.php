<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:03
 */

class Usuario_Controller
{

    public function inserir(Usuario $usuario){
        include_once ("../model/Usuario_DAO.class.php");
       $usuario_dao = new Usuario_DAO();
       $retorno = $usuario_dao->inserir($usuario);
       return $retorno;
    }

    public function update(Usuario $usuario){
        include_once ("../model/Usuario_DAO.class.php");
        $usuario_dao = new Usuario_DAO();
        $retorno = $usuario_dao->update($usuario);
        return $retorno;
    }

    public function resetarSenha($usuario){
        include_once ("../model/Usuario_DAO.class.php");
        $usuario_dao = new Usuario_DAO();
        $retorno = $usuario_dao->resetarSenha($usuario);
        return $retorno;
    }

    public function delete($user){
        include_once ("../model/Usuario_DAO.class.php");
        $usuario_dao = new Usuario_DAO();
        $retorno = $usuario_dao->delete($user);
        return $retorno;
    }

    public function getListaUsuario($nome){
        require_once 'model/Usuario_DAO.class.php';
        $usuario_dao = new Usuario_DAO();
        $retorno = $usuario_dao->getListaUsuario($nome);
        return $retorno;
    }

    public function getUsuario($codigo){
        include_once ("model/Usuario_DAO.class.php");
        $usuario_dao = new Usuario_DAO();
        $retorno = $usuario_dao->getUsuario($codigo);
        return $retorno;
    }

    public function getUser($login, $senha){
        include_once ("../model/Usuario_DAO.class.php");
        $usuario_dao = new Usuario_DAO();
        $retorno = $usuario_dao->getUser($login, $senha);
        return $retorno;
    }

    public function snLogar($login, $senha){
        include_once ("../model/Usuario_DAO.class.php");
        $usuario_dao = new Usuario_DAO();
        $retorno = $usuario_dao->snLogar($login, $senha);
        return $retorno;
    }

    public function recSnAtual($login, $senha){
        include_once ("../model/Usuario_DAO.class.php");
        $usuario_dao = new Usuario_DAO();
        $retorno = $usuario_dao->recSnAtual($login, $senha);
        return $retorno;
    }


}