<?php $this->view("include/header"); ?>

<div class="wrapper">
    <div class="container-fluid">

        <!-- BREADCUMP-->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Equipamentos</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Manada</a></li>
                        <li class="breadcrumb-item active">Equipamentos</li>
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
                        <a href="<?= BASE_URL; ?>equipamento/adicionar/" class="btn btn-info btn-lg waves-effect waves-light">Novo Equipamento</a>
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
                                    <th scope="col">CATEGORIA</th>
                                    <th scope="col">IMAGEM</th>
                                    <th scope="col">QUANTIDADE</th>
                                    <th scope="col">AÇÕES</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($equipamentos as $equipamento) : ?>
                                    <tr id="equipamento-<?= $equipamento->id_equipamento ?>">
                                        <td><?= $equipamento->nome ?></td>
                                        <td><?= $equipamento->categoria ?></td>
                                        <td><img src="<?= $equipamento->perfil ?>" width="50px"></td>
                                        <td><?= $equipamento->quantidade ?></td>
                                        <td>
                                            <a href="#ExcluirEquipamento" class="apagarEquipamento" data-id="<?= $equipamento->id_equipamento ?>" > <i style="font-size: 25px;color: #b70a0a;margin-right: 15px;margin-left: -10px;" class="far fa-trash-alt"></i></a>
                                            <a href="<?= BASE_URL; ?>equipamento/editar/<?=$equipamento->id_equipamento ?>"> <i style="font-size: 25px;color: #0a67b7;" class="far fa-edit"></i></a>
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
