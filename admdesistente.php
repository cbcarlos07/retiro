<?php
session_start();

if($_SESSION['login'] == ""){
   echo "<script>location.href='./';</script>";
}


include 'controller/Pessoa_Controller.class.php';
include 'beans/Pessoa.class.php';
include 'services/PessoaListIterator.class.php';

$nome = "";
if(isset($_POST['search'])){
    $nome = $_POST['search'];
}

$pc = new Pessoa_Controller();
$lista = $pc->getListaPessoaDesistente($nome);
$pessoaList = new PessoaListIterator($lista);

?>


<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <title>Cadastro de Retiro</title>
    <link rel="short icon"  href="img/iasd.png"/>
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
            <div class="modal-body">Deseja excluir permanentemente o item <b><span class="nome"></span></b> </div>
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
       <!-- <a href="pessoa?acao=N" style="margin-top: 20px;" class="btn btn-primary novo" >Novo</a>-->
    </div>
    <!--
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        <a href="imprimir?acao=T&codigo='%'" style="margin-top: 20px; " class="btn btn-success" >Imprimir <img src="img/printer.png" width="20"></a>
    </div>
    -->

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
                 $pago  += $pessoa->getValorPago();
                  if($pessoa->getSnChale() == 'S'){
                      $chale += 200;
                  }
            ?>
                  <tr>
                      <td><?php echo $pessoa->getCodigoPessoa(); ?></td>
                      <td><?php echo $pessoa->getNmPessoa(); ?></td>
                      <td><?php echo $pessoa->getNrCpf(); ?></td>
                      <td><?php echo 'R$ '.number_format($pessoa->getValorPagar(),2,',','.'); ?></td>
                      <td><?php echo 'R$ '.number_format($pessoa->getValorFalta(),2,',','.'); ?></td>
                      <td><?php echo 'R$ '.number_format($pessoa->getValorPago(),2,',','.'); ?></td>
                      <td><?php echo $pessoa->getSnChale(); ?></td>
                      <td class="actions">

                          <!--<a class="btn btn-warning btn-xs action-button" href="#" data-nome="B" data-id="${pessoa.codigo_pessoa}">Editar</a> -->
                          <a class="delete btn btn-danger btn-xs" href="#" data-toggle="modal" data-target="#delete-modal" data-nome="<?php echo $pessoa->getNmPessoa(); ?>" data-id="<?php echo $pessoa->getCodigoPessoa(); ?>" data-acao="E">Excluir</a>
                          <a class="delete btn btn-success btn-xs" href="#" data-toggle="modal" data-target="#delete-modal" data-acao="R" data-id="<?php echo $pessoa->getCodigoPessoa(); ?>">Re-inserir</a>
                          <!--<a class="btn btn-primary btn-xs" href="pagamento?codigo=${pessoa.codigo_pessoa}">Pagamentos</a>-->
                      </td>
                  </tr>
            <?php

              }
            ?>


            </tbody>
            <tfoot>
            <th><?php echo $registro; ?></th>
            <th></th>
            <th></th>
            <th><span style="color: green; "><?php echo 'R$ '.number_format($pagar,2,',','.'); ?></span></th>
            <th><span style="color: red; "><?php echo 'R$ '.number_format($falta,2,',','.'); ?></span></th>
            <th><span style="color: blue; "><?php echo 'R$ '.number_format($pago,2,',','.'); ?></span></th>
            <th><?php  echo $chale; ?></th>
            </tfoot>
        </table>
    </div>
</div>



<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/acaodesistente.js"></script>
<script>
    $('.delete').on('click', function(){
        var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-id
        var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
        var acao = $(this).data('acao');
        //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
        //console.log("Nome para deletar: "+nome);
        $('span.nome').text(nome);
        $('.delete-yes').on('click', function(){
            operacao_(id, acao);
        });
        //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

        //$('#myModal').modal('show'); // modal aparece
    });
</script>
<script>
    $('.reinserir').on('click', function(){
        var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
        var acao = $(this).data('acao');

        operacao_(id, acao);


    });
</script>
<script src="js/menu-acao.js"></script>
</body>
</html>
