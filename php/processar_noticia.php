<?php
    include('conexao.php');

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

    $titulo = $_SESSION['titulo_noticia'];
    $tag1 = $_POST['tag1'];
    $tag2 = $_POST['tag2'];
    $descricao = $_POST['descricao'];
    $link = $_POST['link'];
    $publicacao = $_POST['data_publicacao'];
    $imagem_file = "../img/tela Card de Notícias/".$_POST['imagem_file'];

    $sql_noticia = "INSERT INTO noticias_cards (titulo, tag1, tag2, descricao, link, data_publicacao, imagem) VALUES ('$titulo', '$tag1', '$tag2', '$descricao', '$link', '$publicacao', '$imagem_file')";

    if ($mysqli->query($sql_noticia) === TRUE) {
        $num_campos = $_POST['num_campos'];
        $campo = $_POST['campo'];
        $arquivos = $_POST['arquivos'];
        $subtitulo = $_POST['subtitulo'];
        $id_noticias_card = $mysqli->insert_id;
    
        $camposArray = [];
        foreach ($campo as $indice => $campo) {
            $campo = preg_replace('/[\\\\\"\x00]/', '', $campo); // remove as aspas duplas da pergunta
            $camposArray[] = ["campo" . ($indice + 1)  => $campo];
        }

        $arquivosArray = [];
        foreach ($arquivos as $indice2 => $arquivos) {
            $arquivos = preg_replace('/[\\\\\"\x00]/', '', $arquivos); // remove as aspas duplas das corretas
            $arquivosArray[] = ["arquivo" . ($indice2 + 1) => $arquivos];
        }

        $subtitulosArray = [];
        foreach ($subtitulo as $indice3 => $subtitulo) {
            $subtitulo = preg_replace('/[\\\\\"\x00]/', '', $subtitulo); // remove as aspas duplas das corretas
            $subtitulosArray[] = ["subtitulo" . ($indice3 + 1) => $subtitulo];
        }
    
        // Codifique o array de perguntas em JSON
        $json_campo = json_encode($camposArray, JSON_UNESCAPED_UNICODE);
        $json_arquivos = json_encode($arquivosArray, JSON_UNESCAPED_UNICODE);
        $json_subtitulo = json_encode($subtitulosArray, JSON_UNESCAPED_UNICODE);
    
        $sql = "INSERT INTO campo (titulo, imagens, quantidadeCampos, subtitulo, campo_id) VALUES 
        ('$json_campo', '$json_arquivos', '$num_campos', '$json_subtitulo', '$id_noticias_card')";
    
        if ($mysqli->query($sql) === TRUE) {
            header("Location: editarnoticiaadmin.php");
        } else {
            echo "Erro ao inserir: " . $mysqli->error . "<br>";
        }    
    } else {
        echo "Erro ao inserir: " . $mysqli->error . "<br>";
    }
    $mysqli->close();
?>