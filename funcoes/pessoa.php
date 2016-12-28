<?php
/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 25/12/2016
 * Time: 16:45
 */

$acao = "";
$codigo = 0;
$nome = "";
$cpf = "";
$telefone = "";
$email  = "";
$valor  = "";
$retiro  = "";
$chale  = "";
$data = "";

if(isset($_POST['acao'])){
    $acao = $_POST['acao'];
}
if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
}
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}
if(isset($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}
if(isset($_POST['telefone'])){
    $telefone = $_POST['telefone'];
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
if(isset($_POST['valor'])){
    $valor = $_POST['valor'];
}
if(isset($_POST['retiro'])){
    $retiro = $_POST['retiro'];
}
if(isset($_POST['chale'])){
    $chale = $_POST['chale'];
}
if(isset($_POST['data'])){
    $data = $_POST['data'];
}



switch ($acao) {
    case 'C':
        cadastrar(
        $nome,
        $cpf,
        $telefone,
        $email,
        $valor,
        $retiro,
        $chale,
        $data);
        break;
    case 'A':
        alterar($codigo,$nome,
            $cpf,
            $telefone,
            $email,
            $valor,
            $retiro,
            $chale,
            $data);
        break;
    case 'E':
        excluir($codigo);
        break;
    case 'D':

        desistente($codigo);
        break;
}


function cadastrar($nome,$cpf,
                   $telefone,
                   $email,
                   $valor,
                   $retiro,
                   $chale,
                   $data){

        require_once '../controller/Pessoa_Controller.class.php';
        require_once '../beans/Pessoa.class.php';
        require_once '../beans/Retiro.class.php';
        $pessoa = new Pessoa();
        $retiroObj = new Retiro();
        $retiroObj->setCdRetiro($retiro);
        $pc = new Pessoa_Controller();

        $pessoa->setNmPessoa(strtoupper($nome));
        $vowels = array(".", "-");
        $novocpf = str_replace($vowels,'',$cpf);
        $vowels = array("(", ")","-"," ");
        $novotelefone = str_replace($vowels,"",$telefone);
        $pessoa->setNrCpf($novocpf);
        $pessoa->setNrTelefone($novotelefone);
        $pessoa->setDsEmail($email);
        $pessoa->setValorCodigo($valor);
        $pessoa->setSnChale($chale);
        $pessoa->setRetiro($retiroObj);
        $pessoa->setDtNascimento($data);
        $teste = $pc->inserir($pessoa);

        if($teste = true) {
            echo json_encode(array('retorno' => 1));
        }
        else {
            echo json_encode(array('retorno' => 0));
        }

    }



function alterar($codigo,$nome,
                 $cpf,
                 $telefone,
                 $email,
                 $valor,
                 $retiro,
                 $chale,
                 $data){
    require_once '../controller/Pessoa_Controller.class.php';
    require_once '../beans/Pessoa.class.php';
    require_once '../beans/Retiro.class.php';
    $pessoa = new Pessoa();
    $retiroObj = new Retiro();
    $retiroObj->setCdRetiro($retiro);

    $pessoa = new Pessoa();
    $pc = new Pessoa_Controller();
    $pessoa->setCodigoPessoa($codigo);
    $pessoa->setNmPessoa(strtoupper($nome));
    $vowels = array(".", "-");
    $novocpf = str_replace($vowels,'',$cpf);
    $vowels = array("(", ")","-"," ");
    $novotelefone = str_replace($vowels,"",$telefone);
    $pessoa->setNrCpf($novocpf);
    $pessoa->setNrTelefone($novotelefone);
    $pessoa->setDsEmail($email);
    $pessoa->setValorCodigo($valor);
    $pessoa->setSnChale($chale);
    $pessoa->setRetiro($retiroObj);
    $pessoa->setDtNascimento($data);
    $teste = $pc->update($pessoa);


    if($teste = true) {
        echo json_encode(array('retorno' => 1));
    }
    else {
        echo json_encode(array('retorno' => 0));
    }

}


function excluir($codigo){
    require_once '../controller/Pessoa_Controller.class.php';
    require_once '../beans/Pessoa.class.php';

    $pc = new Pessoa_Controller();

    $teste = $pc->delete($codigo);
    if($teste = true) {
        echo json_encode(array('retorno' => 1));
    }
    else {
        echo json_encode(array('retorno' => 0));
    }

}


function desistente($codigo){
    require_once '../controller/Pessoa_Controller.class.php';


    $pc = new Pessoa_Controller();

    $teste = $pc->inserirDesistente($codigo);
    if($teste = true) {
        echo json_encode(array('retorno' => 1));
    }
    else {
        echo json_encode(array('retorno' => 0));
    }

}
