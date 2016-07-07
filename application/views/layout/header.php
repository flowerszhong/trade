<!DOCTYPE html>
<html lang="zh">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>途瑞(torun) 物流管理系统</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo asset_url() . '/bootstrap/dist/css/bootstrap.min.css'; ?>">


    <!-- MetisMenu CSS -->
    <link href="<?php echo asset_url() . 'metisMenu/dist/metisMenu.min.css'; ?>" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="<?php echo asset_url() . 'main.css'; ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!-- <link href="../bower_components/morrisjs/morris.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="<?php echo asset_url() . 'font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a class="navbar-brand" href="<?php site_url( '' ); ?>">途瑞[ToRun]-领先全球的物流管理系统</a>
            </div>
            <!-- /.navbar-header -->

            

            <?php 
            include 'navtop.php';
            include 'sidebar.php'; 
            ?>
            
        </nav>


         <div id="page-wrapper">