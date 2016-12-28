<?php
include 'include/sessao.php';
require_once 'controller/Pessoa_Controller.class.php';
require_once 'beans/Pessoa.class.php';
$codigo = $_POST['codigo'];
$pessoa =  new Pessoa();
$pc = new Pessoa_Controller();
$pessoa = $pc->getPessoa($codigo);


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
    <script src="js/jquery.min.js"></script>
    <script src="js/acaopessoa.js"></script>


</head>
<body>
<?php include 'include/menu.php' ?>
<div class="container main" style="margin-top: 120px;">
    <div class=" col-lg-12">
        <form action="#" id="cad-pessoa" method="post">
            <input type="hidden" id="acao" name="acao" value="A"/>

            <input type="hidden" id="codigo"  value="<?php echo $pessoa->getCodigoPessoa(); ?>"/>
            <div class="form-group col-lg-3 col-xs-12 col-sm-12 col-md-3">
                <label for="retiro">Retiro</label>
                <select class="form-control" name="retiro" id="retiro">
                    <?php
                      require_once 'controller/Retiro_Controller.php';
                      require_once 'services/RetiroListIterator.class.php';
                      require_once 'beans/Retiro.class.php';

                      $rc = new Retiro_Controller();
                      $lista = $rc->getListaRetiro('');
                      $retiroList = new RetiroListIterator($lista);

                       while($retiroList->hasNextRetiro()){
                           $retiro = $retiroList->getNextRetiro();
                           $selected = "";
                           if($pessoa->getRetiro() == $retiro->getCdRetiro()){
                               $selected = "selected";
                           }
                    ?>
                           <option <?php echo $selected; ?> value="<?php echo $retiro->getCdRetiro(); ?>"><?php echo $retiro->getDsRetiro(); ?></option>
                    <?php
                       }
                    ?>
                </select>
            </div>
            <div class="row"></div>
            <div class="form-group col-xs-12 col-sm-6 col-md-7 col-lg-6">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" required="" value="<?php echo $pessoa->getNmPessoa(); ?>"/>
            </div>
            <div class  ="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <label for="data">Data de Nascimento</label>
                <?php
                  $datamysql =  explode('-',$pessoa->getDtNascimento());
                  $dia = $datamysql[2];
                  $mes = $datamysql[1];
                  $ano = $datamysql[0];
                ?>
                <input type="text" name="data" id="data" class="form-control data-nasc" value="<?php echo $dia."/".$mes."/".$ano; ?>"/>
            </div>
            <div class  ="form-group col-xs-12 col-sm-3 col-md-1 col-lg-1">
                <label for="idade">Idade</label>
                <input name="idade" id="idade" class="form-control" disabled=""/>
            </div>
            <!--
            <div class  ="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
                <a href="#div" class="btn btn-primary calc-idade" style="margin-top: 25px;" >Calcular Idade</a>
            </div>
            -->
            <div class="row"></div>
            <div class  ="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <label for="cpf">CPF</label>
                <input name="cpf" id="cpf"   class="form-control" onblur="javascript: validarCPF(this.value);"
                       pattern="\d{3}\.\d{3}.\d{3}-\d{2}"  value="<?php echo $pessoa->getNrCpf(); ?>" />
            </div>
            <div class  ="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <label for="telefone">Telefone</label>
                <input name="telefone" id="telefone"  class="form-control" value="<?php echo $pessoa->getNrTelefone(); ?>"/>
                <label class="checkbox-inline"><input type="radio" checked="" value="" name="tipo" class="celular ">Celular</label>
                <label class="checkbox-inline"><input type="radio" value="" name="tipo" class="fixo ">Fixo</label>
            </div>
            <div class  ="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <label for="email">E-mail</label>
                <input name="email" id="email" type="email" class="form-control" value="<?php echo $pessoa->getDsEmail(); ?>"/>
            </div>
            <div class="row"></div>
            <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <label for="valor">Valor</label>
                <select class="form-control" id="valor" name="valor">
                    <option value="0">Selecione</option>
                    <?php
                        include_once 'controller/Valores_Controller.php';
                        include_once 'services/ValoresListIterator.class.php';
                        $vc = new Valores_Controller();
                        $lista = $vc->getListaValores('');
                        $valoresList = new ValoresListIterator($lista);
                        while($valoresList->hasNextValores()){
                            $valores = $valoresList->getNextValores();
                     ?>
                            <option value="<?php echo $valores->getValorCodigo(); ?>"><?php echo 'R$ '.number_format($valores->getValorValor(),2,',','.'); ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="S" id="chale" class="chale"> Chal&eacute;?
                        </label>
                    </div>
                </div>
            </div>
            <div class="row"></div>
            <div class="form-group ">
                <label for="Total" class=" col-xs-2 col-sm-3 col-md-1 col-lg-1">Total</label>
                <div class="col-xs-2 col-sm-3 col-md-2 col-lg-2">
                    <input name="total" id="total" type="text" class="form-control" disabled="" style="font-weight: bold; color: green; font-size: 15px;"/>
                </div>
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
<script src="js/validarcpf.js"></script>

<script>
    $('.delete').on('click', function(){
        var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
        var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
        //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
        //console.log("Nome para deletar: "+nome);
        $('span.nome').text(nome);
        $('.delete-yes').on('click', function(){
            deletar(id);
        });
        //$('.delete-yes').attr('href', 'curso?acao=E&id=' +id); // mudar dinamicamente o link, href do botão confirmar da modal

        //$('#myModal').modal('show'); // modal aparece
    });
</script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script>
    $(document).ready(function(){
        $('#cpf').mask('000.000.000-00');

    });
</script>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script>
    $(document).ready(function(){
        $('#telefone').mask('(00) 00000-0000');

    });
</script>
<script language=javascript>
    function verifica(Msg)
    {
        return confirm(Msg) ;
    }
</script>
<script src="js/jquery.js"></script>
<script src="js/calcularIdade.js"></script>
<script src="js/jquery.mask.js"></script>
<script>
    $('.celular').click(function(){
        $('#telefone').mask('(00) 00000-0000');
    });
    $('.fixo').click(function(){
        $('#telefone').mask('(00) 0000-0000');
    });
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
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script>
    $(document).ready(function(){
        $('#cpf').mask('000.000.000-00');

    });
</script>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.mask.js"></script>
<script>
    $(document).ready(function(){
        $('#telefone').mask('(00) 00000-0000');

    });
</script>



</body>
</html>
