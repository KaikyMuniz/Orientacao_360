<?php

include("conexao.php");

class CadastroUsuario {
    private $mysqli;

    public function __construct() {
        // Inicialize a conexão com o banco de dados no construtor
        $this->mysqli = new mysqli("localhost", "root", "", "orientacao_360_bd");
    }

    public function cadastrarUsuario($user, $nasc, $recuperar, $senha) {
        // Verificação de erros
        $erros = [];

        if (empty($user)) {
            $erros[] = "O nome de usuário deve ser preenchido";
        }
        else if (strlen($user) > 32){
            $erros[] = "O nome de usuário está muito longo";
        }

        if (empty($nasc)) {
            $erros[] = "A data de nascimento deve ser preenchida";
        } else {
            $check_date = explode('-', $nasc);
            $ano_atual = date('Y');
            $idade = $ano_atual - intval($check_date[0]);
            if ($idade < 14 || $idade > 100) {
                $erros[] = "A idade inserida não é aceita";
            }
        }

        if (empty($recuperar)) {
            $erros[] = "O email de recuperação deve ser preenchido";
        } else if(strlen($recuperar) > 64){
            $erros[] = "O email de recuperação está muito longo";
        } else if (!filter_var($recuperar, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "O email de recuperação inserido não é válido";
        } else {
            $check_recuperar = explode('@', $recuperar);
            $check_recuperar_remove = explode('.', $check_recuperar[1]);
            $allowed_domains = ["gmail", "hotmail", "outlook", "yahoo", "terra", "icloud"];
            if (!in_array(strtolower($check_recuperar_remove[0]), $allowed_domains)) {
                $erros[] = "O domínio do email de recuperação não é suportado";
            }
        }

        if (strlen($senha) < 8 || strlen($senha) > 16) {
            $erros[] = "A senha deve ter entre 8 e 16 caracteres";
        }

        // Verifica se houve erros
        if (!empty($erros)) {
            return $erros;
        }

        // Verificar se o nome de usuário já existe no banco de dados
        $user = mysqli_real_escape_string($this->mysqli, trim($user));
        $sql = "SELECT count(*) AS total FROM usuarios WHERE user = '$user'";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_assoc();

        if ($row['total'] >= 1) {
            $erros[] = "O nome de usuário já está sendo usado";
            return $erros;
        }

        // Verificar se o nome de usuário é igual ao email de recuperação
        $array_recuperar = explode("@", $recuperar);
        if (strtolower($user) == strtolower($array_recuperar[0]) || $user == $recuperar) {
            $erros[] = "O nome de usuário não pode ser igual ao email de recuperação";
            return $erros;
        }

        // Inserir os dados no banco de dados
        $nascimento = mysqli_real_escape_string($this->mysqli, trim($nasc));
        $recuperar = mysqli_real_escape_string($this->mysqli, trim(password_hash($recuperar, PASSWORD_DEFAULT)));
        $senha =  mysqli_real_escape_string($this->mysqli, trim(password_hash($senha, PASSWORD_DEFAULT)));
        $horaAtual = date('Y-m-d');
        $horaBr = explode('-', $horaAtual);
        $horaFormatada = $horaBr[2] . "/" . $horaBr[1] . "/" . $horaBr[0];

        $sql = "INSERT INTO usuarios (user, nascimento, email_recuperacao, senha, avatar, nome_personagem, criacao) VALUES ('$user', '$nascimento', '$recuperar', '$senha', '0.png', 'Orientaçãozinha', '$horaFormatada')";

        if ($this->mysqli->query($sql) === TRUE) {
            return true;
        } else {
            $erros[] = "Erro ao cadastrar o usuário: " . $this->mysqli->error;
            return $erros;
        }
    }

    public function fecharConexao() {
        // Feche a conexão com o banco de dados quando não for mais necessário
        $this->mysqli->close();
    }
}