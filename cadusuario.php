<?php
session_start();

if($_SESSION['login'] == ""){
   echo "<script>location.href='./';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cadastro de Retiro</title>
    <link rel="short icon"  href="img/iasd.png"/>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery.datetimepicker.min.css" type="text/css" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/acaousuario.js"></script>
</head>
<body>
<?php include 'include/menu.php' ?>
<div class="container main" style="margin-top: 120px;">

    <div class="col-lg-offset-1 col-lg-12">
        <form action="#" id="cad-usuario" method="post" data-toggle="validator">
            <input type="hidden" id="acao" name="acao" value="C"/>
            <input type="hidden" id="codigo"  value="0"/>
            <input type="hidden" id="atual"  value="N"/>
            <div class="form-group col-xs-12 col-sm-6 col-md-7 col-lg-6">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" required="" placeholder="digite o nome"/>
                <div class="help-block with-errors"></div>
            </div>
            <div class="row"></div>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="login">Login</label>
                <input  id="login" name="login" class="form-control" required="" placeholder="digite o login"/>
                <div class="help-block with-errors"></div>

            </div>
            <div class="row"></div>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" class="form-control" data-minlength="6" required="" placeholder="digite a senha"/>
                <span class="help-block">Mínimo de seis (6) digitos</span>
            </div>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="senha">Repita a Senha</label>
                <input type="password" id="senha" name="senha" class="form-control" data-minlength="6" required=""
                       data-match="#senha" data-match-error="Atenção! As senhas não estão iguais." placeholder="repita a senha"/>
                <div class="help-block with-errors"></div>
            </div>
            <div class="row"></div>




            <p class="mensagem"></p>
            <br>
            <hr />
            <button type="submit" class="btn btn-success " onclick="novo()">Salvar</button>
            <button type="reset" class="btn btn-primary">Limpar</button>
            <a href="#" class="btn btn-warning voltar" data-url="admusuario.php" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');"s>Cancelar</a>
        </form>
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
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/menu-acao.js"></script>
<script>
    $('.voltar').on('click', function(){
        var url = $(this).data('url'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado

        var form = $('<form action="' + url + '" method="post">' +

            '</form>');
        $('body').append(form);
        form.submit();
    });
</script>
</body>
</html>
