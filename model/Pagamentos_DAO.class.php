<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:26
 */
//include ("ConnectionFactory.class.php");

class Pagamentos_DAO
{
    private $conexao = null;
    public function inserir(Pagamentos $pagamentos){
        require_once 'ConnectionFactory.class.php';
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "INSERT INTO `pagamentos` (`CD_PESSOA`, `DS_VALOR`, `DT_PGTO`)
                 VALUES(:pessoa,:valor,:data_)";
        try {
            $datas = explode('/',$pagamentos->getValorData());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":pessoa",$pagamentos->getPessoa()->getCodigoPessoa(), PDO::PARAM_INT);
            $stmt->bindValue(":valor", $pagamentos->getValorPgto(), PDO::PARAM_STR);
            $stmt->bindValue(":data_",$data, PDO::PARAM_STR);
            $stmt->execute();

            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }
    public function update(Pagamentos $pagamentos){
        require_once 'ConnectionFactory.class.php';
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "UPDATE `pagamentos` SET `CD_PESSOA` = :pessoa, `DS_VALOR` = :valor, `DT_PGTO` = :data_
                 WHERE `CD_PGTO` = :codigo";
        try {
            $datas = explode('/',$pagamentos->getValorData());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":pessoa",$pagamentos->getPessoa()->getCodigoPessoa(), PDO::PARAM_INT);
            $stmt->bindValue(":valor", $pagamentos->getValorPgto(), PDO::PARAM_STR);
            $stmt->bindValue(":data_",$data, PDO::PARAM_STR);
            $stmt->bindValue(":codigo",$pagamentos->getCdPgto(), PDO::PARAM_INT);
            $stmt->execute();

            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function delete($codigo){
        require_once 'ConnectionFactory.class.php';

        $teste = false;
        $conexao = null;
        $this->conexao =  new ConnectionFactory();
        $sql = "DELETE FROM `pagamentos` WHERE `CD_PGTO` = :CODIGO";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":CODIGO", $codigo, PDO::PARAM_INT);
            $stmt->execute();
          
            $teste = true;

            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function deletePessoa($pagamentos){
        require_once 'ConnectionFactory.class.php';
            $teste = false;
            $conexao = null;
            $teste = false;
            $this->conexao =  new ConnectionFactory();
            $sql = "DELETE FROM `pagamentos`  WHERE `CD_PESSOA` = :CODIGO";
            try {
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(":CODIGO", $pagamentos, PDO::PARAM_INT);
                $stmt->execute();
                $teste = true;
                $this->conexao = null;


            } catch (PDOException $ex) {
                echo "Erro: ".$ex->getMessage();
            }
        return $teste;
    }



    public function getListaPagamentos($nome, $pessoa){
        require_once 'ConnectionFactory.class.php';
        require_once ("services/PagamentoList.class.php");
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $pagamentosList = new PagamentoList();

        try {
            if($nome == ""){
                $sql = "SELECT * FROM `pagamentos` WHERE `CD_PESSOA` = :pessoa";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(":pessoa", $pessoa, PDO::PARAM_INT);

            }else{
                $sql = "SELECT * FROM `pagamentos` WHERE `DS_VALOR` LIKE :valor AND `CD_PESSOA` = :pessoa";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(":valor", "%$nome%", PDO::PARAM_STR);
                $stmt->bindValue(":pessoa", $pessoa, PDO::PARAM_INT);

            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $pagamentos = new Pagamentos();

                $pagamentos->setCdPgto($row['CD_PGTO']);
                $pagamentos->setPessoa($row['CD_PESSOA']);
                $pagamentos->setValorPgto($row['DS_VALOR']);
                $pagamentos->setValorData($row['DT_PGTO']);

                $pagamentosList->addPagamento($pagamentos);
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $pagamentosList;
    }

    public function getPagamentos($codigo){
        require_once 'ConnectionFactory.class.php';
        require_once 'beans/Pessoa.class.php';
        $pagamentos = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM `pagamentos` WHERE `CD_PGTO` = :CODIGO";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":CODIGO", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){

                $pagamentos = new Pagamentos();

                $pagamentos->setCdPgto($row['CD_PGTO']);
                $pagamentos->setValorPgto($row['DS_VALOR']);
                $pagamentos->setValorData($row['DT_PGTO']);
                $pessoa = new Pessoa();
                $pessoa->setCodigoPessoa($row['CD_PESSOA']);
                $pagamentos->setPessoa($pessoa);


            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $pagamentos;
    }

}