<?php

namespace App\Controllers;

use App\Http\Controller;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function __construct()
    {
        parent ::__construct();
        if (empty($_SESSION['id'])) {
            header('Location:' . BASE_URL . '/login');

            exit;
        }
    }

    public function index()
    {
        $data = [];
        if (!empty($_SESSION['error'])) {
            $data['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        $this -> render('usuario', $data);
    }

    public function create()
    {
        $nome = @$_POST['nome'];
        $email = @$_POST['email'];
        $login = @$_POST['login'];
        $senha = password_hash(@$_POST['senha'], PASSWORD_DEFAULT);
        $celular = @$_POST['celular'];
        if (!empty($nome) && !empty($email) && !empty($login) && !empty($senha)) {
            $usuario = new Usuario();
            $bool = $usuario -> adicionarUsuario($nome, $email, $login, $senha, $celular);

            if (!$bool) {
                $_SESSION['error'] = 'Verifica todos os campos';
                header('Location:' . BASE_URL . '/usuario');

                exit;
            }
            unset($_SESSION['error']);
            header('Location:' . BASE_URL . '/usuario');

            exit;
        }
        $_SESSION['error'] = 'Precisa preencher todos os campos';
        header('Location:' . BASE_URL . '/usuario');

        exit;
    }
}
