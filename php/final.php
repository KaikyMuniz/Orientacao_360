<?php
    include("protect.php");
    include("conexao.php");

    if(!isset($_SESSION)){
        session_start();
    }

    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;

    $sql_code = "SELECT xp, nome_personagem FROM usuarios WHERE user = '$nome'";
    $result = mysqli_query($mysqli, $sql_code);
    $row = mysqli_fetch_assoc($result);

    if($row['xp'] < 500){
        header("Location: ../index.php");
        exit;
    }else{
        $estado_personagem = "Doutorado";
        $Personagem_img = "doutorado.png";
        $text = "Olá ".$nome.", sou eu ".$row['nome_personagem'].", queria 
        te parabenizar por ter chegado até o final desta jornada e ter permitido 
        que eu finalmente conseguisse meu doutorado que tanto almejei!
        Agora, você também tem a oportunidade de se preparar para seu futuro 
        assim como eu fiz. Continue estudando, lendo as notícias e também testando 
        seu conhecimento com os quizzes, assim tenho certeza que você conseguirá
        montar sua carreira profissional de sucesso, assim como eu consegui<br>
        Posso ter alcançado minha tão sonha meta".$nome.", mas, eu, ".$row['nome_personagem'].
        " seguirei sempre aqui ao seu lado :)<br> bye bye por enquanto, ".$nome." e agradeço por
        toda essa jornada ao seu lado :´)";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
        <link rel="icon" href="../img/Tela Perfil/Logo Ícone.png">
        <link rel="stylesheet" type="text/css" href="../css/final.css">
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Final</title>
    </head>
    <body>
        <div class="personagem_container">
            <img src="../img/Tela Perfil/<?php echo $Personagem_img; ?>">
        </div>
        <div class="texto_container">
            <div class="text">
                <h1 id="textoDigitacao"></h1>
            </div>
        </div>
    </body>
    <script>
        var textToType = `Olá <?php echo $nome; ?>, sou eu <?php echo $row["nome_personagem"]; ?>
        , queria te parabenizar por ter chegado até o final desta jornada e ter permitido 
        que eu finalmente conseguisse meu doutorado que tanto almejei!
        Agora, você também tem a oportunidade de se preparar para seu futuro 
        assim como eu fiz. Continue estudando, lendo as notícias e também testando 
        seu conhecimento com os quizzes, assim tenho certeza que você conseguirá
        montar sua carreira profissional de sucesso, assim como eu consegui.
        Posso ter alcançado minha tão sonhada meta <?php echo $nome; ?>, mas, eu, <?php echo $row["nome_personagem"]; ?>
        seguirei sempre aqui ao seu lado :) Bye bye por enquanto, <?php echo $nome; ?> e agradeço por
        toda essa jornada ao seu lado :)`;
        var h1Element = document.getElementById("textoDigitacao");
        var index = 0;

        function typeText() {
            if (index < textToType.length) {
                h1Element.innerHTML += textToType.charAt(index);
                index++;
                setTimeout(typeText, 100); // Ajuste o valor para a velocidade da digitação
            }
        }

        typeText();
    </script>
</html>