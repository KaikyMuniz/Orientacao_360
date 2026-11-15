<?php
    include("conexao.php");
    include("protect.php");
    if (!isset($_SESSION)) {
        session_start();
    }

    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;
    $sql_code = "SELECT nome_personagem FROM usuarios WHERE user = '$nome'";
    $result = mysqli_query($mysqli, $sql_code);
    $row = mysqli_fetch_assoc($result);

    $sql_code_avatar = "SELECT avatar FROM usuarios WHERE user = '$nome'";
    $result_avatar = mysqli_query($mysqli, $sql_code_avatar);
    $row_avatar = mysqli_fetch_assoc($result_avatar);
 
    $sql_code_xp = "SELECT xp FROM usuarios WHERE user = '$nome'";
    $result_xp = mysqli_query($mysqli, $sql_code_xp);
    $row_xp = mysqli_fetch_assoc($result_xp);
    $xp = $row_xp['xp'];

    switch($xp){
        case $xp > 0 && $xp < 20:
            $estado_personagem = "Fundamental I";
            $Personagem_img = "Fundamental I.png";
        break;

        case $xp >= 20 && $xp < 50:
            $estado_personagem = "Fundamental II";
            $Personagem_img = "Fundamental II.png";
        break;

        case $xp >= 50 && $xp < 100:
            $estado_personagem = "Ensino Médio";
            $Personagem_img = "Ensino Médio.png";
        break;

        case $xp >= 100 && $xp < 170:
            $estado_personagem = "Ensino Superior - Calouro";
            $Personagem_img = "Ensino Superior - Calouro.png";
        break;

        case $xp >= 170 && $xp < 260:
            $estado_personagem = "Ensino Superior - Veterano";
            $Personagem_img = "Ensino Superior - Veterano.png";
        break;

        case $xp >= 260 && $xp < 380:
            $estado_personagem = "Pós-Graduação";
            $Personagem_img = "Pós-Graduação.png";
        break;

        case $xp >= 380 && $xp < 500:
            $estado_personagem = "Mestrado";
            $Personagem_img = "Mestrado.png";
        break;

        case $xp >= 500:
            $estado_personagem = "Doutorado";
            $Personagem_img = "Doutorado.png";
        break;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
        <link rel="icon" href="https://static.vecteezy.com/system/resources/previews/010/157/483/original/house-symbol-and-home-icon-sign-design-free-png.png">
        <link rel="stylesheet" type="text/css" href="../css/excluir.css">
        <link rel="stylesheet" type="text/css" href="../css/cabecalho.css">
        <script type="text/javascript" src="../js/cabecalho.js" defer></script>
        <script type="text/javascript" src="../js/excluir.js" defer></script>
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Deseja excluir sua conta?</title>
    </head>
    <body>
        <div class="img_container">
            <img id="avatar" class="avatar" src="../img/Tela Perfil/<?php echo $Personagem_img;?>" alt="Avatar">
        </div>
        <div class="info">
            <br>
            <label><?php echo $nome; ?>, você tem certeza que deseja
            <b>EXCLUIR</b> sua conta do Orientação 360 em definitivo?<br>
            Você perderá todo o progresso que tem com seu personagem,
            <?php echo $row['nome_personagem']; ?></label>
            <span>
                <button id="voltar">Voltar</button>
                <button id="excluir">Excluir Conta</button>
            </span>
            <br>
        </div>
    </body>
</html>