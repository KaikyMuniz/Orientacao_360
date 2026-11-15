<?php
    session_start();
    include("conexao.php");

    if(isset($_POST['user']) || isset($_POST['recuperar'])){

        $_SESSION['user'] = $_POST['user'];
        $_SESSION['recuperar'] = $_POST['recuperar']; 

        if(strlen($_POST['user']) == null){
            $_SESSION['vazio_campo_user'] = true;
            header('Location: esqueceuasenha.php');
            exit;
        }
        if(strlen($_POST['recuperar']) == null){
            $_SESSION['vazio_campo_recuperar'] = true;
            header('Location: esqueceuasenha.php');
            exit;
        }
    }
        $user = mysqli_real_escape_string($mysqli, trim($_POST['user']));
        $recuperar = mysqli_real_escape_string($mysqli, trim($_POST['recuperar']));

        $sql_code = "SELECT * FROM usuarios WHERE user = '$user' LIMIT 1"; 
        $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
        $usuario = $sql_query->fetch_assoc();

        if(password_verify($recuperar, $usuario['email_recuperacao'])){

            $quantidade = $sql_query->num_rows; //ME RETORNA QUANTAS LINHAS A CONSULTA TROUXE.

            if($quantidade == 1){
                $_SESSION['valido'] = true;
                $_SESSION['id'] = $usuario['id'];
                $mysqli->close();
                header('Location: esqueceuasenha.php');
                exit;

            }else{
                    $_SESSION['invalido'] = true;
                    header('Location: esqueceuasenha.php');
                    exit; 
                }
        }else{
            $_SESSION['invalido'] = true;
            header('Location: esqueceuasenha.php');
            exit; 
        }
?>