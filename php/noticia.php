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
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
        <link rel="icon" href="../img/tela card de notícias/icone noticia.png">
        <link rel="stylesheet" type="text/css" href="../css/noticia.css">
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Notícia</title>
    </head>
    <body id="body1">
    <div class="slideshow-container">

    <?php
        if(isset($_GET['noticia'])) {
            $id_noticia = $_GET['noticia'];
        }
        $id = $id_noticia;

        $sql_card = "SELECT titulo, link FROM noticias_cards WHERE id = '$id'";
        $result_card = mysqli_query($mysqli, $sql_card);
        $row_card = mysqli_fetch_assoc($result_card);

        $sql = "SELECT * FROM campo WHERE campo_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
            
        $object = $result->fetch_object();
        
        $titulo = json_decode($object->titulo);
        $imagens = json_decode($object->imagens);
        $subtitulo = json_decode($object->subtitulo);
        
        $tituloObj = new stdClass();
        $imagensObj = new stdClass();
        $subtituloObj = new stdClass();

        foreach ($titulo as $indice1 => $campo) {
            $propriedade1 = "campo" . ($indice1 + 1);
            $tituloObj->$propriedade1 = $campo->$propriedade1;
        }

        foreach ($imagens as $indice2 => $imagem) {
            $propriedade2 = "arquivo" . ($indice2 + 1);
            $imagensObj->$propriedade2 = $imagem->$propriedade2;
        }

        foreach ($subtitulo as $indice3 => $subtitulo) {
            $propriedade3 = "subtitulo" . ($indice3 + 1);
            $subtituloObj->$propriedade3 = $subtitulo->$propriedade3;
        }

        $quantidadeCampos_Formatado = $object->quantidadeCampos + 1;
        $titulo_value = $row_card['titulo'];

        for($numeroCampos = 1; $numeroCampos < $quantidadeCampos_Formatado; $numeroCampos++){
            echo 
                "<div class='slide'>
                    <div class='fundo$numeroCampos'>";
                    echo "<h2 class='bem-vindo'>$titulo_value</h2>";
                    switch($numeroCampos){
                        case 1:
                            if(strlen( $imagensObj->{'arquivo1'} != "")){
                                echo "<div class='img_left1_responsive'>";
                                echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo1'} . "'>";
                                echo "</div>";
                            }
                        break;

                        case 3:
                            if(strlen( $imagensObj->{'arquivo2'} != "")){
                                echo "<div class='img_left2_responsive'>";
                                echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo2'} . "'>";
                                echo "</div>";
                            }
                        break;
                        
                        case 5:
                            if(strlen( $imagensObj->{'arquivo3'} != "")){
                                echo "<div class='img_left3_responsive'>";
                                echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo3'} . "'>";
                                echo "</div>";
                            }
                        break;

                        case 7:
                            if(strlen( $imagensObj->{'arquivo4'} != "")){
                                echo "<div class='img_left4'_responsive>";
                                echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo4'} . "'>";
                                echo "</div>";
                            }
                        break;

                        case 9:
                            if(strlen( $imagensObj->{'arquivo5'} != "")){
                                echo "<div class='img_left5'_responsive>";
                                echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo5'} . "'>";
                                echo "</div>";
                            }
                        break;

                        case 11:
                            if(strlen( $imagensObj->{'arquivo6'} != "")){
                                echo "<div class='img_left6'_responsive>";
                                echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo6'} . "'>";
                                echo "</div>";
                            }
                        break;
                    }
                        echo "<div class='slide-text$numeroCampos'>";
                            if($numeroCampos == 1){
                                if(isset($subtituloObj->{'subtitulo'.$numeroCampos})){
                                    $subtitulo_valor = ($subtituloObj->{'subtitulo'.$numeroCampos});
                                    echo "<h3 class='subtitle'>$subtitulo_valor</h3>";
                                }
                                echo "<p>".$tituloObj->{'campo'.$numeroCampos}."</p>";
                                echo "</div>";
                            }else{
                                if($numeroCampos == $object->quantidadeCampos){
                                    if(isset($subtituloObj->{'subtitulo'.$numeroCampos})){
                                        $subtitulo_valor = ($subtituloObj->{'subtitulo'.$numeroCampos});
                                        echo "<h3 class='subtitle'>$subtitulo_valor</h3>";
                                    }
                                    echo "<p>".$tituloObj->{'campo'.$numeroCampos}."</p>";
                                    echo "<a href=".$row_card['link'].">Confira a fonte da notícia</a>";
                                    echo "</div>";
                                }else{
                                    if(isset($subtituloObj->{'subtitulo'.$numeroCampos})){
                                        $subtitulo_valor = ($subtituloObj->{'subtitulo'.$numeroCampos});
                                        echo "<h3 class='subtitle'>$subtitulo_valor</h3>";
                                    }
                                    echo "<p>".$tituloObj->{'campo'.$numeroCampos}."</p>";
                                    echo "</div>";
                                }
                            }
                        switch($numeroCampos){
                            case 1:
                                if(strlen( $imagensObj->{'arquivo1'} != "")){
                                    echo "<div class='img_left1'>";
                                    echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo1'} . "'>";
                                    echo "</div>";
                                }
                            break;

                            case 3:
                                if(strlen( $imagensObj->{'arquivo2'} != "")){
                                    echo "<div class='img_left2'>";
                                    echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo2'} . "'>";
                                    echo "</div>";
                                }
                            break;
                            
                            case 5:
                                if(strlen( $imagensObj->{'arquivo3'} != "")){
                                    echo "<div class='img_left3'>";
                                    echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo3'} . "'>";
                                    echo "</div>";
                                }
                            break;

                            case 7:
                                if(strlen( $imagensObj->{'arquivo4'} != "")){
                                    echo "<div class='img_left4'>";
                                    echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo4'} . "'>";
                                    echo "</div>";
                                }
                            break;

                            case 9:
                                if(strlen( $imagensObj->{'arquivo5'} != "")){
                                    echo "<div class='img_left5'>";
                                    echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo5'} . "'>";
                                    echo "</div>";
                                }
                            break;

                            case 11:
                                if(strlen( $imagensObj->{'arquivo6'} != "")){
                                    echo "<div class='img_left6'>";
                                    echo "<img class='img_slide_lado' src='../img/tela Card de Notícias/" . $imagensObj->{'arquivo6'} . "'>";
                                    echo "</div>";
                                }
                            break;
                        }
                    echo 
                    "</div>
                </div>";
        }
        echo "<div class='manual-navigation'>";
        for($numeroCampos1 = 1; $numeroCampos1 < $quantidadeCampos_Formatado; $numeroCampos1++){
            if($numeroCampos1 == 1){
                echo "<input type='radio' class='radio-btn' name='radio-btn' id='radio$numeroCampos1' checked>";
                echo "<label for='radio$numeroCampos1' class='manual-btn'></label>";
            }else{
                echo "<input type='radio' class='radio-btn' name='radio-btn' id='radio$numeroCampos1'>";
                echo "<label for='radio$numeroCampos1' class='manual-btn'></label>";
            }
        }
        echo 
            "</div>
        </div>";
    ?>
    <input type="hidden" id="numero_slide" value= <?php echo  $object->quantidadeCampos;?>>
    </body>
    <script type="text/javascript" src="../js/noticia.js" defer></script>
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
?> 