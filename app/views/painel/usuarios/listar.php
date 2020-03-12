<?php $this->view("include/header"); ?>

<div class="wrapper">
    <div class="container-fluid">

        <!-- BREADCUMP-->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Usuários</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Manada</a></li>
                        <li class="breadcrumb-item active">Usuários</li>
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
                        <a href="<?= BASE_URL; ?>usuario/adicionar/" class="btn btn-info btn-lg waves-effect waves-light">Novo Usuário</a>
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
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">PERFIL</th>
                                    <th scope="col">AÇÕES</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($usuarios as $user) : ?>
                                    <tr id="usuario-<?= $user->id_usuario ?>">
                                        <td><?= $user->nome ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><img src="<?= $user->perfil ?>" width="50px"></td>
                                        <td>
                                            <a href="#ExcluirUsuario" class="apagarUsuario" data-id="<?= $user->id_usuario ?>" > <i style="font-size: 25px;color: #b70a0a;margin-right: 15px;margin-left: -10px;" class="far fa-trash-alt"></i></a>
                                            <a href="<?= BASE_URL; ?>usuario/editar/<?= $user->id_usuario ?>"> <i style="font-size: 25px;color: #0a67b7;" class="far fa-edit"></i></a>
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
