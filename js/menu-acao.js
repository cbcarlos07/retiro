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
        
    }

    var url = address;
    var form = $('<form action="' + url + '" method="post">' +

        '</form>');
    $('body').append(form);
    form.submit();
})