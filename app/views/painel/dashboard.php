<?php $this->view("include/header"); ?>

    <div class="wrapper">
        <div class="container-fluid">

            <!-- BREADCUMP-->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Manada</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- FIM BREADCUMP-->

            <!-- CARDS-->
            <div class="row">

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="far fa-user bg-success text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">Usuários</h5>
                            </div>
                            <h3 class="mt-4"><?= $qtdeUsuarios ?></h3>
                            <p class="text-muted mt-2 mb-0">Usuários ativos</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="fas fa-user-friends bg-primary text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">Funcionários</h5>
                            </div>
                            <h3 class="mt-4"><?= $qtdeFuncionarios ?></h3>
                            <p class="text-muted mt-2 mb-0">Funcionários ativos</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="fas fa-camera-retro bg-danger text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">Equipamentos</h5>
                            </div>
                            <h3 class="mt-4"><?= $qtdeEquipamentos ?></h3>
                            <p class="text-muted mt-2 mb-0">Todos equipamentos</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="fas fa-list-ol bg-warning text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">Projetos</h5>
                            </div>
                            <h3 class="mt-4"><?= $qtdeProjetos ?></h3>
                            <p class="text-muted mt-2 mb-0">Todos projetos</p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- FIM CARDS-->

            <div class="row">

                <!-- EQUPAMENTOS -->
                <div class="col-xl-6">
                    <div class="card m-b-30">
                        <div style="min-height: 380px;" class="card-body">
                            <h4 class="mt-0 header-title mb-4">EQUIPAMENTOS</h4>
                            <div class="friends-suggestions">
                                <?php if(!empty($equipamentos)): ?>
                                    <?php foreach ($equipamentos as $equipamento) : ?>

                                        <a href="<?= BASE_URL; ?>equipamento/<?= $equipamento->id_equipamento ?>" class="friends-suggestions-list">
                                            <div class="border-bottom position-relative">
                                                <div class="float-left mb-0 mr-3">
                                                    <img src="<?= $equipamento->perfil ?>" alt="<?= $equipamento->nome ?>" class="rounded-circle thumb-md">
                                                </div>
                                                <div class="suggestion-icon float-right mt-2 pt-1">
                                                    <i class="fas fa-eye"></i>
                                                </div>

                                                <div class="desc">
                                                    <h5 class="font-14 mb-1 pt-2"><?= $equipamento->nome ?></h5>
                                                    <p class="text-muted"><?= $equipamento->categoria_nome ?></p>
                                                </div>
                                            </div>
                                        </a>

                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Não possui equipamentos cadastrados.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM EQUPAMENTOS -->

                <!-- PROJETO -->
                <div class="col-xl-6">
                    <div class="card m-b-30">
                        <div style="min-height: 380px;" class="card-body">
                            <h4 class="mt-0 header-title mb-4">PROJETO RECENTE</h4>

                            <?php if(!empty($projeto)): ?>
                                <ol class="activity-feed mb-0">
                                    <li class="feed-item">
                                        <div class="feed-item-list">
                                            <p class="text-muted mb-1"><b>IDA</b> <?= $projeto->data_ida ?> às <?= $projeto->horario ?></p>
                                        </div>
                                    </li>

                                    <li class="feed-item">
                                        <div class="feed-item-list">
                                            <p class="text-muted mb-1">PROJETO</p>
                                            <p class="font-15 mt-0 mb-0"><?= $projeto->nome_cliente ?> - <?= $projeto->nome ?></b></p>
                                        </div>
                                    </li>

                                    <?php if (!empty($projeto->local)) : ?>
                                        <li class="feed-item">
                                            <div class="feed-item-list">
                                                <p class="text-muted mb-1">LOCAL</p>
                                                <p class="font-15 mt-0 mb-0"><?=  substr($projeto->local, 0,50 )."..." ?> </b></p>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (!empty($projeto->observacoes)) : ?>
                                        <li class="feed-item">
                                            <div class="feed-item-list">
                                                <p class="text-muted mb-1">OBSERVAÇÕES</p>
                                                <p class="font-15 mt-0 mb-0"><?=  substr($projeto->observacoes, 0,100 )."..." ?> </b></p>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <li class="feed-item">
                                        <div class="feed-item-list">
                                            <p class="text-muted mb-1"><b>VOLTA</b> <?= $projeto->data_volta ?></p>
                                        </div>
                                    </li>

                                </ol>
                            <?php else: ?>
                                <p>Não possui projeto cadastrado.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- FIM PROJETO -->

            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end wrapper -->

<?php $this->view("include/footer"); ?>
