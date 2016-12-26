<?php

/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 23/12/2016
 * Time: 16:26
 */
include ("ConnectionFactory.class.php");
include ("services/PessoaList.class.php");
class Pessoa_DAO
{
    private $conexao = null;
    public function inserir(Pessoa $pessoa){
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "INSERT INTO PESSOA 
            (CD_PESSOA, NM_PESSOA, NR_CPF, NR_TELEFONE, DS_EMAIL, CD_VALOR, CD_RETIRO, SN_CHALE, DT_NASCIMENTO)
        VALUES(NULL,?,?,?,?,?,?,?,?)";
        try {
            $datas = explode('/',$pessoa->getDtNascimento());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$pessoa->getNmPessoa());
            $stmt->bindValue(2, $pessoa->getNrCpf());
            $stmt->bindValue(3,$pessoa->getNrTelefone());
            $stmt->bindValue(4,$pessoa->getDsEmail());
            $stmt->bindValue(5,$pessoa->getValorCodigo());
            $stmt->bindValue(6,$pessoa->getSnChale());
            $stmt->bindValue(7,$pessoa->$data);
            $stmt->execute();
            $stmt.execute();
            $teste = true;
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;
    }
    public function update(Pessoa $pessoa){
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "UPDATE PESSOA SET 
                NM_PESSOA = ?, NR_CPF = ?, 
                NR_TELEFONE = ?, DS_EMAIL = ?,
                CD_VALOR = ?, CD_RETIRO = ?, SN_CHALE = ? 
                ,DT_NASCIMENTO = ?
                 WHERE CD_PESSOA = ?";
        try {
            $datas = explode('/',$pessoa->getDtNascimento());
            $dia = $datas[0];
            $mes = $datas[1];
            $ano = $datas[2];
            $data = $ano.'-'.$mes.'-'.$dia;
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1,$pessoa->getNmPessoa());
            $stmt->bindValue(2, $pessoa->getNrCpf());
            $stmt->bindValue(3,$pessoa->getNrTelefone());
            $stmt->bindValue(4,$pessoa->getDsEmail());
            $stmt->bindValue(5,$pessoa->getValorCodigo());
            $stmt->bindValue(6,$pessoa->getSnChale());
            $stmt->bindValue(7,$pessoa->$data);
            $stmt->bindValue(8,$pessoa->getCodigoPessoa());
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
        $this->conexao =  new ConnectionFactory();
        $sql = "DELETE FROM PESSOA WHERE CD_PESSOA = ?";
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

    public function getListaPessoa($nome){

        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $pessoaList = new PessoaList();

        try {
            if($nome == ""){
                $sql = "SELECT * FROM V_PESSOA P";
                $stmt = $this->conexao->prepare($sql);

            }else{
                $sql = "SELECT * FROM V_PESSOA P WHERE P.NM_PESSOA LIKE ?";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(1, "%"+$nome+"%");

            }
            while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $pessoa = new Pessoa();
                $pessoa->setCodigo_pessoa($row["CD_PESSOA"]);
                $pessoa->setNm_pessoa($row["NM_PESSOA"]);
                $pessoa->setNr_cpf($row["CPF"]);
                $pessoa->setNr_telefone($row["NR_TELEFONE"]);
                $pessoa->setDs_email($row["DS_EMAIL"]);
                $pessoa->setSn_chale($row["SN_CHALE"]);
                $pessoa->setValor_pagar($row["TOTAL"]);
                $pessoa->setValor_falta($row["FALTA"]);
                $pessoa->setValor_valor($row["VALOR"]);
                $pessoa->setValor_pago($row["PAGO"]);
                $pessoaList->addPessoa($pessoa);
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }

        return $pessoaList;
    }

    public function getPessoa($codigo){
        $pessoa = null;
        $conexao = null;

        $this->conexao =  new ConnectionFactory();

        $sql = "SELECT * FROM V_PESSOA WHERE CD_PESSOA = ?";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $codigo);

            if($row =  $stmt->fetch(PDO::FETCH_OBJ)){
                $pessoa = new Pessoa();
               $pessoa->setCodigo_pessoa($row["CD_PESSOA"]);
               $pessoa->setNm_pessoa($row["NM_PESSOA"]);
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

   public function getListaPessoaDesistente($str_pessoa){

       $conexao = null;

       $this->conexao =  new ConnectionFactory();

       $pessoaList = new PessoaList();

       try {
           if($str_pessoa.equals("")){
               $sql = "SELECT D.*, 
                       CONCAT(SUBSTR(d.CPF_DESISTENTE,1,3),'.',SUBSTR(d.CPF_DESISTENTE,4,3),'.',SUBSTR(d.CPF_DESISTENTE,7,3),'-',SUBSTR(d.CPF_DESISTENTE,10,3)) CPF 
                       FROM desistente d ";
               $stmt = $this->conexao->prepare($sql);

           }else{
               $sql = "SELECT D.*,
                         CONCAT(SUBSTR(d.CPF_DESISTENTE,1,3),'.',SUBSTR(d.CPF_DESISTENTE,4,3),'.',SUBSTR(d.CPF_DESISTENTE,7,3),'-',SUBSTR(d.CPF_DESISTENTE,10,3)) CPF 
                        FROM desistente d WHERE d.NM_desistente LIKE ?";
               $stmt = $this->conexao->prepare($sql);
               $stmt->bindValue(1, "%"+$str_pessoa+"%");

           }
           while($row = $stmt->fetch(PDO::FETCH_OBJ)){
               $pessoa = new Pessoa();
               $pessoa->setCodigo_pessoa($row["CD_DESISTENTE"]);
               $pessoa->setNm_pessoa($row["NM_DESISTENTE"]);
               $pessoa->setNr_cpf($row["CPF"]);
               $pessoa->setNr_telefone($row["NR_TELEFONE"]);
               $pessoa->setDs_email($row["DS_EMAIL"]);
               $pessoa->setSn_chale($row["SN_CHALE"]);
               $pessoa->setValor_pagar($row["TOTAL"]);
               $pessoa->setValor_falta($row["FALTA"]);
               $pessoa->setValor_valor($row["VALOR"]);
               $pessoa->setValor_pago($row["PAGO"]);

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
        $conexao = null;
        $teste = false;
        $this->conexao =  new ConnectionFactory();
        $sql = "DELETE FROM DESISTENTE  WHERE CD_DESISTENTE = ?";
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
        $valor = getValor($pessoa);
        $conexao = null;

        $this->conexao =  new ConnectionFactory();
        $sql =  "INSERT INTO PESSOA 
        ( CD_PESSOA,NM_PESSOA, NR_CPF, NR_TELEFONE, DS_EMAIL, CD_VALOR, CD_RETIRO, SN_CHALE, DT_NASCIMENTO)
         SELECT NULL, NM_DESISTENTE, CPF_DESISTENTE, NR_TELEFONE, DS_EMAIL, VALOR, RETIRO, SN_CHALE, DT_NASCIMENTO FROM DESISTENTE WHERE
         CD_DESISTENTE = ?";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $pessoa);

            $stmt.execute();
            $codigo =  $this->conexao->lastInsertId();
                inserirValor($codigo, $valor);

            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }


        deleteDesistente($pessoa);
        return $codigo;
    }

    public function inserirDesistente($pessoa){
        $codigo = 0;

        $conexao = null;

        $this->conexao =  new ConnectionFactory();
        $sql = "INSERT INTO DESISTENTE 
             ( 
               NM_DESISTENTE, CPF_DESISTENTE, TOTAL, FALTA, PAGO, VALOR, SN_CHALE, NR_TELEFONE, DT_NASCIMENTO, DS_EMAIL, RETIRO
             ) 
              SELECT P.NM_PESSOA, P.NR_CPF, P.TOTAL,  P.FALTA, P.PAGO, P.CD_VALOR, P.SN_CHALE, P.NR_TELEFONE, P.DT_NASCIMENTO, P.DS_EMAIL, CD_RETIRO FROM V_PESSOA P
              WHERE P.CD_PESSOA = ?";
            try {
                $stmt = $this->conexao->prepare(sql);
                $stmt->bindValue(1, $pessoa);

                $stmt->execute();
                $codigo =  $this->conexao->lastInsertId();

            } catch (PDOException $ex) {
                echo "Erro: ".$ex->getMessage();
            }
             $pd = new Pagamentos_DAO();
             $pd->deletePessoa($pessoa);
             delete($pessoa);
         return $codigo;
    }
}