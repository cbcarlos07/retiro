<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 26/12/2016
 * Time: 20:02
 */
class Totais_DAO
{
    private $conexao = null;
    public function getTotais(){
        require_once 'ConnectionFactory.class.php';
        require_once 'beans/Totais.class.php';
        $totais = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM V_TOTAIS ";

        try {
            $stmt = $this->conexao->prepare($sql);

            $stmt->execute();

            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $totais = new Totais();
                $totais->setReceber($row['RECEBER']);
                $totais->setGasto($row['GASTO']);
                $totais->setRecebido($row['RECEBIDO']);
                $totais->setAtual($row['ATUAL']);

            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $totais;
    }
}