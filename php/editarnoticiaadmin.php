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
                background-color: #0b1833c4;
                max-width: 50vw;
                min-height: 50vh;
                padding: 2vh 2vh 5vh 2vh;
                border-radius: 15px 0 15px 0;
                place-items: center;
                display: flex;
                flex-direction: column;
                justify-content: space-evenly;
            }   
        </style>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST["titulo"];
        $tag1 = $_POST["tag1"];
        $tag2 = $_POST["tag2"];
        $descricao = $_POST["descricao"];
        $data_publicacao = $_POST["data_publicacao"];
        $ano = explode("-", $data_publicacao);

        if (isset($_POST['id'])) {
            echo $card_id = $_POST['id'];
            $imagem = $_POST["imagem"];
                
            $sql = "UPDATE noticias_cards SET titulo='$titulo', tag1='$tag1', tag2='$tag2', descricao='$descricao', data_publicacao='$data_publicacao', imagem='$imagem' WHERE id=$card_id";

            if ($mysqli->query($sql) === TRUE) {
                echo "<script defer>alert('Card atualizado com sucesso!')</script>";
                header("Location: editarnoticiaadmin.php");
                exit;
            } else {
                echo "<script defer>alert('Erro ao atualizar o card: ')</script>" . $mysqli->error;
                header("Location: editarnoticiaadmin.php");
                exit;
            }
        }
    }

    $sql = "SELECT * FROM noticias_cards ORDER BY id DESC";
    $result = $mysqli->query($sql);

    if (!$result) {
        die("Erro na consulta: " . $mysqli->error);
    }

    if (isset($_GET['delete_id'])) {
        $card_id = $_GET['delete_id'];
        // Excluir o card do banco de dados
        $sql = "DELETE FROM noticias_cards WHERE id=$card_id";
        $sql2 = "DELETE FROM campo WHERE campo_id=$card_id";
        if ($mysqli->query($sql) === TRUE && $mysqli->query($sql2) === TRUE) {
            echo "<script>alert('Card excluído com sucesso!')</script>";
            header("Location: editarnoticiaadmin.php");
            exit;
        } else {
            echo "<script defer>alert('Erro ao excluir o card: ')</script>" . $mysqli->error;
            header("Location: editarnoticiaadmin.php");
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
    <link rel="stylesheet" type="text/css" href="../css/editarnoticia.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- GOOGLE FONTS -->
    <title>Editar ou Excluir Notícias</title>
</head>
<body class='noticia_body'>
    <header>
        <img src="../img/tela Principal/Logo Orientação 360.png" class="logo" alt="LOGO">
        <a href="indexadmin.php">Início</a>
        <a href="conteudosadmin.php">Criar Conteúdos</a>
        <a href="noticiaadmin.php">Criar Notícias</a>
        <a href="quizadmin.php">Criar Quizzes</a>
        <a class= "sair" href="logout.php">Sair</a>
    </header>
    <h1>Lista de Notícias</h1>
    <p></p>
    <form method="post" action="" enctype="multipart/form-data">
        <?php
            if (isset($_GET['edit_id'])) {
                // Editando um card existente - preencha os campos do formulário com os dados do card
                $edit_id = $_GET['edit_id'];
                $sql = "SELECT * FROM noticias_cards WHERE id=$edit_id";
                $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $card_id = $row["id"];
                    $titulo = $row["titulo"];
                    $descricao = $row['descricao'];
                    $tag1 = $row["tag1"];
                    $tag2 = $row["tag2"];
                    $data_publicacao = date("Y-m-d", strtotime($row["data_publicacao"]));
                    $imagem = $row["imagem"];
            ?>
                    <input type="hidden" name="id" value="<?php echo $card_id; ?>">
            <?php
                }
            ?>
            <h2>Edite o card da notícia "<?php echo $row['titulo']; ?>"</h1>
            <!-- Campos do formulário para adicionar/editar um card -->
            <label>Novo Título: </label>
            <input type="text" id="titulo" name="titulo" placeholder="Insira aqui um título:" required minlength="16" maxlength="40" value=
                "<?php 
                    if(isset($_POST['titulo'])){ 
                        echo $_POST['titulo'];
                    }else{
                        echo $titulo;
                    }
                ?>">
            <p></p>
            <label>Tag 1:</label>
            <select id="tag1" name="tag1">
                <option value=
                    "<?php 
                        if(isset($_POST['tag1'])){ 
                            echo $_POST['tag1'];
                        }else{
                            echo $tag1;
                        }
                    ?>">
                    <?php 
                        if(isset($_POST['tag1'])){ 
                            echo $_POST['tag1'];
                        }else{
                            echo $tag1;
                        }
                    ?>
                </option>
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
            <select id="tag2" name="tag2">
                <option value=
                    "<?php 
                    if(isset($_POST['tag2'])){ 
                            echo $_POST['tag2'];
                        }else{
                            echo $tag2;
                        }
                    ?>">
                    <?php 
                        if(isset($_POST['tag2'])){ 
                            echo $_POST['tag2'];
                        }else{
                            echo $tag2;
                        }
                    ?>
                </option>
                    <option value="Corporativo">Corporativo</option>
                    <option value="Desenvolvimento">Desenvolvimento</option>
                    <option value="Economia">Economia</option>
                    <option value="Inovação">Inovação</option>
                    <option value="Pessoal">Pessoal</option>
                    <option value="Tecnologia">Tecnologia</option>
                    <option value="Trabalho">Trabalho</option>
            </select>
            <p></p>
            <label>Nova Descrição da notícia: </label>
            <textarea id="descricao" name="descricao" placeholder="Insira aqui a descrição:" minlength="32" maxlength="128"><?php 
                if(isset($_POST['descricao'])){ 
                    echo $_POST['descricao'];
                }else{
                    echo $descricao;
                }
                ?></textarea>
            <p></p>
            <?php
                $data = date('d/m/Y');
            ?>
            <label>Data de publicação: </label>
            <input type="date" id="data_publicacao" name="data_publicacao" required value="<?php if(isset($data_publicacao)){echo $data_publicacao;}else{echo "";}?>">
            <br>
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
                ?>" readonly>
            <p></p>
            <input class="submit" type="submit" value="Salvar Edição">
            <?php
            } else {
                $data_publicacao = date("Y-m-d");
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
            <th>Data de Publicação</th>
            <th>Imagem</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <p></p>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $card_id = $row["id"];
                $titulo = $row["titulo"];
                $tag1 = $row["tag1"];
                $tag2 = $row["tag2"];
                $descricao = $row["descricao"];
                $data_publicacao = date("d/m/Y", strtotime($row["data_publicacao"]));
                $imagem = $row["imagem"];
        ?>
                <tr>
                    <td><?php echo $card_id; ?></td>
                    <td><?php echo $titulo; ?></td>
                    <td><?php echo $tag1; ?></td>
                    <td><?php echo $tag2; ?></td>
                    <td class="desc"><?php echo $descricao; ?></td>
                    <td><?php echo $data_publicacao; ?></td>
                    <td><?php echo '<img src="'. $imagem . '" alt="Imagem do Card" style="max-width: 100px; max-height: 100px;">';?></td>
                    <td><a href="listacampo.php?edit_id=<?php echo $card_id; ?>">Editar</a></td>
                    <td><a href="editarnoticiaadmin.php?delete_id=<?php echo $card_id; ?>">Excluir</a></td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8'>Nenhum card encontrado.</td></tr>";
        }
        ?>
    </table>
</body>
<script defer type="text/javascript" src="../js/noticiasadmin.js"></script>
</html>