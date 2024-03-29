<?php $this->view("include/header"); ?>

<div class="wrapper">
    <div class="container-fluid">

        <!-- BREADCUMP-->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Usuário</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Manada</a></li>
                        <li class="breadcrumb-item active"><a href="<?= BASE_URL ?>usuarios">Usuários</a></li>
                        <li class="breadcrumb-item active">Editar Usuário</li>
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

                        <h4 class="mt-0 header-title">Editar Usuário</h4>
                        <p class="sub-title">No sistema um usuário vai ter permissão de adicionar outros usuários, projetos, funcionários, clientes, categorias e equipamentos.</p>

                        <form id="editarUsuario" novalidate="">

                            <input name="id_usuario" type="hidden" value="<?= $usuarios->id_usuario ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome Completo</label>
                                        <div>
                                            <input name="nome" type="text" class="form-control" required placeholder="Nome Completo" value="<?= $usuarios->nome ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div>
                                            <input disabled type="email" class="form-control" required placeholder="Email" value="<?= $usuarios->email ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <div>
                                            <input name="senha" type="password" class="form-control" required placeholder="Senha">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirmar Senha</label>
                                        <div>
                                            <input name="senha_repete" type="password" class="form-control" required placeholder="Confirmar Senha">
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
