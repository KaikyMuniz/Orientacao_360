<?php
    session_start();
    include("conexao.php");

    $user = $_SESSION['user'];
    $senha =  mysqli_real_escape_string($mysqli, trim(password_hash($_POST['senha'], PASSWORD_DEFAULT))); //FUNÇÃO DO PHP ONDE ELA RECEBE COMO PRIMEIRO PARAMÊTRO A INSTÂNCIA DA NOSSA CONEXÃO.
    $confirm = mysqli_real_escape_string($mysqli, trim(password_hash($_POST['confirm'], PASSWORD_DEFAULT)));
    
    if(strlen($_POST['senha']) < 8 || strlen($_POST['senha']) > 16){
        $_SESSION['senha_menos_maior'] = true;
        header('Location: mudarsenha.php');
        exit;
    }

    $_SESSION['senha'] = $_POST['senha'];
    $_SESSION['confirm'] = $_POST['confirm']; 
    
    $sql = "SELECT senha FROM usuarios WHERE user = '$user'"; //REALIZANDO A CONSULTA.
    $result = mysqli_query($mysqli, $sql); //PUXAR O DADO.
    $row = mysqli_fetch_assoc($result);

    if(password_verify($_POST['senha'], $row['senha'])){
        $_SESSION['senha_igual_anterior'] = true;
        header('Location: mudarsenha.php');
        exit;
    }

    if($_POST['senha'] != $_POST['confirm']){
        $_SESSION['senha_nao_igual'] = true;
        header('Location: mudarsenha.php');
        exit;
    }

    $sql = "UPDATE usuarios SET senha = '$senha' WHERE user = '$user'";

    if($mysqli->query($sql) === TRUE){
        $_SESSION['alterada'] = true;
        header('Location: mudarsenha.php');
    }
    $mysqli->close();

    header('Location: mudarsenha.php');
    exit;
?>