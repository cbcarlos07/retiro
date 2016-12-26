
<?php
$nome = "";
if(isset($_POST['search'])){
    $nome = $_POST['search'];
}

include_once 'controller/Pessoa_Controller.class.php';
include_once 'services/PessoaListIterator.class.php';
include_once 'beans/Pessoa.class.php';
$pc = new Pessoa_Controller();
$lista = $pc->getListaPessoa($nome);
$pessoaList = new PessoaListIterator($lista);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cadastro de Retiro</title>
    <link rel="short icon"  href="img/iasd.png"/>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />

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
            <div class="modal-body">Deseja realmente excluir o item <b><span class="nome"></span></b> e todos dados de pagamento? </div>
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
        <form action="pessoa" method="post" id="form-pesquisa">
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
        <a href="cadpessoa.php" style="margin-top: 20px;" class="btn btn-primary novo" >Novo</a>
    </div>
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        <a href="imprimir?acao=T&codigo='%'" style="margin-top: 20px; " class="btn btn-success" >Imprimir <img src="img/printer.png" width="20"></a>
    </div>


    <div class="table table-hover table-responsive">
        <table class="table table-striped" cellspacing="0" cellpadding="0">
            <thead>
            <th>C&oacute;digo</th>
            <th>Pessoa</th>
            <th>CPF</th>
            <th>Total</th>
            <th>Falta</th>
            <th>Pago</th>
            <th>Chal&eacute;</th>
            </thead>
            <tbody>
            <?php
              $pagar = 0;
              $falta = 0;
              $pago = 0;
              $chale = 0;
              $registro = 0;
              while($pessoaList->hasNextPessoa()){
                  $registro++;
                  $pessoa = $pessoaList->getNextPessoa();
                  $pagar += $pessoa->getValorPagar();
                  $falta += $pessoa->getValorFalta();
                  $pago += $pessoa->getValorPago();
                  if($pessoa->getSnChale() == "S"){
                      $chale = $chale + 200;
                  }
             ?>
                  <tr>
                      <td><?php $pessoa->getCodigoPessoa(); ?></td>
                      <td><?php $pessoa->getNmPessoa(); ?></td>
                      <td><?php $pessoa->getNrCpf(); ?></td>
                      <td><?php echo 'R$ '.number_format($pessoa->getValorPagar(),2,',','.'); ?></td>
                      <td><?php echo 'R$ '.number_format($pessoa->getValorFalta(),2,',','.'); ?></td>
                      <td><?php echo 'R$ '.number_format($pessoa->getValorPago(),2,',','.'); ?></td>
                      <td>${pessoa.sn_chale}</td>
                      <td class="actions">

                          <a class="btn btn-warning btn-xs action-button" href="#" data-nome="B" data-id="<?php $pessoa->getCodigoPessoa(); ?>">Editar</a>
                          <a class="delete btn btn-danger btn-xs" href="#" data-toggle="modal" data-target="#delete-modal" data-nome="<?php $pessoa->getNmPessoa(); ?>" data-id="<?php $pessoa->getCodigoPessoa(); ?>" data-action="E">Excluir</a>
                          <a class="delete btn btn-default btn-xs" href="#" data-toggle="modal" data-target="#delete-modal" data-nome="<?php $pessoa->getNmPessoa(); ?>" data-id="<?php $pessoa->getCodigoPessoa(); ?>" data-action="D">Desistente</a>
                          <a class="btn btn-success btn-xs" href="imprimir?acao=F&codigo=<?php $pessoa->getCodigoPessoa(); ?>">Imprimir</a>
                          <a class="btn btn-primary btn-xs" href="pagamento?codigo=<?php $pessoa->getCodigoPessoa(); ?>">Pagamentos</a>
                      </td>
                  </tr>
            <?php
              }
            ?>


            </c:forEach>
            </tbody>
            <tfoot>
            <th><?php echo $registro; ?></th>
            <th></th>
            <th></th>
            <th><span style="color: green; "><?php echo 'R$ '.number_format($pagar,2,',','.'); ?></span></th>
            <th><span style="color: red; "><?php echo 'R$ '.number_format($falta,2,',','.'); ?></span></th>
            <th><span style="color: blue; "><?php echo 'R$ '.number_format($pago,2,',','.'); ?></span></th>
            <th><?php echo 'R$ '.number_format($chale,2,',','.'); ?></th>
            </tfoot>
        </table>
    </div>
</div>



<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/acaopessoa.js"></script>
<script>
    $('.delete').on('click', function(){
        var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
        var acao = $(this).data('action');
        //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
        //console.log("Nome para deletar: "+nome);
        $('span.nome').text(nome);
        $('.delete-yes').on('click', function(){
            deletar(id,acao);
        });
        //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

        //$('#myModal').modal('show'); // modal aparece
    });
</script>
<script>
    $('.action-button').on('click', function(){
        var acao = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var codigo = $(this).data('id');
        location.href = "pessoa?acao="+acao+"&codigo="+codigo;
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
