<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Documentations</title>

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

    <style>
        #myInput {
            width: 100%; /* Full-width */
            font-size: 16px; /* Increase font-size */
            padding: 12px 20px 12px 40px; /* Add some padding */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
            align-content: center;
        }
    </style>

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
            <a class="navbar-brand" href="index.php"><b>Ruthless Real Estate - Admin Site</b></a>
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
                <li>
                    <a href="index.php"><i class="fa fa-home"></i> Homepage</a>
                </li>
                <li>
                    <a href="Client.php"><i class="fa fa-users"></i> Clients</a>
                </li>
                <li>
                    <a href="Property.php"><i class="fa fa-building-o"></i> Properties</a>
                </li>
                <li>
                    <a href="Types.php"><i class="fa fa-cube"></i> Property Types</a>
                </li>
                <li>
                    <a href="Features.php"><i class="fa fa-ellipsis-h"></i> Property Features</a>
                </li>
                <li>
                    <a href="Images.php"><i class="fa fa-image"></i> Images</a>
                </li>
                <li class="active">
                    <a href="#"><i class="fa fa-file"></i> Documentations</a>
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
                        Assignment Documentation
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="index.php">Home</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Documentations</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <p>User Interface Referenced & Modified From: <a href="http://startbootstrap.com/template-overviews/sb-admin/">Link</a></p>
            <br>
            <div>
                <h3><b>Author Details:</b></h3>
                <br>
                <p><b>Name: </b>Zhanpeng Hu</p>
                <p><b>Student ID: </b>28056434</p>
                <p><b>Date of Submission: </b>5th of October, 2018</p>
                <br>
                <p><b>Partner Name: </b>Boxin Hao</p>
                <p><b>Student ID: </b>27273342</p>
                <br>
                <br>
                <br>
                <h3><b>Login Details:</b></h3>
                <div class="row">
                    <div class="table-responsive col-lg-6">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Admin</td>
                                    <td>Admin</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <h3><b>Database Details:</b></h3>
                <input id="DataPDF" type="button" onclick="window.location.href='PDFS/Tables.pdf'" value="View SQL Tables"/>
                <br>
                <br>
                <br>
                <h3><b>Test Data Details:</b></h3>
                <br>
                <div class="row">
                    <div class="table-responsive col-lg-6">
                        <table class="table table-bordered table-hover table-striped">
                            <tbody>
                            <tr>
                                <td>
                                    <a href="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Type_Data.JPG">
                                    <h5><i>Property Type Data</i></h5>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Feature_Data.JPG">
                                        <h5><i>Property Feature Data</i></h5>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Client_Data.JPG">
                                        <h5><i>Property Client Data</i></h5>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Property_Data_1.JPG">
                                        <h5><i>Property Data Part 1</i></h5>
                                    </a>
                                </td>
                            </tr>
                            <td>
                                <a href="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Property_Data_2.JPG">
                                    <h5><i>Property Data Part 2 (Images + Description)</i></h5>
                                </a>
                            </td>
                            <tr>
                                <td>
                                    <a href="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/PF_Data.JPG">
                                        <h5><i>Property - Feature Bridge Data</i></h5>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Admin_Data.JPG">
                                        <h5><i>Admin Data</i></h5>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
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
