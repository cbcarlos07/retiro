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

class Usuario_DAO {
        private $conexao = null;
  public function inserir(Usuario $usuario){
         require_once 'ConnectionFactory.class.php';
         $conexao = null;
         $teste = false;
         $this->conexao =  new ConnectionFactory();
         $sql = "INSERT INTO `usuario` (`NM_USUARIO`, `DS_LOGIN`, `DS_SENHA`)
                 VALUES(:nome,:login,MD5(:senha))";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":nome",$usuario->getNm_usuario(), PDO::PARAM_STR);
            $stmt->bindValue(":login", $usuario->getDs_login(), PDO::PARAM_STR);
            $stmt->bindValue(":senha",$usuario->getDs_senha(), PDO::PARAM_STR);
            $stmt->execute();
            // print_r($stmt);
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function update(Usuario $usuario){
        require_once 'ConnectionFactory.class.php';
        $conexao = null;

        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "UPDATE `usuario` SET `NM_USUARIO` = :nome, `DS_LOGIN` = :login, `DS_SENHA` = MD5(:senha), `SN_ATUAL` = :atual
                 WHERE `CD_USUARIO` = :codigo";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":nome", $usuario->getNm_usuario(), PDO::PARAM_STR);
            $stmt->bindValue(":login", $usuario->getDs_login(), PDO::PARAM_STR);
            $stmt->bindValue(":senha", $usuario->getDs_senha(), PDO::PARAM_STR);
            $stmt->bindValue("atual", $usuario->getSn_atual(), PDO::PARAM_STR);
            $stmt->bindValue("codigo", $usuario->getCd_usuario(), PDO::PARAM_INT);

            $stmt->execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function resetarSenha($usuario){
        require_once 'ConnectionFactory.class.php';
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "UPDATE `usuario` SET `DS_SENHA` = MD5(123456), `SN_ATUAL` = 'N' 
                WHERE `CD_USUARIO` = :codigo";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":codigo", $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function delete($user){
        require_once 'ConnectionFactory.class.php';
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "DELETE  FROM `usuario` 
                 WHERE `CD_USUARIO` = :codigo";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":codigo", $user, PDO::PARAM_STR);
            $stmt->execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function getListaUsuario($nome){
        require_once 'ConnectionFactory.class.php';
        require_once 'services/UsuarioList.class.php';

        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $usuarioList = new UsuarioList();

        try {
            if($nome == ""){
                $sql = "SELECT *  FROM `usuario`";
                $stmt = $this->conexao->prepare($sql);

            }else{
                $sql = "SELECT *  FROM `usuario` WHERE `NM_USUARIO` LIKE :nome";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            }
            $stmt->execute();
           while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               $usuario = new Usuario();

               $usuario->setCd_usuario($row['CD_USUARIO']);
               $usuario->setNm_usuario($row ['NM_USUARIO']);
               $usuario->setDs_login($row ['DS_LOGIN']);
               $usuarioList->addUsuario($usuario);
           }
            $this->conexao = null;
         } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $usuarioList;
    }


    public function getUsuario($codigo){
        require_once 'ConnectionFactory.class.php';
        include_once 'beans/Usuario.class.php';
        $usuario = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT *  FROM `usuario` WHERE `CD_USUARIO` = :codigo";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue("codigo", $codigo,PDO::PARAM_INT);
            $stmt->execute();


            if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $usuario = new Usuario();
                $usuario->setCd_usuario($row['CD_USUARIO']);
                $usuario->setNm_usuario($row ['NM_USUARIO']);
                $usuario->setDs_login($row ['DS_LOGIN']);
                $usuario->setSn_atual($row ['SN_ATUAL']);
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $usuario;
    }

    public function getUser($login, $senha){
        require_once 'ConnectionFactory.class.php';
        $usuario = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();
        
        $sql = "SELECT * FROM `usuario` WHERE `DS_LOGIN` = :login AND `DS_SENHA` = MD5(:senha);";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":login", $login, PDO::PARAM_STR);
            $stmt->bindValue(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();

           // $row =  $stmt->fetch(PDO::FETCH_ASSOC);

            if($rs = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    $usuario = new Usuario();
                    $usuario->setCd_usuario($rs["CD_USUARIO"]);
                    $usuario->setNm_usuario($rs["NM_USUARIO"]);
                    $usuario->setDs_login($rs["DS_LOGIN"]);
                    $usuario->setSn_atual($rs["SN_ATUAL"]);
                   // echo "Encontrou no dao getUser";

            }


            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $usuario;
    }





    public function snLogar($login, $senha){
        
        require_once 'ConnectionFactory.class.php';
       
        $teste = 0;
        $usuario = null;
        $conexao = null;


        $this->conexao =  new ConnectionFactory();
        

        $sql = "SELECT * FROM `usuario` WHERE `DS_LOGIN` = :login AND `DS_SENHA` = MD5(:senha)";
      
        try {
            $stmt = $this->conexao->prepare($sql);
           
            $stmt->bindValue(":login", $login, PDO::PARAM_STR);
            $stmt->bindValue(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
           
          

            if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $teste = 1;
            
               
            } 

            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
     
        return $teste;
    }


public function getRecCodigo($login, $senha){
        
        require_once 'ConnectionFactory.class.php';
       
        $teste = 0;
        $usuario = null;
        $conexao = null;


        $this->conexao =  new ConnectionFactory();
        

        $sql = "SELECT `CD_USUARIO` FROM `usuario` WHERE `DS_LOGIN` = :login AND `DS_SENHA` = MD5(:senha)";
      
        try {
            $stmt = $this->conexao->prepare($sql);
           
            $stmt->bindValue(":login", $login, PDO::PARAM_STR);
            $stmt->bindValue(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();
           
          

            if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $teste = $row['CD_USUARIO'];
            
               
            } 

            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
     
        return $teste;
    }



    public function recSnAtual($login, $senha){
        require_once 'ConnectionFactory.class.php';
        $teste = "";
        $usuario = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM `usuario` WHERE `DS_LOGIN` = :login AND `DS_SENHA` = MD5(:senha)";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":login", $login, PDO::PARAM_STR);
            $stmt->bindValue(":senha", $senha, PDO::PARAM_STR);
            $stmt->execute();

           

            if($row = $stmt->fetch(PDO::FETCH_ASSOC)){


                $teste = $row ['SN_ATUAL'];
               

            }


            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
       
        return $teste;
    }
}
