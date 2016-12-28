<?php
include 'include/sessao.php';
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

    <div class="col-xs-12 col-sm-6  col-md-6 col-lg-3">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h2 class="panel-title">A Receber</h2>
            </div>
            <div class="panel-body">

                <div style="text-align: center;"><h1 style="font-size: 40px; color: green"><?php echo 'R$ '.number_format($totais->getReceber(),2,',','.'); ?></h1></div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h2 class="panel-title">Recebidos</h2>
            </div>
            <div class="panel-body">
                <div style="text-align: center;"><h1 style="font-size: 40px; color: blue"><?php echo 'R$ '.number_format($totais->getRecebido(),2,',','.'); ?></h1></div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h2 class="panel-title">Gastos</h2>
            </div>
            <div class="panel-body">
                <div style="text-align: center;"><h1 style="font-size: 40px; color: green"><?php echo 'R$ '.number_format($totais->getGasto(),2,',','.'); ?></h1></div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h2 class="panel-title">Atual</h2>
            </div>
            <div class="panel-body">
                <?php
                 $cor = "";
                 if($totais->getAtual() >= 0){
                     $cor = "green";
                 }else{
                     $cor = "red";
                 }
                ?>

                <div style="text-align: center;"><h1 style="font-size: 37px; color: <?php echo $cor; ?>"><?php echo 'R$ '.number_format($totais->getAtual(),2,',','.'); ?></h1></div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/menu-acao.js"></script>
</body>
</html>
