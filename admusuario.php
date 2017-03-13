<?php
session_start();

if($_SESSION['login'] == ""){
   echo "<script>location.href='./';</script>";
}
include 'controller/Usuario_Controller.php';
include 'services/UsuarioListIterator.class.php';
include 'beans/Usuario.class.php';

$nome = "";
if(isset($_POST['search'])){
    $nome = $_POST['search'];
}

$uc = new Usuario_Controller();
$lsita = $uc->getListaUsuario($nome);
$usuarioList = new UsuarioListIterator($lsita);

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cadastro de Retiro</title>
    <link rel="short icon"  href="img/iasd.png"/>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/acaousuario.js"></script>
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

<?php include 'include/menu.php'; ?>
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
        <a href="cadusuario.php" style="margin-top: 20px; float: right;" class="btn btn-primary novo" >Novo</a>
    </div>
    <div class="table table-hover table-responsive">
        <table class="table table-striped" cellspacing="0" cellpadding="0">
            <thead>
            <th>C&oacute;digo</th>
            <th>Nome</th>
            <th>Login</th>

            </thead>
            <tbody>
            <?php
              while($usuarioList->hasNextUsuario()){
                  $usuario = $usuarioList->getNextUsuario();
             ?>
                  <tr>
                      <td><?php echo $usuario->getCd_usuario(); ?></td>
                      <td><?php echo $usuario->getNm_usuario(); ?></td>
                      <td><?php echo $usuario->getDs_login(); ?></td>

                      <td class="actions">

                          <a class="btn btn-warning btn-xs action-button" href="#" data-nome="B" data-url="altusuario.php"  data-id="<?php echo $usuario->getCd_usuario(); ?>">Editar</a>
                          <a class="delete btn btn-danger btn-xs" href="#" data-toggle="modal" data-target="#delete-modal" data-nome="<?php echo $usuario->getNm_usuario(); ?>" data-id="<?php echo $usuario->getCd_usuario(); ?>">Excluir</a>
                          <a class="action-button btn btn-success btn-xs" href="#"  data-nome="R" data-id="<?php echo $usuario->getCd_usuario(); ?>" title="Senha será resetada para 123456">Resetar senha</a>
                      </td>
                  </tr>
            <?php
              }
            ?>

            </tbody>
        </table>
    </div>
</div>



<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    $('.delete').on('click', function(){
        var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
        //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
        //console.log("Nome para deletar: "+nome);
        $('span.nome').text(nome);
        $('.delete-yes').on('click', function(){
            excluir_user(id);
        });
        //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

        //$('#myModal').modal('show'); // modal aparece
    });
</script>
<script>
    $('.action-button').on('click', function(){
        var acao = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var codigo = $(this).data('id');
       // buscar(codigo);
        var url = $(this).data('url');
        var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="codigo" value="' + codigo + '" />' +
            '<input type="text" name="acao" value="' + acao + '" />' +
            '</form>');
        var div = $('<div style="display: none;" >'+form+'</div>');
        $('body').append(div);
        // $('body').append(form);
        form.submit();

    });
</script>

<script src="js/menu-acao.js"></script>
</body>
</html>
