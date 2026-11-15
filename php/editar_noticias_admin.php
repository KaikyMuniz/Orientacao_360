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
    $edit_id = $_GET['id_noticia'];
    $campo_id = $_GET['id_campo'];

    if($campo_id == 0){
        header("Location: editarnoticiaadmin.php?edit_id=$edit_id");
        exit;
    }

    $sql_json = "SELECT titulo, imagens, subtitulo FROM campo WHERE campo_id = ?";
    $stmt = $mysqli->prepare($sql_json);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
            
    $object = $result->fetch_object();

    $titulo = json_decode($object->titulo);
    $subtitulo = json_decode($object->subtitulo);
    
    $tituloObj = new stdClass();
    $subtituloObj = new stdClass();

    foreach ($titulo as $indice1 => $campo) {
        $propriedade1 = "campo" . ($indice1 + 1);
        $tituloObj->$propriedade1 = $campo->$propriedade1;
    }
    $valor_campo = "campo".$campo_id + 0;
    $valor_exibir_campo = $tituloObj->$valor_campo;

    foreach ($subtitulo as $indice2 => $subtitulo) {
        $propriedade2 = "subtitulo" . ($indice2 + 1);
        $subtituloObj->$propriedade2 = $subtitulo->$propriedade2;
    }

    $valor_subtitulo = "subtitulo".$campo_id + 0;
    $valor_exibir_subtitulo = $subtituloObj->$valor_subtitulo;

    $sql_geral = "SELECT quantidadeCampos FROM campo WHERE campo_id = $edit_id";
    $sql_query_geral = $mysqli->query($sql_geral) or die ($mysqli->error);
    $result_geral = $sql_query_geral->fetch_assoc();

    $sql_geral2 = "SELECT titulo FROM noticias_cards WHERE id = $edit_id";
    $sql_query_geral2 = $mysqli->query($sql_geral2) or die ($mysqli->error);
    $result_geral2 = $sql_query_geral2->fetch_assoc();

    if (isset($_POST['img_value'])) {
        $int = 0;

        switch($campo_id){
            case 1:
                $img_value_sql = 'arquivo'.$int + 1;
                $id_array_img = 0;
            break;

            case 3:
                $img_value_sql = 'arquivo'.$int + 2;
                $id_array_img = 1;
            break;

            case 5:
                $img_value_sql = 'arquivo'.$int + 3;
                $id_array_img = 2;
            break;

            case 7:
                $img_value_sql = 'arquivo'.$int + 4;
                $id_array_img = 3;
            break;

            case 9:
                $img_value_sql = 'arquivo'.$int + 5;
                $id_array_img = 4;
            break;

            case 11:
                $img_value_sql = 'arquivo'.$int + 6;
                $id_array_img = 5;
            break;

            case 13:
                $img_value_sql = 'arquivo'.$int + 7;
                $id_array_img = 6;
            break;

            case 15:
                $img_value_sql = 'arquivo'.$int + 8;
                $id_array_img = 7;
            break;
        }
        $campoValue = $_POST['campo_value'];
        $imgValue = $_POST['img_value'];
        $subtituloValue = $_POST['subtitulo_value'];

        $id_array = $campo_id - 1;
        $campo_value_sql = 'campo'.$campo_id + 0;
        $subtitulo_value_sql = 'subtitulo'.$campo_id + 0;

    
        $sql2 = "UPDATE campo SET titulo = JSON_SET(titulo, '$[$id_array].$campo_value_sql', ?) WHERE id = ?";
        $stmt2 = $mysqli->prepare($sql2);
        
        $sql3 = "UPDATE campo SET imagens = JSON_SET(imagens, '$[$id_array_img].$img_value_sql', ?) WHERE id = ?";
        $stmt3 = $mysqli->prepare($sql3);

        $sql4 = "UPDATE campo SET subtitulo = JSON_SET(subtitulo, '$[$id_array].$subtitulo_value_sql', ?) WHERE id = ?";
        $stmt4 = $mysqli->prepare($sql4);
    
        if ($stmt2 && $stmt3 && $stmt4) {
            $stmt2->bind_param("si", $campoValue, $edit_id);
            $stmt3->bind_param("si", $imgValue, $edit_id);
            $stmt4->bind_param("si", $subtituloValue, $edit_id);

    
            if ($stmt2->execute() && $stmt3->execute() && $stmt4->execute()) {
                echo "<label>Campo $campo_id atualizado com sucesso!</label>";
                echo "<script defer>
                setInterval(function (){
                    window.location.href = 'editarnoticiaadmin.php';
                }, 5000)
                </script>";
                if($valor_exibir_subtitulo == null){
                    $valor_exibir_subtitulo = "";                    
                }else{
                    $valor_exibir_subtitulo = $_POST['subtitulo_value'];
                    $valor_exibir_campo = $_POST['campo_value'];
                }
            } else {
                echo "<label>Erro ao atualizar campo$campo_id: </label>" . $stmt2->error;
            }
    
            $stmt2->close();
        } else {
            echo "Erro na preparação da declaração SQL: " . $mysqli->error;
        }
        
        $mysqli->close();
    }else if(isset($_POST['campo_value'])){
        $campoValue = $_POST['campo_value'];
        $subtituloValue = $_POST['subtitulo_value'];

        $id_array = $campo_id - 1;
        $campo_value_sql = 'campo'.$campo_id + 0;
        $subtitulo_value_sql = 'subtitulo'.$campo_id + 0;
    
        $sql2 = "UPDATE campo SET titulo = JSON_SET(titulo, '$[$id_array].$campo_value_sql', ?) WHERE campo_id = ?";
        $stmt2 = $mysqli->prepare($sql2);

        $sql4 = "UPDATE campo SET subtitulo = JSON_SET(subtitulo, '$[$id_array].$subtitulo_value_sql', ?) WHERE campo_id = ?";
        $stmt4 = $mysqli->prepare($sql4);
    
        if ($stmt2 && $stmt4) {
            $stmt2->bind_param("si", $campoValue, $edit_id);
            $stmt4->bind_param("si", $subtituloValue, $edit_id);

    
            if ($stmt2->execute() && $stmt4->execute()) {
                echo "<label>Campo $campo_id atualizado com sucesso!</label>";
                echo "<script defer>
                setInterval(function (){
                    window.location.href = 'editarnoticiaadmin.php';
                }, 5000)
                </script>";
                if($valor_exibir_subtitulo == null){
                    $valor_exibir_subtitulo = "";                    
                }else{
                    $valor_exibir_subtitulo = $_POST['subtitulo_value'];
                    $valor_exibir_campo = $_POST['campo_value'];
                }
            } else {
                echo "<label>Erro ao atualizar campo$campo_id: </label>" . $stmt2->error;
            }
    
            $stmt2->close();
        } else {
            echo "Erro na preparação da declaração SQL: " . $mysqli->error;
        }
        
        $mysqli->close(); 
    }  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/tela Videos/icon head.png">
    <link rel="stylesheet" type="text/css" href="../css/editaradmin.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- GOOGLE FONTS -->
    <title>Edite o campo</title>
</head>
<body class='noticia_body'>
        <h1>Editar o campo <?php echo $campo_id; ?> da notícia "<?php echo $result_geral2['titulo']; ?>"</h1>
        <form method="POST" action="">
            <label>Campo <?php echo $campo_id; ?>:</label>
            <br>
            <textarea name='campo_value' placeholder="Atualize o campo aqui" minlength="250" maxlength="400"><?php echo $valor_exibir_campo; ?></textarea>
            <p></p>
            <?php 
                switch($campo_id){
                    case 1:
                        echo 
                        "<label>Imagem do campo $campo_id:</label>
                        <br>
                        <input type='file' class='img' name='img_value'>
                        <p></p>";
                    break;

                    case 3:
                        echo 
                        "<label>Imagem do campo $campo_id:</label>
                        <br>
                        <input type='file' class='img' name='img_value'>
                        <p></p>";
                    break;

                    case 5:
                        echo 
                        "<label>Imagem do campo $campo_id:</label>
                        <br>
                        <input type='file' class='img' name='img_value'>
                        <p></p>";
                    break;

                    case 7:
                        echo 
                        "<label>Imagem do campo $campo_id:</label>
                        <br>
                        <input type='file' class='img' name='img_value'>
                        <p></p>";
                    break;

                    case 9:
                        echo 
                        "<label>Imagem do campo $campo_id:</label>
                        <br>
                        <input type='file' class='img' name='img_value'>
                        <p></p>";
                    break;

                    case 11:
                        echo 
                        "<label>Imagem do campo $campo_id:</label>
                        <br>
                        <input type='file' class='img' name='img_value'>
                        <p></p>";
                    break;

                    case 13:
                        echo 
                        "<label>Imagem do campo $campo_id:</label>
                        <br>
                        <input type='file' class='img' name='img_value'>
                        <p></p>";
                    break;

                    case 15:
                        echo 
                        "<label>Imagem do campo $campo_id:</label>
                        <br>
                        <input type='file' class='img' name='img_value'>
                        <p></p>";
                    break;
                }
            ?>
            <label>Subtítulo do campo <?php echo $campo_id; ?>:</label>
            <br>
            <input type='text' name='subtitulo_value' minlength="0" maxlength="60" value="<?php echo $valor_exibir_subtitulo; ?>">
            <p></p>
            <br>
            <input class='submit' type='submit' value='Atualizar campo <?php echo $campo_id; ?>'>
        </form>
</body>
</html>