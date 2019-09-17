<?php session_start();
ob_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="Index.php"><b>Ruthless Real Estate - Admin Site</b></a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <?php if(isset($_SESSION['User'])){?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo $_SESSION['User']; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="Login.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
            <?php }else{
                ?>
                <button type="button" class="btn btn-primary btn-lg"
                        OnClick='window.location="Login.php"'>Login
                </button>
                <?php
            }?>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="Index.php"><i class="fa fa-home"></i> Homepage</a>
                </li>
                <li>
                    <a href="Client.php"><i class="fa fa-users"></i> Clients</a>
                </li>
                <li>
                    <a href="Property.php"><i class="fa fa-building-o"></i> Properties</a>
                </li>
                <li>
                    <a href="Types.php"><i class="	fa fa-cube"></i> Property Types</a>
                </li>
                <li>
                    <a href="Features.php"><i class="fa fa-ellipsis-h"></i> Property Features</a>
                </li>
                <li>
                    <a href="Images.php"><i class="fa fa-image"></i> Images</a>
                </li>
                <li>
                    <a href="Documentation.php"><i class="fa fa-file"></i> Documentations</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Homepage
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-home"></i>Home
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div>
                <!--Home-->
                <?php if(isset($_SESSION['User'])){?>
                    <div class="alert alert-success">
                        <strong>Welcome!</strong> User <b><?php echo $_SESSION['User']; ?></b>
                    </div>

                    <h4>Some notes before start using the website:</h4>
                    <br>
                    <p>
                        Whilst we have displayed the source codes for all the pages, some of them uses duplicate images (<b>Types.php</b> & <b>Type_Modify.php</b> for example).
                        <br>
                        Rest assured all source codes for every page can be viewed properly regardless of the images!
                    </p>
                    <br>
                    <br>
                    <p>
                        We have used Source_Code.php to display the pages.
                        <br>
                        Whilst you can manually type the URL to reach there, it will show you the code for Source_Code.php.
                    </p>
                    <br>
                    <br>
                    <center>
                        <p>Click the tiny icon below to view the source code for Index.php (This page) too!</p>
                        <a href="Source_Code.php?filename=<?php echo $_SERVER["SCRIPT_FILENAME"]?>">
                            <i class="fa fa-home"></i>
                        </a>
                    </center>
                <?php }else{
                    ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Welcome!</h3>
                        </div>
                        <div class="panel-body">
                            Welcome to Ruthless Real Estate!
                            <br>
                            However, you need to log in to use the full features of this site.
                            <br>
                            Click the "Login" button at either below or the top right hand corner of the page to be redirected to the login page.
                            <br>
                            <br>
                            <h4 class="text-danger">The username & password can be found in the Documentations page!</h4>
                        </div>
                    </div>
                    <br>
                    <center>
                    <button type="button" class="btn btn-primary" OnClick = 'window.location="Login.php"'>Login</button>
                    </center>
                    <?php
                }?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>