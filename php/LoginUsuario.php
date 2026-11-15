<?php
    class LoginUsuario {
    // Propriedades da classe
    private $user;
    private $senha;
    private $id;

    // Construtor da classe
    public function __construct($user, $senha, $id) {
        $this->user = $user;
        $this->senha = $senha;
        $this->id = $id;
    }

    // Método estático para buscar um usuário pelo user
    public static function buscarPorUser($user) {
        // Incluir o arquivo de conexão
        include('conexao.php');

        // Preparar a consulta SQL
        $sql_code = "SELECT * FROM usuarios WHERE user = ? LIMIT 1";
        $sql_query = $mysqli->prepare($sql_code) or die ($mysqli->error);
        
        // Vincular o parâmetro user
        $sql_query->bind_param('s', $user);

        // Executar a consulta
        $sql_query->execute();

        // Obter o resultado
        $resultado = $sql_query->get_result();

        // Verificar se encontrou algum registro
        if ($resultado->num_rows == 1) {
        // Obter o registro como um array associativo
        $usuario = $resultado->fetch_assoc();

        // Retornar uma instância da classe Usuario com os dados do registro
        return new LoginUsuario($usuario['user'], $usuario['senha'], $usuario['id']);
        } else {
        // Retornar null se não encontrou nenhum registro
        return null;
        }
    }

    // Método para validar a senha
    public function validarSenha($senha) {
        // Retornar true se a senha for igual à propriedade senha da classe, ou false caso contrário
        return password_verify($senha, $this->senha);
    }

    // Método para iniciar a sessão
    public function iniciarSessao() {
        // Verificar se a sessão não foi iniciada
        if (!isset($_SESSION)) {
        // Iniciar a sessão
        session_start();
        }

        // Atribuir as propriedades user e id às variáveis de sessão
        $_SESSION['nome'] = $this->user;
        $_SESSION['id'] = $this->id;
    }

    // Método para redirecionar para a página correta
    public function redirecionar() {
            // Verificar se o usuário é administrador ou não
            if ($this->id == 1 && $this->user == "Admin@") {
            // Redirecionar para a página de administrador
            header("Location: indexadmin.php");
            } else {
            // Redirecionar para a página de usuário normal
            header("Location: ../index.php");
            }
        }
    }
?>