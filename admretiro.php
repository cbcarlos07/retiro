


<?php
include 'include/sessao.php';
$nome = "";
if(isset($_POST['search'])){
    $nome = $_POST['search'];
}

include_once 'controller/Retiro_Controller.php';
include_once 'services/RetiroListIterator.class.php';
include_once '/beans/Retiro.class.php';
$rc = new Retiro_Controller();
$lista = $rc->getListaRetiro($nome);
$retiroList = new RetiroListIterator($lista);


?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cadastro de Retiro</title>
    <?php include 'include/head.html' ?>
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
            </div>
            <div class="modal-body">Deseja realmente excluir o item <b><span class="nome"></span></b>? </div>
            <div class="modal-footer">
                <a href="#" type="button"  class="btn btn-primary delete-yes">Sim</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
            </div>
        </div>
    </div>
</div>

<?php include 'include/menu.php'
?>
<div class="container main">
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-pesquisa">
            <input type="hidden" name="acao" value="P">
            <div class="input-group h2">
                <input  name="search"  id="search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" >
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                          </span>
            </div>
        </form>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" ></div>
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <a href="cadretiro.php" style="margin-top: 20px; float: right;" class="btn btn-primary novo" >Novo</a>
    </div>
    <div class="table table-hover table-responsive">
        <table class="table table-striped" cellspacing="0" cellpadding="0">
            <thead>
            <th>C&oacute;digo</th>
            <th>Descri&ccedil;&atilde;o</th>
            <th>Data</th>
            </thead>
            <tbody>
            <?php
                while($retiroList->hasNextRetiro()){

                    $retiro = $retiroList->getNextRetiro();
             ?>
                    <tr>
                        <td><?php echo $retiro->getCdRetiro(); ?></td>
                        <td><?php echo $retiro->getDsRetiro(); ?></td>
                        <?php
                          $datas = explode('-',$retiro->getDataRetiro());
                          $dia   = $datas[2];
                          $mes   = $datas[1];
                          $ano   = $datas[0];
                        ?>
                        <td><?php echo $dia ."/".$mes."/".$ano; ?></td>
                        <td class="actions">

                            <a class="btn btn-warning btn-xs action-button" href="#" data-nome="B" data-url="altretiro.php" data-id="<?php echo $retiro->getCdRetiro(); ?>">Editar</a>
                            <a class="delete btn btn-danger btn-xs" href="#" data-toggle="modal" data-target="#delete-modal" data-nome="<?php echo $retiro->getDsRetiro(); ?>" data-id="<?php echo $retiro->getCdRetiro(); ?>">Excluir</a>
                            <!--    <a class="btn btn-success btn-xs" href="view.html">Imprimir</a>-->
                        </td>
                    </tr>
            <?php
                }
            ?>


            </c:forEach>
            </tbody>
        </table>
    </div>
</div>



<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/acaoretiro.js"></script>
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
<script>
    $('.action-button').on('click', function(){
        var acao = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var codigo = $(this).data('id');
        var url = $(this).data('url');
        var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="codigo" value="' + codigo + '" />' +
            '<input type="text" name="acao" value="' + acao + '" />' +
            '</form>');
        var div = $('<div style=" display: none;>"'+form+'</div>')
        $('body').append(div);
        form.submit();
        //location.href = "retiro?acao="+acao+"&codigo="+codigo;

    });
</script>
<script src="js/menu-acao.js"></script>
</body>
</html>
