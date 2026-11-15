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
                background-color: #101c3fc4;
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                place-items: center;
                min-width: 50vw;
                min-height: 50vh;
                padding: 2vh 2vh 5vh 2vh;
                border-radius: 15px 0 15px 0;
            }   
        </style>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST["titulo"];
        $descricao = $_POST["descricao"];
        $data_publicacao = $_POST["data_publicacao"];
        $link = $_POST["link"];
        $ano = explode("-", $data_publicacao);
           
        if (isset($_POST['id'])) {
            // Edição do card existente
            $card_id = $_POST['id'];
            $imagem = $_POST["imagem"];
                
            // Atualizar os dados do card no banco de dados
            $sql = "UPDATE conteudos_cards SET titulo='$titulo', descricao='$descricao', link='$link', data_publicacao='$data_publicacao', imagem='$imagem' WHERE id=$card_id";

            if ($mysqli->query($sql) === TRUE) {
                $aviso_card = "Card atualizado com suceso!";
                header("Location: editarconteudosadmin.php");
                exit;
            } else {
                echo "<script defer>alert('Erro ao atualizar o card: ')</script>" . $mysqli->error;
                header("Location: editarconteudosadmin.php");
                exit;
            }
        }
    }

    $sql = "SELECT * FROM conteudos_cards ORDER BY id DESC";
    $result = $mysqli->query($sql);

    if (!$result) {
        die("Erro na consulta: " . $mysqli->error);
    }

    if (isset($_GET['delete_id'])) {
        $card_id = $_GET['delete_id'];
        // Excluir o card do banco de dados
        $sql = "DELETE FROM conteudos_cards WHERE id=$card_id";
        if ($mysqli->query($sql) === TRUE) {
            echo "<script defer>alert('Card excluído com sucesso!')</script>";
            header("Location: editarconteudosadmin.php");
            exit;
        } else {
            echo "<script defer>alert('Erro ao excluir o card: ')</script>" . $mysqli->error;
            header("Location: editarconteudosadmin.php");
            exit;
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
    <link rel="stylesheet" type="text/css" href="../css/editarconteudo.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- GOOGLE FONTS -->
    <title>Edite ou Exclua Conteúdos</title>
</head>
<body class="conteudos_body">
    <header>
        <img src="../img/tela Principal/Logo Orientação 360.png" class="logo" alt="LOGO">
        <a href="indexadmin.php">Início</a>
        <a href="conteudosadmin.php">Criar Conteúdos</a>
        <a href="noticiaadmin.php">Criar Notícias</a>
        <a href="quizadmin.php">Criar Quizzes</a>
        <a class= "sair" href="logout.php">Sair</a>
    </header>
    <!-- Conteúdo do painel administrativo -->
    <h1>Lista de Conteúdos</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <!-- Campos do formulário para adicionar/editar um card -->
        <?php
        if (isset($_GET['edit_id'])) {
            // Editando um card existente - preencha os campos do formulário com os dados do card
            $edit_id = $_GET['edit_id'];
            $sql = "SELECT * FROM conteudos_cards WHERE id=$edit_id";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $card_id = $row["id"];
                $titulo = $row["titulo"];
                $descricao = $row["descricao"];
                $data_publicacao = date("Y-m-d", strtotime($row["data_publicacao"]));
                $imagem = $row["imagem"];
                $link = $row["link"];
        ?>
                <input type="hidden" name="id" value="<?php echo $card_id; ?>">
        <?php
            }
        ?>
        <h2>Edite o card do conteúdo "<?php echo $row['titulo']; ?>"</h1>
        <label>Título do Conteúdo: </label>
        <input type="text" name="titulo" id="titulo" minlength="16" maxlength="32" placeholder="Insira aqui um título:" value=
            "<?php 
                if(isset($_POST['titulo'])){ 
                    echo $_POST['titulo'];
                }else{
                    echo $titulo;
                }
            ?>">
        <p></p>
        <label>Descrição da notícia: </label>
        <textarea id="descricao" name="descricao" minlength="32" maxlength="128" placeholder="Insira aqui a descrição:"><?php 
            if(isset($_POST['descricao'])){ 
                echo $_POST['descricao'];
            }else{
                echo $descricao;
        }?></textarea>
        <p></p>
        <?php
            $data = date('d/m/Y');
        ?>
        <label>Data de publicação: </label>
        <input type="date" id="data_publicacao" name="data_publicacao" required value="<?php if(isset($data_publicacao)){echo $data_publicacao;}else{echo "";}?>">
        <p></p>
        <label>Link: </label>
        <input type="text" name="link" id="link" minlength="5" maxlength="100" placeholder="Insira aqui um link:" value=
            "<?php 
                if(isset($_POST['link'])){ 
                    echo $_POST['link'];
                }else{
                    echo $link;
                }
            ?>">
        <p></p>
        <label>Enviar nova Imagem do card de notícia: </label>
        <input type="file" id="imagem_file" name="imagem_file" value=
            "<?php 
                if(isset($_POST['image_file'])){ 
                    echo $_POST['image_file'];
                }else{
                    echo $imagem;
                }
            ?>">
        <p></p>
        <label>URL da imagem atual de card:</label>
        <input type="text" id="imagem" name="imagem" value=
        "<?php 
                if(isset($_POST['imagem_file'])){ 
                    echo $_POST['imagem_file'];
                }else{
                    echo $imagem;
                }
            ?>" readonly><br>
        <p></p>
        <input class="submit" type="submit" value="Salvar Edição">
        <?php
        } else {
            $data_publicacao = date("Y-m-d");
        ?>
        <?php
        }
        ?>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Data de Publicação</th>
            <th>Imagem</th>
            <th>Link</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <br>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $card_id = $row["id"];
                $titulo = $row["titulo"];
                $descricao = $row["descricao"];
                $data_publicacao = date("d/m/Y", strtotime($row["data_publicacao"]));
                $imagem = $row["imagem"];
                $link = $row["link"];
        ?>
                <tr>
                    <td><?php echo $card_id; ?></td>
                    <td><?php echo $titulo; ?></td>
                    <td class="desc"><?php echo $descricao; ?></td>
                    <td><?php echo $data_publicacao; ?></td>
                    <td><?php echo '<img src="'. $imagem . '" alt="Imagem do Card" style="max-width: 100px; max-height: 100px;">';?></td>
                    <td><?php echo $link; ?></td>
                    <td><a href="editarconteudosadmin.php?edit_id=<?php echo $card_id; ?>">Editar</a></td>
                    <td><a href="editarconteudosadmin.php?delete_id=<?php echo $card_id; ?>">Excluir</a></td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8'>Nenhum card encontrado.</td></tr>";
        }
        ?>
    </table>
</body>
<script defer type="text/javascript" src="../js/conteudosadmin.js"></script>
</html>