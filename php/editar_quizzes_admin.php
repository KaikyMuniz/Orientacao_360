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
    $edit_id = $_GET['id_quiz'];
    $pergunta_id = $_GET['id_pergunta'];

    if($pergunta_id == 0){
        header("Location: editarquizzesadmin.php?edit_id=$edit_id");
        exit;
    }

    $sql_json = "SELECT titulo, alternativas, correto, descricaoFinal FROM pergunta WHERE pergunta_id = ?";
    $stmt = $mysqli->prepare($sql_json);
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
            
    $object = $result->fetch_object();

    $titulo = json_decode($object->titulo);
    $alternativas = json_decode($object->alternativas, true);
    $correto = json_decode($object->correto);

    
    $tituloObj = new stdClass();
    $alternativasObj = new stdClass();
    $corretoObj = new stdClass();

    foreach ($titulo as $indice1 => $campo) {
        $propriedade1 = "pergunta" . ($indice1 + 1);
        $tituloObj->$propriedade1 = $campo->$propriedade1;
    }
    $valor_pergunta = "pergunta".$pergunta_id + 0;
    $valor_exibir_pergunta = $tituloObj->$valor_pergunta;

    foreach ($correto as $indice2 => $correto) {
        $propriedade2 = "correta" . ($indice2 + 1);
        $corretoObj->$propriedade2 = $correto->$propriedade2;
    }

    $valor_correto = "correta".$pergunta_id + 0;
    $valor_exibir_correto = $corretoObj->$valor_correto;

    $sql_geral = "SELECT quantidadePerguntas FROM pergunta WHERE pergunta_id = $edit_id";
    $sql_query_geral = $mysqli->query($sql_geral) or die ($mysqli->error);
    $result_geral = $sql_query_geral->fetch_assoc();

    $sql_geral2 = "SELECT titulo FROM quizzes_cards WHERE id = $edit_id";
    $sql_query_geral2 = $mysqli->query($sql_geral2) or die ($mysqli->error);
    $result_geral2 = $sql_query_geral2->fetch_assoc();

    if(isset($_POST['submit'])){
        $pergunta_value = $_POST['pergunta_value'];
        $alternativa1_value = $_POST['alternativa1_value'];
        $alternativa2_value = $_POST['alternativa2_value'];
        $alternativa3_value = $_POST['alternativa3_value'];
        $alternativa4_value = $_POST['alternativa4_value'];
        $alternativa5_value = $_POST['alternativa5_value'];
        $correta_value = $_POST['correta_value'];
        $descricao_final_value = $_POST['descricao_final_value'];

        $id_array = $pergunta_id - 1;
        $pergunta_value_sql = 'pergunta'.$pergunta_id + 0;
        $alternativa1_value_sql = 'alternativa 1 da pergunta '. $pergunta_id + 0;
        $alternativa2_value_sql = 'alternativa 2 da pergunta '.$pergunta_id + 0;
        $alternativa3_value_sql = 'alternativa 3 da pergunta '.$pergunta_id + 0;
        $alternativa4_value_sql = 'alternativa 4 da pergunta '.$pergunta_id + 0;
        $alternativa5_value_sql = 'alternativa 5 da pergunta '.$pergunta_id + 0;
        $correto_value_sql = 'correta'.$pergunta_id + 0;

        
        $sql2 = "UPDATE pergunta SET titulo = JSON_SET(titulo, '$[$id_array].$pergunta_value_sql', ?) WHERE pergunta_id = ?";
        $stmt2 = $mysqli->prepare($sql2);

        $sql_alternativa1 = "UPDATE pergunta SET alternativas = JSON_SET(alternativas, '$[$id_array].\"$alternativa1_value_sql\"', ?) WHERE pergunta_id = ?";
        $stmt_alternativa1 = $mysqli->prepare($sql_alternativa1);

        $sql_alternativa2 = "UPDATE pergunta SET alternativas = JSON_SET(alternativas, '$[$id_array].\"$alternativa2_value_sql\"', ?) WHERE pergunta_id = ?";
        $stmt_alternativa2 = $mysqli->prepare($sql_alternativa2);

        $sql_alternativa3 = "UPDATE pergunta SET alternativas = JSON_SET(alternativas, '$[$id_array].\"$alternativa3_value_sql\"', ?) WHERE pergunta_id = ?";
        $stmt_alternativa3 = $mysqli->prepare($sql_alternativa3);
        
        $sql_alternativa4 = "UPDATE pergunta SET alternativas = JSON_SET(alternativas, '$[$id_array].\"$alternativa4_value_sql\"', ?) WHERE pergunta_id = ?";
        $stmt_alternativa4 = $mysqli->prepare($sql_alternativa4);

        $sql_alternativa5 = "UPDATE pergunta SET alternativas = JSON_SET(alternativas, '$[$id_array].\"$alternativa5_value_sql\"', ?) WHERE pergunta_id = ?";
        $stmt_alternativa5 = $mysqli->prepare($sql_alternativa5);

        $sql_correto = "UPDATE pergunta SET correto = JSON_SET(correto, '$[$id_array].$correto_value_sql', ?) WHERE pergunta_id = ?";
        $stmt_correto = $mysqli->prepare($sql_correto);
    
        $sql_descricao_final = "UPDATE pergunta SET descricaoFinal = ? WHERE pergunta_id = ?";
        $stmt_descricao_final = $mysqli->prepare($sql_descricao_final);


        if ($stmt2 && $stmt_alternativa1 && $stmt_alternativa2 && $stmt_alternativa3 && $stmt_alternativa4 && $stmt_alternativa5
        && $stmt_correto && $stmt_descricao_final) {
            $stmt2->bind_param("si", $pergunta_value, $edit_id);
            $stmt_alternativa1->bind_param("si", $alternativa1_value, $edit_id);
            $stmt_alternativa2->bind_param("si", $alternativa2_value, $edit_id);
            $stmt_alternativa3->bind_param("si", $alternativa3_value, $edit_id);
            $stmt_alternativa4->bind_param("si", $alternativa4_value, $edit_id);
            $stmt_alternativa5->bind_param("si", $alternativa5_value, $edit_id);
            $stmt_correto->bind_param("si", $correta_value, $edit_id);
            $stmt_descricao_final->bind_param("si", $descricao_final_value, $edit_id);

            if ($stmt2->execute() && $stmt_alternativa1->execute() && $stmt_alternativa2->execute()
             && $stmt_alternativa3->execute() && $stmt_alternativa4->execute() && $stmt_alternativa5->execute()
             && $stmt_correto->execute() && $stmt_descricao_final->execute()){
                echo "<label>Pergunta $pergunta_id atualizado com sucesso!</label>";
                echo "<script defer>
                setInterval(function (){
                    window.location.href = 'editarquizzesadmin.php';
                }, 5000)
                </script>";
                if($descricao_final_value == null){
                    $descricao_final_value = "";                    
                }else{
                    $descricao_final_value = $_POST['descricao_final_value'];
                }
            } else {
                echo "<label>Erro ao atualizar campo$pergunta_id: </label>" . $stmt_correto->error;
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
    <title>Selecione a pergunta</title>
</head>
<body class='quiz_body'>
    <h1>Editar a pergunta <?php echo $pergunta_id; ?> do quiz "<?php echo $result_geral2['titulo']; ?>"</h1>
    <form method="POST" action="">
            <label>Pergunta <?php echo $pergunta_id; ?>:</label>
            <br>
            <textarea class="quiz" name='pergunta_value' placeholder="Atualize a pergunta aqui" minlength="30" maxlength="600"><?php echo $valor_exibir_pergunta; ?></textarea>
            <p></p>
            <br>
            <label>Alternativa 1 da pergunta <?php echo $pergunta_id; ?>:</label>
            <br>
            <textarea class="quiz" name='alternativa1_value' minlength='4' maxlength='300'><?php echo $alternativas['alternativa 1 da pergunta '. ($pergunta_id + 0)]; ?></textarea>
            <p></p>
            <br>
            <label>Alternativa 2 da pergunta <?php echo $pergunta_id; ?>:</label>
            <br>
            <textarea class="quiz" name='alternativa2_value' minlength='4' maxlength='300'><?php echo $alternativas['alternativa 2 da pergunta '. ($pergunta_id + 0)]; ?></textarea>
            <p></p>
            <br>
            <label>Alternativa 3 da pergunta <?php echo $pergunta_id; ?>:</label>
            <br>
            <textarea class="quiz" name='alternativa3_value' minlength='4' maxlength='300'><?php echo $alternativas['alternativa 3 da pergunta '. ($pergunta_id + 0)]; ?></textarea>
            <p></p>
            <br>
            <label>Alternativa 4 da pergunta <?php echo $pergunta_id; ?>:</label>
            <br>
            <textarea class="quiz" name='alternativa4_value' minlength='4' maxlength='300'><?php echo $alternativas['alternativa 4 da pergunta '. ($pergunta_id + 0)]; ?></textarea>
            <p></p>
            <br>
            <label>Alternativa 5 da pergunta <?php echo $pergunta_id; ?>:</label>
            <br>
            <textarea class="quiz" name='alternativa5_value' minlength='4' maxlength='300'><?php echo $alternativas['alternativa 5 da pergunta '. ($pergunta_id + 0)]; ?></textarea>
            <p></p>
            <br>
            <label>Alternativa correta da pergunta <?php echo $pergunta_id; ?>:</label>
            <br>
            <input class="quiz" type="number" name='correta_value' minlength='1' maxlength='1' value="<?php echo $valor_exibir_correto ?>">
            <p></p>
            <br>
            <label>Descrição final do quiz <br>"<?php echo $result_geral2['titulo']; ?>"<br>(Opcional):</label>
            <br>
            <textarea class="quiz" name='descricao_final_value' maxlength="128"><?php echo $object->descricaoFinal ?></textarea>
            <p></p>
            <br>
            <input id="quizBtn" class='submit' name="submit" type='submit' value='Atualizar pergunta <?php echo $pergunta_id; ?>'>
        </form>
</body>
</html>