<?php

    /*if(!isset($_SESSION[md5("User")]) || $_SESSION[md5("User")]==''){
        redirect('user');
    }*/

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Integrasi Data</title>
    
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png'); ?>" type="image/x-icon"/>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?= base_url("assets/vendor/metisMenu/metisMenu.min.css"); ?>" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="<?= base_url("assets/vendor/datatables-plugins/dataTables.bootstrap.css"); ?>" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="<?= base_url("assets/vendor/datatables-responsive/dataTables.responsive.css"); ?>" rel="stylesheet">
    <link href="<?= base_url("assets/vendor/datatables-plugins/dataTables.checkboxes.css"); ?>" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="<?= base_url("assets/css/sb-admin-2.css"); ?>" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?= base_url("assets/vendor/morrisjs/morris.css"); ?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?= base_url("assets/vendor/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery -->
    <script src="<?= base_url("assets/vendor/jquery/jquery.min.js"); ?>"></script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url(""); ?>">
                    Integrasi Data
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Admin
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="<?= base_url("user/setting"); ?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?= base_url("user/logout"); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li> -->
                    <!-- /.dropdown-user -->
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            
                        </li>
                        <li>
                            <a href="<?= base_url(""); ?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gears fa-fw"></i> Knowledge 1 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= base_url("k1/sort"); ?>">Sorting</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k1/textpre"); ?>">Text Preprocessing</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k1/training"); ?>">Training</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k1/hitung"); ?>">Perhitungan</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k1/akurasi"); ?>">Akurasi</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gears fa-fw"></i> Knowledge 2 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= base_url("k2/sort"); ?>">Sorting</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k2/textpre"); ?>">Text Preprocessing</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k2/training"); ?>">Training</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k2/hitung"); ?>">Perhitungan</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k2/akurasi"); ?>">Akurasi</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gears fa-fw"></i> Knowledge 3 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= base_url("k3/sort"); ?>">Sorting</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k3/textpre"); ?>">Text Preprocessing</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k3/training"); ?>">Training</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k3/hitung"); ?>">Perhitungan</a>
                                </li>
                                <li>
                                    <a href="<?= base_url("k3/akurasi"); ?>">Akurasi</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php $this->load->view($page); ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <div class="ajax_loading">
        <div class="ajax_load_overlay">
            <img src="<?= base_url('assets/img/loading.svg'); ?>" alt="">
            <img src="<?= base_url('assets/img/process.svg'); ?>" alt="">
        </div>
    </div>
    <?php 
        $msg = $this->session->flashdata("msg");
        $msg_status = $this->session->flashdata("msg_status");
        $msg_title = $this->session->flashdata("msg_title");
        if(isset($msg)): 
    ?>
        <div class="alert <?= $msg_status; ?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 id="omg-error-txt"><?= $msg_title; ?><a class="anchorjs-link" href="#omg-error-txt"><span class="anchorjs-icon"></span></a></h4>
            <p><?php echo $msg; ?></p>
        </div>
    <?php endif; ?>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url("assets/vendor/bootstrap/js/bootstrap.min.js"); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= base_url("assets/vendor/metisMenu/metisMenu.min.js"); ?>"></script>

    <!-- DataTables JavaScript -->
    <script src="<?= base_url("assets/vendor/datatables/js/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?= base_url("assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"); ?>"></script>
    <script src="<?= base_url("assets/vendor/datatables-responsive/dataTables.responsive.js"); ?>"></script>


    <script src="<?= base_url("assets/vendor/datatables-plugins/dataTables.checkboxes.min.js"); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url("assets/js/sb-admin-2.js"); ?>"></script>
    <script src="<?= base_url("assets/js/ajaxfileupload.js"); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.dataTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
            setTimeout(function(){
                $('.alert').hide(600);
            }, 3000);
        });
    </script>
</body>

</html>
