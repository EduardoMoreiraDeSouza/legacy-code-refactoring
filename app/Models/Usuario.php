<?php

namespace App\Models;

use App\Database\MySQL;

class Usuario
{
    use Validation;

    public function login(
        string $login,
        string $senha
    ) {
        $sql = 'SELECT * FROM usuario WHERE `login` = :login';
        $query = MySQL::getInstancia()->prepare($sql);
        $query->bindValue(':login', $login);
        $query->execute();

        if ($query->rowCount() > 0) {
            $dados = $query->fetch();
            if (password_verify($senha, $dados['senha'])) {
                $_SESSION['id'] = $dados['id'];
                $_SESSION['login'] = $dados['login'];
                $this->redirect('home');

                exit;
            }
        }

        return 'Usuário e/ou senha invalido';
    }
}
