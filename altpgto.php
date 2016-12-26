<?php
$nome = $_POST['acao'];
$pessoa = $_POST['pessoa'];
$codigo = $_POST['codigo'];
include 'controller/Pagamentos_Controller.class.php';
include "beans/Pagamentos.class.php";

$pc = new Pagamentos_Controller();
$pagamento = $pc->getPagamentos($codigo);

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Retiro - Cadastro de Pagamento </title>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery.datetimepicker.min.css" type="text/css" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/acaopgto.js"></script>
    <script>
        function dataNow(){
            var dataAtual = new Date();
            var campodata = document.getElementById("data");
            var month = dataAtual.getMonth() + 1;
            campodata.value = dataAtual.getDate()+"/"+month+"/"+dataAtual.getFullYear();
        }
    </script>
</head>
<body onload="dataNow()">
<?php include 'include/menu.php' ?>
<div class="container main" style="margin-top: 120px;">

    <div class="col-lg-offset-1 col-lg-12">
        <h3 ><?php echo $nome; ?></h3>
        <form action="#" id="cad-pgto" method="post">
            <input type="hidden" id="acao" name="acao" value="A"/>
            <input type="hidden" id="codigo"  value="<?php echo $pagamento->getCdPgto(); ?>"/>
            <input type="hidden" id="pessoa"  value="<?php echo $pagamento->getPessoa()->getCodigoPessoa(); ?>"/>
            <input type="hidden" id="nome"  value="<?php echo $nome; ?>"/>
            <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <label for="valor">Valor</label>
                <input type="text" id="valor" name="valor" class="form-control" required="" placeholder="Ex.: 2,50 =  2.50"
                 value="<?php echo $pagamento->getValorPgto(); ?>"/>
            </div>
            <div class="row"></div>
            <div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
                <label for="descricao">Data</label>
                <?php
                $dataMySQL = explode('-',$pagamento->getValorData());
                $dia = $dataMySQL[2];
                $mes = $dataMySQL[1];
                $ano = $dataMySQL[0];
                ?>
                <input type="text" id="data" name="data" class="form-control" value="<?php echo $dia.'/'.$mes.'/'.$ano; ?>"/>
            </div>


            <br>
            <br>
            <br>
            <br>
            <p class="mensagem"></p>
            <br>
            <hr />
            <button type="submit" class="btn btn-success " onclick="salvar()">Salvar</button>
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
