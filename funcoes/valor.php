<?php
/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 25/12/2016
 * Time: 16:45
 */

$acao = "";
$descricao = "";
$valor = "";
$codigo = 0;
$idade_inicial = 0;
$idade_final = 0;
$idade = 0;
if(isset($_POST['acao'])){
    $acao = $_POST['acao'];
}
if(isset($_POST['descricao'])){
    $descricao = $_POST['descricao'];
}

if(isset($_POST['valor'])){
    $valor = $_POST['valor'];
}

if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
}

if(isset($_POST['idade_inicial'])){
    $idade_inicial = $_POST['idade_inicial'];
}

if(isset($_POST['idade_final'])){
    $idade_final = $_POST['idade_final'];
}
if(isset($_POST['idade'])){
    $idade = $_POST['idade'];
}

switch ($acao) {
    case 'I':
        cadastrar($descricao, $valor, $idade_inicial, $idade_final);
        break;
    case 'A':
        alterar($codigo, $descricao, $valor, $idade_inicial, $idade_final);
        break;
    case 'E':
        excluir($codigo);
        break;
    case 'R':
        getValor($idade);
        break;

}


function cadastrar($descricao, $desc_valor, $idade_inicial, $idade_final){
        require_once '../controller/Valores_Controller.php';
        require_once '../beans/Valores.class.php';
        $valor = new Valores();
        $vc = new Valores_Controller();

        $valor->setValorValor($desc_valor);
        $valor->setDescricao($descricao);
        $valor->setIdadeInicial($idade_inicial);
        $valor->setIdadeFinal($idade_final);
        $teste = $vc->inserir($valor);
        if($teste = true) {
            echo json_encode(array('retorno' => 1));
        }
        else {
            echo json_encode(array('retorno' => 0));
        }

    }



function alterar($codigo, $descricao, $desc_valor, $idade_inicial, $idade_final){
    require_once '../controller/Valores_Controller.php';
    require_once '../beans/Valores.class.php';
    $valor = new Valores();
    $vc = new Valores_Controller();
    $valor->setValorCodigo($codigo);
    $valor->setValorValor($desc_valor);
    $valor->setDescricao($descricao);
    $valor->setIdadeInicial($idade_inicial);
    $valor->setIdadeFinal($idade_final);
        $teste = $vc->update($valor);
        if($teste = true) {
            echo json_encode(array('retorno' => 1));
        }
        else {
            echo json_encode(array('retorno' => 0));
        }

}


function excluir($codigo){
    require_once '../controller/Valores_Controller.php';
    require_once '../beans/Valores.class.php';

    $vc = new Valores_Controller();

    $teste = $vc->delete($codigo);
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