<?php
    include('CadastroUsuario.php');

    $cadastro = new CadastroUsuario();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["user"];
        $nasc = $_POST["nasc"];
        $recuperar = $_POST["recuperar"];
        $senha = $_POST["senha"];

        // Chame o método cadastrarUsuario e capture o resultado
        $resultado = $cadastro->cadastrarUsuario($user, $nasc, $recuperar, $senha);

        if ($resultado === true) {
            // Sucesso: redirecione para uma página de sucesso ou exiba uma mensagem de sucesso
            $sucesso = "Cadastro realizado com sucesso!";
            echo "<script defer>
            setInterval(function (){
                window.location.href = 'login.php';
            }, 3000)
            </script>";
        } else {
            switch($resultado[0]){
                case "O nome de usuário deve ser preenchido":
                    $campo_user_vazio = $resultado[0];
                break;

                case "O nome de usuário está muito longo":
                    $campo_user_longo = $resultado[0];
                break;

                case "O nome de usuário já está sendo usado":
                    $campo_user_existe = $resultado[0];
                break;

                case "O nome de usuário não pode ser igual ao email de recuperação":
                    $campo_user_igual_recuperar = $resultado[0];
                break;

                case "A data de nascimento deve ser preenchida":
                    $campo_nasc_vazio = $resultado[0];
                break;

                case "A idade inserida não é aceita":
                    $campo_nasc_invalido = $resultado[0];
                break;

                case "O email de recuperação deve ser preenchido":
                    $campo_recuperar_vazio = $resultado[0];
                break;

                case "O email de recuperação inserido não é válido":
                    $campo_recuperar_invalido = $resultado[0];
                break;

                case "O domínio do email de recuperação não é suportado":
                    $campo_recuperar_dominio = $resultado[0];
                break;

                case "A senha deve ter entre 8 e 16 caracteres":
                    $campo_senha_tamanho = $resultado[0];
                break;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/tela Cadastro/icon head.png">
        <link rel="stylesheet" type="text/css" href="../css/cadastro.css">
        <script defer type="text/javascript" src="../js/cadastro.js"></script>
        <!--GOOGLE FONTES -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!--FIM GOOGLE FONTES -->
        <title>Cadastro</title>
    </head>
    <body>
        <div class="container">
            <div class="center">
                <form action="" method="POST">
                    <div class="form_center">
                        <h1>Cadastro</h1>
                        <p></p>
                        <label for="user">Insira seu nome de usuário:</label>
                        <br>
                        <input type="text" id="user" name="user" placeholder="Nome de usuário:" value=
                        "<?php 
                            if(isset($_POST['user'])){ 
                                echo $_POST['user'];
                            }else{
                                echo "";
                            }
                        ?>">
                        <br>
                        <?php
                            if(isset($campo_user_vazio)){
                                echo "<div id='user_aviso' class='aviso'>" . $campo_user_vazio . "</div>";
                            }else if(isset($campo_user_longo)){
                                echo "<div  id='user_aviso' class='aviso'>" . $campo_user_longo . "</div>";   
                            }else if(isset($campo_user_existe)){
                                echo "<div  id='user_aviso' class='aviso'>" . $campo_user_existe . "</div>";   
                            }
                        ?>
                        <br>
                        <label for="nasc">Insira sua data de nascimento:</label>
                        <br>
                        <input type="date" id="nasc" name="nasc" value=
                        "<?php 
                            if(isset($_POST['nasc'])){ 
                                echo $_POST['nasc'];
                            }else{
                                echo "";
                            }
                        ?>">
                        <br>
                        <?php
                            if(isset($campo_nasc_vazio)){
                                echo "<div id='nasc_aviso' class='aviso'>" . $campo_nasc_vazio . "</div>";
                            }
                            else if(isset($campo_nasc_invalido)){
                                echo "<div id='nasc_aviso' class='aviso'>" . $campo_nasc_invalido . "</div>";
                            }
                        ?>
                        <br>
                        <label for="recuperar">Insira seu email de recuperação:</label>
                        <br>
                        <input type="email" id="recuperar" name="recuperar" placeholder="Email de recuperação:" value=
                        "<?php 
                            if(isset($_POST['recuperar'])){ 
                                echo $_POST['recuperar'];
                            }else{
                                echo "";
                            }
                        ?>">
                        <br>
                        <?php
                            if(isset($campo_recuperar_vazio)){
                                echo "<div id='recuperar_aviso' class='aviso'>" . $campo_recuperar_vazio . "</div>";
                            }else if(isset($campo_recuperar_longo)){
                                echo "<div id='recuperar_aviso' class='aviso'>" . $campo_recuperar_longo . "</div>";   
                            }else if(isset($campo_user_igual_recuperar)){
                                echo "<div id='recuperar_aviso' class='aviso'>" . $campo_user_igual_recuperar . "</div>";   
                            }else if(isset($campo_recuperar_dominio)){
                                echo "<div id='recuperar_aviso' class='aviso'>" . $campo_recuperar_dominio . "</div>";   
                            }
                        ?>
                        <br>
                        <label for="senha">Insira sua senha:</label>
                        <br>
                        <span id="visible_password_span">
                            <input type="password" id="senha" name="senha" placeholder="Senha:" value=
                            "<?php 
                                if(isset($_POST['senha'])){ 
                                    echo $_POST['senha'];
                                }else{
                                    echo "";
                                }
                            ?>">
                        </span>
                        <img id="visible_senha" name="visible_senha" src="../img/tela Cadastro/search_invisible.png">
                        </label>
                        <br>
                        <?php
                            if(isset($campo_senha_tamanho)){
                                echo "<div id='senha_aviso' class='aviso'>" . $campo_senha_tamanho . "</div>";
                            }
                        ?>
                        <div class="info">
                            <p>Ao se cadastrar no Orientação 360, você concorda com todos os nossos <a href="termos.php">Termos de Uso</a>.</p>
                        </div>
                        <?php
                            if(isset($sucesso)){
                                echo "<div class='cadastrado'>" . $sucesso . "</div>";
                            }
                        ?>
                        <div class="center2">
                            <input type="submit" id="submit" name="submit" value="Cadastrar">
                        </div>
                        <div class="conecta">
                            <label>Tem uma conta? <a href="login.php">Conecte-se</a></label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="image">
                <img src="../img/tela Cadastro/icon cadastro.png" alt="Icon Cadastro">
            </div>
        </div>
    </body>
</html>