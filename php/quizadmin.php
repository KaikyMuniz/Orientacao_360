<?php
    include 'conexao.php';
    if(!isset($_SESSION)){
        session_start();
    }

    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null; // o "?" está agindo como um operador condicional
    
    $sql_code = "SELECT * FROM usuarios WHERE user = '$nome' LIMIT 1"; 
    $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
    
    $usuario = $sql_query->fetch_assoc();
    
    if($usuario["id"] == 1 && $usuario["user"] == "Admin@"){
        $autenticado = true; // Defina como true se o usuário estiver autenticado
    }else{
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://static.vecteezy.com/system/resources/previews/010/157/483/original/house-symbol-and-home-icon-sign-design-free-png.png">
        <link rel="stylesheet" type="text/css" href="../css/quizadmin">
        <link rel="stylesheet" type="text/css" href="../css/cabecalho.css">
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Painel Administrativo Quiz</title>
    </head>
    <body>
    <header>
        <img src="../img/tela Principal/Logo Orientação 360.png" class="logo" alt="LOGO">
        <a href="indexadmin.php">Início</a>
        <a href="conteudosadmin.php">Criar Conteúdos</a>
        <a href="noticiaadmin.php">Criar Notícias</a>
        <a href="quizadmin.php">Criar Quizzes</a>
        <a class= "sair" href="logout.php">Sair</a>
    </header>
      <div class="container">
        <form action="criar_quiz.php" method="POST">
            <h1>Criar Novo Quiz</h1>
            <label for="titulo">Título do Quiz:</label>
            <input type="text" name="titulo" placeholder="Título do quiz:" autocomplete="off" required minlength="16" maxlength="64"><br>
            <p></p>
            <br>
            <label for="num_perguntas">Número de Perguntas:</label>
            <input type="number" name="num_perguntas"  placeholder="Quantidade de perguntas:" autocomplete="off" required min="5" max="15"><br>
            <p></p>
            <br>
            <br>
            <span>
              <input class="submit" type="submit" value="Criar Quiz">
            </span>
        </form>
      </div>
    </body>
</html>