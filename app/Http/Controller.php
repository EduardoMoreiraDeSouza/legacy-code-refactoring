<?php

namespace App\Http;

use App\Models\Validation;
use League\Plates\Engine;

abstract class Controller
{
    use Validation;
    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__.'/../../resources', 'php');
    }

    public function render(string $name, array $data = []): void
    {
        echo $this->view->render($name, $data);
    }
}
