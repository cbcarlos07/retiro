/**
 * Created by carlos.brito on 26/12/2016.
 */
function operacao_(codigo, acao){
    console.log("Acao deletar Acao: "+acao+" Codigo: "+codigo);
    $.ajax({
        dataType: 'json',
        type: "POST",
        url: "funcoes/desistente.php",
        beforeSend: carregando,

        data: {
            'codigo' : codigo,
            'acao'     : acao
        },
        success: function( data )
        {
            //var retorno = data.retorno;
            //alert(retorno);

            console.log("Excluir: "+data.retorno);
            if(data.retorno == 1){
                //sucesso();
                console.log("Excluido com sucesso")
                $('#delete-modal').modal('hide');
                sucesso_delete('Item excluido com sucesso');
                //listacard(cardapio);
                //$('.list-group-item').remove();
                //$(a.delete).remove();

            }else if(data.retorno == 0){
                console.log("Nao conseguiu excluir");
                errosend('N&atilde;o foi poss&iacute;vel excluir');
            }

        }
    });

    return false;

}


function carregando(){
    var mensagem = $('.mensagem');
    //alert('Carregando: '+mensagem);
    mensagem.empty().html('<p class="alert alert-warning"><img src="img/loading.gif" alt="Carregando..."> Verificando dados!</p>').fadeIn("fast");
    setTimeout(function (){

    },300);

}

function errosend(msg){
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-danger"><strong>Opa! </strong>'+msg+'</p>').fadeIn("fast");
}
function sucesso(msg){
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK. </strong>'+msg+'<img src="img/ok.png" alt="Carregando..."></p>').fadeIn("fast");
    setTimeout(function (){
        location.href = "admpessoas.php";
    },2000);

    //window.setTimeout()
    //delay(2000);
}
function sucesso_delete(msg){
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK. </strong>'+msg+'<img src="img/ok.png" alt="Carregando..."></p>').fadeIn("fast");
    setTimeout(function (){
        location.reload();
    },1000);

    //window.setTimeout()
    //delay(2000);
}