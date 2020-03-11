<?php $this->view("include/header"); ?>


<style>
    .datepicker table tr td span.focused, .datepicker table tr td span:hover
    {
        background: #02C58D !important;
    }
    .datepicker table tr td.active.active
    {
        background: #02C58D !important;
    }
    .datepicker .datepicker-switch:hover
    {
        background: #30419B !important;
    }
    .datepicker table tr td.day:hover
    {
        background: #30419B !important;
    }
    .datepicker table tr td.range
    {
        background: #30419B !important;
    }
    .datepicker table tr td.selected
    {
        background: #02C58D !important;
    }
    .custom-control-label::before
    {
        background: #fff;
    }
    .custom-control
    {
        position: relative;
        display: block;
        min-height: 1.5rem;
        padding-left: 1.5rem;
        font-size: 18px;
        margin-bottom: 10px;
        border-bottom: 1px solid #3c3f61;
        margin-top: 10px;
        padding-bottom: 15px;
    }

    .custom-control.semPad
    {
        padding-left: 0px;
    }
</style>

<div class="wrapper">
    <div class="container-fluid">

        <!-- BREADCUMP-->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Alterar Projeto</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Manada</a></li>
                        <li class="breadcrumb-item active"><a href="<?= BASE_URL ?>projetos">Projetos</a></li>
                        <li class="breadcrumb-item active">Alterar Projeto</li>
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

                        <form id="alterarProjeto" data-id="<?= $projeto->id_projeto; ?>">

                            <div class="row mt-1 mb-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Responsável</label>
                                        <div>
                                            <p><?= $responsavel->nome; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome do Projeto</label>
                                        <div>
                                            <input name="nome" type="text" value="<?= $projeto->nome; ?>" class="form-control" required placeholder="Nome do Projeto">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-1 mb-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <div>
                                            <select name="id_cliente" required class="form-control">
                                                <?php foreach ($clientes as $cliente) : ?>
                                                    <option value="<?= $cliente->id_cliente ?>" <?php if($cliente->id_cliente == $projeto->id_cliente){echo "selected";} ?>>
                                                        <?= $cliente->nome ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Local</label>
                                        <input type="text" placeholder="Ex: Estúdio na Desigual" value="<?= $projeto->local; ?>" name="local" required class="form-control" />
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-1 mb-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data de Ida e Volta</label>
                                        <div>
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" required class="form-control" value="<?= $projeto->data_ida; ?>" name="data_ida" placeholder="Data de Ida">
                                                <input type="text" required class="form-control" value="<?= $projeto->data_volta; ?>" name="data_volta" placeholder="Data de Volta">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Horário</label>
                                        <div>
                                            <input name="horario" required class="form-control" type="time" value="<?= $projeto->horario; ?>" id="example-time-input">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-1 mb-1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observações</label>
                                        <textarea name="observacoes" class="form-control"><?= $projeto->observacoes; ?></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group m-b-0 mt-4">
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
