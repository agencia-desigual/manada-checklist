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
                        <li class="breadcrumb-item active"><a href="<?= BASE_URL ?>equipamentos">Equipamentos</a></li>
                        <li class="breadcrumb-item active">Novo Equipamento</li>
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

                        <h4 class="mt-0 header-title">Novo Equipamento</h4>
                        <p class="sub-title">No sistema os equipamentos poderá apenas ser vinculado aos projetos.</p>

                        <form id="adicionarEquipamento" novalidate="">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <div>
                                            <input name="nome" type="text" class="form-control" required placeholder="Nome">
                                        </div>
                                    </div>
                                </div>

                                <!-- SELECIONAR CATEGORIA -->
                                <div id="selecionarCategoria" class="col-md-4">
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <label class="novaCategoria" style="float: right; color: #24d424; cursor: pointer">NOVA CATEGORIA</label>
                                        <div id="lista-categoria">
                                            <select name="id_categoria" id="id_categoria" class="form-control">
                                                <option value="" selected disabled>Selecione</option>
                                                <?php foreach ($categorias as $categoria) : ?>
                                                    <option value="<?= $categoria->id_categoria ?>"><?= $categoria->nome ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- FIM SELECIONAR CATEGORIA -->

                                <!-- NOVA CATEGORIA -->
                                <div id="novaCategoria" style="display: none" class="col-md-4">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <label class="selecioneCategoria" style="float: right; color: #24d424; cursor: pointer">SELECIONE UMA CATEGORIA</label>
                                        <div>
                                            <input name="nome-categoria" type="text" class="form-control nomeCategoria" required placeholder="Nova categoria">
                                        </div>
                                    </div>
                                </div>
                                <!-- FIM NOVA CATEGORIA -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Quantidade</label>
                                        <div>
                                            <select name="quantidade" class="form-control">
                                                <option selected disabled>Selecione</option>
                                                <?php for ($i=1;$i<=15;$i++): ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <label>Imagem do Equipamento</label>
                                    <input name="perfil" type="file" id="input-file-now" class="dropify">
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Cadastrar
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
