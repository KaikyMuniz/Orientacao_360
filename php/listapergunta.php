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
    $edit_id = $_GET['edit_id'];

    $sql_geral = "SELECT quantidadePerguntas FROM pergunta WHERE pergunta_id = $edit_id";
    $sql_query_geral = $mysqli->query($sql_geral) or die ($mysqli->error);
    $result_geral = $sql_query_geral->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/tela Videos/icon head.png">
    <link rel="stylesheet" type="text/css" href="../css/listasadmin.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- GOOGLE FONTS -->
    <title>Selecione a pergunta</title>
</head>
<body class='quiz_body'>
    <h1>Lista de Perguntas</h1>
    <div class='container'>
        <?php
            for($i = 0; $i <= $result_geral['quantidadePerguntas']; $i++){
            echo   
            "<div class='container_card'>
                    <h1 class='number_title'>{$i}°</h1>
                    <hr>
                    <a class='pergunta_link' href='editar_quizzes_admin.php?id_pergunta=$i && id_quiz=$edit_id'>Editar a pergunta $i</a>
                </div>";
            }
        ?>
    </div>
    <input type="hidden" name="id" value="<?php echo $edit_id; ?>">
</body>
</html>