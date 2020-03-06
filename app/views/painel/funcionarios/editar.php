<?php $this->view("include/header"); ?>

<div class="wrapper">
    <div class="container-fluid">

        <!-- BREADCUMP-->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Funcionário</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Manada</a></li>
                        <li class="breadcrumb-item active"><a href="<?= BASE_URL ?>funcionarios">Funcionários</a></li>
                        <li class="breadcrumb-item active">Novo Funcionário</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- FIM BREADCUMP-->

        <!-- FORMULARIO -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Novo Funcionário</h4>
                        <p class="sub-title">No sistema os funcionários poderá apenas ser vinculado aos projetos.</p>

                        <form id="editarFuncionario" novalidate="">

                            <input type="hidden" name="id_funcionario" value="<?= $funcionario->id_funcionario ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome Completo</label>
                                        <div>
                                            <input name="nome" type="text" class="form-control" required placeholder="Nome Completo" value="<?= $funcionario->nome ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <div>
                                            <input name="cargo" type="text" class="form-control" required placeholder="Cargo" value="<?= $funcionario->cargo ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <label>Imagem de perfil</label>
                                    <input name="perfil" type="file" id="input-file-now" class="dropify">
                                </div>
                            </div>

                            <div class="form-group">

                                <label>Status</label>
                                <div>
                                    <div class="custom-control custom-checkbox">
                                        <?php if ($funcionario->status == 0) : ?>
                                            <input name="status" type="checkbox" class="custom-control-input" id="customCheck1">
                                        <?php else: ?>
                                            <input name="status" type="checkbox" class="custom-control-input" id="customCheck1" checked>
                                        <?php endif; ?>
                                        <label class="custom-control-label" for="customCheck1">Ativo?</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Alterar
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- FIM FORMULARIO -->

    </div>
    <!-- end container-fluid -->
</div>
<!-- end wrapper -->

<?php $this->view("include/footer"); ?>