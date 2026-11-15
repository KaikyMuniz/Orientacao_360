<?php
    include("conexao.php");
    session_start();
    $titulo = $_POST['titulo'];
    $num_perguntas = $_POST['num_perguntas'];

    $_SESSION['titulo_quiz'] = $titulo;

    if (isset($_SESSION['titulo_quiz']) === TRUE) {
        header("Location: adicionar_perguntas.php?num_perguntas=$num_perguntas");
    } else {
        echo "Erro ao criar o quiz: " . $mysqli->error;
    }

    $mysqli->close();
?>