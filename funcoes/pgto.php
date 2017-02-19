<?php
/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 25/12/2016
 * Time: 16:45
 */

$acao = "";
$codigo = 0;
$pessoa = 0;
$valor = "";
$data = "";

if(isset($_POST['acao'])){
    $acao = $_POST['acao'];
}
if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
}

if(isset($_POST['pessoa'])){
    $pessoa = $_POST['pessoa'];
}

if(isset($_POST['valor'])){
    $valor = $_POST['valor'];
}
if(isset($_POST['data'])){
    $data = $_POST['data'];
}

switch ($acao) {
    case 'C':
        cadastrar($pessoa, $valor, $data);
        break;
    case 'A':
        alterar($codigo, $pessoa, $valor, $data);
        break;
    case 'E':
        excluir($codigo);
        break;
    case 'R':
        getValor($idade);
        break;

}


function cadastrar($pessoa, $valor, $data){
        require_once '../controller/Pagamentos_Controller.class.php';
        require_once '../beans/Pagamentos.class.php';
        require_once '../beans/Pessoa.class.php';
        $pagamento = new Pagamentos();
        $pc = new Pagamentos_Controller();
        $pessoaObj =  new Pessoa();
        $pessoaObj->setCodigoPessoa($pessoa);
        $pagamento->setPessoa($pessoaObj);
        $pagamento->setValorPgto($valor);
        $pagamento->setValorData($data);
        $teste = $pc->inserir($pagamento);
        if($teste = true) {
            echo json_encode(array('retorno' => 1));
        }
        else {
            echo json_encode(array('retorno' => 0));
        }

    }



function alterar($codigo, $pessoa, $valor, $data){
    require_once '../controller/Pagamentos_Controller.class.php';
    require_once '../beans/Pagamentos.class.php';
    require_once '../beans/Pessoa.class.php';
    $pagamento = new Pagamentos();
    $pc = new Pagamentos_Controller();
    $pessoaObj =  new Pessoa();
    $pagamento->setCdPgto($codigo);
    $pessoaObj->setCodigoPessoa($pessoa);
    $pagamento->setPessoa($pessoaObj);
    $pagamento->setValorPgto($valor);
    $pagamento->setValorData($data);
    $teste = $pc->update($pagamento);
    if($teste = true) {
        echo json_encode(array('retorno' => 1));
    }
    else {
        echo json_encode(array('retorno' => 0));
    }

}


function excluir($codigo){
    require_once '../controller/Pagamentos_Controller.class.php';
   print_r("Codigo no excluir: ".$codigo);

    $pc = new Pagamentos_Controller();

    $teste = $pc->delete($codigo);
    if($teste = true) {
        echo json_encode(array('retorno' => 1));
    }
    else {
        echo json_encode(array('retorno' => 0));
    }

}

function getValor($idade){
    require_once '../controller/Valores_Controller.php';
    require_once '../beans/Valores.class.php';

    $vc = new Valores_Controller();
    $valores = $vc->getValoresPorIdade($idade);
    echo json_encode(array('idade' => $valores->getValorCodigo(),'valor' => $valores->getValorValor()));

}