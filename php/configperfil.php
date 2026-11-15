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
        break;

        case $xp >= 20 && $xp < 50:
            $estado_personagem = "Fundamental II";
        break;

        case $xp >= 50 && $xp < 100:
            $estado_personagem = "Ensino Médio";
        break;

        case $xp >= 100 && $xp < 170:
            $estado_personagem = "Ensino Superior - Calouro";
        break;

        case $xp >= 170 && $xp < 260:
            $estado_personagem = "Ensino Superior - Veterano";
        break;

        case $xp >= 260 && $xp < 380:
            $estado_personagem = "Pós-Graduação";
        break;

        case $xp >= 380 && $xp < 500:
            $estado_personagem = "Mestrado";
        break;

        case $xp >= 500:
            $estado_personagem = "Doutorado";
        break;
    }

    if (mysqli_num_rows($result) < 0) {
        $row['nome_personagem'] = "";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (isset($_POST['avatar_path'])) {
            $avatarPath = $_POST['avatar_path'];
            $nomeEscapado3 = mysqli_real_escape_string($mysqli, $nome);
            
            $sql_code3 = "UPDATE usuarios SET avatar = '$avatarPath' WHERE user = '$nomeEscapado3'";
            $sql_query3 = mysqli_query($mysqli, $sql_code3) or die(mysqli_error($mysqli));
            $acao_css = 'container_finish';

            if ($sql_query3) {
                echo 'avatar_success';
                if ($row_avatar['avatar'] == "0.png") {
                    $xp_conquista = $xp + 30;
                    $sql_code_xp = "UPDATE usuarios SET xp = '$xp_conquista' WHERE user = '$nomeEscapado3'";
                    $sql_query_xp = mysqli_query($mysqli, $sql_code_xp) or die(mysqli_error($mysqli));
            
                    $acao_css = 'container_finish_visible';
                    $_SESSION['acao_css'] = $acao_css; 
                }
            }else {
                echo 'avatar_error';
            }
            header("Refresh: 0"); 
            exit;
        }

        if (isset($_POST['novoNome'])) {
            $novoNome = $_POST['novoNome'];

            if(strlen($novoNome) > 32){
                echo 'error_caracteres';
                exit;
            }

            // Verificar se o novo nome já existe no banco de dados
            $novoNomeEscapado = mysqli_real_escape_string($mysqli, $novoNome);
            $sql_code = "SELECT COUNT(*) AS total FROM usuarios WHERE user = '$novoNomeEscapado'";
            $sql_query = mysqli_query($mysqli, $sql_code) or die(mysqli_error($mysqli));
            $resultado = mysqli_fetch_assoc($sql_query);
            $total = $resultado['total'];
        
            if ($total > 0) {
                echo 'error';
            } else {
                $nomeEscapado = mysqli_real_escape_string($mysqli, $nome);
                $sql_code = "UPDATE usuarios SET user = '$novoNomeEscapado' WHERE user = '$nomeEscapado'";
                $sql_query = mysqli_query($mysqli, $sql_code) or die(mysqli_error($mysqli));
                $_SESSION['nome'] = $novoNome;
                $nome = $novoNome;
                echo 'success';
            }
            exit;
        } else {
            $NomePersonagem = $_POST['NomePersonagem'];

            if (strlen($NomePersonagem) > 20) {
                echo 'error';
            } else {
                $nomeEscapado = mysqli_real_escape_string($mysqli, $nome);
                $NomePersonagemEscapado = mysqli_real_escape_string($mysqli, $NomePersonagem);
                $sql_code2 = "UPDATE usuarios SET nome_personagem = '$NomePersonagemEscapado' WHERE user = '$nomeEscapado'";
                $sql_query2 = mysqli_query($mysqli, $sql_code2) or die(mysqli_error($mysqli));
                $Personagem = $NomePersonagem;
                echo 'success2';
            }
            exit;
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
        <link rel="stylesheet" type="text/css" href="../css/configperfil.css">
        <link rel="stylesheet" type="text/css" href="../css/cabecalho.css">
        <script defer type="text/javascript" src="../js/configperfil.js"></script>
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
    <body id="body">
    <div id="container_avatar" class="container_avatar">
        <h2>Escolha o seu avatar</h2>
        <p></p>
        <div class="flex_avatar">
            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/1.png" data-path="1.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/2.png" data-path="2.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/3.png" data-path="3.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/4.png" data-path="4.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/5.png" data-path="5.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/6.png" data-path="6.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/7.png" data-path="7.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/8.png" data-path="8.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/9.png" data-path="9.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/10.png" data-path="10.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/11.png" data-path="11.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/12.png" data-path="12.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/13.png" data-path="13.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/14.png" data-path="14.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/15.png" data-path="15.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/16.png" data-path="16.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/17.png" data-path="17.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/18.png" data-path="18.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/19.png" data-path="19.png">
                <br>
            </div>

            <div class="organizar">
                <img class="avatar_icon" src="../img/tela Configurações do Perfil/Avatar/20.png" data-path="20.png">
                <br>
            </div>
        </div>
        <span class="avatar_botao">
            <button id="cancelar_avatar" name="cancelar_avatar" class="cancelar_avatar">Cancelar Mudança</button>
            <button id="confirma_avatar" name="confirma_avatar" class="confirma_avatar">Confirma Mudança</button>
        </span>
    </div>
    <div id="ocultar">
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
        <?php
            if(isset($nome)){ 
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
                    </style>"
                ;
            }
        ?>
        <h1>Faça modificações em seu perfil</h1>
        <p></p>
        <div class="container">
            <div class="<?php echo isset($_SESSION['acao_css']) ? $_SESSION['acao_css'] : 'container_finish'; ?>">
                <label>Você completou a conquista de trocar seu avatar pela primeira vez!<br>+30 de XP</label>
                <a href="perfil.php">Clique aqui e confira como está<br> seu personagem <b><?php echo $row['nome_personagem']; ?></b></a>
                <br>
                <button id="conquistaBtn">Continuar</button>
            </div>
            <div class="avatares">
                <img id="avatar" class="avatar" src="../img/tela Configurações do Perfil/Avatar/<?php echo $row_avatar['avatar'];?>" alt="Avatar">
                <p></p>
                <button id="escolher_avatar" class="escolher_avatar">Mudar Avatar</button>
                <p></p>
                <br>
            </div>
            <div class="dados">
                <span>
                    <label>Nome de Usuário: </label>
                    <span id="medidor" style="position: absolute; visibility: hidden;"></span>
                    <input type="text" id="campo_user" name="campo_user" class="campo_user" 
                    placeholder="Novo nome de usuário: " disabled value="<?php echo $nome; ?>">
                    <img id="alterar" class="alterar" src="../img/tela Configurações do Perfil/icon alterar.png" alt="Alterar">
                    <button id="confirma" name="confirma" class="confirma"></button>
                    <button id="cancelar" name="cancelar" class="cancelar"></button>
                </span>
                <label id="erro_nome_existe" class="aviso">🛈 Nome de usuário já existe. Por favor, escolha outro nome</label>
                <label id="erro_nome_caracter" class="aviso">🛈 Nome de usuário deve ter no máximo 32 caracteres</label>
                <label id="nome_valido" class="aviso">🛈 Nome de usuário alterado com sucesso!</label>
                <br>
                <span>
                    <label>Idade:
                    <?php
                        $sql_code = "SELECT nascimento FROM usuarios WHERE user = '$nome' LIMIT 1"; 
                        $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
                        $usuario = $sql_query->fetch_assoc();

                        $ano = explode("-", $usuario['nascimento']);
                        $idade = 2023 - $ano[0];
                        echo $idade;
                    ?></label>
                </span>
                <br>
                <span>
                    <label>Você está no <b>Orientação 360</b> desde:
                    <?php
                        $sql_code2 = "SELECT criacao FROM usuarios WHERE user = '$nome' LIMIT 1"; 
                        $sql_query2 = $mysqli->query($sql_code2) or die ($mysqli->error);
                        $usuario2 = $sql_query2->fetch_assoc();

                        if($usuario2['criacao'] == null){
                            echo "Muito tempo :)";
                        }
                        else{
                            $tempo = $usuario2['criacao'];
                            echo $tempo;
                        }
                    ?></label>
                </span>
                <br>
                <span>
                    <label>Status de seu personagem: </label>
                    <?php
                        echo $estado_personagem;
                    ?>
                </span>
                <br>
                <span>
                    <label>Nome de seu Personagem: </label>
                    <span id="medidor2" style="position: absolute; visibility: hidden;"></span>
                        <input type="text" id="campo_personagem" name="campo_personagem" class="campo_personagem" 
                        placeholder=" Dê um nome ao seu personagem" disabled value="<?php echo $row['nome_personagem']; ?>">
                        <img id="alterar2" class="alterar" src="../img/tela Configurações do Perfil/icon alterar.png" alt="Alterar">
                        <button id="confirma2" name="confirma2" class="confirma"></button>
                        <button id="cancelar2" name="cancelar2" class="cancelar"></button>
                </span>
                <label id="erro_tamanho" class="aviso">🛈 Nome seu personagem deve ter no máximo 25 caracteres</label>
                <label id="personagem_valido" class="aviso">🛈 Nome do personagem alterado com sucesso!</label>
                <br>
                <div class="direita">
                    <img id="sair" class="sair" src="../img/tela Configurações do Perfil/deslogar.png" alt="Clique aqui e desconecte">
                </div>
            </div>
        </div>
        <div class="esquerda">
            <button id="excluir" class="excluir">Excluir conta</button>
            <label id="aviso2" class="aviso">Clicando no botão acima<br>Você será desconectado da sua conta</label>
        </div>
    </div>
</body>
</html>
<?php
        if($row_avatar['avatar'] != "0.png"){
            unset($_SESSION['acao_css']);
        }
?>