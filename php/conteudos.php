<?php
// Inclua o arquivo de conexão ao banco de dados (conexao.php)
    include 'conexao.php';
    if(!isset($_SESSION)){
        session_start();
    }

    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;

    // Buscar todos os cards existentes no banco de dados
    $sql = "SELECT * FROM conteudos_cards ORDER BY id DESC";
    $result = $mysqli->query($sql);

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
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="icon" href="../img/tela Videos/icon head.png">
    <link rel="stylesheet" type="text/css" href="../css/conteudos.css">
    <link rel="stylesheet" type="text/css" href="../css/cabecalho.css">
    <script type="text/javascript" src="../js/cabecalho.js" defer></script>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- GOOGLE FONTS -->
    <title>Conteúdos</title>
</head>
<body class="conteudo">
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
    <br>
    <h1 class="title">Confira os vídeos abaixo pra entender melhor os temas</h1>
    <br>
    <div class="container_principal">
        <?php
        // Exibição dinâmica dos cards
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $card_id = $row["id"];
                $titulo = $row["titulo"];
                $descricao = $row["descricao"];
                $data_publicacao = $row["data_publicacao"];
                $imagem = $row["imagem"];
                $link = $row["link"];
        ?>
                <div class="container">
                    <img class="picture" src="<?php echo $imagem; ?>" title="<?php echo $titulo; ?>">
                    <p class="data"><?php echo date("d/m/Y", strtotime($data_publicacao)); ?></p>
                    <h1><?php echo $titulo; ?></h1>
                    <p><?php echo $descricao; ?></p>
                    <p></p>
                    <div class="center">
                        <img class="icon" src="../img/tela Videos/icon_seta_right.png" title="Ícone">
                        <a href="<?php echo $link; ?>">Acesse o vídeo aqui!</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<h1>Nenhum card encontrado.</h1>";
        }
        ?>
    </div>
</body>
</html>
<?php
// Fechando a conexão com o banco de dados
$mysqli->close();
?>