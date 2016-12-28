<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:26
 */
//include ("ConnectionFactory.class.php");
//include ("../services/GastoList.class.php");
class Gasto_DAO
{
    private $conexao = null;
    public function inserir(Gasto $gasto){
        require_once ("ConnectionFactory.class.php");
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "INSERT INTO GASTOS (DS_GASTO, OBS_GASTO, VALOR_GASTO, DT_GASTO)
                 VALUES(:descricao,:obs,:valor,:data_)";
        try {
            $datas = explode('/',$gasto->getDtGasto());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":descricao",$gasto->getDsGasto(), PDO::PARAM_STR);
            $stmt->bindValue(":obs", $gasto->getObsGasto(), PDO::PARAM_STR);
            $stmt->bindValue(":valor",$gasto->getValorGasto(), PDO::PARAM_STR);
            $stmt->bindValue(":data_",$data, PDO::PARAM_STR);
            $stmt->execute();

            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }
    public function update(Gasto $gasto){
        require_once ("ConnectionFactory.class.php");
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "UPDATE GASTOS SET DS_GASTO = :descricao, OBS_GASTO = :obs, VALOR_GASTO = :valor, DT_GASTO = :data_
                 WHERE CD_GASTO = :codigo";
        try {
            $datas = explode('/',$gasto->getDtGasto());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":descricao",$gasto->getDsGasto(), PDO::PARAM_STR);
            $stmt->bindValue(":obs", $gasto->getObsGasto(), PDO::PARAM_STR);
            $stmt->bindValue(":valor",$gasto->getValorGasto(), PDO::PARAM_STR);
            $stmt->bindValue(":data_",$data, PDO::PARAM_STR);
            $stmt->bindValue(":codigo",$gasto->getCdGasto(), PDO::PARAM_INT);
            $stmt->execute();

            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function delete($codigo){
        require_once ("ConnectionFactory.class.php");
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "DELETE FROM GASTOS 
                 WHERE CD_GASTO = :codigo";
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

    public function getListaGasto($nome){

        require_once ("ConnectionFactory.class.php");
        require_once ("services/GastoList.class.php");
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $gastoList = new GastoList();

        try {
            if($nome == ""){
                $sql = "SELECT * FROM GASTOS";
                $stmt = $this->conexao->prepare($sql);

            }else{
                $sql = "SELECT * FROM GASTOS WHERE DS_GASTO LIKE :nome";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
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
        require_once ("ConnectionFactory.class.php");
        $gasto = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM GASTOS WHERE CD_GASTO = :codigo";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
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