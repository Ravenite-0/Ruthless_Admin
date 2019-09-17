<?php
session_start();
if (isset($_SESSION['User'])) {
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

    <title>Properties Data</title>

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

<?php
//Checks if the user have logged in.
//Connecting to the database.
include "Connection.php";
$connection = mysqli_connect($Host,$User_Name,$Pass_Word,$Database);
$Search="NoString";
if (isset($_POST['PropertySearch'])) {
    $Search = $_POST['PropertySearch'];
}
if (isset($_POST['SearchString'])) {
    $Criteria = $_POST['SearchString'];
}
    switch ($Search) {
        case "NoString":
            $query = "SELECT * FROM PROPERTY p LEFT JOIN TYPE t on p.PROPERTY_TYPE = t.TYPE_ID 
                                           LEFT JOIN CLIENT c ON p.SELLER_ID = c.CLIENT_ID ORDER BY PROPERTY_TYPE ASC";
            break;

        case "SuburbString":
            $query = "SELECT * FROM PROPERTY p LEFT JOIN TYPE t on p.PROPERTY_TYPE = t.TYPE_ID 
                                           LEFT JOIN CLIENT c ON p.SELLER_ID = c.CLIENT_ID
                                           WHERE p.PROPERTY_SUBURB LIKE '%" . $Criteria . "%' ORDER BY PROPERTY_ID ASC";
            break;

        case "TypeString":
            $query = "SELECT * FROM PROPERTY p LEFT JOIN TYPE t on p.PROPERTY_TYPE = t.TYPE_ID 
                                           LEFT JOIN CLIENT c ON p.SELLER_ID = c.CLIENT_ID
                                           WHERE t.TYPE_NAME LIKE '%" . $Criteria . "%' ORDER BY PROPERTY_ID ASC";
            break;

        default:
            $query = "SELECT * FROM PROPERTY p LEFT JOIN TYPE t on p.PROPERTY_TYPE = t.TYPE_ID
                                           LEFT JOIN CLIENT c ON p.SELLER_ID = c.CLIENT_ID ORDER BY PROPERTY_ID ASC";
            break;
    }
$result = $connection->query($query);
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
                <li class="active">
                    <a href="#"><i class="fa fa-building-o"></i> Properties</a>
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
                        Properties
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="index.php">Home</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-building-o"></i> Properties
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div>
                <form method="post" action="Property.php">
                    <div class="row">
                    <div class="col-lg-6">
                        <input class="form-control" name="SearchString" type="text" placeholder="Search">
                    </div>
                    <div class="col-lg-1">
                        <input class="form-control btn-primary" type="submit" name="search Property">
                    </div>
                    </div>
                    <label>Columns to Search:</label>
                    <label class="radio-inline">
                        <input type="radio" name="PropertySearch" id="SearchAll" value="NoString" checked>
                        All <superscript class="text-danger" style="font-size: x-small">(Neglects Search Clause!)</superscript>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="PropertySearch" id="SearchSuburb" value="SuburbString">Suburbs
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="PropertySearch" id="SearchType" value="TypeString">Types
                    </label>
                </form>
                <div class="table-responsive">
                    <br>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Property Type</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">List Date<br>(Year-Month-Day)</th>
                            <th class="text-center">List Price<br>($AUD)</th>
                            <th class="text-center">Sale Date<br>(Year-Month-Day)</th>
                            <th class="text-center">Sale Price<br>($AUD)</th>
                            <th class="text-center">Seller Name</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody id="PropertyTable">
                        <?php
                        if (mysqli_num_rows($result)==0){?>
                            <tr>
                                <td colspan="10" style="text-align: center"><b>Sorry, no results were found.</b></td>
                            </tr>
                        <?php }else{
                        while ($row = $result->fetch_array()) {
                            ?>

                            <tr>
                                <td><?php echo $row[14] ?></td>
                                <td>
                                    <?php echo $row[1] ?>,<br>
                                    <?php echo $row[2] ?>,
                                    <?php echo $row[3] ?>,<br>
                                    <?php echo $row[4] ?>
                                </td>
                                <td><?php echo $row[7] ?></td>
                                <td><?php echo $row[8] ?></td>
                                <td><?php echo $row[9] ?></td>
                                <td><?php echo $row[10] ?></td>
                                <td>
                                    <?php echo $row[16] ?>,<br>
                                    <?php echo $row[17] ?>
                                </td>
                                <td><?php echo $row[11] ?>
                                    <br>
                                    <br>
                                    <?php $dir = "property_image/";
                                    if(!empty($row["IMAGE_NAME"])) {
                                        echo "<a href=" . $dir . $row["IMAGE_NAME"] . ">View Image</a>";
                                    }
                                    ?>

                                </td>
                                <td><?php echo $row[12] ?></td>
                                <td align="center">
                                    <a href="Property_Modify.php?propertyid=<?php echo $row["PROPERTY_ID"]; ?>&Action=Update"><u><b>Update</b></u></a>
                                    &nbsp;
                                    <a href="Property_Modify.php?propertyid=<?php echo $row["PROPERTY_ID"]; ?>&Action=Delete"><u><b>Delete</b></u></a>
                                </td>
                            </tr>

                            <?php
                        }}
                        ?>
                        <?php
                        //Closes the database after displaying the records
                        $result->free_result();
                        $connection->close();
                        ?>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        <input type="button" value="+ Add New Record" onClick="window.location='Property_Modify.php?Action=Insert'"
                               style="height:30px; width:400px">
                        <input type="button" value="$ Mass Edit Prices" onClick="window.location='Property_Multi_Edit.php'"
                               style="height:30px; width:400px">
                    </div>
                </div>
                <br>
                <a href="Source_Code.php?filename=<?php echo $_SERVER["SCRIPT_FILENAME"]?>">
                    <image src="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Property_SC.JPG" width="120" height="30"></image>
                </a>
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
