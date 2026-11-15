<?php
    include 'conexao.php';

    session_start();

    // Verifica se o usuário está autenticado como administrador (implemente sua lógica de autenticação aqui)
    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;

    $sql_code = "SELECT * FROM usuarios WHERE user = '$nome' LIMIT 1"; 
    $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);

    $usuario = $sql_query->fetch_assoc();

    if($usuario["id"] == 1 && $usuario["user"] == "Admin@"){
        $autenticado = true; // Defina como true se o usuário estiver autenticado
    }else{
        header("Location: login.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST["titulo"];
        $descricao = $_POST["descricao"];
        $data_publicacao = $_POST["data_publicacao"];
        $link = $_POST["link"];
        $ano = explode("-", $data_publicacao);

            // Processar o upload da imagem (se for enviado)
            if (isset($_FILES["imagem_file"]) && $_FILES["imagem_file"]["error"] === UPLOAD_ERR_OK) {
                $target_dir = "../img/tela Videos/"; // Substitua pelo caminho do diretório onde as imagens serão armazenadas
                $imagem = $target_dir . basename($_FILES["imagem_file"]["name"]);
                move_uploaded_file($_FILES["imagem_file"]["tmp_name"], $imagem);
                        
                $numero_cards = "SELECT COUNT('id') AS total_registros FROM noticias_cards";
                $numero_cards2 = $mysqli->query($numero_cards) or die ($mysqli->error);
                $result_numero_cards = $numero_cards2->fetch_assoc();

                if($result_numero_cards['total_registros'] < 20){
                    // Inserir o novo card no banco de dados
                    $sql = "INSERT INTO conteudos_cards (titulo, descricao, link, data_publicacao, imagem) VALUES ('$titulo', '$descricao', '$link', '$data_publicacao', '$imagem')";

                    if ($mysqli->query($sql) === TRUE) {
                        echo "<script defer>alert('Card adicionado com sucesso!')</script>";
                        header("Location: editarconteudosadmin.php");
                        exit;
                    } else {
                        echo "<script defer>alert('Erro ao adicionar o card: ')</script>" . $mysqli->error;
                        header("Location: conteudosadmin.php");
                        exit;
                    }
                } else {
                    echo "<script defer>alert('Você antigiu o limite de 20 cards')</script>";
                }
            } 
            else {
            echo "<script defer>alert('Imagem não inserida')</script>";
            }
        }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/tela Videos/icon head.png">
    <link rel="stylesheet" type="text/css" href="../css/cabecalho.css">
    <link rel="stylesheet" type="text/css" href="../css/conteudosadmin.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- GOOGLE FONTS -->
    <title>Paindel administrativo Conteúdos</title>
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
    <!-- Conteúdo do painel administrativo -->
    <form method="post" action="" enctype="multipart/form-data">
        <?php
            $data_publicacao = date("Y-m-d");
        ?>
        <div class="container">
            <h1>Criar Novo Conteúdo</h1>

            <label>Título do Conteúdo: </label>
            <input type="text" name="titulo" id="titulo" placeholder="Insira aqui um título:" minlength="16" maxlength="32" value=
            "<?php 
                if(isset($_POST['titulo'])){ 
                    echo $_POST['titulo'];
                }else{
                    echo "";
                }
            ?>">
            <p></p>
            <label>Descrição do conteúdo: </label>
            <textarea id="descricao" name="descricao" minlength="32" maxlength="128" placeholder="Insira aqui a descrição:" ><?php 
            if(isset($_POST['descricao'])){ 
                echo $_POST['descricao'];
            }else{
                echo "";
            }?></textarea>
            <?php
                $data = date('d/m/Y');
            ?>
            <p></p>
            <label>Link: </label>
            <input type="text" name="link" id="link" minlength="5" maxlength="100" placeholder="Insira aqui um link:" value=
            "<?php 
                if(isset($_POST['link'])){ 
                    echo $_POST['link'];
                }else{
                    echo "";
                }
            ?>">
            <p></p>
            <label>Data de publicação: </label>
            <input type="date" id="data_publicacao" name="data_publicacao" required value="<?php if(isset($data_publicacao)){echo $data_publicacao;}else{echo "";}?>">
            <p></p>
            <label>Imagem do card de conteúdo: </label>
            <input type="file" name="imagem_file" required value=
            "<?php 
                if(isset($_POST['image_file'])){ 
                    echo $_POST['image_file'];
                }else{
                    echo "";
                }
            ?>">
            <p></p>
            <input class="submit" type="submit" value="Adicionar Conteúdo">
        </div>
    </form>
</body>
<script defer type="text/javascript" src="../js/conteudosadmin.js"></script>
</html>