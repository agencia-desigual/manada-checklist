<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Manada | Gerenciamento de equipamentos</title>
    <link rel="shortcut icon" href="<?= BASE_URL ?>assets/custom/img/logo.png">

    <!-- Morris Chart CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/theme/plugins/morris/morris.css">

    <link href="<?= BASE_URL ?>assets/theme/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL ?>assets/theme/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL ?>assets/theme/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL ?>assets/theme/css/style.css" rel="stylesheet" type="text/css">

    <!-- Autoload CSS ================================================= -->
    <?php $this->view("autoload/css") ?>
</head>

<body>

<!-- header -->
<div class="header-bg">
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo-->
                <div>
                    <a href="index.html" class="logo">
                                <span class="logo-light" style="letter-spacing: 10px">
                                    <img width="45px" src="<?= BASE_URL; ?>assets/custom/img/logo.png"/> <p style="display: inline;position: relative;top: 5px;left: 5px;">MANADA</p>
                                </span>
                    </a>
                </div>
                <!-- End Logo-->

                <div class="menu-extras topbar-custom navbar p-0">

                    <ul class="navbar-right ml-auto list-inline float-right mb-0">

                        <!-- full screen -->
                        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                            <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                                <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                            </a>
                        </li>

                        <li class="dropdown notification-list list-inline-item">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="<?= $usuario->perfil ?>" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> Perfil</a>
                                    <a class="dropdown-item text-danger" href="<?= BASE_URL; ?>sair"><i class="mdi mdi-power text-danger"></i> Sair</a>
                                </div>
                            </div>
                        </li>

                        <li class="menu-item dropdown notification-list list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                    </ul>

                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div>
            <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <!-- MENU Start -->
        <div class="navbar-custom">
            <div class="container-fluid">

                <div id="navigation">

                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">

                        <li class="has-submenu">
                            <a href="<?= BASE_URL ?>"><i class="icon-accelerator"></i> Dashboard</a>
                        </li>

                        <li class="has-submenu">
                            <a href="<?= BASE_URL; ?>usuarios"><i class="far fa-user"></i> Usuários </a>
                        </li>

                        <li class="has-submenu">
                            <a href="<?= BASE_URL ?>funcionarios"><i class="fas fa-user-friends"></i> Funcionários </a>
                        </li>

                        <li class="has-submenu">
                            <a href="<?= BASE_URL ?>empresas"><i class="fas fa-industry"></i> Empresas </a>
                        </li>

                        <li class="has-submenu">
                            <a href="<?= BASE_URL ?>equipamentos"><i class="fas fa-camera-retro"></i> Equipamentos </a>
                        </li>

                        <li class="has-submenu">
                            <a href="<?= BASE_URL ?>projetos"><i class="fas fa-list-ol"></i> Projetos </a>
                        </li>

                    </ul>
                    <!-- End navigation menu -->
                </div>
                <!-- end #navigation -->
            </div>
            <!-- end container -->
        </div>
        <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->
</div>
<!-- fim header -->