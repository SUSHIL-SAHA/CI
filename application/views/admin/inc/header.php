<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title><?php echo (isset($sitetitle)) ? $sitetitle : site_title() . ' - Admin dashboard'; ?></title>
    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/front/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="#">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="#">
    <!-- Bootstrap core CSS-->
    <!-- <link href="<?php echo base_url(); ?>assets/admin/select2/dist/css/select2.min.css" rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/css/jquery.timepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/css/mult_selectbox.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/css/jquery.datetimepicker.css" />
    <!-- Icon fonts-->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Plugin styles -->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/magnific-popup.css">
    <!-- Your custom styles -->
    <link href="<?php echo base_url(); ?>assets/admin/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/css/dropzone.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/css/date_picker.css" rel="stylesheet">
    <!-- Your custom styles -->
    <!-- WYSIWYG Editor -->
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/js/editor/summernote-bs4.css"> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/chosen.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript">
        var baseURL = '<?php echo base_url(); ?>';
    </script>
        <!-- Main styles -->
        <link href="<?php echo base_url(); ?>assets/admin/css/admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
        <a class="navbar-brand" href="<?php echo base_url() . 'admin/dashboard'; ?>">Ln Service</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <div class="mCust">
                <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

                    <!-- <li class="nav-item<?php if (isset($class) && $class == 'module') {
                                            echo ' active';
                                        } ?>" data-toggle="tooltip" data-placement="right" title="Module">
                        <a class="nav-link " href="<?php echo base_url() ?>admin/<?php echo $mainmenu['permalink'] ?>">
                            <i class="fa fa-fw fa fa-list"></i>
                            <span class="nav-link-text">Module</span>
                        </a>
                    </li> -->

                    <?php
                    $menus = admin_menu();
                    // print '<pre>';
                    // print_r($menus);
                    // die;
                    foreach ($menus as $k => $mainmenu) {
                        if (isset($mainmenu['inner'])) {

                    ?>
                            <li class="nav-item<?php if (isset($class) && $class == $mainmenu['permalink']) {
                                                    echo ' active';
                                                } ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $mainmenu['module_name'] ?>">
                                <a class="nav-link nav-link-collapse <?php if (isset($class) && $class == $mainmenu['permalink']) {
                                                                            echo '';
                                                                        } else {
                                                                            echo 'collapsed';
                                                                        } ?>" data-toggle="collapse" href="#collapse<?php echo $mainmenu['permalink'] ?>" data-parent="#mylistings" <?php if (isset($class) && $class == $mainmenu['permalink']) {
                                                                                                                                                                                                                                                                                    echo 'aria-expanded="true"';
                                                                                                                                                                                                                                                                                } ?>>
                                    <i class="fa <?php echo $mainmenu['fontawesome']; ?>"></i>
                                    <span class="nav-link-text"> <?php echo $mainmenu['module_name'] ?></span>
                                </a>
                                <ul class="sidenav-second-level collapse <?php if (isset($class) && $class == $mainmenu['permalink']) {
                                                                                echo 'show';
                                                                            } ?>" id="collapse<?php echo $mainmenu['permalink'] ?>">
                                    <?php
                                    foreach ($mainmenu['inner'] as $subk => $subv) {
                                    ?>
                                        <li>
                                            <a href="<?php echo base_url(); ?>admin/<?php echo $mainmenu['permalink'] ?>/<?php echo $subv['permalink'] ?>"><?php echo $subv['module_name'] ?><span class="badge badge-pill badge-success"></span></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        <?php
                        } else {
                            //echo $class . ' ' . $mainmenu['permalink'];
                        ?>
                            <li class="nav-item<?php if (isset($class) && $class == $mainmenu['permalink']) {
                                                    echo ' active';
                                                } ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $mainmenu['module_name'] ?>">
                                <a class="nav-link " href="<?php echo base_url() ?>admin/<?php echo $mainmenu['permalink'] ?>">
                                    <i class="fa fa-fw <?php echo $mainmenu['fontawesome']; ?> "></i>
                                    <span class="nav-link-text"><?php echo $mainmenu['module_name'] ?></span>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                    <!-- ==== -->
                </ul>
            </div>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mypro" data-toggle="tooltip" data-placement="right" title="">
                    <a class="nav-link" href="<?php echo  SITE_URL ?>" target="_blank">
                        <i class="fa fa-fw fa-globe"></i>
                        <span class="nav-link-text">Visit Site</span>
                    </a>
                </li>
                <li class="nav-item mypro" data-toggle="tooltip" data-placement="right" title="">
                    <a class="nav-link" href="<?php echo base_url() ?>admin/profile">
                        <i class="fa fa-fw fa-user"></i>
                        <span class="nav-link-text">My Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /Navigation-->