<?php
session_start();

if($_SESSION['login'] == ""){
   echo "<script>location.href='./';</script>";
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Retiro da Igreja</title>
    <link rel="short icon"  href="img/iasd.png"/>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>
<?php include 'include/menu.php' ?>
<div class="container">
    <div class="col-xs-12 col-md-12 col-lg-12">

    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/menu-acao.js"></script>
</body>
</html>