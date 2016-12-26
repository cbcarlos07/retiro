<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:26
 */
include ("ConnectionFactory.class.php");


class Retiro_DAO
{
    private $conexao = null;
    public function inserir(Retiro $retiro){
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "INSERT INTO RETIRO (DS_RETIRO, DT_RETIRO) VALUES(:descricao,:data_)";
        try {
            $datas = explode('/',$retiro->getDataRetiro());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":descricao",$retiro->getDsRetiro(), PDO::PARAM_STR);
            $stmt->bindValue(":data_", $data, PDO::PARAM_STR);

            $stmt->execute();

            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }
    public function update(Retiro $retiro){
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "UPDATE RETIRO SET DS_RETIRO = :descricao, DT_RETIRO = :data_ WHERE CD_RETIRO = :codigo";
        try {
            $datas = explode('/',$retiro->getDataRetiro());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue("descricao",$retiro->getDsRetiro(), PDO::PARAM_STR);
            $stmt->bindValue("data_", $data, PDO::PARAM_STR);
            $stmt->bindValue(":codigo",$retiro->getCdRetiro(),PDO::PARAM_INT);
            $stmt->execute();

            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function delete($codigo){
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "DELETE FROM RETIRO  WHERE CD_RETIRO = :codigo";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function getListaRetiro($nome){
        require_once  ("services/RetiroList.class.php");
        require_once  ("beans/Retiro.class.php");
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $retiroList = new RetiroList();

        try {
            if($nome == ""){
                $sql = "SELECT * FROM RETIRO";
                $stmt = $this->conexao->prepare($sql);

            }else{
                $sql = "SELECT * FROM RETIRO WHERE DS_RETIRO LIKE :nome";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $retiro = new Retiro();

                $retiro->setCdRetiro($row['CD_RETIRO']);
                $retiro->setDsRetiro($row['DS_RETIRO']);
                $retiro->setDataRetiro($row['DT_RETIRO']);

                $retiroList->addRetiro($retiro);
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $retiroList;
    }

    public function getRetiro($codigo){
        $retiro = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM RETIRO WHERE CD_RETIRO = :codigo";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();

            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $retiro = new Retiro();
                $retiro->setCdRetiro($row['CD_RETIRO']);
                $retiro->setDsRetiro($row['DS_RETIRO']);
                $retiro->setDataRetiro($row['DT_RETIRO']);

            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $retiro;
    }

}