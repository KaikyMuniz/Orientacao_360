<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/tela Esqueci A Senha/icon head.png">
        <link rel="stylesheet" type="text/css" href="../css/esqueceuasenha.css">
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Esqueceu a Senha</title>
    </head>
    <body>
        <form method="POST" action="recuperarsenha.php">
            <div class="container">
                <h1>Esqueci a Senha</h1>
                <p></p>
                <label for="user">Insira seu nome de usuário:</label>
                <br>
                <input type="text" name="user" id="user" placeholder="Nome de usuário:" value=
                "<?php 
                    if(isset($_SESSION['user'])){ 
                        echo $_SESSION['user'];
                        }else{
                            echo "";
                        }
                ?>">
                <div class="aviso" id="erro_user_vazio" name="erro_user_vazio">🛈 Este campo não pode ser nulo</div>
                <p></p>
                <label for="recuperar">Insira seu email de recuperação:</label>
                <br>
                <input type="email" name="recuperar" id="recuperar" placeholder="Email de recuperação:" value=
                "<?php 
                    if(isset($_SESSION['recuperar'])){ 
                        echo $_SESSION['recuperar'];
                        }else{
                            echo "";
                        }
                ?>">
                <div class="aviso" id="erro_recuperar_vazio" name="erro_recuperar_vazio">🛈 Este campo não pode ser nulo</div>
                <div class="aviso" id="erro_user_recuperar" name="erro_user_recuperar">🛈 O nome de usuário ou o email <br>de recuperação estão incorretos</div>
                <p></p>
                <p></p>
                <div class="center">
                    <input name="submit" id="submit" value="Continuar" type="submit">
                </div>
                <p></p>
                <div class="center">
                    <hr>
                        <label class="ou">Ou</label>
                    <hr>
                    <label class="realize">Realize seu <a href="cadastro.php">Cadastro</a></label>
                </div>
            </div>
        </form>
    </body>
</html>
<?php
    if(isset($_SESSION['vazio_campo_user'])){
        echo
        "<style>
            div #erro_user_vazio{
                display: block;
            }
    
            form #user:not(:focus){
                border-color: red;
            }
        </style>
        <script defer type='text/javascript'>
            var valor_nome = document.querySelector('#user');
            var erro_user_invalido = document.querySelector('#erro_user_vazio');
            valor_nome.addEventListener('input', function(){
                    erro_user_invalido.style.display = 'none';
                    document.getElementById('user').style.borderColor = '#3363CD';
                });
        </script>";
    }
    unset($_SESSION['vazio_campo_user']);

    if(isset($_SESSION['vazio_campo_recuperar'])){
        echo
        "<style>
            div #erro_recuperar_vazio{
                display: block;
            }
    
            form #recuperar:not(:focus){
                border-color: red;
            }
        </style>
        <script defer type='text/javascript'>
            var valor_recuperar = document.querySelector('#recuperar');
            var erro_recuperar_invalido = document.querySelector('#erro_recuperar_vazio');
            valor_recuperar.addEventListener('input', function(){
                    erro_recuperar_invalido.style.display = 'none';
                    document.getElementById('recuperar').style.borderColor = '#3363CD';
                });
        </script>";
    }
    unset($_SESSION['vazio_campo_recuperar']);

    if(isset($_SESSION['invalido'])){
        echo
        "<style>
            div #erro_user_recuperar{
                display: block;
            }
    
            form #user:not(:focus){
                border-color: red;
            }

            form #recuperar:not(:focus){
                border-color: red;
            }
        </style>
        <script defer type='text/javascript'>
            var valor_nome = document.querySelector('#user');
            var valor_recuperar = document.querySelector('#recuperar');
            var erro_user_recuperar = document.querySelector('#erro_user_recuperar');
            valor_recuperar.addEventListener('input', function(){
                    erro_user_recuperar.style.display = 'none';
                    document.getElementById('recuperar').style.borderColor = '#3363CD';
                    document.getElementById('user').style.borderColor = '#3363CD';
                });
                valor_nome.addEventListener('input', function(){
                    erro_user_recuperar.style.display = 'none';
                    document.getElementById('user').style.borderColor = '#3363CD';
                    document.getElementById('recuperar').style.borderColor = '#3363CD';
                });
        </script>";
    }
    unset($_SESSION['invalido']);

    if(isset($_SESSION['valido'])){
        header('Location: mudarsenha.php');
   }
   unset($_SESSION['valido']);
?>