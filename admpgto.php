<?php
include 'include/sessao.php';
require_once 'controller/Pagamentos_Controller.class.php';
require_once 'beans/Pagamentos.class.php';
require_once 'services/PagamentosListIterator.class.php';

$codigo = $_POST['codigo'];
$name = $_POST['acao'];
$nome = '';
if(isset($_POST['search'])){
    $nome = $_POST['search'];
}
$pc = new Pagamentos_Controller();
$lista = $pc->getListaPagamentos($nome, $codigo);
$pgtoList = new PagamentosListIterator($lista);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cadastro de Retiro</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/acaopgto.js"></script>
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

<?php include 'include/menu.php' ?>
<div class="container main">
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <form action="<?echo $_SERVER['PHP_SELF']; ?>" method="post" id="form-pesquisa">
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
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        <a href="#" data-url="cadpgto.php" data-id="<?php echo $codigo; ?>" data-nome="<?php echo $name; ?>" style="margin-top: 20px; " class="btn btn-primary action-button" >Novo</a>
    </div>
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        <a href="admpessoas.php" style="margin-top: 20px;" class="btn btn-default" >Voltar</a>
    </div>

    <div class="row"></div>
    <h3 style="text-align: center; font-weight: bold;"><?php echo $name; ?></h3>
    <div class="table table-hover table-responsive">
        <table class="table table-striped" cellspacing="0" cellpadding="0">
            <thead>
            <th>C&oacute;digo</th>
            <th>Valor</th>
            <th>Data</th>
            </thead>
            <tbody>
            <?php
                    $total = 0;
                    $registro = 0;
                    $pagamento = new Pagamentos();
                    while($pgtoList->hasNextPagamentos()){
                        $registro++;
                        $pagamento = $pgtoList->getNextPagamentos();
                        $total += $pagamento->getValorPgto();
             ?>
                        <tr>

                            <td><?php echo $pagamento->getCdPgto(); ?></td>
                            <td><?php echo 'R$ '.number_format($pagamento->getValorPgto(),2,',','.'); ?> </td>
                            <?php
                            $dataMySQL = explode('-',$pagamento->getValorData());
                            $dia = $dataMySQL[2];
                            $mes = $dataMySQL[1];
                            $ano = $dataMySQL[0];
                            ?>
                            <td><?php echo $dia.'/'.$mes.'/'.$ano; ?></td>
                            <td class="actions">

                                <a class="btn btn-warning btn-xs action-button" href="#" data-pessoa="<?php echo $codigo; ?>" data-nome="<?php echo $name; ?>" data-url="altpgto.php" data-id="<?php echo $pagamento->getCdPgto(); ?>">Editar</a>
                                <a class="delete btn btn-danger btn-xs" href="#" data-toggle="modal" data-target="#delete-modal" data-nome="<?php echo 'R$ '.number_format($pagamento->getValorPgto(),2,',','.'); ?>" data-id="$<?php echo $pagamento->getCdPgto(); ?>">Excluir</a>
                                <!--  <a class="btn btn-success btn-xs" href="imprimir?acao=F&codigo=${pessoa.codigo_pessoa}">Imprimir</a>
                                  <a class="btn btn-primary btn-xs" href="pagamentos?acao=F&codigo=${pessoa.codigo_pessoa}">Pagamentos</a>
                               -->
                            </td>
                        </tr>
            <?php
                    }
            ?>

            </tbody>
            <tfoot>
            <th><?php echo $registro; ?></th>
            <th><span style="color: green; "><?php echo 'R$ '.number_format($total,2,',','.'); ?> </span></th>
            <th></th>
            </tfoot>
        </table>
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
<script>
    $('.action-button').on('click', function(){
        var acao = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var codigo = $(this).data('id');
        var pessoa = $(this).data('pessoa');
        var url = $(this).data('url');
        var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="codigo" value="' + codigo + '" />' +
            '<input type="text" name="acao" value="' + acao + '" />' +
            '<input type="text" name="pessoa" value="' + pessoa + '" />' +
            '</form>');
        var div = $('<div style="display: none;>"'+form+'</div>');
        $('body').append(div);
        form.submit();
        //location.href = "pagamento?acao="+acao+"&codigo="+codigo;
        //var email = $(this).data('email');
        // $('#alvo').val(nome);
        //console.log("Arquivo para envio: "+nome)
        //$('span.email').text(email);
        //document.querySelector("[name='email']").value = email;

        //$('#myModal').modal('show'); // modal aparece
    });
</script>
<script src="js/menu-acao.js"></script>
</body>
</html>
