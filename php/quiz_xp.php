<?php

    //INCLUIR PROTEÇÃO AQUI PARA QUE O USUÁRIO NÃO ACESSE!!

    include('conexao.php');
    include("protect.php");

    if (!isset($_SESSION)) {
        session_start();
    }

    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;
    $nome = $mysqli->real_escape_string($nome);

    $sql_xp = "SELECT xp FROM usuarios WHERE user = '$nome'";
    $result_xp = mysqli_query($mysqli, $sql_xp);
    $row_xp = mysqli_fetch_assoc($result_xp);

    $sql_Quizzesfeitos = "SELECT quizzes_feitos FROM usuarios WHERE user = '$nome'";
    $result_Quizzesfeitos = mysqli_query($mysqli, $sql_Quizzesfeitos);
    $row_Quizzesfeitos = mysqli_fetch_assoc($result_Quizzesfeitos);

    $corretas = $_POST['corretas'];
    $id_quiz = $_POST['idQuiz'];
    $xp_nivel = $row_xp['xp'] + $corretas;
    $xp_nivel_total = $mysqli->real_escape_string($xp_nivel);

    $sql_update = "UPDATE usuarios SET xp = '$xp_nivel' WHERE user = '$nome'";

    if ($mysqli->query($sql_update) === TRUE);

    $Quizzes_feitos = $row_Quizzesfeitos['quizzes_feitos'];

    if (strpos($Quizzes_feitos, $id_quiz) === false) {
        $Quizzes_feitos .= $id_quiz . ", ";
        
        // Atualize o campo quizzes_feitos
        $sql_insert = "UPDATE usuarios SET quizzes_feitos = '$Quizzes_feitos' WHERE user = '$nome'";
        if ($mysqli->query($sql_insert) === TRUE) {
            $sql_code_quizzesFeitos = "SELECT quizzes_feitos FROM usuarios WHERE user = '$nome'";
            $result_quizzesFeitos = mysqli_query($mysqli, $sql_code_quizzesFeitos);
            $row_quizzesFeitos = mysqli_fetch_assoc($result_quizzesFeitos);
            $quizzes_feitos = $row_quizzesFeitos['quizzes_feitos'];
    
            $array_numero_quizzes = explode(", ", $quizzes_feitos);
            $array_numero_quizzes = array_filter($array_numero_quizzes);
            $total_feitos = count($array_numero_quizzes);

            echo $total_feitos;
    
            switch($total_feitos){
                case 1:
                    $xp = $row_xp['xp'] + 30;
                    $sql_update_xp = "UPDATE usuarios SET xp = '$xp' WHERE user = '$nome'";
                    if ($mysqli->query($sql_update_xp) === TRUE) {
                        $mysqli->close();
                    }
                break;
    
                case 3:
                    $xp = $row_xp['xp'] + 30;
                    $sql_update_xp = "UPDATE usuarios SET xp = '$xp' WHERE user = '$nome'";
                    if ($mysqli->query($sql_update_xp) === TRUE) {
                        $mysqli->close();
                    }
                break;
    
                case 5:
                    $xp = $row_xp['xp'] + 30;
                    $sql_update_xp = "UPDATE usuarios SET xp = '$xp' WHERE user = '$nome'";
                    if ($mysqli->query($sql_update_xp) === TRUE) {
                        $mysqli->close();
                    }
                break;
    
                case 10:
                    $xp = $row_xp['xp'] + 30;
                    $sql_update_xp = "UPDATE usuarios SET xp = '$xp' WHERE user = '$nome'";
                    if ($mysqli->query($sql_update_xp) === TRUE) {
                        $mysqli->close();
                    }
                break;
    
                case 15:
                    $xp = $row_xp['xp'] + 30;
                    $sql_update_xp = "UPDATE usuarios SET xp = '$xp' WHERE user = '$nome'";
                    if ($mysqli->query($sql_update_xp) === TRUE) {
                        $mysqli->close();
                    }
                break;
    
                case 25:
                    $xp = $row_xp['xp'] + 30;
                    $sql_update_xp = "UPDATE usuarios SET xp = '$xp' WHERE user = '$nome'";
                    if ($mysqli->query($sql_update_xp) === TRUE) {
                        $mysqli->close();
                    }
                break;
    
                case 35:
                    $xp = $row_xp['xp'] + 30;
                    $sql_update_xp = "UPDATE usuarios SET xp = '$xp' WHERE user = '$nome'";
                    if ($mysqli->query($sql_update_xp) === TRUE) {
                        $mysqli->close();
                    }
                break;
    
                case 50:
                    $xp = $row_xp['xp'] + 30;
                    $sql_update_xp = "UPDATE usuarios SET xp = '$xp' WHERE user = '$nome'";
                    if ($mysqli->query($sql_update_xp) === TRUE) {
                        $mysqli->close();
                    }
                break;
            } 
        }
    }
    $mysqli->close();
?>