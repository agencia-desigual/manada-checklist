<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Invoice - Fatura</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/plugins/bootstrap/css/bootstrap.min.css" />
<body>

<div class="container">

    <div class="page-header">
        <div class="row">
            <div class="col-md-12">
                <img src="<?= BASE_URL; ?>assets/custom/img/logo-preta.png">
            </div>

            <div class="col-sm-12">
                <h3 style="padding-top: 15px">
                    <?= $projeto->nome; ?> <br>
                    <small>
                        <span style="font-style: italic;">Responsável: </span> <?= $responsavel->nome; ?>
                    </small>
                </h3>
            </div>
        </div>
    </div>

    <!-- Simple Invoice - START -->
    <div class="row">
        <!-- Informações -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-6" style="width: 50%; float:left;">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Informações do Projeto</div>
                        <div class="panel-body">
                            <strong><?= $cliente->nome; ?></strong><br>
                            <small>Local:</small> <?= $projeto->local; ?><br><br>

                            <?php if(!empty($projeto->observacoes)): ?>
                                <?= $projeto->observacoes; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6" style="width: 50%; float:left;">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Datas e Horas</div>
                        <div class="panel-body">
                            <strong>Saída:</strong> <?= date("d/m/Y", strtotime($projeto->data_ida)); ?><br>
                            <strong>Volta:</strong> <?= date("d/m/Y", strtotime($projeto->data_volta)); ?><br>
                            <strong>Horário:</strong> <?= date("H:i", strtotime($projeto->horario)); ?><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabela -->
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Equipamentos <small><?= $total; ?></small></h4>

                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Produto</strong></td>
                                <td class="text-center"><strong>Categoria</strong></td>
                                <td class="text-center"><strong>Quantidade</strong></td>
                                <td class="text-right"><strong>Devolvido</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($equipamentos as $eq): ?>
                                <tr>
                                    <td><?= $eq->equipamento->nome; ?></td>
                                    <td class="text-center"><?= $eq->categoria->nome; ?></td>
                                    <td class="text-center"><?= $eq->quantidade ?></td>
                                    <td class="text-right"></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Funcionarios</h4>

                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Nome</strong></td>
                                <td class="text-center"><strong>Cargo</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($funcionarios as $fun): ?>
                                <tr>
                                    <td><?= $fun->funcionario->nome; ?></td>
                                    <td class="text-center"><?= $fun->funcionario->cargo; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assinatura -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7" style="width: 60%; float:left;">
                    <hr style="border-color: #000; margin-bottom: 6px; margin-top: 60px;">
                    <p style="text-align: center;">Assinatura do Responsável</p>
                </div>

                <div class="col-md-5" style="width: 40%; float:left;">
                    <hr style="border-color: #000; margin-bottom: 6px; margin-top: 60px;">
                    <p style="text-align: center;">Assinatura de Devolução / Data</p>
                </div>
            </div>
        </div>
    </div>


    <style>
        .table > tbody > tr > .highrow {
            border-top: 3px solid;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(() => {
            window.print();

            window.addEventListener('afterprint', (event) => {
                window.close();
            });
        });
    </script>
</div>
</body>
</html>