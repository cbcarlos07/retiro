<?php
/**
 * Created by PhpStorm.
 * User: Gysa
 * Date: 25/12/2016
 * Time: 00:23
 */
error_reporting(E_ALL & ~ E_NOTICE);// para nao mostrar undefined variable
header('Access-Control-Allow-Origin: *');
include ('../controller/Usuario_Controller.php');
include ('../beans/Usuario.class.php');
$uc = new Usuario_Controller();
$usuario = new Usuario();
$acao = $_POST['acao'];

$login = $_POST['usuario'];
$senha = $_POST['senha'];
$codigo = 0;
$nome = "";
//echo "Usuario";
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}
if(isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
}

    switch ($acao){
        case 'L': //login
                login($login, $senha);
            break;
        case 'C': //senha
                cadastrar($nome, $login,$senha);
            break;
        case 'E':
            excluir($codigo);
            break;

        }


function login($login, $senha){

    $uc = new Usuario_Controller();
    $login = $_POST["usuario"];
    $senha = $_POST["senha"];
    $lembrar = $_POST["lembrar"];

    $usuario = $uc->getUser($login, $senha);

    if(searchUser($login, $senha)){
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
            session_start();
            $_SESSION['login'] = $login;
            echo json_encode(array('retorno' => 1,'codigo' => $usuario->getCd_usuario()));
            // echo 1;
        }else{
            session_start();
            $_SESSION['login'] = $login;
            echo json_encode(array('retorno' => 0,'codigo' => $usuario->getCd_usuario()));
            //echo 0;
        }
    }else{
        echo json_encode(array('retorno' => -1));
        //echo -1;

    }
}

function cadastrar($nome, $login, $senha){
    $usuario = new Usuario();
    $uc = new Usuario_Controller();
    $usuario->setNm_usuario($nome);
    $usuario->setDs_login($login);
    $usuario->setDs_senha($senha);

    $teste = $uc->inserir($usuario);
    if($teste){
        echo json_encode(array('retorno' => 1));

    }else{
        echo json_encode(array('retorno' => 0));
    }
}

function excluir($codigo){
    $uc = new Usuario_Controller();
    $teste = $uc->delete($codigo);
    if($teste){
        echo "1";
     }else {
        echo "0";
    }                       
}

/**
 * @param $login
 * @param $senha
 */
function searchUser($login, $senha){
   
    $uc = new Usuario_Controller();
    $user = $uc->getUser($login, $senha);

    try{
        $user = $uc->getUser($login, $senha);
        $user->getSn_atual();
        return true;
    }catch (Exception $e){return false;}
}

 function sn_atual($login, $senha){
        $usuario = new Usuario();
        $uc = new Usuario_Controller();
        $usuario = $uc->getUser($login, $senha);
        $current = "";
        try{
            $current = $usuario->getSn_atual();
        }catch(Exception $e){

    }
        return $current;
    }