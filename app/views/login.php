<?php $this->view("include/header-login"); ?>

    <!-- Login -->
    <div class="wrapper-page">
        <div style="height: calc(100vh - 400px);" class="centraliza-itens">
            <div style="width: 100%;" class="card card-pages shadow-none">

                <div class="card-body">
                    <div class="text-center m-t-0 m-b-15">
                        <a href="index.html" class="logo logo-admin"><img src="<?= BASE_URL ?>assets/custom/img/logo.png"></a>
                    </div>
                    <h5 style="letter-spacing: 10px;" class="font-18 text-center">MANADA</h5>

                    <form id="formLogin" class="form-horizontal m-t-30">

                        <div class="form-group">
                            <div class="col-12">
                                <label>Email</label>
                                <input required name="email" class="form-control" type="text" required="" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <label>Senha</label>
                                <input required name="senha" class="form-control" type="password" required="" placeholder="Senha">
                            </div>
                        </div>

                        <div class="form-group text-center m-t-20">
                            <div class="col-12">
                                <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

                        <div class="form-group row m-t-30 m-b-0 text-center">
                            <div class="col-sm-12">
                                <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Esqueci minha senha</a>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!-- Fim Login -->

<?php $this->view("include/footer"); ?>
