<?php
/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 25/12/2016
 * Time: 16:45
 */

$acao = "";
$codigo = 0;
if(isset($_POST['acao'])){
    $acao = $_POST['acao'];
}
if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
}

switch ($acao) {
    case 'R':
        reinserir($codigo);
        break;
    case 'E':
        excluir($codigo);
        break;
}


function reinserir($codigo){
        require_once '../controller/Pessoa_Controller.class.php';
        $pc = new Pessoa_Controller();
        $teste = $pc->inserirRetornarDesistente($codigo);
        if($teste = true) {
            echo json_encode(array('retorno' => 1));
        }
        else {
            echo json_encode(array('retorno' => 0));
        }
    }

function excluir($codigo){
    require_once '../controller/Pessoa_Controller.class.php';
    $pc = new Pessoa_Controller();
    $teste = $pc->deleteDesistente($codigo);
    if($teste = true) {
        echo json_encode(array('retorno' => 1));
    }
    else {
        echo json_encode(array('retorno' => 0));
    }


}
