<?php
    if(!isset($_SESSION)){
        session_start();
    } 

    if(!isset($_SESSION['id'])) { // PAGINA CRIADA PARA QUE O USUÁRIO NÃO COPIE A URL E MUDE A SENHA.
        die("
            <!DOCTYPE html>
            <html lang='pt-br'>
                <head>
                    <meta charset='UTF-8'>
                    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <link rel='icon' href='../img/tela Protect/icon_head.png'>
                    <link rel='stylesheet' type='text/css' href='../css/protect.css'>
                        <link rel='preconnect' href='https://fonts.googleapis.com'>
                        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
                        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap' rel='stylesheet'>
                    <title>Erro</title>
                </head>
                <body>
                    <div>
                        <label>Você não pode alterar sua senha, pois o link expirou!</label>
                        <img src='../img/tela Protect/icon robo erro.png' alt='erro'>
                        <a href=\"esqueceuasenha.php\">Esqueceu sua senha? Clique aqui</a>
                    </div>
                </body>
            </html>
        ");
    }