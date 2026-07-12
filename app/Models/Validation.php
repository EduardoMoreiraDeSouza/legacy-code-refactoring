<?php

namespace App\Models;

trait Validation
{
    public function redirect(
        string $url
    ): void {
        if ('home' !== $url) {
            header('Location:'.BASE_URL.'/'.$url);

            exit;
        }

        header('Location:'.BASE_URL);

        exit;
    }

    public function destroySession(
    ): void {
        if (!empty($_SESSION['id'])) {
            unset($_SESSION['id'], $_SESSION['login']);

            $this->redirect('home');
        }
    }
}
