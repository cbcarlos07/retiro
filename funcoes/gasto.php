<?php
/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 25/12/2016
 * Time: 16:45
 */

$acao = "";
$codigo = 0;
$descricao = "";
$observacao = "";
$valor = "";
$data = "";
if(isset($_POST['acao'])){
    $acao = $_POST['acao'];
}
if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
}

if(isset($_POST['descricao'])){
    $descricao = $_POST['descricao'];
}

if(isset($_POST['observacao'])){
    $observacao = $_POST['observacao'];
}

if(isset($_POST['valor'])){
    $valor = $_POST['valor'];
}

if(isset($_POST['data'])){
    $data = $_POST['data'];
}



switch ($acao) {
    case 'C':
        cadastrar($descricao, $observacao, $valor, $data);
        break;
    case 'A':
        alterar($codigo, $descricao, $observacao, $valor, $data);
        break;
    case 'E':
        excluir($codigo);
        break;


}


function cadastrar($descricao, $observacao, $valor, $data){
        require_once '../controller/Gasto_Controller.php';
        require_once '../beans/Gasto.class.php';
        $gasto =  new Gasto();
        $gc = new Gasto_Controller();

        $gasto->setDsGasto(strtoupper($descricao));
        $gasto->setObsGasto($observacao);
        $gasto->setValorGasto($valor);
        $gasto->setDtGasto($data);
        $teste = $gc->inserir($gasto);
        if($teste = true) {
            echo json_encode(array('retorno' => 1));
        }
        else {
            echo json_encode(array('retorno' => 0));
        }

    }



function alterar($codigo, $descricao, $observacao, $valor, $data){
    require_once '../controller/Gasto_Controller.php';
    require_once '../beans/Gasto.class.php';
    $gasto =  new Gasto();
    $gc = new Gasto_Controller();
    $gasto->setCdGasto($codigo);
    $gasto->setDsGasto(strtoupper($descricao));
    $gasto->setObsGasto($observacao);
    $gasto->setValorGasto($valor);
    $gasto->setDtGasto($data);
    $teste = $gc->update($gasto);
    if($teste = true) {
        echo json_encode(array('retorno' => 1));
    }
    else {
        echo json_encode(array('retorno' => 0));
    }

}


function excluir($codigo){
    require_once '../controller/Gasto_Controller.php';

    $gc = new Gasto_Controller();

    $teste = $gc->delete($codigo);
    if($teste = true) {
        echo json_encode(array('retorno' => 1));
    }
    else {
        echo json_encode(array('retorno' => 0));
    }

}

