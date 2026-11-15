<?php
    include('conexao.php');

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

    $titulo = $_SESSION['titulo_quiz'];
    $tag1 = $_POST['tag1'];
    $tag2 = $_POST['tag2'];
    $descricao = $_POST['descricao'];
    $imagem_file = "../img/tela Card de Quiz/".$_POST['imagem_file'];

    $sql_quiz = "INSERT INTO quizzes_cards (titulo, tag1, tag2, descricao, imagem) VALUES ('$titulo', '$tag1', '$tag2', '$descricao', '$imagem_file')";

    if ($mysqli->query($sql_quiz) === TRUE) {
        $num_perguntas = $_POST['num_perguntas'];
        $perguntas = $_POST['perguntas'];
        $respostas = $_POST['respostas'];
        $corretas = $_POST['corretas'];
        $descricao_final = $_POST['descricao_final'];
        $id_quizzes_card = $mysqli->insert_id;
    
        $perguntasArray = [];
        foreach ($perguntas as $indice => $pergunta) {
            $pergunta = preg_replace('/[\\\\\"\x00]/', '', $pergunta); // remove as aspas duplas da pergunta
            $perguntasArray[] = ["pergunta" . ($indice + 1)  => $pergunta];
        }
    
        $respostasArray = [];
        $numeroPergunta = 1;
    
        foreach ($respostas as $indice2 => $resposta) {
            $numeroAlternativa = $indice2 % 5 + 1; // Calcula o número da alternativa com base no índice
    
            $chave = "alternativa {$numeroAlternativa} da pergunta {$numeroPergunta}";
            $chave = preg_replace('/[\\\\\"\x00]/', '', $chave); // remove as aspas duplas da chave
    
            $resposta = preg_replace('/[\\\\\"\x00]/', '', $resposta); // remove as aspas duplas da resposta
            $respostasArray[$chave] = $resposta;
    
            if ($numeroAlternativa === 5) {
                $numeroPergunta++; // Incrementa o número da pergunta após cada grupo de 5 alternativas
            }
        }
    
        $corretasArray = [];
        foreach ($corretas as $indice3 => $corretas) {
            $corretas = preg_replace('/[\\\\\"\x00]/', '', $corretas); // remove as aspas duplas das corretas
            $corretasArray[] = ["correta" . ($indice3 + 1) => $corretas];
        }
    
    
        // Codifique o array de perguntas em JSON
        $json_pergunta = json_encode($perguntasArray, JSON_UNESCAPED_UNICODE);
        $json_resposta = json_encode($respostasArray, JSON_UNESCAPED_UNICODE);
        $json_correta = json_encode($corretasArray, JSON_UNESCAPED_UNICODE);
    
        $sql = "INSERT INTO pergunta (titulo, alternativas, correto, quantidadePerguntas, descricaoFinal, pergunta_id) VALUES 
        ('$json_pergunta', '$json_resposta', '$json_correta', '$num_perguntas', '$descricao_final', '$id_quizzes_card')";
    
        if ($mysqli->query($sql) === TRUE) {
            header("Location: editarquizzesadmin.php");
        } else {
            echo "Erro ao inserir: " . $mysqli->error . "<br>";
        }
    } else {
        echo "Erro ao inserir: " . $mysqli->error . "<br>";
    }
    $mysqli->close();

?>