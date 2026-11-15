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
        <link rel="stylesheet" type="text/css" href="../css/index.css">
        <link rel="stylesheet" type="text/css" href="../css/cabecalho.css">
        <script defer type="text/javascript" src="../js/indexadmin.js"></script>
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Home</title>
    </head>
    <img id="seta_btn1" src="../img/tela Principal/seta.png">
    <body id="body1">
    <header>
        <img src="../img/tela Principal/Logo Orientação 360.png" class="logo" alt="LOGO">
        <a href="indexadmin.php">Início</a>
        <a href="conteudosadmin.php">Criar Conteúdos</a>
        <a href="noticiaadmin.php">Criar Notícias</a>
        <a href="quizadmin.php">Criar Quizzes</a>
        <a class= "sair" href="logout.php">Sair</a>
    </header>
    <div class="slideshow-container">
        <div class="slide">
            <img src="../img/tela Principal/fundo 1.png" alt="Imagem 1">
            <div class="slide-text1">
                <div class="center">
                    <h2 class="bem-vindo">Bem vindo(a) desenvolvedor(a),</h2>
                </div> 
                <p>Seja muito bem vindo(a) a versão de desenvolvedor do Orientação 360</p>
            </div>
        </div>
                
        <div class="slide">
            <img src="../img/tela Principal/fundo 2.png" alt="Imagem 2">
            <div class="slide-text2">
                <h2>Por aqui você terá acesso a diversas funcionalidades e criações em nossos sites</h2>
                <p>Atualize o Orientação 360!
                </p>
            </div>
        </div>

        <div class="slide">
            <img src="../img/tela Principal/fundo 3.png" alt="Imagem 3">
            <div class="slide-text3">
                <h2>Criar, Alterar e Excluir</h2>
                <p>O Orientação 360 fornece essa versão de desenvolvedor para
                    que seja possível criar, alterar, exlcuir os cards, notícis
                    e quizzes.
                </p>
            </div>
        </div>

        <div class="slide">
            <img src="../img/tela Principal/fundo 4.png" alt="Imagem 4">
            <div class="slide-text4">
                <h2>Tome cuidado</h2>
                <p>Tendo em vista que é possível alterar praticamente toda forma
                    de mídia do site, tome cuidado para não criar mídias que vão
                    contra oque nossa site propõe, ou excluir mídias fundamentais.
                </p>
            </div>
        </div>

        <div class="slide">
            <img src="../img/tela Principal/fundo 5.jpg" alt="imagem 5">
            <div class="slide-text5">
                <h2 id="text_cadastro">Entre de vez nessa jornada!<br>Crie, Altere ou exclua oque for necessário agora mesmo!</h2>
            </div>
        </div>

        <!-- Adicione mais slides conforme necessário -->

        <div class="manual-navigation">
            <input type="radio" class="radio-btn" name="radio-btn" id="radio1" checked>
            <label for="radio1" class="manual-btn"></label>
            <input type="radio" class="radio-btn" name="radio-btn" id="radio2">
            <label for="radio2" class="manual-btn"></label>
            <input type="radio" class="radio-btn" name="radio-btn" id="radio3">
            <label for="radio3" class="manual-btn"></label>
            <input type="radio" class="radio-btn" name="radio-btn" id="radio4">
            <label for="radio4" class="manual-btn"></label>
            <input type="radio" class="radio-btn" name="radio-btn" id="radio5">
            <label for="radio5" class="manual-btn"></label>
        </div>
    </div>

    <div id="body2" class="body2">
        <div class="container">
            <div class="img2">
                <img src="../img/tela Principal/notícias.png" alt="imagem_notícia">
            </div>
            <div class="conteudo2">
                <div class="conteudos">
                    <h1>Edite ou Exclua as Notícias!</h1>
                    <br>
                    <label>
                        Tenha acesso a notícias 
                        a todas as notícias presentes no site
                        e edite ou exclua qualquer uma delas
                    </label>
                    <p></p>
                    <button id="noticia" class="btn_body2">Acesse!</button>
                </div>
            </div>
        </div>
    </div>

    <div id="body3" class="body3">
        <div class="container">
            <div class="conteudo3">
                <div class="conteudos">
                    <h1>Edite ou Exclua os Quizzes!</h1>
                    <br>
                    <label>
                        Confira todos os quizzes
                        que se encontram no site e os edite
                        ou os exclua a qualquer momento
                    </label>
                    <p></p>
                    <button id="quiz" class="btn_body3">Acesse!</button>
                </div>
            </div>
            <div class="img3">
                <img src="../img/tela Principal/quiz.png" alt="imagem_quiz">
            </div>
        </div>
    </div>

    <div id="body4" class="body4">
        <div class="container">
            <div class="img4">
                <img src="../img/tela Principal/conteudos.jpg" alt="imagem_perfil">
            </div>
            <div class="conteudo4">
                <div class="conteudos">
                    <h1>Edite ou Exclua os Conteúdos!</h1>
                    <br>
                    <label>
                        Acompanhe aqui todos os conteúdos
                        do nosso site e tenha acesso a 
                        edita-los ou excluo-los
                    </label>
                    <p></p>
                    <button id="conteudosbtn" class="btn_body4">Acesse!</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>