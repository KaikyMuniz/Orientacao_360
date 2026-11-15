<?php
    include("protect.php");
    include("conexao.php");

    if(!isset($_SESSION)){
        session_start();
    }

    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null;

    $sql_code_avatar = "SELECT avatar FROM usuarios WHERE user = '$nome'";
    $result_avatar = mysqli_query($mysqli, $sql_code_avatar);
    $row_avatar = mysqli_fetch_assoc($result_avatar);

    if($row_avatar['avatar'] != "0.png"){
        $contador_personagem = 1;
        $pontuacao_maxima_avatar = 1;
    }else{
        $contador_personagem = 0;
        $pontuacao_maxima_avatar = 1;
    }

    $porcentagem_quiz_quantidade = ($contador_personagem / $pontuacao_maxima_avatar) * 100;
    $largura_proportional_avatar = $porcentagem_quiz_quantidade . '%';

    $sql_code_nome_personagem = "SELECT nome_personagem FROM usuarios WHERE user = '$nome'";
    $result_nome_personagem = mysqli_query($mysqli, $sql_code_nome_personagem);
    $row_nome_personagem = mysqli_fetch_assoc($result_nome_personagem);

    $sql_code_xp = "SELECT xp FROM usuarios WHERE user = '$nome'";
    $result_xp = mysqli_query($mysqli, $sql_code_xp);
    $row_xp = mysqli_fetch_assoc($result_xp);
    $xp = $row_xp['xp'];

    switch($xp){
        case $xp > 0 && $xp < 20:
            $estado_personagem = "Fundamental I";
            $pontuacao_maxima = 20;
            $Personagem_img = "Fundamental I.png";
            $css_classe = 'container_finish_evolution';
        break;

        case $xp >= 20 && $xp < 50:
            $estado_personagem = "Fundamental II";
            $pontuacao_maxima = 50;
            $Personagem_img = "Fundamental II.png";
            $css_classe = 'container_finish_evolution';
        break;

        case $xp >= 50 && $xp < 100:
            $estado_personagem = "Ensino Médio";
            $pontuacao_maxima = 100;
            $Personagem_img = "Ensino Médio.png";
            $css_classe = 'container_finish_evolution';
        break;

        case $xp >= 100 && $xp < 170:
            $estado_personagem = "Ensino Superior - Calouro";
            $pontuacao_maxima = 170;
            $Personagem_img = "Ensino Superior - Calouro.png";
            $css_classe = 'container_finish_evolution';
        break;

        case $xp >= 170 && $xp < 260:
            $estado_personagem = "Ensino Superior - Veterano";
            $pontuacao_maxima = 260;
            $Personagem_img = "Ensino Superior - Veterano.png";
            $css_classe = 'container_finish_evolution';
        break;

        case $xp >= 260 && $xp < 380:
            $estado_personagem = "Pós-Graduação";
            $pontuacao_maxima = 380;
            $Personagem_img = "Pós-Graduação.png";
            $css_classe = 'container_finish_evolution';
        break;

        case $xp >= 380 && $xp < 500:
            $estado_personagem = "Mestrado";
            $pontuacao_maxima = 500;
            $Personagem_img = "Mestrado.png";
            $css_classe = 'container_finish_evolution';
        break;

        case $xp >= 500:
            $estado_personagem = "Doutorado";
            $pontuacao_maxima = 500;
            $Personagem_img = "doutorado.png";
            $css_classe = 'container_finish_evolution';
            $class_final = "class_final";
            $class_final_link = "link_final_visible";
            $link_fim = "final.php";
        break;
    }

    $porcentagem_xp = ($xp / $pontuacao_maxima) * 100;
    $largura_proportional = $porcentagem_xp . '%';

    switch($xp){
        case 0:
            $css_classe = 'container_finish_evolution_visible';
            $text = "Seja bem vindo(a) ao seu perfil ".$nome.", aqui você poderá acompanhar como anda
            a evolução de seu personagem!<br>Bônus para usuários novos: +5 de XP";
            $xp3 = $row_xp['xp'] + 5;
            $sql_update_xp3 = "UPDATE usuarios SET xp = '$xp3' WHERE user = '$nome'";
            if ($mysqli->query($sql_update_xp3) === TRUE);
        break;

        case 20:
            $css_classe = 'container_finish_evolution_visible';
            $text = $row_nome_personagem['nome_personagem']. " acaba de evoluir para o nível ".$estado_personagem."!<br>+10 de XP<br>Continue assim ".$row_nome_personagem['nome_personagem']." :)";
            $xp3 = $row_xp['xp'] + 10;
            $sql_update_xp3 = "UPDATE usuarios SET xp = '$xp3' WHERE user = '$nome'";
            if ($mysqli->query($sql_update_xp3) === TRUE); 
        break;

        case 50:
            $css_classe = 'container_finish_evolution_visible';
            $text = $row_nome_personagem['nome_personagem']. " acaba de evoluir para o nível ".$estado_personagem."!<br>+15 de XP<br>Continue assim ".$row_nome_personagem['nome_personagem']." :)";
            $xp3 = $row_xp['xp'] + 15;
            $sql_update_xp3 = "UPDATE usuarios SET xp = '$xp3' WHERE user = '$nome'";
            if ($mysqli->query($sql_update_xp3) === TRUE); 
        break;

        case 100:
            $css_classe = 'container_finish_evolution_visible';
            $text = $row_nome_personagem['nome_personagem']. " acaba de evoluir para o nível ".$estado_personagem."!<br>+20 de XP<br>Continue assim ".$row_nome_personagem['nome_personagem']." :)";
            $xp3 = $row_xp['xp'] + 20;
            $sql_update_xp3 = "UPDATE usuarios SET xp = '$xp3' WHERE user = '$nome'";
            if ($mysqli->query($sql_update_xp3) === TRUE); 
        break;
        
        case 170:
            $css_classe = 'container_finish_evolution_visible';
            $text = $row_nome_personagem['nome_personagem']. " acaba de evoluir para o nível ".$estado_personagem."!<br>+25 de XP<br>Continue assim ".$row_nome_personagem['nome_personagem']." :)";
            $xp3 = $row_xp['xp'] + 25;
            $sql_update_xp3 = "UPDATE usuarios SET xp = '$xp3' WHERE user = '$nome'";
            if ($mysqli->query($sql_update_xp3) === TRUE); 
        break;

        case 260:
            $css_classe = 'container_finish_evolution_visible';
            $text = $row_nome_personagem['nome_personagem']. " acaba de evoluir para o nível ".$estado_personagem."!<br>+30 de XP<br>Continue assim ".$row_nome_personagem['nome_personagem']." :)";
            $xp3 = $row_xp['xp'] + 30;
            $sql_update_xp3 = "UPDATE usuarios SET xp = '$xp3' WHERE user = '$nome'";
            if ($mysqli->query($sql_update_xp3) === TRUE); 
        break;

        case 380:
            $css_classe = 'container_finish_evolution_visible';
            $text = $row_nome_personagem['nome_personagem']. " acaba de evoluir para o nível ".$estado_personagem."!<br>+35 de XP<br>Continue assim ".$row_nome_personagem['nome_personagem']." :)";
            $xp3 = $row_xp['xp'] + 35;
            $sql_update_xp3 = "UPDATE usuarios SET xp = '$xp3' WHERE user = '$nome'";
            if ($mysqli->query($sql_update_xp3) === TRUE); 
        break;
    }


    //($xp == 20 || $xp == 50|| $xp == 100 || $xp == 170 || $xp == 260 || $xp == 380){
    
    $sql_code_data = "SELECT criacao FROM usuarios WHERE user = '$nome'";
    $result_data = mysqli_query($mysqli, $sql_code_data);
    $row_data = mysqli_fetch_assoc($result_data);
    $criacao_user = $row_data['criacao'];
    
    $partes_data = explode("/", $criacao_user);
    
    $criacao_user_formatada = $partes_data[2] . "-" . $partes_data[1] . "-" . $partes_data[0];
    
    $data_atual = date("Y-m-d");
    
    $data_criacao = new DateTime($criacao_user_formatada);
    $data_atual = new DateTime($data_atual);
    
    $interval = $data_criacao->diff($data_atual);
    
    $dias = $interval->days;
    
    switch($dias){
        case $dias > 0 && $dias < 7:
            $pontuacao_maxima_data = 7;
        break;

        case $dias >= 7 && $dias < 10:
            $pontuacao_maxima_data = 10;
        break;

        case $dias >= 10 && $dias < 20:
            $pontuacao_maxima_data = 20;
        break;

        case $dias >= 20 && $dias < 30:
            $pontuacao_maxima_data = 30;
        break;

        case $dias >= 30 && $dias < 50:
            $pontuacao_maxima_data = 50;
        break;

        case $dias >= 50 && $dias < 75:
            $pontuacao_maxima_data = 75;
        break;

        case $dias >= 75 && $dias < 100:
            $pontuacao_maxima_data = 100;
        break;

        case $dias >= 100 && $dias < 150:
            $pontuacao_maxima_data = 150;
        break;

        case $dias >= 150 && $dias < 200:
            $pontuacao_maxima_data = 200;
        break;

        case $dias >= 200 && $dias < 250:
            $pontuacao_maxima_data = 250;
        break;

        case $dias >= 250 && $dias < 365:
            $pontuacao_maxima_data = 365;
        break;

        case $dias >= 365 && $dias < 1000:
            $pontuacao_maxima_data = 1000;
        break;

        case $dias >= 1000:
            $pontuacao_maxima_data = 1000;
        break;
    }

    $porcentagem_data = ($dias / $pontuacao_maxima_data) * 100;
    $largura_proportional_data = $porcentagem_data . '%';


    $sql_code_quizzesFeitos = "SELECT quizzes_feitos FROM usuarios WHERE user = '$nome'";
    $result_quizzesFeitos = mysqli_query($mysqli, $sql_code_quizzesFeitos);
    $row_quizzesFeitos = mysqli_fetch_assoc($result_quizzesFeitos);
    $quizzes_feitos = $row_quizzesFeitos['quizzes_feitos'];

    $array_numero_quizzes = explode(", ", $quizzes_feitos);
    $array_numero_quizzes = array_filter($array_numero_quizzes);
    $total_feitos = count($array_numero_quizzes);

    switch($total_feitos){
        case 0:
            $pontuacao_quiz_maxima = 1;
            $conquista1_titulo = "quiz";
        break;

        case $total_feitos >= 1 && $total_feitos < 3:
            $pontuacao_quiz_maxima = 3;
            $conquista1_titulo = "quizzes";
        break;

        case $total_feitos >= 3 && $total_feitos < 5:
            $pontuacao_quiz_maxima = 5;
            $conquista1_titulo = "quizzes";
        break;

        case $total_feitos >= 5 && $total_feitos < 10:
            $pontuacao_quiz_maxima = 10;
            $conquista1_titulo = "quizzes";
        break;

        case $total_feitos >= 10 && $total_feitos < 15:
            $pontuacao_quiz_maxima = 15;
            $conquista1_titulo = "quizzes";
        break;

        case $total_feitos >= 15 && $total_feitos < 25:
            $pontuacao_quiz_maxima = 25;
            $conquista1_titulo = "quizzes";
        break;

        case $total_feitos >= 25 && $total_feitos < 35:
            $pontuacao_quiz_maxima = 35;
            $conquista1_titulo = "quizzes";
        break;

        case $total_feitos >= 35 && $total_feitos < 50:
            $pontuacao_quiz_maxima = 50;
            $conquista1_titulo = "quizzes";
        break;

        case $total_feitos >= 50:
            $pontuacao_quiz_maxima = 50;
            $conquista1_titulo = "quizzes";
        break;
    }

    $porcentagem_quiz_quantidade = ($total_feitos / $pontuacao_quiz_maxima) * 100;
    $largura_proportional_quiz = $porcentagem_quiz_quantidade . '%';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
        <link rel="icon" href="../img/Tela Perfil/Logo Ícone.png">
        <link rel="stylesheet" type="text/css" href="../css/perfil.css">
        <link rel="stylesheet" type="text/css" href="../css/cabecalho.css">
        <script type="text/javascript" src="../js/cabecalho.js" defer></script>
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Perfil</title>
    </head>
    <body>
        <header>
            <img src="../img/tela Principal/Logo Orientação 360.png" class="logo" alt="LOGO">
            <div class="mobile-menu" id="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-list" id="nav-list">
                <li><a href="../index.php">Início</a></li>
                <li><a href="sobrenos.php">Sobre nós</a></li>
                <li><a href="conteudos.php">Conteúdos</a></li>
                <li><a class="logado" href="perfil.php">Seu perfil</a></li>
                <li class="perfil"><img id="perfil" class="perfil" src="../img/tela Configurações do Perfil/Avatar/<?php echo $row_avatar['avatar'];?>" alt="Seu avatar"></li>
            </ul>
        </header>
        <br>
        <h1>Acompanhe aqui a evolução do seu perfil</h1>
        <p></p>
        <div class="container">
            <div class="container_finish">
                <h2>Você completou uma conquista por estar há <?php echo $dias?> dias no Orientação 360!<br>+30 de XP<br>+1 dia bônus</h2>
                <button id="conquistaBtn">Continuar</button>
            </div>
            <div class="<?php echo $css_classe; ?>">
                <label class="<?php if(isset($class_final)) echo $class_final; ?>"><?php if(isset($text)){ echo $text; }?></label>
                <button id="conquistaBtn2">Continuar</button>
            </div>
            <div class= "personagem_container">
                <h2><?php echo $row_nome_personagem['nome_personagem'];?></h2>
                <img class="personagem" src="../img/Tela Perfil/<?php echo $Personagem_img; ?>">
                <br>
                <label><?php echo $estado_personagem; ?></label>
                <br>
                <input type="text" class="xp" id="nivel" name="nivel" placeholder="<?php echo $row_xp['xp'];?>/<?php echo $pontuacao_maxima."pts"; ?>" disabled
                style="background-image: linear-gradient(to right, rgb(0, 231, 0) <?php echo $largura_proportional; ?>, white <?php echo $largura_proportional; ?>);">
                <br>
                <p></p>
                <a class="<?php if(isset($class_final_link)){ echo $class_final_link; }else{ echo "link_final"; }?>" href="<?php if(isset($link_fim)){ echo $link_fim; }?>">Confira a mensagem de <?php echo $row_nome_personagem['nome_personagem'] ?> para você</a>
                <br>
            </div>
            <div class= "conquista_container">
                <span class="conquistas">
                    <img class="conquista_picture" src="../img/Tela Perfil/conquista.png">
                    <div class="estado_conquistas">
                        <h2>Responda <?php echo $pontuacao_quiz_maxima; ?> <?php echo $conquista1_titulo; ?></h2>
                        <input type="text" class="niveis" id="conquista" name="conquista" placeholder="<?php echo $total_feitos; ?>/<?php echo $pontuacao_quiz_maxima; ?>" disabled
                        style="background-image: linear-gradient(to right, rgb(0, 231, 0) <?php echo $largura_proportional_quiz; ?>, white <?php echo $largura_proportional_quiz; ?>);">
                    </div>
                </span>
                <br>
                <span class="conquistas">
                    <img class="conquista_picture" src="../img/Tela Perfil/conquista.png">
                    <div class="estado_conquistas">
                        <h2>Complete <?php echo $pontuacao_maxima_data; ?> dias no<br> Orientação 360</h2>
                        <input type="text" class="niveis" id="conquista" name="conquista" placeholder="<?php echo $dias; ?>/<?php echo $pontuacao_maxima_data; ?>" disabled
                        style="background-image: linear-gradient(to right, rgb(0, 231, 0) <?php echo $largura_proportional_data; ?>, white <?php echo $largura_proportional_data; ?>);">
                    </div>
                </span>
                <br>
                <span class="conquistas">
                    <img class="conquista_picture" src="../img/Tela Perfil/conquista.png">
                    <div class="estado_conquistas">
                        <h2>Mude seu avatar</h2>
                        <input type="text" class="niveis" id="conquista" name="conquista" placeholder="<?php echo $contador_personagem; ?>/<?php echo $pontuacao_maxima_avatar; ?>" disabled
                        style="background-image: linear-gradient(to right, rgb(0, 231, 0) <?php echo $largura_proportional_avatar; ?>, white <?php echo $largura_proportional_avatar; ?>);">
                    </div>
                </span>           
            </div>
        </div>
    </body>
    <script type="text/javascript" src="../js/perfil.js" defer></script>
</html>

<?php
    echo 
        "<style>
            header #nao_logado{
                display: none;
            }
                            
            header .perfil{
                display: block;
            }

            header .logado{
                    display: block;
            }

            .logado_btn{
                display: none;
            }
        </style>";

    if($dias == 7 || $dias == 10 || $dias == 20 || $dias == 30 || 
    $dias == 50 || $dias == 75 || $dias == 100 || $dias == 150 || 
    $dias == 200 || $dias == 250 || $dias == 365 || $dias == 1000){
        $criacao_user = DateTime::createFromFormat("d/m/Y", $criacao_user)->format("Y-m-d");
        $data = new DateTime($criacao_user);
        $data->sub(new DateInterval('P1D'));

        $data_formatada_brasileira = $data->format("d/m/Y");
        $xp2 = $row_xp['xp'] + 30;
        $sql_update_xp = "UPDATE usuarios SET xp = '$xp2' WHERE user = '$nome'";
        $sql_update_data = "UPDATE usuarios SET criacao = '$data_formatada_brasileira' WHERE user = '$nome'";
        if ($mysqli->query($sql_update_xp) === TRUE && $mysqli->query($sql_update_data) === TRUE) {
                echo "<style>
                    .container_finish{
                        visibility: visible;
                    }
                </style>";
            }
        }
?>