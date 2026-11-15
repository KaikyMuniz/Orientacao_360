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
    if(isset($_GET['edit_id'])){
        $edit_id_verification = $_GET['edit_id'];
    }

    if(isset($edit_id_verification) != null){
        echo 
        "<style>
            form{
                background-color: rgb(14, 5, 26);
                max-width: 50vw;
                min-height: 50vh;
                padding: 2vh 10vh 5vh 10vh;
                border-radius: 15px 0 15px 0;
                place-items: center;
                display: flex;
                flex-direction: column;
                justify-content: space-evenly;
            }   
        </style>";
    }

    // Processar a submissão do formulário para adicionar ou editar um card
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST["titulo"];
        $tag1 = $_POST['tag1'];
        $tag2 = $_POST['tag2'];
        $descricao = $_POST["descricao"];

        if (isset($_POST['id'])) {
            // Edição do card existente
            $card_id = $_POST['id'];
            $imagem = $_POST["imagem"];
                
            // Atualizar os dados do card no banco de dados
            $sql = "UPDATE quizzes_cards SET titulo='$titulo', tag1='$tag1', tag2='$tag2', descricao='$descricao', imagem='$imagem' WHERE id=$card_id";

            if ($mysqli->query($sql) === TRUE) {
                echo "<script defer>alert('Card atualizado com sucesso!')</script>";
                header("Location: editarquizzesadmin.php");
                exit;
            } else {
                echo "<script defer>alert('Erro ao atualizar o card: ')</script>" . $mysqli->error;
                header("Location: editarquizzesadmin.php");
                exit;
            }
        } else {
            echo "<script defer>alert('Nenhuma imagem escolhida')</script>";
        }
    }
    
    // Exclusão de um card
    if (isset($_GET['delete_id'])) {
        $card_id = $_GET['delete_id'];
        // Excluir o card do banco de dados
        $sql = "DELETE FROM quizzes_cards WHERE id=$card_id";
        $sql2 = "DELETE FROM pergunta WHERE pergunta_id=$card_id";
        if ($mysqli->query($sql) === TRUE && $mysqli->query($sql2) === TRUE) {
            echo "<script defer>alert('Card excluído com sucesso!')</script>";
            header("Location: editarquizzesadmin.php");
            exit;
        } else {
            echo "<script defer>alert('Erro ao excluir o card: ')</script>" . $mysqli->error;
            header("Location: editarquizzesadmin.php");
            exit;
        }
    }

    // Buscar todos os cards existentes no banco de dados
    $sql = "SELECT * FROM quizzes_cards ORDER BY id DESC";
    $result = $mysqli->query($sql);

    if (!$result) {
        die("Erro na consulta: " . $mysqli->error);
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
    <link rel="stylesheet" type="text/css" href="../css/editarquiz.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- GOOGLE FONTS -->
    <title>Edite ou Exclua Quizzes</title>
</head>
<body class="quiz_body">
    <header>
        <img src="../img/tela Principal/Logo Orientação 360.png" class="logo" alt="LOGO">
        <a href="indexadmin.php">Início</a>
        <a href="conteudosadmin.php">Criar Conteúdos</a>
        <a href="noticiaadmin.php">Criar Notícias</a>
        <a href="quizadmin.php">Criar Quizzes</a>
        <a class= "sair" href="logout.php">Sair</a>
    </header>
    <!-- Conteúdo do painel administrativo -->
    <h1>Lista de Quizzes</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <!-- Campos do formulário para adicionar/editar um card -->
        <?php
        if (isset($_GET['edit_id'])) {
            // Editando um card existente - preencha os campos do formulário com os dados do card
            $edit_id = $_GET['edit_id'];
            $sql = "SELECT * FROM quizzes_cards WHERE id=$edit_id";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $card_id = $row["id"];
                $titulo = $row["titulo"];
                $tag1 = $row["tag1"];
                $tag2 = $row["tag2"];
                $descricao = $row["descricao"];
                $imagem = $row["imagem"];
        ?>
                <input type="hidden" name="id" value="<?php echo $card_id; ?>">
        <?php
            }
        ?>
        <h2>Edite o card da notícia "<?php echo $row['titulo']; ?>"</h1>
        <label>Título:</label>
        <input type="text" name="titulo" minlength="16" maxlength="64" value="<?php echo $titulo; ?>"><p></p>
        
        <label>Tag 1:</label>
            <select name="tag1">
                <option value="Aprender">Aprender</option>
                <option value="Educação">Educação</option>
                <option value="Faculdade">Faculdade</option>
                <option value="Vestibular">Vestibular</option>
                <option value="Faculdade">Faculdade</option>
                <option value="Vestibular">Vestibular</option>
                <option value="Vocacional">Vocacional</option>
            </select>
            <p></p>
            <label>Tag 2:</label>
            <select name="tag2">
                <option value="Corporativo">Corporativo</option>
                <option value="Desenvolvimento">Desenvolvimento</option>
                <option value="Economia">Economia</option>
                <option value="Inovação">Inovação</option>
                <option value="Pessoal">Pessoal</option>
                <option value="Tecnologia">Tecnologia</option>
                <option value="Trabalho">Trabalho</option>
            </select>
        <p></p>

        <label>Descrição:</label>
        <textarea minlength="32" maxlength="128" name="descricao"><?php echo $descricao; ?></textarea><p></p>

        <label>Enviar nova imagem:</label>
        <input type="file" id="imagem_file" name="imagem_file"><p></p>

        <label>URL da imagem atual:</label>
        <input type="text" id="imagem" name="imagem" value="<?php echo $imagem; ?>" readonly><p></p><br>
        

        <input class="submit" type="submit" value="Salvar Edição">
        <?php
        }
        ?>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Tag 1</th>
            <th>Tag 2</th>
            <th>Descrição</th>
            <th>Imagem</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <br>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $card_id = $row["id"];
                $titulo = $row["titulo"];
                $tag1 = $row["tag1"];
                $tag2 = $row["tag2"];
                $descricao = $row["descricao"];
                $imagem = $row["imagem"];
        ?>
                <tr>
                    <td><?php echo $card_id; ?></td>
                    <td><?php echo $titulo; ?></td>
                    <td><?php echo $tag1; ?></td>
                    <td><?php echo $tag2; ?></td>
                    <td class="desc"><?php echo $descricao; ?></td>
                    <td><?php echo '<img src="'. $imagem . '" alt="Imagem do Card" style="max-width: 100px; max-height: 100px;">';?></td>
                    <td><a href="listapergunta.php?edit_id=<?php echo $card_id; ?>">Editar</a></td>
                    <td><a href="editarquizzesadmin.php?delete_id=<?php echo $card_id; ?>">Excluir</a></td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8'>Nenhum card encontrado.</td></tr>";
        }
        ?>
    </table>
</body>
<script type="text/javascript" src="../js/quizzesadmin.js"></script>
</html>