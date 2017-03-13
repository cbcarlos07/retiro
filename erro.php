<?php
session_start();

if($_SESSION['login'] == ""){
   echo "<script>location.href='./';</script>";
}
include 'controller/Totais_Controller.class.php';
include 'beans/Totais.class.php';

$tc = new Totais_Controller();
$totais = $tc->getTotais();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Retiro - Total</title>
    <link rel="short icon"  href="img/iasd.png"/>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />

</head>
<body>


<?php include 'include/menu.php'?>
<div class="container" style="margin-top: 100px;">

   <p class="alert alert-danger"><strong>Opa!</strong>A P&aacute;gina que voc&ecirc; procura n&atilde;o foi encontrada</p>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/menu-acao.js"></script>
</body>
</html>
