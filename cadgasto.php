<?php
include 'include/sessao.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cadastro de Gastos </title>
    <link rel="short icon"  href="img/iasd.png"/>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery.datetimepicker.min.css" type="text/css" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/acaogasto.js"></script>
</head>
<body>
<?php include 'include/menu.php' ?>
<div class="container main" style="margin-top: 120px;">

    <div class="col-lg-offset-1 col-lg-12">
        <form action="#" id="cad-gasto" method="post">
            <input type="hidden" id="acao" name="acao" value="C"/>
            <input type="hidden" id="codigo"  value="0"/>
            <div class="form-group col-xs-12 col-sm-6 col-md-7 col-lg-6">
                <label for="descricao">Descri&ccedil;&atilde;o</label>
                <input type="text" id="descricao" name="descricao" class="form-control" required=""/>
            </div>
            <div class="row"></div>
            <div class="form-group col-xs-12 col-sm-6 col-md-7 col-lg-6">
                <label for="obs">Observa&ccedil;&atilde;o</label>
                <textarea id="obs" name="obs" class="form-control" required="" rows="5"></textarea>
            </div>
            <div class="row"></div>
            <div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <label for="valor">Valor</label>
                <input type="text" id="valor" name="valor" class="form-control" required=""/>
            </div>
            <div class="row"></div>

            <div class="form-group col-xs-12 col-sm-6 col-md-7 col-lg-3">
                <label for="Data">Data</label>
                <input type="text" name="data" id="data" class="form-control data-nasc" />

            </div>


            <br>
            <br>
            <br>
            <br>
            <p class="mensagem"></p>
            <br>
            <hr />
            <button type="submit" class="btn btn-success " onclick="novo()">Salvar</button>
            <button type="reset" class="btn btn-primary">Limpar</button>
            <a href="javascript:history.back();self.location.reload();" class="btn btn-warning" onclick="return verifica('Tem certeza de que deseja cancelar a opera&ccedil;&atilde;o?');"s>Cancelar</a>
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

<script src="js/jquery.min.js"></script>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
    $("#data").datetimepicker({
        timepicker: false,
        format: 'd/m/Y',
        mask: true
    });
    $.datetimepicker.setLocale('pt-BR');
</script>
<script src="js/menu-acao.js"></script>
</body>
</html>
