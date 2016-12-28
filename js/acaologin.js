/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var mensagem = $('.mensagem');

function logar(acao){
        jQuery('#login-form').submit(function(){
        //alert('Submit');
        //var dados = jQuery( this ).serialize();
        var usuario = document.getElementById("inputEmail").value;
        var senha = document.getElementById("inputPassword").value;
        var lembrar = document.getElementById("lembrar");
        if(lembrar.checked == true)
            lembrar = 'S';
        else
            lembrar = 'N';
        console.log("Acao: "+acao);
        console.log("Lembrar: "+lembrar);
        console.log("usuario: "+usuario);
        $.getJSON({

                type: "POST",
                url: "funcoes/usuario.php",

                beforeSend: carregando,
                data: {
                    'login'   : usuario,
                    'senha'   : senha,
                    'lembrar' : lembrar,
                    'acao'     : acao
                },
                success: function( data )
                {
                    //var retorno = data.retorno;
                    //alert(retorno);

                    console.log("Data: "+data.retorno);
                    if(data.retorno == 1){
                        sucesso();
                      }
                     
                     else if(data.retorno == 0){
                         senhaalterar(data.codigo);
                     } 
                    else{
                        errosend();
                        $('input[name="inputEmail"]').css("border-color","red").focus();
                        $('input[name="inputPassword"]').css("border-color","red").focus();
                   }
                }
        });

        return false;
        });
    }
    
    

function carregando(){
        var mensagem = $('.mensagem');
        //alert('Carregando: '+mensagem);
        mensagem.empty().html('<p class="alert alert-warning"><img src="img/loading.gif" alt="Carregando..."> Verificando dados!</p>').fadeIn("fast");
        setTimeout(function (){
            
        },300);
        
  }

  function errosend(){
        var mensagem = $('.mensagem');
        mensagem.empty().html('<p class="alert alert-danger"><strong>Opa!</strong> Por favor, verifique seu login e/ou sua senha</p>').fadeIn("fast");
}
function errosendlogin(){
        var mensagem = $('.mensagem');
        mensagem.empty().html('<p class="alert alert-danger"><strong>Restri&ccedil;&atilde;o!</strong> Voc&ecirc; n&atilde;o t&ecirc;m permiss&atilde;o para acessar este m&oacute;dulo</p>').fadeIn("fast");
}
function sucesso(msg){
        var mensagem = $('.mensagem');
        mensagem.empty().html('<p class="alert alert-success"><strong>OK.</strong> Estamos redirecionando <img src="img/loading.gif" alt="Carregando..."></p>').fadeIn("fast");
        var url = 'principal.php';
        var form = $('<form action="' + url + '" method="post">' +

            '</form>');
        $('body').append(form);
        form.submit();
         //   location.href = "usuario?acao=S";
        
        //window.setTimeout()
        //delay(2000);
}

function senhaalterar(codigo){
        console.log("Alterar senha");
        var mensagem = $('.mensagem');

        mensagem.empty().html('<p class="alert alert-success"><strong>OK.</strong> Estamos redirecionando <img src="img/loading.gif" alt="Carregando..."></p>').fadeIn("fast");                
        
       //     location.href = "usuario?acao=T&codigo="+codigo;
        var url = 'loginsenha.php';
        var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="codigo" value="' + codigo + '" />' +
            '</form>');
        $('body').append(form);
        form.submit();


    //window.setTimeout()
        //delay(2000);
}