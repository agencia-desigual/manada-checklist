<?php $this->view("include/header"); ?>

<div class="wrapper">
    <div class="container-fluid">

        <!-- BREADCUMP-->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Funcionários</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Manada</a></li>
                        <li class="breadcrumb-item active">Funcionários</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- FIM BREADCUMP-->

        <!-- TABELA -->
        <div class="row">
            <div class="col-xl-12">
                <div class="centraliza-itens">
                    <div>
                        <a href="<?= BASE_URL; ?>funcionario/adicionar/" class="btn btn-info btn-lg waves-effect waves-light">Novo Funcionário</a>
                    </div>
                </div>
                <br>
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover js-exportable">
                                <thead>
                                <tr>
                                    <th scope="col">NOME</th>
                                    <th scope="col">CARGO</th>
                                    <th scope="col">PERFIL</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">AÇÕES</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($funcionarios as $funcionario) : ?>
                                    <tr id="funcionario-<?= $funcionario->id_funcionario ?>">
                                        <td><?= $funcionario->nome ?></td>
                                        <td><?= $funcionario->cargo ?></td>
                                        <td><img src="<?= $funcionario->perfil ?>" width="50px"></td>
                                        <?php if ($funcionario->status == 0) : ?>
                                            <td><span class="badge badge-danger">Inativo</span></td>
                                        <?php else : ?>
                                            <td><span class="badge badge-success">Ativo</span></td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="#ExcluirFuncionario" class="apagarFuncionario" data-id="<?= $funcionario->id_funcionario ?>" > <i style="font-size: 25px;color: #b70a0a;margin-right: 15px;margin-left: -10px;" class="far fa-trash-alt"></i></a>
                                            <a href="<?= BASE_URL; ?>funcionario/editar/<?= $funcionario->id_funcionario ?>"> <i style="font-size: 25px;color: #0a67b7;" class="far fa-edit"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- FIM TABELA -->

    </div>
    <!-- end container-fluid -->
</div>
<!-- end wrapper -->

<?php $this->view("include/footer"); ?>
