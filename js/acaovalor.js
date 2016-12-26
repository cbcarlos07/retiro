/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var mensagem = $('.mensagem');

function novo(){
        jQuery('#cad-valor').submit(function(){
        //alert('Submit');
        //var dados = jQuery( this ).serialize();
        var codigo   = document.getElementById("codigo").value;
        var valor = document.getElementById("valor").value;        
        var descricao = document.getElementById("descricao").value;        
        var idade_inicial = document.getElementById("idade_inicial").value; 
        var idade_final = document.getElementById("idade_final").value; 
        var acao = document.getElementById("acao").value;
        
        console.log("Acao: "+acao);
        //var cracha = $('#cracha').value;
        //alert("Acao: "+acao);    
        //console.log("Usuario: "+usuario+" Senha: "+senha);    
            $.ajax({
                dataType: 'json',
                type: "POST",
                url: "funcoes/valor.php",
                beforeSend: carregando,
                data: {
                    'codigo'    : codigo,
                    'valor'     : valor,
                    'descricao' : descricao,
                    'idade_inicial' : idade_inicial,
                    'idade_final'   : idade_final,
                    'acao'      : acao
                },
                success: function( data )
                {
                    //var retorno = data.retorno;
                    //alert(retorno);

                    console.log("Data: "+data.retorno);
                    //console.log("Mensagem: "+data.mensagem);
                    
                    if(data.retorno == 1){
                        sucesso('Opera&ccedil;&atilde;o realizada com sucesso!');
                      }
                    else{
                        errosend(' N&atilde;o foi poss&iacute;vel realizar opera&ccedil;&atilde;o. Verifique se todos os campos est&atilde;o preenchidos');
                        
                   }
                }
        });

        return false;
        });
    }
    
    function excluir(codigo){
            console.log("Excluir");
        $.ajax({
                dataType: 'json',
                type: "POST",
                url: "funcoes/valor.php",
                beforeSend: carregando,
                
                data: {
                    'codigo' : codigo,                    
                    'acao'     : 'E'
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
            location.href= "admvalores.php";
        },1000);
        
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