<?php
/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 25/12/2016
 * Time: 16:45
 */

$acao = "";
$descricao = "";
$data = "";
$codigo = 0;
if(isset($_POST['acao'])){
    $acao = $_POST['acao'];
}
if(isset($_POST['descricao'])){
    $descricao = $_POST['descricao'];
}

if(isset($_POST['data'])){
    $data = $_POST['data'];
}

if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
}

switch ($acao) {
    case 'I':
        cadastrar($descricao, $data);
        break;
    case 'A':
        alterar($codigo, $descricao, $data);
        break;
    case 'E':
        excluir($codigo);
        break;
}


function cadastrar($descricao, $data){
        require_once '../controller/Retiro_Controller.php';
        require_once '../beans/Retiro.class.php';
        $retiro = new Retiro();
        $rc = new Retiro_Controller();

        $retiro->setDsRetiro(strtoupper($descricao));
        $retiro->setDataRetiro($data);
        $teste = $rc->inserir($retiro);
        if($teste = true) {
            echo json_encode(array('retorno' => 1));
        }
        else {
            echo json_encode(array('retorno' => 0));
        }

    }



function alterar($codigo, $descricao, $data){
    require_once '../controller/Retiro_Controller.php';
    require_once '../beans/Retiro.class.php';
    $retiro = new Retiro();
    $rc = new Retiro_Controller();
    $retiro->setCdRetiro($codigo);
    $retiro->setDsRetiro(strtoupper($descricao));
    $retiro->setDataRetiro($data);
    $teste = $rc->update($retiro);
    if($teste = true) {
        echo json_encode(array('retorno' => 1));
    }
    else {
        echo json_encode(array('retorno' => 0));
    }

}


function excluir($codigo){
    require_once '../controller/Retiro_Controller.php';
    require_once '../beans/Retiro.class.php';
    $retiro = new Retiro();
    $rc = new Retiro_Controller();

    $teste = $rc->delete($codigo);
    if($teste = true) {
        echo json_encode(array('retorno' => 1));
    }
    else {
        echo json_encode(array('retorno' => 0));
    }

}