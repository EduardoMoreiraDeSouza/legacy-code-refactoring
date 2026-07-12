<?php

namespace App\Controllers;

use App\Http\Controller;
use App\Database\MySQL;

class LoginController extends Controller
{
    public function index()
    {
        $this->render('login');
    }

    public function logIn()
    {   $data = [];
        $login = @$_POST['login'];
        $senha = @$_POST['senha'];

        $sql = "SELECT * FROM usuario WHERE `login` = :login";
        $query = MySQL::getInstancia()->prepare($sql);
        $query->bindValue(':login',$login);
        $query->execute();
        if ($query->rowCount() > 0) {
            $dados = $query->fetch();
            if (password_verify($senha,$dados['senha'])) {
                $_SESSION['id'] = $dados['id'];
                $_SESSION['login'] = $dados['login'];
                header('Location:'.BASE_URL);die();
            } else {
                $data['msg'] = "Usuário e/ou senha invalido";
            }
        } else {
            $data['msg'] = "Usuário e/ou senha invalido";
        }
        
        $this->render('login',$data);
    }

    public function logout()
    {
        if (!empty($_SESSION['id'])) {
            unset($_SESSION['id']);
            unset($_SESSION['login']);
            header('Location:'.BASE_URL);die();
        }
    }
}