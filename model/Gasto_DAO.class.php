<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:26
 */
include ("ConnectionFactory.class.php");
include ("../services/GastoList.class.php");
class Gasto_DAO
{
    private $conexao = null;
    public function inserir(Gasto $gasto){
        $conexao = null;
        $teste = false;
        $this->p =  new ConnectionFactory();
        $sql = "INSERT INTO GASTOS (DS_GASTO, OBS_GASTO, VALOR_GASTO, DT_GASTO)
                 VALUES(?,?,?,?)";
        try {
            $datas = explode('/',$gasto->getDtGasto());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$gasto->getDtGasto());
            $stmt->bindValue(2, $gasto->getObsGasto());
            $stmt->bindValue(3,$gasto->getValorGasto());
            $stmt->bindValue(4,$data);
            $stmt->execute();
            $stmt.execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }
    public function update(Gasto $gasto){
        $conexao = null;
        $teste = false;
        $this->p =  new ConnectionFactory();
        $sql = "UPDATE GASTOS SET DS_GASTO = ?, OBS_GASTO = ?, VALOR_GASTO = ?, DT_GASTO = ?
                 WHERE CD_GASTO = ?";
        try {
            $datas = explode('/',$gasto->getDtGasto());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$gasto->getDtGasto());
            $stmt->bindValue(2, $gasto->getObsGasto());
            $stmt->bindValue(3,$gasto->getValorGasto());
            $stmt->bindValue(4,$data);
            $stmt->bindValue(4,$gasto->getCdGasto());
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
        $sql = "DELETE FROM GASTOS 
                 WHERE CD_GASTO = ?";
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

    public function getListaGasto($nome){

        $conexao = null;

        $this->p =  new ConnectionFactory();

        $gastoList = new GastoList();

        try {
            if($nome.equals("")){
                $sql = "SELECT * FROM GASTOS";
                $stmt = $this->conexao->prepare($sql);

            }else{
                $sql = "SELECT * FROM GASTOS WHERE DS_GASTO LIKE ?";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1, "%"+$nome+"%");

            }
            while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $gasto = new Gasto();

                $gasto->setCdGasto($row['CD_GASTO']);
                $gasto->setDsGasto($row['DS_GASTO']);
                $gasto->setObsGasto($row['OBS_GASTO']);
                $gasto->setValorGasto($row['VALOR_GASTO']);
                $gasto->setDtGasto($row['DT_GASTO']);
                $gastoList->addGasto($gasto);
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $gastoList;
    }

    public function getGasto($codigo){
        $gasto = null;
        $conexao = null;

        $this->p =  new ConnectionFactory();

        $sql = "SELECT * FROM GASTOS WHERE CD_GASTO = ?";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $codigo);

            if($row =  $stmt->fetch(PDO::FETCH_OBJ)){
                $gasto = new Gasto();

                $gasto->setCdGasto($row['CD_GASTO']);
                $gasto->setDsGasto($row['DS_GASTO']);
                $gasto->setObsGasto($row['OBS_GASTO']);
                $gasto->setValorGasto($row['VALOR_GASTO']);
                $gasto->setDtGasto($row['DT_GASTO']);

            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $gasto;
    }

}