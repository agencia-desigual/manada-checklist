<?php $this->view("include/header"); ?>

<div class="wrapper">
    <div class="container-fluid">

        <!-- BREADCUMP-->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Empresa</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Manada</a></li>
                        <li class="breadcrumb-item active"><a href="<?= BASE_URL ?>empresas">Empresas</a></li>
                        <li class="breadcrumb-item active">Novo Empresa</li>
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

                        <h4 class="mt-0 header-title">Editar Empresa</h4>
                        <p class="sub-title">No sistema as empresas poderá apenas ser vinculado aos projetos.</p>

                        <form id="editarEmpresa" novalidate="">
                            <input type="hidden" name="id_cliente" value="<?= $empresa->id_cliente ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <div>
                                            <input name="nome" type="text" class="form-control" required placeholder="Nome da Empresa" value="<?= $empresa->nome ?>">
                                        </div>
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