/**
 * Created by Gysa on 25/12/2016.
 */
$(".menu-retiro").on('click', function(){
    var acao = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
    var address = "";
    if(acao == 'retiro'){
        address = "admretiro.php";
    }
    else if(acao == 'valor'){
        address = "admvalores.php";
    }
    else if(acao == 'pessoa'){
        address = "admpessoas.php";
        
    }else if(acao == 'gasto'){
        address = "admgasto.php"
    }
    else if(acao == 'desistente'){
        address = "admdesistente.php"
    }
    else if(acao == 'total'){
        address = "admtotais.php"
    }
    else if(acao == 'usuario'){
        //alert('Usuario');
        address = "admusuario.php"
    }

    var url = address;
    var form = $('<form action="' + url + '" method="post">' +

        '</form>');
    $('body').append(form);
    form.submit();
})