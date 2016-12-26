<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_DAO
 *
 * @author carlos.brito
 */
include ("ConnectionFactory.class.php");
include ("../services/UsuarioList.class.php");
class Usuario_DAO {
        private $conexao = null;
  public function inserir(Usuario $usuario){
         $conexao = null;
         $teste = false;
         $this->conexao =  new ConnectionFactory();
         $sql = "INSERT INTO USUARIO (NM_USUARIO, DS_LOGIN, DS_SENHA, SN_ATUAL)
                 VALUES(?,?,MD5(?),'N')";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$usuario->getNm_usuario());
            $stmt->bindValue(2, $usuario->getDs_login());
            $stmt->bindValue(3,$usuario->getDs_senha());
            $stmt->execute();
            stmt.execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function update(Usuario $usuario){
        $conexao = null;

        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "UPDATE USUARIO SET NM_USUARIO = ?, DS_LOGIN = ?, DS_SENHA = MD5(?), SN_ATUAL = ?
                 WHERE CD_USUARIO = ?";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $usuario->getNm_usuario());
            $stmt->bindValue(2, $usuario->getDs_login());
            $stmt->bindValue(3, $usuario->getDs_senha());
            $stmt->bindValue(4, $usuario->getSn_atual());
            $stmt->bindValue(5, $usuario->getCd_usuario());

            $stmt.execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function resetarSenha($usuario){
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "UPDATE USUARIO SET DS_SENHA = MD5(123456), SN_ATUAL = 'N' 
                WHERE CD_USUARIO = ?";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $usuario);
            $stmt.execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function delete($user){
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "DELETE FROM USUARIO 
                 WHERE CD_USUARIO = ?";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $user);
            $stmt.execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function getListaUsuario($nome){
            
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $usuarioList = new UsuarioList();

        try {
            if($nome.equals("")){
                $sql = "SELECT * FROM USUARIO";
                $stmt = $this->conexao->prepare($sql);

            }else{
                $sql = "SELECT * FROM USUARIO WHERE NM_USUARIO LIKE ?";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1, "%"+$nome+"%");

            }
           while($row = $stmt->fetch(PDO::FETCH_OBJ)){
               $usuario = new Usuario();

               $usuario->setCd_usuario($row['CD_USUARIO']);
               $usuario->setNm_usuario($row['NM_USUARIO']);
               $usuario->setDs_login($row['DS_LOGIN']);
               $usuarioList->addUsuario($usuario);
           }
            $this->conexao = null;
         } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $usuarioList;
    }


    public function getUsuario($codigo){
        include_once 'beans/Usuario.class.php';
        $usuario = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM USUARIO WHERE CD_USUARIO = :codigo";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue("codigo", $codigo,PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if($row>0){
                $usuario = new Usuario();
                $usuario->setCd_usuario($row['CD_USUARIO']);
                $usuario->setNm_usuario($row['NM_USUARIO']);
                $usuario->setDs_login($row['DS_LOGIN']);
                $usuario->setSn_atual($row['SN_ATUAL']);
            }else{
                echo "Nao achou";
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $usuario;
    }

    public function getUser($login, $senha){
        $usuario = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();
        
        $sql = "SELECT * FROM USUARIO U WHERE U.DS_LOGIN = :login AND DS_SENHA = MD5(:senha);";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":login", $login, PDO::PARAM_STR);
            $stmt->bindValue(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
            $rs = $stmt->fetch();
           // $row =  $stmt->fetch(PDO::FETCH_ASSOC);

            if($rs > 0){
              //  echo "Encontrou no dao getUser ";
              //  var_dump($rs);

                    
                    $usuario = new Usuario();
                    $usuario->setCd_usuario($rs["CD_USUARIO"]);
                    $usuario->setNm_usuario($rs["NM_USUARIO"]);
                    $usuario->setDs_login($rs["DS_LOGIN"]);
                    $usuario->setSn_atual($rs["SN_ATUAL"]);
                   // echo "Encontrou no dao getUser";

            }else{
               // echo "<br>Nao encontrado<br>";
            }


            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $usuario;
    }
}
