<?php
include 'include/sessao.php';
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cadastro de Retiro</title>
    <?php include 'include/head.html' ?>
    <script src="js/acaoretiro.js"></script>
</head>
<body>
<?php include 'include/menu.php' ?>
<div class="container main" style="margin-top: 120px;">
    <div class=" col-lg-12">
        <form action="#" id="cad-retiro" method="post">
            <input type="hidden" id="acao" name="acao" value="I"/>
            <input type="hidden" id="codigo"  value="0"/>
            <div class="form-group col-xs-12 col-sm-6 col-md-7 col-lg-6">
                <label for="descricao">Descri&ccedil;&atilde;o</label>
                <input type="text" id="descricao" name="descricao" class="form-control" required=""/>
            </div>
            <div class  ="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <label for="data">Data</label>
                <input id="data" name="data"  type="text" class="form-control" required="">
            </div>
            <br>
            <br>
            <br>
            <br>
            <p class="mensagem"></p>
            <br>
            <hr />
            <button type="submit" class="btn btn-success " onclick="save()">Salvar</button>
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
