<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/tela Login/icon head.png">
        <link rel="stylesheet" type="text/css" href="../css/login.css">
        <script defer type="text/javascript" src="../js/login.js"></script>
        <!--GOOGLE FONTES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
        <!--FIM GOOGLE FONTES -->
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="image">
                <img src="../img/tela Login/icon login.png" alt="Icon Login">
            </div>
            <div class="center">
                <form action="" method="POST">
                    <h1>Login</h1>
                    <p id="erro"></p>
                    <label for="user">Nome de usuário:</label>
                    <br>
                    <input type="text" id="user" name="user" placeholder="Insira seu nome de usuário:" value=
                        "<?php 
                            if(isset($_POST['user'])){ 
                                echo $_POST['user'];
                            }else{
                                echo "";
                            }
                        ?>">
                    <div class="aviso" id="erro_geral" style="display: none">Erro genérico.</div>
                    <p></p>
                    <label for="senha">Senha:</label>
                    <br>
                    <span id="senha_visible_span">
                        <input type="password" id="senha" name="senha" placeholder="Insira sua senha:" value=
                        "<?php 
                            if(isset($_POST['senha'])){ 
                                echo $_POST['senha'];
                            }else{
                                echo "";
                            }
                        ?>">
                        <img id="visible_senha" src="../img/tela Login/search_invisible.png">
                    </span>
                    <div class="aviso" id="erro_geral_senha" style="display: none">Erro genérico.</div>
                    <a href="esqueceuasenha.php">Esqueci a senha</a>
                    <br>
                    <div class="center2">
                        <button id="submit">Logar</button>
                    </div>
                    <br>
                    <label>É novo(a) por aqui? Cadastre-se abaixo:</label>
                    <p></p>
                        <a href="cadastro.php">Clique aqui e realize seu cadastro!</a>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
// Incluir o arquivo da classe Usuario
    if (isset($_POST["user"]) && isset($_POST["senha"])) {
        // Obter os dados do formulário
        $user = $_POST["user"];
        $senha = $_POST["senha"];

        if(empty($user)){
            echo "<script> 
                document.addEventListener('DOMContentLoaded', function(){
                    var erroGeral = document.getElementById('erro_geral');
                    var erroGeralSenha = document.getElementById('erro_geral_senha');
                    erroGeral.textContent = '🛈 Esse campo não pode estar vazio';
                    erroGeral.style.display = 'block';
                    erroGeralSenha.style.display = 'none';
                });
            </script>";
            }else if (strlen($senha) < 8 || strlen($senha) > 16){
                echo "<script> 
                    document.addEventListener('DOMContentLoaded', function(){
                        var erroGeral = document.getElementById('erro_geral');
                        var erroGeralSenha =document.getElementById('erro_geral_senha');
                        erroGeralSenha.textContent = '🛈 Verifique o número de caracteres da senha';
                        erroGeral.style.display = 'none';
                        erroGeralSenha.style.display = 'block';
                    });
                </script>";
            }
            include('LoginUsuario.php');
            
            // Buscar um usuário pelo user
            $usuario = LoginUsuario::buscarPorUser($user);

            // Verificar se encontrou algum usuário
            if ($usuario != null) {
                // Validar a senha
                if ($usuario->validarSenha($senha)) {
                    // Iniciar a sessão
                    $usuario->iniciarSessao();

                    // Redirecionar para a página correta
                    $usuario->redirecionar();
                    } else {
                        // Senha incorreta
                        echo "<script>
                            var erroGeral = document.getElementById('erro_geral');
                            var erroGeralSenha =document.getElementById('erro_geral_senha');
                            erroGeral.textContent = '🛈 O nome de usuário ou a senha estão incorretos';
                            erroGeral.style.display = 'block';
                            erroGeralSenha.style.display = 'none';
                            </script>";
                    }
                } else {
                    // Usuário não encontrado
                    echo "<script>
                            var erroGeral = document.getElementById('erro_geral');
                            var erroGeralSenha =document.getElementById('erro_geral_senha');
                            erroGeral.textContent = '🛈 O nome de usuário ou a senha estão incorretos';
                            erroGeral.style.display = 'block';
                            erroGeralSenha.style.display = 'none';
                        </script>;";
                }
                echo "<script>
                // Obtenha referências aos elementos HTML
                let campoUser = document.getElementById('user');
                let campoSenha = document.getElementById('senha');
                let erroGeral = document.getElementById('erro_geral');
                let erroGeralSenha = document.getElementById('erro_geral_senha');
        
                // Adicione um ouvinte de eventos para os campos de entrada de usuário e senha
                campoUser.addEventListener('input', function() {
                    // Oculte o erro geral
                    erroGeral.style.display = 'none';
                });
        
                campoSenha.addEventListener('input', function() {
                    // Oculte o erro geral de senha
                    erroGeralSenha.style.display = 'none';
                });
                </script>";
    }
?>