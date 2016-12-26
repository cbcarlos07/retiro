<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:26
 */
include ("ConnectionFactory.class.php");
include ("../services/PagamentosList.class.php");
class Pagamentos_DAO
{
    private $conexao = null;
    public function inserir(Pagamentos $pagamentos){
        $conexao = null;
        $teste = false;
        $this->p =  new ConnectionFactory();
        $sql = "INSERT INTO PAGAMENTOS (CD_PESSOA, DS_VALOR, DT_PGTO)
                 VALUES(?,?,?)";
        try {
            $datas = explode('/',$pagamentos->getValorData());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$pagamentos->getPessoa());
            $stmt->bindValue(2, $pagamentos->getValorPgto());
            $stmt->bindValue(3,$data);
            $stmt->execute();
            $stmt.execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }
    public function update(Pagamentos $pagamentos){
        $conexao = null;
        $teste = false;
        $this->p =  new ConnectionFactory();
        $sql = "UPDATE PAGAMENTOS SET CD_PESSOA = ?, DS_VALOR = ?, DT_PGTO = ?
                 WHERE CD_PGTO = ?";
        try {
            $datas = explode('/',$pagamentos->getDtPagamentos());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$pagamentos->getPessoa());
            $stmt->bindValue(2, $pagamentos->getValorData());
            $stmt->bindValue(4,$data);
            $stmt->bindValue(4,$pagamentos->getCdPagamentos());
            $stmt->execute();
            $stmt.execute();
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
        $this->p =  new ConnectionFactory();
        $sql = "DELETE FROM PAGAMENTOS WHERE CD_PGTO = ?";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $codigo);
            $stmt.execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function deletePessoa($pagamentos){
            $teste = false;
            $conexao = null;
            $teste = false;
            $this->p =  new ConnectionFactory();
            $sql = "DELETE FROM PAGAMENTOS  WHERE CD_PESSOA = ?";
            try {
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1, $pagamentos);
                $stmt.execute();
                $teste = true;
                $this->conexao = null;


            } catch (PDOException $ex) {
                echo "Erro: ".$ex->getMessage();
            }
        return $teste;
    }



    public function getListaPagamentos($nome, $pessoa){

        $conexao = null;

        $this->p =  new ConnectionFactory();

        $pagamentosList = new PagamentosList();

        try {
            if($nome.equals("")){
                $sql = "SELECT * FROM PAGAMENTOS WHERE CD_PESSOA = ?";
                $stmt = $this->conexao->prepare($sql);

            }else{
                $sql = "SELECT * FROM PAGAMENTOS WHERE DS_VALOR LIKE ? AND CD_PESSOA = ?";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1, "%"+$nome+"%");
                $stmt->bindValue(2, $pessoa);

            }
            while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $pagamentos = new Pagamentos();

                $pagamentos->setCdPgto($row['CD_PGTO']);
                $pagamentos->setPessoa($row['CD_PESSOA']);
                $pagamentos->setValorPgto($row['DS_VALOR']);
                $pagamentos->setValorData($row['DT_PGTO']);

                $pagamentosList->addPagamentos($pagamentos);
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $pagamentosList;
    }

    public function getPagamentos($codigo){
        $pagamentos = null;
        $conexao = null;

        $this->p =  new ConnectionFactory();

        $sql = "SELECT * FROM GASTOS WHERE CD_GASTO = ?";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $codigo);

            if($row =  $stmt->fetch(PDO::FETCH_OBJ)){
                $pagamentos = new Pagamentos();

                $pagamentos->setCdPagamentos($row['CD_GASTO']);
                $pagamentos->setDsPagamentos($row['DS_GASTO']);
                $pagamentos->setObsPagamentos($row['OBS_GASTO']);
                $pagamentos->setValorPagamentos($row['VALOR_GASTO']);
                $pagamentos->setDtPagamentos($row['DT_GASTO']);

            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $pagamentos;
    }

}