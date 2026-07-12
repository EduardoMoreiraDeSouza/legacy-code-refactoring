<?php

namespace App\Controllers;

use App\Http\Controller;
use App\Models\Despesa;

class DespesaController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION['id'])) {
            header('Location:'.BASE_URL.'/login');

            exit;
        }
    }

    public function index()
    {
        $data = [];
        $pagamento = new Despesa();
        $data['pagamento'] = $pagamento->formaDePagamento();

        $despesa = new Despesa();
        $data['despesas'] = $despesa->todasDespesas();
        if (!empty($_SESSION['error'])) {
            $data['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        $this->render('despesa', $data);
    }

    public function create()
    {
        $descricao = @$_POST['descricao'];
        $dataVencimento = @$_POST['dataVencimento'];
        $valor = @$_POST['valor'];
        $situacao = @$_POST['situacao'];
        $pagamento = @$_POST['pagamento'];

        if (!empty($descricao) && !empty($dataVencimento) && !empty($valor) && !empty($situacao) && !empty($pagamento)) {
            $despesa = new Despesa();
            $bool = $despesa->adicionarDespesa($descricao, $dataVencimento, $valor, $situacao, $pagamento);
            if (!$bool) {
                $_SESSION['error'] = 'Verifica todos os campos';
                header('Location:'.BASE_URL.'/despesa');

                exit;
            }
            unset($_SESSION['error']);
            header('Location:'.BASE_URL.'/despesa');

            exit;
        }
        $_SESSION['error'] = 'Precisa preencher todos os campos';
        header('Location:'.BASE_URL.'/despesa');

        exit;
    }

    public function edit($req)
    {
        $data = [];
        $id = $req->getAttribute('id');

        if ($id) {
            $despesa = new Despesa();
            $data['despesa'] = $despesa->unicaDespesa($id);

            $pagamento = new Despesa();
            $data['pagamento'] = $pagamento->formaDePagamento();
            if (!empty($_SESSION['error'])) {
                $data['error'] = $_SESSION['error'];
                unset($_SESSION['error']);
            }
            $this->render('edit-despesa', $data);
        } else {
            header('Location:'.BASE_URL.'/despesa');

            exit;
        }
    }

    public function update()
    {
        $id = @$_POST['id'];
        $descricao = @$_POST['descricao'];
        $dataVencimento = @$_POST['dataVencimento'];
        $valor = @$_POST['valor'];
        $situacao = @$_POST['situacao'];
        $pagamento = @$_POST['pagamento'];

        if (!empty($descricao) && !empty($dataVencimento) && !empty($valor) && !empty($situacao) && !empty($pagamento)) {
            $despesa = new Despesa();
            $bool = $despesa->atualizarDespesa($descricao, $dataVencimento, $valor, $situacao, $pagamento, $id);
            if (!$bool) {
                $_SESSION['error'] = 'Verifica todos os campos';
                header('Location:'.BASE_URL.'/edit-despesa/'.$id);

                exit;
            }
            unset($_SESSION['error']);
            header('Location:'.BASE_URL.'/despesa');

            exit;
        }
        $_SESSION['error'] = 'Precisa preencher todos os campos';
        header('Location:'.BASE_URL.'/edit-despesa/'.$id);

        exit;
    }

    public function delete($req)
    {
        $id = $req->getAttribute('id');
        $despesa = new Despesa();
        $despesa->excluirDespesa($id);
        header('Location:'.BASE_URL.'/despesa');

        exit;
    }

    public function pagamento($req, $res, $args)
    {
        $id = $args['id'];
        $despesa = new Despesa();
        $despesa->pagamento($id);
        header('Location:'.BASE_URL.'/despesa');

        exit;
    }
}
