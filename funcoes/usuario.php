<?php
/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 25/12/2016
 * Time: 00:23
 */

$acao = $_POST['acao'];
$nome = "";
$codigo = 0;
$login = "";
$senha = "";
$atual = 0;
$nome = "";
$lembrar = "";
//echo "Usuario";

if(isset($_POST['login'])){
    $login = $_POST['login'];
}
if(isset($_POST['senha'])){
    $senha = $_POST['senha'];
}

if(isset($_POST['atual'])){
    $atual = $_POST['atual'];
}

if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
}


if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}
if(isset($_POST['lembrar'])){
    $lembrar = $_POST['lembrar'];
}
if(isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
}

    switch ($acao){
        case 'L': //login
                login($login, $senha, $lembrar);
            break;
        case 'C': //senha
                cadastrar($nome, $login,$senha);
            break;
        case 'E':
            excluir($codigo);
            break;
        case 'A':
            alterar($codigo, $nome, $login,$senha, $atual);
            break;

        }


function login($login, $senha, $lembrar){
    require_once '../beans/Usuario.class.php';
    require_once '../controller/Usuario_Controller.php';
    $uc = new Usuario_Controller();

    
   
    $teste = searchUser($login, $senha);
     $usuario = $uc->getUser($login, $senha);
    if($teste){
     session_start();
        if(sn_atual($login,$senha) == 'S'){
            if($lembrar == 'S'){
                $ck_login = "login";
                $ck_vlogin = $login;
                setcookie($ck_login, $ck_vlogin, time() + (86400 * 30), "/"); // 86400 = 1 day

                $ck_pwd = "senha";
                $ck_vpwd = $senha;
                setcookie($ck_pwd, $ck_vpwd, time() + (86400 * 30), "/"); // 86400 = 1 day

                $ck_check = "checked";
                $ck_vcheck = 'S';
                setcookie($ck_check, $ck_vcheck, time() + (86400 * 30), "/"); // 86400 = 1 day


            }
           
            $_SESSION['login'] = $login;
            $codigo = $uc->getRecCodigo($login,$senha);
            echo json_encode(array('retorno' => 1,'codigo' => $codigo ));
          
        }else{
           
            $codigo = $uc->getRecCodigo($login,$senha);
            $_SESSION['login'] = $login;
            echo json_encode(array('retorno' => 0,'codigo' => $codigo ));
        
        }
    }else{
        echo json_encode(array('retorno' => -1));
   

    }
}

function cadastrar($nome, $login, $senha){
    require_once '../beans/Usuario.class.php';
    require_once '../controller/Usuario_Controller.php';
    //echo "Cadastrar";
    $usuario = new Usuario();
    $uc = new Usuario_Controller();
    $usuario->setNm_usuario(strtoupper($nome));
    $usuario->setDs_login($login);
    $usuario->setDs_senha($senha);

    $teste = $uc->inserir($usuario);
    if($teste){
        echo json_encode(array('retorno' => 1));

    }else{
        echo json_encode(array('retorno' => 0));
    }
}

function alterar($codigo, $nome, $login, $senha, $atual){
   // echo "Alterar<br>";
    require_once '../beans/Usuario.class.php';
    require_once '../controller/Usuario_Controller.php';
    $usuario = new Usuario();
    $uc = new Usuario_Controller();
    $usuario->setCd_usuario($codigo);
    $usuario->setNm_usuario(strtoupper($nome));
    $usuario->setDs_login($login);
    $usuario->setDs_senha($senha);
    $usuario->setSn_atual($atual);

    $teste = $uc->update($usuario);
    if($teste){
        echo json_encode(array('retorno' => 1));

    }else{
        echo json_encode(array('retorno' => 0));
    }
}

function excluir($codigo){
    require_once '../controller/Usuario_Controller.php';
    $uc = new Usuario_Controller();
    $teste = $uc->delete($codigo);
    if($teste){
        echo json_encode(array('retorno' => 1));
     }else {
        echo json_encode(array('retorno' => 0));
    }                       
}

/**
 * @param $login
 * @param $senha
 */
function searchUser($login, $senha){

    require_once '../controller/Usuario_Controller.php';
    $uc = new Usuario_Controller();

    $teste = $uc->snLogar($login, $senha);
  
    return $teste;
   // echo "Login: ".$user->getSn_atual();
}

 function sn_atual($login, $senha){
     require_once '../beans/Usuario.class.php';
     require_once '../controller/Usuario_Controller.php';
        $usuario = new Usuario();
        $uc = new Usuario_Controller();
        $current = $uc->recSnAtual($login, $senha);

        //print_r('Atual: '.$current);
        return $current;
    }