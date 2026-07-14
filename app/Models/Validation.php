<?php

namespace App\Models;

trait Validation
{
    public function redirect(
        string $url
    ): void {
        if ('home' !== $url) {
            header('Location:' . BASE_URL . '/' . $url);

            exit;
        }

        header('Location:' . BASE_URL);

        exit;
    }

    public function destroySession(): void
    {
        if (!empty($_SESSION['id'])) {
            unset($_SESSION['id'], $_SESSION['login']);

            $this -> redirect('home');
        }
    }

    public function validarDados(array $campos): void
    {
        foreach ($campos as $name => $required) {
            if (empty($_POST[$name] && $required === 'required')) {
                $_SESSION['tipo'] = 'danger';
                $_SESSION['campo'] = $name;
                $_SESSION['validar'] = true;
                break;
            }
        }

        $this->setDadosPost($campos);
    }

    public function flashMensagem(): array
    {
        $msg = [];
        if (!empty($_SESSION['tipo']) && $_SESSION['tipo'] === 'danger') {
            $campo = $_SESSION['campo'];
            $msg = ['tipo' => 'danger', 'mensagem' => 'Preencha o campo "' . strtoupper($campo) . '" e tente novamente!'];

            $this -> limparSession();
        }

        if (!empty($_SESSION['tipo']) && $_SESSION['tipo'] === 'success') {
            $msg = ['tipo' => 'success', 'mensagem' => 'Dados registrados com sucesso!'];
            $this -> limparSession();
        }

        return $msg;
    }

    private function limparSession(): void
    {
        unset($_SESSION['tipo']);
        unset($_SESSION['campo']);
    }

    public function validarTemError(): bool
    {
        if (!empty($_SESSION['validar'])) {
            unset($_SESSION['validar']);
            return true;
        }

        return false;
    }

    public function getDadosPost(): array
    {
        $data = [
            'nome' => '',
            'email' => '',
            'login' => '',
            'senha' => '',
            'telefone' => '',
        ];

        foreach ($_SESSION as $key => $value) {
            if ($key !== 'id' && $key !== 'usuario_logado') {
                $data[$key] = $value;
                unset($_SESSION[$key]);
            }
        }

        return $data;
    }

    private function setDadosPost(array $data): void
    {
        if (!empty($_SESSION['tipo']) && $_SESSION['tipo'] !== 'success') {
            foreach ($data as $key => $value) {
                $_SESSION[$key] = $_POST[$key];
            }
        }
    }
}
