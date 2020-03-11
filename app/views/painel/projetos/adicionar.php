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
                    <h4 class="page-title">Projeto</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Manada</a></li>
                        <li class="breadcrumb-item active"><a href="<?= BASE_URL ?>projetos">Projetos</a></li>
                        <li class="breadcrumb-item active">Novo Projeto</li>
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

                        <h4 class="mt-0 header-title">Novo Projeto</h4>
                        <p class="sub-title">No projeto você pode fazer um checklist de equipamentos e funcionarios que estão no projeto.</p>

                        <form id="adicionarProjeto" novalidate="">

                            <div class="row mt-1 mb-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Responsável</label>
                                        <div>
                                            <input name="id_usuario" type="hidden" class="form-control" required value="<?= $usuario->id_usuario ?>">
                                            <input style="opacity: 0.3;color: #fff;" disabled name="responsavel" type="text" class="form-control" value="<?= $usuario->nome ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome do Projeto</label>
                                        <div>
                                            <input name="nome" type="text" class="form-control" required placeholder="Nome do Projeto">
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
                                                <option selected disabled>Selecione</option>
                                                <?php foreach ($clientes as $cliente) : ?>
                                                    <option value="<?= $cliente->id_cliente ?>"><?= $cliente->nome ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Local</label>
                                        <input type="text" placeholder="Ex: Estúdio na Desigual" name="local" required class="form-control" />
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-1 mb-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data de Ida e Volta</label>
                                        <div>
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" required class="form-control" name="data_ida" placeholder="Data de Ida">
                                                <input type="text" required class="form-control" name="data_volta" placeholder="Data de Volta">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Horário</label>
                                        <div>
                                            <input name="horario" required class="form-control" type="time" value="13:45:00" id="example-time-input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-1 mb-1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Observações</label>
                                        <textarea name="observacoes" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="row pt-4">
                                <div class="col-md-12">
                                    <div id="accordion">
                                        <!-- Equipamentos -->
                                        <div class="card mb-0">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0 mt-0 font-14">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="text-dark">
                                                        <div class="mini-stat-icon float-left">
                                                            <i style="font-size: 20px;width: 45px;height: 45px;line-height: 45px;" class="fas fa-camera-retro bg-danger text-white"></i>
                                                        </div> <p style="color: #FC5454 !important;font-weight: 500;font-size: 15px;text-transform: uppercase;position: relative;display: inline; top: 10px; left: 8px">Equipamentos</p>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <?php foreach ($equipamentos as $equipamento) : ?>
                                                        <div class="custom-control semPad custom-checkbox">
                                                            <div class="row">
                                                                <div class="col-md-8 pt-3">
                                                                    <!-- <input type="checkbox" class="custom-control-input" id="customCheckEquipamento<?= $equipamento->id_equipamento ?>" data-parsley-multiple="groups"> -->
                                                                    <label><?= $equipamento->nome ?> / <?= $equipamento->nome_categoria ?></label>
                                                                </div>

                                                                <div class="col-md-4 pt-2">
                                                                    <select name="equipamentos[<?= $equipamento->id_equipamento ?>]" class="form-control">
                                                                        <option value="0" selected disabled>Quantidade</option>
                                                                        <?php for ($i=1; $i<=$equipamento->quantidade; $i++) : ?>
                                                                            <option class="quantidadeCheck" value="<?= $i ?>"><?= $i ?></option>
                                                                        <?php endfor; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Funcionarios -->
                                        <div class="card mb-0">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="mb-0 mt-0 font-14">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" class="text-dark">
                                                        <div class="mini-stat-icon float-left">
                                                            <i style="font-size: 20px;width: 45px;height: 45px;line-height: 45px;" class="fas fa-user-friends bg-primary text-white"></i>
                                                        </div> <p style="color: #6e7ab7 !important;font-weight: 500;font-size: 15px;text-transform: uppercase;position: relative;display: inline; top: 10px; left: 8px">Funcionários</p>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div>
                                                            <?php foreach ($funcionarios as $funcionario) : ?>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input name="funcionarios[]" value="<?= $funcionario->id_funcionario ?>" type="checkbox" class="custom-control-input" id="customCheckFuncionario<?= $funcionario->id_funcionario ?>" data-parsley-multiple="groups">
                                                                    <label class="custom-control-label" for="customCheckFuncionario<?= $funcionario->id_funcionario ?>"><?= $funcionario->nome ?></label>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="form-group m-b-0 mt-4">
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
