<?php
session_start();

if($_SESSION['login'] == ""){
   echo "<script>location.href='./';</script>";
}
  $codigo = $_POST['codigo'];

  include('controller/Usuario_Controller.php');
  include ('beans/Usuario.class.php');
  $uc = new Usuario_Controller();
  $usuario = $uc->getUsuario($codigo);
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cadastro de Retiro</title>
    <link rel="short icon"  href="img/iasd.png"/>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/acaousuario.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">

            <a class="navbar-brand" href="#">Retiro da Igreja</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">



        </div>
    </div>
</nav>
<div class="container" style="margin-top: 120px;">
    <div class="col-lg-5" style="margin-left: 30%;">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <h2 class="panel-title">Alterar Senha</h2>
            </div>
            <div class="panel-body">
                <div style="margin-left: 50px;">
                    <form action="#" id="cad-usuario" method="post" data-toggle="validator">
                        <input type="hidden" id="acao" name="acao" value="A"/>
                        <input type="hidden" id="codigo"  value="<?php echo $usuario->getCd_usuario(); ?>"/>
                        <input type="hidden" id="atual"  value="S"/>

                        <!--  <label for="nome">Nome</label>-->
                        <input type="hidden" id="nome" name="nome" class="form-control" required="" value="<?php echo $usuario->getNm_usuario(); ?>"
                               placeholder="digite o nome"/>
                        <div class="col-lg-10">
                            <label for="login">Login</label>
                            <input  id="login" name="login" class="form-control" required="" value="<?php echo $usuario->getDs_login(); ?>"
                                    placeholder="Digite o login" disabled=""/>
                        </div>
                        <div class="row"></div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-10 col-lg-10">
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control" data-minlength="6" required=""
                                   placeholder="Digite a senha" />
                            <span class="help-block">Mínimo de seis (6) digitos</span>
                        </div>
                        <div class="row"></div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-10 col-lg-10">
                            <label for="senha">Repita a Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control" data-minlength="6" required=""
                                   data-match="#senha" data-match-error="Atenção! As senhas não estão iguais."
                                   placeholder="Repita a senha" />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="row"></div>
                        <p class="mensagem"></p>

                        <hr />
                        <button type="submit" class="btn btn-success " onclick="novo()">Salvar</button>
                        <button type="reset" class="btn btn-primary">Limpar</button>
                        <a href="javascript:history.back();self.location.reload();" class="btn btn-warning" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');"s>Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    $('.delete').on('click', function(){
        var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
        //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
        //console.log("Nome para deletar: "+nome);
        $('span.nome').text(nome);
        $('.delete-yes').on('click', function(){
            excluir(id);
        });
        //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

        //$('#myModal').modal('show'); // modal aparece
    });
</script>
<script language=javascript>
    function verifica(Msg)
    {
        return confirm(Msg) ;
    }
</script>
<script src="js/validator.min.js"></script>
</body>
</html>
