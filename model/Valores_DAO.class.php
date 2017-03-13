<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:26
 */
include_once ("ConnectionFactory.class.php");

class Valores_DAO
{
    private $conexao = null;
    public function inserir(Valores $valores){
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "INSERT INTO `valores` (`DS_VALOR`, `DESCRICAO`, `IDADE_INICIAL`, `IDADE_FINAL`)
               VALUES(:valor,:descricao,:idade_inicial,:idade_final)";
        try {
            
            
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":valor",$valores->getValorValor(), PDO::PARAM_STR);
            $stmt->bindValue(":descricao", $valores->getDescricao(), PDO::PARAM_STR);
            $stmt->bindValue(":idade_inicial",$valores->getIdadeInicial(), PDO::PARAM_INT);
            $stmt->bindValue("idade_final",$valores->getIdadeFinal(), PDO::PARAM_INT);
            $stmt->execute();

            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }
    public function update(Valores $valores){
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "UPDATE `valores` SET `DS_VALOR` = :valor, `DESCRICAO` = :descricao, `IDADE_INICIAL` = :inicial, `IDADE_FINAL` = :final
                 WHERE `CD_VALOR` = :codigo";
        try {

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":valor",$valores->getValorValor());
            $stmt->bindValue(":descricao", $valores->getDescricao());
            $stmt->bindValue(":inicial",$valores->getIdadeInicial());
            $stmt->bindValue(":final",$valores->getIdadeFinal());
            $stmt->bindValue(":codigo", $valores->getValorCodigo());
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
        $sql = "DELETE FROM `valores`  WHERE `CD_VALOR` = :codigo";
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

    public function getListaValores($nome){
        include_once ("services/ValoresList.class.php");
        include_once ("beans/Valores.class.php");
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $valoresList = new ValoresList();

        try {
            if($nome == ""){
                $sql = "SELECT * FROM `valores`";
                $stmt = $this->conexao->prepare($sql);

            }else{
                $sql = "SELECT * FROM `valores` WHERE `DS_VALOR` LIKE :nome";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $valores = new Valores();

                $valores->setValorCodigo($row['CD_VALOR']);
                $valores->setValorValor($row['DS_VALOR']);
                $valores->setDescricao(utf8_decode($row['DESCRICAO']));
                $valores->setIdadeInicial($row['IDADE_INICIAL']);
                $valores->setIdadeFinal($row['IDADE_FINAL']);
                $valoresList->addValores($valores);
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $valoresList;
    }

    public function getValores($codigo){
        $valores = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM `valores` WHERE `CD_VALOR` = :codigo";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $valores = new Valores();

                $valores->setValorCodigo($row['CD_VALOR']);
                $valores->setValorValor($row['DS_VALOR']);
                $valores->setDescricao($row['DESCRICAO']);
                $valores->setIdadeInicial($row['IDADE_INICIAL']);
                $valores->setIdadeFinal($row['IDADE_FINAL']);

            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $valores;
    }

    public function getValoresPorIdade($idade){
        $valores = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM `valores` `V` 
                  WHERE :idade BETWEEN `V`.`IDADE_INICIAL` AND `V`.`IDADE_FINAL`";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":idade", $idade, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $valores = new Valores();

                $valores->setValorCodigo($row['CD_VALOR']);
                $valores->setValorValor($row['DS_VALOR']);
                $valores->setDescricao($row['DESCRICAO']);
                $valores->setIdadeInicial($row['IDADE_INICIAL']);
                $valores->setIdadeFinal($row['IDADE_FINAL']);

            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $valores;
    }

}