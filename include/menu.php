<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start(); ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Retiro - <span><?php echo $_SESSION['login'];?></span></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li role="presentation" class="dropdown">
                    <a href="#retiro" data-nome="retiro" class="menu-retiro">Retiro</a>
                    <ul class="dropdown-menu">
                        <li><a href="#retiro" data-nome="retiro" class="menu-retiro">Retiro</a></li>
                        <li><a href="cadretiro.php" class="novo">Novo Retiro</a></li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="#valor" data-nome="valor" class="menu-retiro">Valores</a>
                    <ul class="dropdown-menu">
                        <li><a href="valor" data-nome="valor" class="menu-retiro" >Valores</a></li>
                        <li><a href="cadvalor.php"  >Novo Cadastro</a></li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="#pessoas"  data-nome="pessoa" class="menu-retiro">Pessoas</a>
                    <ul class="dropdown-menu">
                        <li><a href="#pessoas"  data-nome="pessoa" class="menu-retiro">Pessoas</a></li>
                        <li><a href="cadpessoa.php"  >Novo Cadastro</a></li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="gasto">Gastos</a>
                    <ul class="dropdown-menu">
                        <li><a href="gasto" >Gastos</a></li>
                        <li><a href="gasto?acao=N">Novo Cadastro</a></li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="desistente">Desistente</a>
                    <ul class="dropdown-menu">
                        <li><a href="desistente" >Desistente</a></li>
                        <!-- <li><a href="curso?acao=N">Novo Cadastro</a></li>-->
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="total">Totais</a>
                    <ul class="dropdown-menu">
                        <li><a href="total" >Totais</a></li>
                        <!-- <li><a href="curso?acao=N">Novo Cadastro</a></li>-->
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="usuario">Usu&aacute;rios</a>
                    <ul class="dropdown-menu">
                        <li><a href="usuario" >Usu&aacute;rios</a></li>
                        <li><a href="usuario?acao=N">Novo Cadastro</a></li>
                    </ul>
                </li>
                <!--
                <li role="presentation" class="dropdown">
                    <a href="login.html">Login</a>
                    <ul class="dropdown-menu">
                        <li><a href="login.html" >Login</a></li>
                       <!-- <li><a href="curso?acao=N">Novo Cadastro</a></li>-->
                <!--      </ul>
                  </li>
                  -->
                <li role="presentation" class="dropdown">
                    <a href="usuario?acao=D">Sair</a>

                </li>
            </ul>
        </div>
    </div>
</nav>

