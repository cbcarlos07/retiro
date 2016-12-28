<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:26
 */

//include_once 'ConnectionFactory.class.php';
class Pessoa_DAO
{
    private $conexao = null;
    public function inserir(Pessoa $pessoa){
        require_once 'ConnectionFactory.class.php';
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "INSERT INTO PESSOA 
            (CD_PESSOA, NM_PESSOA, NR_CPF, NR_TELEFONE, DS_EMAIL, CD_VALOR, CD_RETIRO, SN_CHALE, DT_NASCIMENTO)
        VALUES(NULL,     :NOME,      :CPF,   :TELEFONE,   :EMAIL,   :VALOR,   :RETIRO,   :CHALE,   :DATA_)";
        try {
            $datas = explode('/',$pessoa->getDtNascimento());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":NOME",$pessoa->getNmPessoa(), PDO::PARAM_STR);
            $stmt->bindValue(":CPF", $pessoa->getNrCpf(),PDO::PARAM_STR);
            $stmt->bindValue(":TELEFONE",$pessoa->getNrTelefone(),PDO::PARAM_STR);
            $stmt->bindValue(":EMAIL",$pessoa->getDsEmail(),PDO::PARAM_STR);
            $stmt->bindValue(":VALOR",$pessoa->getValorCodigo(),PDO::PARAM_INT);
            $stmt->bindValue(":RETIRO",$pessoa->getRetiro()->getCdRetiro(), PDO::PARAM_INT);
            $stmt->bindValue(":CHALE",$pessoa->getSnChale(), PDO::PARAM_STR);
            $stmt->bindValue(":DATA_",$data, PDO::PARAM_STR);
            $stmt->execute();

            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }
    public function update(Pessoa $pessoa){
        require_once 'ConnectionFactory.class.php';
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "UPDATE PESSOA SET 
                NM_PESSOA = :NOME, NR_CPF = :CPF, 
                NR_TELEFONE = :TELEFONE, DS_EMAIL = :EMAIL,
                CD_VALOR = :VALOR, CD_RETIRO = :RETIRO, SN_CHALE = :CHALE 
                ,DT_NASCIMENTO = :DATA_
                 WHERE CD_PESSOA = :CODIGO";
        try {
            $datas = explode('/',$pessoa->getDtNascimento());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":NOME",$pessoa->getNmPessoa(), PDO::PARAM_STR);
            $stmt->bindValue(":CPF", $pessoa->getNrCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":TELEFONE",$pessoa->getNrTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":EMAIL",$pessoa->getDsEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":VALOR",$pessoa->getValorCodigo(), PDO::PARAM_INT);
            $stmt->bindValue(":CHALE",$pessoa->getSnChale(), PDO::PARAM_STR);
            $stmt->bindValue(":RETIRO",$pessoa->getRetiro()->getCdRetiro(), PDO::PARAM_INT);
            $stmt->bindValue(":DATA_",$data);
            $stmt->bindValue(":CODIGO",$pessoa->getCodigoPessoa());
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
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "DELETE FROM PESSOA WHERE CD_PESSOA = :codigo";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":codigo", $codigo,PDO::PARAM_INT);
            $stmt->execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }

    public function getListaPessoa($nome){
        include_once ("services/PessoaList.class.php");
        require_once ('model/Pessoa_DAO.class.php');
        include_once 'ConnectionFactory.class.php';
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $pessoaList = new PessoaList();

        try {
            if($nome == ""){
                $sql = "SELECT * FROM V_PESSOA P";
                $stmt = $this->conexao->prepare($sql);

            }else{
                $sql = "SELECT * FROM V_PESSOA P WHERE P.NM_PESSOA LIKE :nome";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $pessoa = new Pessoa();
                $pessoa->setCodigoPessoa($row["CD_PESSOA"]);
                $pessoa->setNmPessoa($row["NM_PESSOA"]);
                $pessoa->setNrCpf($row["CPF"]);
                $pessoa->setNrTelefone($row["NR_TELEFONE"]);
                $pessoa->setDsEmail($row["DS_EMAIL"]);
                $pessoa->setSnChale($row["SN_CHALE"]);
                $pessoa->setValorPagar($row["TOTAL"]);
                $pessoa->setValorFalta($row["FALTA"]);
                $pessoa->setValorValor($row["VALOR"]);
                $pessoa->setValorPago($row["PAGO"]);
                $pessoa->setDtNascimento($row['DT_NASCIMENTO']);
                $pessoaList->addPessoa($pessoa);
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $pessoaList;
    }

    public function getPessoa($codigo){
        require_once 'ConnectionFactory.class.php';
        require_once 'beans/Pessoa.class.php';
        require_once 'beans/Retiro.class.php';
        $pessoa = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM V_PESSOA P WHERE P.CD_PESSOA = :codigo";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){

                $pessoa = new Pessoa();
                $pessoa->setCodigoPessoa($row["CD_PESSOA"]);
                $pessoa->setNmPessoa($row["NM_PESSOA"]);
                $pessoa->setNrCpf($row["CPF"]);
                $pessoa->setNrTelefone($row["NR_TELEFONE"]);
                $pessoa->setDsEmail($row["DS_EMAIL"]);
                $pessoa->setSnChale($row["SN_CHALE"]);
                $pessoa->setValorPagar($row["TOTAL"]);
                $pessoa->setValorFalta($row["FALTA"]);
                $pessoa->setValorValor($row["VALOR"]);
                $pessoa->setValorPago($row["PAGO"]);


                $retiro = new Retiro();
                $retiro->setCdRetiro($row["CD_RETIRO"]);
                $pessoa->setRetiro($retiro);


                $pessoa->setDtNascimento($row["DT_NASCIMENTO"]);

            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $pessoa;
    }

   public function getListaPessoaDesistente($str_pessoa){
       require_once 'ConnectionFactory.class.php';
       require_once 'beans/Pessoa.class.php';
       include_once ("services/PessoaList.class.php");

       $conexao = null;

       $this->conexao =  new ConnectionFactory();

       $pessoaList = new PessoaList();

       try {
           if($str_pessoa == ""){
               $sql = "SELECT D.*, 
                       CONCAT(SUBSTR(d.CPF_DESISTENTE,1,3),'.',SUBSTR(d.CPF_DESISTENTE,4,3),'.',SUBSTR(d.CPF_DESISTENTE,7,3),'-',SUBSTR(d.CPF_DESISTENTE,10,3)) CPF 
                       FROM desistente d ";
               $stmt = $this->conexao->prepare($sql);

           }else{
               $sql = "SELECT D.*,
                         CONCAT(SUBSTR(d.CPF_DESISTENTE,1,3),'.',SUBSTR(d.CPF_DESISTENTE,4,3),'.',SUBSTR(d.CPF_DESISTENTE,7,3),'-',SUBSTR(d.CPF_DESISTENTE,10,3)) CPF 
                        FROM desistente d WHERE d.NM_desistente LIKE :nome";
               $stmt = $this->conexao->prepare($sql);
               $stmt->bindValue(":nome", "%$str_pessoa%", PDO::PARAM_STR);

           }
           $stmt->execute();
           while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               $pessoa = new Pessoa();
               $pessoa->setCodigoPessoa($row["CD_DESISTENTE"]);
               $pessoa->setNmPessoa($row["NM_DESISTENTE"]);
               $pessoa->setNrCpf($row["CPF"]);
               $pessoa->setNrTelefone($row["NR_TELEFONE"]);
               $pessoa->setDsEmail($row["DS_EMAIL"]);
               $pessoa->setSnChale($row["SN_CHALE"]);
               $pessoa->setValorPagar($row["TOTAL"]);
               $pessoa->setValorFalta($row["FALTA"]);
               $pessoa->setValorValor($row["VALOR"]);
               $pessoa->setValorPago($row["PAGO"]);

               $pessoaList->addPessoa($pessoa);
           }
           $this->conexao = null;
       } catch (PDOException $ex) {
           echo "Erro: ".$ex->getMessage();
       }

       return $pessoaList;

   }

    public function getPessoaDesistente($codigo){
        $pessoa = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM DESISTENTE WHERE CD_DESISTENTE = ?s";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $codigo);

            if($row =  $stmt->fetch(PDO::FETCH_OBJ)){
                $pessoa = new Pessoa();
                $pessoa->setCodigo_pessoa($row["CD_DESISTENTE"]);
                $pessoa->setNm_pessoa($row["NM_DESISTENTE"]);
                $pessoa->setNr_cpf($row["NR_CPF"]);
                $pessoa->setNr_telefone($row["NR_TELEFONE"]);
                $pessoa->setDs_email($row["DS_EMAIL"]);
                $pessoa->setValor_codigo($row["CD_VALOR"]);
                $pessoa->setValor_valor($row["VALOR"]);
                $pessoa->setSn_chale($row["SN_CHALE"]);
                $pessoa->setValor_pagar($row["TOTAL"]);
                $pessoa->setValor_falta($row["FALTA"]);
                $pessoa->setRetiro(new Retiro());
                $pessoa->getRetiro().setCd_retiro($row["CD_RETIRO"]);
                $pessoa->getRetiro().setDs_retiro($row["RETIRO"]);
                $pessoa->setValor_pago($row["PAGO"]);
                $pessoa->setDt_nascimento($row["DT_NASCIMENTO"]);

            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $pessoa;
    }

    public function deleteDesistente($codigo){
        require_once 'ConnectionFactory.class.php';
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "DELETE FROM DESISTENTE  WHERE CD_DESISTENTE = ?";
        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $codigo);
            $stmt->execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }


        public function inserirValor($pessoa, $valor){


            $conexao = null;
            $teste = false;
            $this->conexao =  new ConnectionFactory();
            $sql =  "INSERT INTO PAGAMENTOS ( CD_PESSOA,DS_VALOR, DT_PGTO) VALUES (?,?, curdate()) ";
        try{

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $pessoa);
            $stmt->bindValue(2, $valor);

            $stmt->execute();

            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
            return $teste;
         }

  public function getValor($pessoa){
             require_once 'ConnectionFactory.class.php';
            $valor = 0;
            $conexao = null;

            $this->conexao =  new ConnectionFactory();
            $sql =   "SELECT PAGO FROM DESISTENTE WHERE CD_DESISTENTE = ?";


        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $pessoa);

            if($row =  $stmt->fetch(PDO::FETCH_OBJ)){
               $valor = $row['PAGO'];
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
            return $valor;
   }

    public function inserirRetornarDesistente($pessoa){
        $codigo = 0;
        $valor = $this->getValor($pessoa);
        $conexao = null;

        $this->conexao =  new ConnectionFactory();
        $sql =  "INSERT INTO PESSOA 
        ( CD_PESSOA,NM_PESSOA, NR_CPF, NR_TELEFONE, DS_EMAIL, CD_VALOR, CD_RETIRO, SN_CHALE, DT_NASCIMENTO)
         SELECT NULL, NM_DESISTENTE, CPF_DESISTENTE, NR_TELEFONE, DS_EMAIL, VALOR, RETIRO, SN_CHALE, DT_NASCIMENTO FROM DESISTENTE WHERE
         CD_DESISTENTE = ?";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $pessoa);

            $stmt->execute();
            $codigo =  $this->conexao->lastInsertId();
                $this->inserirValor($codigo, $valor);

            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }


        $this->deleteDesistente($pessoa);
        return $codigo;
    }

    public function inserirDesistente($pessoa){
        require_once 'Pagamentos_DAO.class.php';
        require_once 'ConnectionFactory.class.php';
        $codigo = 0;

        $conexao = null;

        $this->conexao =  new ConnectionFactory();
        $sql = "INSERT INTO DESISTENTE 
             ( 
               NM_DESISTENTE, CPF_DESISTENTE, TOTAL, FALTA, PAGO, VALOR, SN_CHALE, NR_TELEFONE, DT_NASCIMENTO, DS_EMAIL, RETIRO
             ) 
              SELECT P.NM_PESSOA, P.NR_CPF, P.TOTAL,  P.FALTA, P.PAGO, P.CD_VALOR, P.SN_CHALE, P.NR_TELEFONE, P.DT_NASCIMENTO, P.DS_EMAIL, CD_RETIRO FROM V_PESSOA P
              WHERE P.CD_PESSOA = :codigo";
            try {
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(":codigo", $pessoa, PDO::PARAM_INT);

                $stmt->execute();
                //$codigo =  $this->conexao->lastInsertId();
                $codigo = 1;

                $this->conexao = null;
            } catch (PDOException $ex) {
                echo "Erro: ".$ex->getMessage();
            }
             $pd = new Pagamentos_DAO();
             $pd->deletePessoa($pessoa);
             $this->delete($pessoa);
         return $codigo;
    }
}