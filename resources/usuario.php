<?php $this->layout('templates/dashboard',['title'=>'Usuário','subtitle'=>'Cadastro']) ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($error)):?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <span><?=$error;?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-material" action="<?=BASE_URL;?>/cad-usuario" method="POST" autocomplete="off">
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0" for="nome">Nome Completo</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" placeholder="Johnathan Doe" name="nome" id="nome"
                                class="form-control p-0 border-0"> </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="email" class="col-md-12 p-0">E-mail</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="email" placeholder="johnathan@admin.com"
                                class="form-control p-0 border-0" name="email"
                                id="email">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0" for="login">Login</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" placeholder="Paul" name="login" class="form-control p-0 border-0" id="login">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0" for="senha">Senha</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="password" name="senha" class="form-control p-0 border-0" id="senha">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Celular</label>
                        <div class="col-md-12 border-bottom p-0" for="celular">
                            <input type="text" placeholder="(99) 99999-9999" name="celular" id="celular"
                                class="form-control p-0 border-0">
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>