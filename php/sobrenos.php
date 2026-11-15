<?php
    include('conexao.php');
    
    if(!isset($_SESSION)){
        session_start();
    }

    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null; // o "?" está agindo como um operador condicional
    
    if(isset($nome)){
        $sql_code_avatar = "SELECT avatar FROM usuarios WHERE user = '$nome'";
        $result_avatar = mysqli_query($mysqli, $sql_code_avatar);
        $row_avatar = mysqli_fetch_assoc($result_avatar);
        
    }else{
        $row_avatar['avatar'] = "1.png";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
        <link rel="icon" href="https://static.vecteezy.com/system/resources/previews/010/157/483/original/house-symbol-and-home-icon-sign-design-free-png.png">
        <link rel="stylesheet" type="text/css" href="../css/sobrenos.css">
        <link rel="stylesheet" type="text/css" href="../css/cabecalho.css">
        <script type="text/javascript" src="../js/sobrenos.js" defer></script>
        <script type="text/javascript" src="../js/cabecalho.js" defer></script>
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Sobre nós</title>
    </head>
    <body id="body1">
    <header>
        <img src="../img/tela Principal/Logo Orientação 360.png" class="logo" alt="LOGO">
        <div class="mobile-menu" id="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul class="nav-list" id="nav-list">
            <li><a href="../index.php">Início</a></li>
            <li><a href="sobrenos.php">Sobre nós</a></li>
            <li><a href="conteudos.php">Conteúdos</a></li>
            <li class="logado"><a href="perfil.php">Seu perfil</a></li>
            <li id= "nao_logado"><a href="login.php">Entrar</a></li>
            <li id= "nao_logado" class= "nao_logado_cadastro"><a class= "nao-logado-cadastro" href="cadastro.php">Criar usuário</a></li>
            <li class="perfil"><img id="perfil" class="perfil" src="../img/tela Configurações do Perfil/Avatar/<?php echo $row_avatar['avatar'];?>" alt="Seu avatar"></li>
        </ul>
    </header>
    <img id="seta_btn1" src="../img/tela Principal/seta.png">
    <div id="body1" class="body1">
        <div class="container_inicial">
            <h2 class="bem-vindo">Quem somos nós?</h2>
            <p>
                O <b>Orientação 360</b> é um projeto desenvolvido para orientar
                nosso público a mondar sua própria carreira profissional
                e educacional.
                <br>
                Por aqui em nosso site você encontrará notícias breves, conteúdos
                rápidos em vídeos, quizzes dinâmicos para testar seus conhecimentos
                e um sistema gamificado de perfil.
            </p>
        </div>
    </div>

    <div id="body2" class="body2">
        <div class="container_inicial_2">
            <h2>Como surgimos?</h2>
            <p>Somos ex-alunos formados na ETEC de Itaquaquecetuba em 2023, e 
                nosso site surgiu como uma proposta para o nosso Trabalho de Conclusão
                de Curso (TCC).
                 <br>
                A ideia de desenvolver o Orientação 360 surgiu a partir de nossas
                próprias vivências e dúvidas sobre o nosso futuro pós ensino médio.
            </p>
        </div>
    </div>

    <div id="body3" class="body3">
        <div class="container_inicial_3">
            <h2>Viabilidade do Projeto</h2>
            <p>
                Após a realização de uma pesquisa de campo muito ampla,
                e um grande número de pesquisas sobre como os jovens se sentem
                em relação ao seu futuro, conseguimos concluir que nosso projeto
                será viável e irá orientar o público com todas essas dúvidas
                frequentes.
            </p>
        </div>
    </div>

    <div id="body4" class="body4">
        <div class="container_inicial_4">
            <h2 id='focus'>Entre em contato conosco!</h2>
            <p>
                Caso você queira entrar em contato ou enviar
                algum feedback, iremos disponibilizar
                nosso email e o instagram de nosso projeto:
                <br><br>
                - Email: orientacao360@gmail<br>.com
                <br>
                - Instagram: @orientacao360
            </p>
        </div>
    </div>

    <div id="body5" class="body5">
        <div class="container" id="scrollableDiv">
                <h2>Nossa equipe</h2>
                <br>
                <div class="flex_container">
                    <div class="card">
                        <img src="../img/tela Sobre Nós/pessoa 1.png" title="equipe 1">
                        <p class="profissao">CEO</p>
                        <h1>Kaiky<br>Muniz</h1>
                    </div>

                    <div class="card">
                        <img src="../img/tela Sobre Nós/pessoa 1.png" title="equipe 2">
                        <p class="profissao">Presidente</p>
                        <h1>Helena<br>Landim</h1>
                    </div>

                    <div class="card">
                        <img src="../img/tela Sobre Nós/pessoa 1.png" title="equipe 3">
                        <p class="profissao">Gerente Administrativa</p>
                        <h1>Bheatriz<br>Ivanes</h1>
                    </div>

                    <div class="card">
                        <img src="../img/tela Sobre Nós/pessoa 1.png" title="equipe 4">
                        <p class="profissao">Gerente de Marketing</p>
                        <h1>Davi<br>Guilherme</h1>
                    </div>

                    <div class="card">
                        <img src="../img/tela Sobre Nós/pessoa 1.png" title="equipe 5">
                        <p class="profissao">Supervisor Administrativo</p>
                        <h1>Leonardo<br>Santana</h1>
                    </div>

                    <div class="card">
                        <img src="../img/tela Sobre Nós/pessoa 1.png" title="equipe 5">
                        <p class="profissao">Auxiliar Administrativo</p>
                        <h1>Matheus<br>Alexander</h1>
                    </div>
                </div>
        </div>
    </body>
</html>
<?php
    if(isset($nome)){ 
        echo 
            "<style>
                header #nao_logado{
                    display: none;
                }
                            
                header .perfil{
                    display: block;
                }

                header .logado{
                        display: block;
                }

                .logado_btn{
                    display: none;
                }
            </style>";
    }
?>    