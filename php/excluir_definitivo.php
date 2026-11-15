<?php
    include("conexao.php");
    include("protect.php");
    if (!isset($_SESSION)) {
        session_start();
    }

    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;

    $sql_id = "SELECT id FROM usuarios WHERE user = '$nome'";
    $result_id = mysqli_query($mysqli, $sql_id);
    $row_id = mysqli_fetch_assoc($result_id);
    $id_user = $row_id['id'];

    if (isset($_POST['user'])){
        if($nome == $_POST['user']){
            $sql_delete = "DELETE FROM usuarios WHERE id = $id_user";
            if ($mysqli->query($sql_delete)) {
                header("Location: logout.php");
                exit;
            } else {
                echo "Erro ao excluir conta: " . $mysqli->error;
            }
            $mysqli->close();
        }else{
            echo "<script>alert('O nome de usuário não corresponde')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
        <link rel="icon" href="https://static.vecteezy.com/system/resources/previews/010/157/483/original/house-symbol-and-home-icon-sign-design-free-png.png">
        <link rel="stylesheet" type="text/css" href="../css/excluirdefinitivo.css">
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Exclusão da conta</title>
    </head>
    <body>
        <form method="POST" action="">
            <div class="container">
                <h1>Excluir Conta</h1>
                    <p></p>
                    <label for="senha">Insira seu nome de usuário<br>para excluir sua conta</label>
                    <p></p>
                    <input type="text" name="user" id="user" placeholder="Nome de Usuário:">
                    <p></p>
                    <div class="center">
                        <input type="submit" id="submit" name="submit" value="Confirma">
                    </div>
            </div>
        </form>
    </body>
</html>