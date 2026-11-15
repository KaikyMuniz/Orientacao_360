<?php
    include 'conexao.php';
    if(!isset($_SESSION)){
        session_start();
    }

    $nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : null; // o "?" está agindo como um operador condicional
    
    $sql_code = "SELECT * FROM usuarios WHERE user = '$nome' LIMIT 1"; 
    $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
    
    $usuario = $sql_query->fetch_assoc();
    
    if($usuario["id"] == 1 && $usuario["user"] == "Admin@"){
        $autenticado = true; // Defina como true se o usuário estiver autenticado
    }else{
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://static.vecteezy.com/system/resources/previews/010/157/483/original/house-symbol-and-home-icon-sign-design-free-png.png">
        <link rel="stylesheet" type="text/css" href="../css/adicionarcampo.css">
        <link rel="stylesheet" type="text/css" href="../css/cabecalho.css">
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600&family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!-- GOOGLE FONTS -->
        <title>Adicionar Notícia</title>
    </head>
<body>
    <h1>Adicionar Campos da Notícia</h1>

    <form action="processar_noticia.php" method="POST">
        <div class="container">
            <h2>Informações para o card de Notícia</h2>
            <p></p>
            
            <label>Tag 1:</label>
            <select name="tag1">
                <option value="Aprender">Aprender</option>
                <option value="Educação">Educação</option>
                <option value="Faculdade">Faculdade</option>
                <option value="Vestibular">Vestibular</option>
                <option value="Faculdade">Faculdade</option>
                <option value="Vestibular">Vestibular</option>
                <option value="Vocacional">Vocacional</option>
            </select>
            <p></p>
            <label>Tag 2:</label>
            <select name="tag2">
                <option value="Corporativo">Corporativo</option>
                <option value="Desenvolvimento">Desenvolvimento</option>
                <option value="Economia">Economia</option>
                <option value="Inovação">Inovação</option>
                <option value="Pessoal">Pessoal</option>
                <option value="Tecnologia">Tecnologia</option>
                <option value="Trabalho">Trabalho</option>
            </select>
            <p></p>
            <br>
            <label>Descrição</label>
            <p></p>
            <textarea placeholder="Insira aqui a descrição do card:" autocomplete='off' name="descricao" minlength="32" maxlength="128"></textarea>
            <p></p>
            <br>
            <label>Link: </label>
            <input type="text" name="link" id="link" autocomplete='off' placeholder="Insira aqui um link:">
            <p></p>
            <br>
            <label>Data de publicação: </label>
            <input type="date" id="data_publicacao" name="data_publicacao">
            <p></p>
            <br>
            <label>Imagem do card</label>
            <p></p>
            <input class="file" type="file" id="imagem_file" name="imagem_file" accept="image/*" required>
        </div>
        <p></p>
        <br>
        <?php
        $num_campos = $_GET['num_campos'];
        for ($i = 1; $i <= $num_campos; $i++) {
            echo "<div class='container'>";
            echo "<h2>Subtítulo $i <br>(Opcional, caso seja nulo, deixar em branco)</h2>";
            echo "<input type='text' id='subtitulo$i' autocomplete='off' placeholder='Subtitulo do campo $i:' name='subtitulo[]' minlength='0' maxlength='60'>";
            echo "</div>";
            echo "<br><p></p>";
            echo "<div class='container'>";
            echo "<h2>Campo $i</h2>";
            echo "<textarea id='campo$i' placeholder='Campo $i da notícia:' autocomplete='off' name='campo[]' minlength='250' maxlength='400' required></textarea><br><p></p>";   
            if ($i % 2 == 1) {
                echo '<input type="file" name="arquivos[]"><br>';
            }
            echo "</div><p></p><br>";
        }
        echo "<input type='hidden' name='num_campos' value='$num_campos'>";
        ?>
        <input class="submit" type="submit" value="Salvar Notícia">
    </form>
</body>
</html>