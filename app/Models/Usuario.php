<?php

namespace App\Models;

use App\Database\MySQL;

class Usuario
{
    use Validation;

    public function login(
        string $login,
        string $senha
    )
    {
        $sql = 'SELECT * FROM usuario WHERE `login` = :login';
        $query = MySQL ::getInstancia() -> prepare($sql);
        $query -> bindValue(':login', $login);
        $query -> execute();

        if ($query -> rowCount() > 0) {
            $dados = $query -> fetch();
            if (password_verify($senha, $dados['senha'])) {
                $_SESSION['id'] = $dados['id'];
                $_SESSION['usuario_logado'] = $dados['login'];
                $this -> redirect('home');

                exit;
            }
        }

        return 'Usuário e/ou senha invalido';
    }

    public function adicionarUsuario(
        string $nome,
        string $email,
        string $login,
        string $senha,
        string $telefone
    ): bool {
        $sql = 'INSERT INTO usuario (nome_completo, email, login, senha, telefone)
        VALUES (:nome, :email, :login, :senha, :celular);';

        $query = MySQL ::getInstancia() -> prepare($sql);

        $query -> bindValue(':nome', $nome);
        $query -> bindValue(':email', $email);
        $query -> bindValue(':login', $login);
        $query -> bindValue(':senha', $senha);
        $query -> bindValue(':celular', $telefone);

        return $query -> execute();
    }
}
