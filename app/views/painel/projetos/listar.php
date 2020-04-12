<?php $this->view("include/header"); ?>

<div class="wrapper">
    <div class="container-fluid">

        <!-- BREADCUMP-->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Projetos</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Manada</a></li>
                        <li class="breadcrumb-item active">Projetos</li>
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
                        <a href="<?= BASE_URL; ?>projeto/adicionar/" class="btn btn-info btn-lg waves-effect waves-light">Novo Projeto</a>
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
                                    <th scope="col">CLIENTE</th>
                                    <th scope="col">DATA IDA</th>
                                    <th scope="col">DATA VOLTA</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">AÇÕES</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($projetos as $projeto) : ?>
                                    <tr id="projeto-<?= $projeto->id_projeto ?>">
                                        <td><?= $projeto->nome ?></td>
                                        <td><?= $projeto->nome_cliente ?></td>
                                        <td><?= $projeto->data_ida ?></td>
                                        <td><?= $projeto->data_volta ?></td>
                                        <?php if ($projeto->status == 0) : ?>
                                            <td><span class="badge badge-danger">Encerrado</span></td>
                                        <?php else : ?>
                                            <td><span class="badge badge-success">Ativo</span></td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="#" class="apagarProjeto" data-id="<?= $projeto->id_projeto ?>"> <i style="font-size: 25px;color: #b70a0a;margin-right: 15px;margin-left: -10px;" class="far fa-trash-alt"></i></a>
                                            <a href="<?= BASE_URL; ?>projeto/editar/<?= $projeto->id_projeto ?>"> <i style="font-size: 25px;color: #0a67b7;" class="far fa-edit"></i></a>
                                            <a href="<?= BASE_URL; ?>projeto/imprimir/<?= $projeto->id_projeto ?>" title="Imprimir" target="_blank">
                                                <i style="font-size: 27px; color: #0a67b7; padding-left: 7px" class="mdi mdi-cloud-print-outline"></i>
                                            </a>
                                            <a href="#" class="duplicarProjeto" data-id="<?= $projeto->id_projeto ?>"> <i style="font-size: 25px;color: #0a67b7;margin-right: 15px;margin-left: 10px;" class="far fa-copy"></i></a>
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
