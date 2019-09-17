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

    <title>Features Data</title>

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

<?php
//Checks if the user have logged in.
if (isset($_SESSION['User'])){
    //Connecting to the database.
    include "Connection.php";
    $connection = mysqli_connect($Host,$User_Name,$Pass_Word,$Database);
    $query="SELECT * FROM FEATURE ORDER BY FEATURE_NAME ASC";
//Querying the data.
    $result = mysqli_query($connection, $query);
?>


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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo $_SESSION['User']; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="Login.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
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
                <li class="active">
                    <a href="#"><i class="fa fa-ellipsis-h"></i> Property Features</a>
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
                        Property Features
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="index.php">Home</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-ellipsis-h"></i> Property Features
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div>
                <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-hover table-striped col-lg-5">
                        <thead>
                        <tr>
                            <th class="text-center">Feature Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="FeatureTable">
                        <?php
                        if (mysqli_num_rows($result)==0){?>
                            <tr>
                                <td colspan="2" style="text-align: center"><b>Sorry, no results were found.</b></td>
                            </tr>
                        <?php }else{
                        while ($row = $result->fetch_array()) {
                            ?>

                            <tr>
                                <td><?php echo $row[1] ?></td>
                                <td align="center">
                                    <a href="Feature_Modify.php?featureid=<?php echo $row["FEATURE_ID"]; ?>&Action=Update"><b><u>Update</u></b></a>
                                    &nbsp;
                                    <a href="Feature_Modify.php?featureid=<?php echo $row["FEATURE_ID"]; ?>&Action=Delete"><b><u>Delete</u></b></a>
                                </td>
                            </tr>

                        <?php }}
                        //Closes the database after displaying the records
                        $result->free_result();
                        $connection->close();
                        ?>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        <input type="button" value="+ Add New Record" onClick="window.location='Feature_Modify.php?Action=Insert'"
                               style="height:30px; width:400px">
                    </div>
                    <br>
                    <a href="Source_Code.php?filename=<?php echo $_SERVER["SCRIPT_FILENAME"]?>">
                        <image src="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Feature_SC.JPG" width="120" height="30"></image>
                    </a>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
    <?php
}else{
    //If logs out, the user will be sent to the Login page where he will have to login again.
    header("Location: Login.php?History=".urlencode($_SERVER['REQUEST_URI']));
}
?>
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
