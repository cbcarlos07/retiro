<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Sistema de Retiro</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/logincss.css" />
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/acaologin.js"></script>
        <link rel="short icon"  href="img/iasd.png"/>
        
    </head>
    <body>
        <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" id="login-form" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Usu&aacute;rio" required autofocus value="">
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Senha" required value="">
                <div id="remember" class="checkbox">
                    <label>
                        <c:set var="checkbox" value="" />
                        <c:if test="${checked == 'S'}">
                            <c:set var="checkbox" value="checked" />
                        </c:if>
                        <input type="checkbox" value="S" name="lembrar" id="lembrar" > Lembre-me
                    </label>
                </div>
                <p class="mensagem"></p>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" onclick="logar('L')">Logar</button>
            </form><!-- /form -->
         <!--   <a href="#" class="forgot-password">
                Forgot the password?
            </a>
         -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
   
    </body>
</html>