<?php
    session_start();
    include('protectsenha.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/tela Nova Senha/icon_head.png">
        <link rel="stylesheet" type="text/css" href="../css/mudarsenha.css">
        <script defer type="text/javascript" src="../js/mudarsenha.js"></script>
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Mudar Senha</title>
    </head>
    <body>
        <form method="POST" action="mudandosenha.php">
            <div class="container">
                <h1>Mudar Senha</h1>
                    <p></p>
                    <label for="senha">Insira sua nova senha:</label>
                    <br>
                    <span id="senha_visible_span">
                        <input type="password" name="senha" id="senha" placeholder="Nova senha:" value=
                        "<?php 
                            if(isset($_SESSION['senha'])){ 
                                echo $_SESSION['senha'];
                                }else{
                                    echo "";
                                }
                        ?>">
                        <img class="visible_senha" id="visible_senha" src="../img/tela Login/search_invisible.png">
                    </span>
                    <div class="aviso" id="senha_igual">🛈 A senha não pode ser igual a anterior</div>
                    <p></p>
                    <label for="confirm">Confirme a nova senha:</label>
                    <br>
                    <span id="senha_visible_span">
                        <input type="password" name="confirm" id="confirm" placeholder="Confirma:" value=
                        "<?php 
                            if(isset($_SESSION['confirm'])){ 
                                echo $_SESSION['confirm'];
                                }else{
                                    echo "";
                                }
                        ?>">
                        <img class="visible_senha" id="visible_senha2" src="../img/tela Login/search_invisible.png">
                    </span>
                    <div class="aviso" id="senha_menos_maior">🛈 A senha deve ter entre 8 e 16 caracteres</div> 
                    <div class="aviso" id="senha_nao_igual">🛈 As senhas não estão iguais</div> 
                    <p></p>
                    <div class="center">
                        <input type="submit" id="submit" name="submit" value="Confirma">
                    </div>
            </div>
        </form>
    </body>
</html>
<?php
    if(isset($_SESSION['senha_menos_maior'])){
        echo         
        "<style>
            div #senha_menos_maior{
                display: block;
            }

            form #senha:not(:focus){
                border-color: red;
            }

            form #confirm:not(:focus){
                border-color: red;
            }
        </style>
        <script defer type='text/javascript'>
            var valor_senha = document.querySelector('#senha');
            var valor_confirm = document.querySelector('#confirm');
            var senha_menos_maior = document.querySelector('#senha_menos_maior');
            valor_senha.addEventListener('input', function(){
                senha_menos_maior.style.display = 'none';
                document.getElementById('senha').style.borderColor = '#3363CD';
                document.getElementById('confirm').style.borderColor = '#3363CD';
            });

            valor_confirm.addEventListener('input', function(){
                senha_menos_maior.style.display = 'none';
                document.getElementById('senha').style.borderColor = '#3363CD';
                document.getElementById('confirm').style.borderColor = '#3363CD';
            });
        </script>";
    }
    unset($_SESSION['senha_menos_maior']);

    if(isset($_SESSION['senha_igual_anterior'])){
        echo
        "<style>
            div #senha_igual{
                display: block;
            }

            form #senha:not(:focus){
                border-color: red;
            }
        </style>
        <script defer type='text/javascript'>
            var valor_senha = document.querySelector('#senha');
            var senha_igual = document.querySelector('#senha_igual');
            valor_senha.addEventListener('input', function(){
                senha_igual.style.display = 'none';
                document.getElementById('senha').style.borderColor = '#3363CD';
            });
        </script>";
    }
    unset($_SESSION['senha_igual_anterior']);

    if(isset($_SESSION['alterada'])){
        echo "<script>alert('Senha alterada com sucesso!');location.href=\"encerrarsenha.php\";</script>";

    }
    unset($_SESSION['alterada']);

    if(isset($_SESSION['senha_nao_igual'])){
        echo
        "<style>
            div #senha_nao_igual{
                display: block;
            }

            form #senha:not(:focus){
                border-color: red;
            }

            form #confirm:not(:focus){
                border-color: red;
            }
        </style>
        <script defer type='text/javascript'>
            var valor_senha = document.querySelector('#senha');
            var valor_confirm = document.querySelector('#confirm');
            var senha_nao_igual = document.querySelector('#senha_nao_igual');
            valor_senha.addEventListener('input', function(){
                senha_nao_igual.style.display = 'none';
                document.getElementById('senha').style.borderColor = '#3363CD';
                document.getElementById('confirm').style.borderColor = '#3363CD';
            });

            valor_confirm.addEventListener('input', function(){
                senha_nao_igual.style.display = 'none';
                document.getElementById('senha').style.borderColor = '#3363CD';
                document.getElementById('confirm').style.borderColor = '#3363CD';
            });
        </script>";
    }
    unset($_SESSION['senha_nao_igual']);
?>