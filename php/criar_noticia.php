<?php
    include("conexao.php");
    session_start();
    $titulo = $_POST['titulo'];
    $num_campos = $_POST['num_campos'];

    $_SESSION['titulo_noticia'] = $titulo;

    if (isset($_SESSION['titulo_noticia']) === TRUE) {
        header("Location: adicionar_campos.php?num_campos=$num_campos");
    } else {
        echo "Erro ao criar a notícia: " . $mysqli->error;
    }

    $mysqli->close();
?>