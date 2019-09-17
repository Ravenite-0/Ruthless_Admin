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

    <title>Images Data</title>

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
if (isset($_SESSION['User'])){
//Connecting to the database.
include "Connection.php";
$connection = mysqli_connect($Host,$User_Name,$Pass_Word,$Database);
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
            <a class="navbar-brand" href="Index.php"><b>Ruthless Real Estate - Admin Site</b></a>
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
                    <a href="Index.php"><i class="fa fa-home"></i> Homepage</a>
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
                <li class="active">
                    <a href="#"><i class="fa fa-image"></i> Images</a>
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
                        Images
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="Index.php">Home</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-image"></i> Images
                        </li>
                    </ol>
                </div>
            </div>

            <?php
            $sponsorError;

            if(isset($_POST['imgDelete']))
            {
                if(!empty($_POST['checkbox'])) {
                    $filename=$_POST['checkbox'];

                    foreach($filename as $item)
                    {
                            $testimagequery="SELECT * FROM PROPERTY WHERE IMAGE_NAME='$item'";
                            $testimageresult=mysqli_query($connection,$testimagequery);
                            if((mysqli_num_rows($testimageresult)>0)) {
                                $imagequery = "UPDATE PROPERTY SET IMAGE_NAME='' WHERE IMAGE_NAME='$item'";
                                if ($connection->query($imagequery)) {
                                    unlink('property_image/' . $item);
                                    $sponsorError = "Success! Selected image(s) has been deleted.";
                                } else {
                                    $sponsorError = "Failed! Something went wrong in the deletion process. Incomplete deletion(s) might have occurred.";
                                    break;
                                }
                            }else{
                                unlink('property_image/' . $item);
                                $sponsorError = "Success! Selected image(s) has been deleted.";
                            }

                    }
                }
            };
            $targetDir = "property_image/";
            ?>

            <form method="post" onsubmit=" return confirmDelete()">
                <table class="table table-bordered table-hover table-striped col-lg-5">
                    <thead>
                    <tr>
                        <th>Image Name</th>
                        <th>View<br>(Opens a New Page)</th>
                        <th>Designated Property<br>(Shown by Addresses)</th>
                        <th>Select</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $dirname = "property_image/";

                    $images = scandir($dirname);

                    $ignore = Array(".", "..");
                    foreach($images as $curimg){
                        if(!in_array($curimg, $ignore))
                        {
                            echo "<tr><td><div> $curimg </div></td> ";
                            echo "<td><div><a href=".$dirname.$curimg.">View</a></div></td>";
                            /**echo "<tr><td><div> <img src=".$dirname.$curimg." /> </div></td> ";*/
                            $query="SELECT * FROM PROPERTY WHERE IMAGE_NAME='$curimg' ORDER BY IMAGE_NAME ASC";
                            $result=mysqli_query($connection, $query);
                            $row = $result->fetch_assoc();
                            if(mysqli_num_rows($result)==0){
                                echo "<td><p class='text-danger'>No Properties Allocated.</p></td>";
                            }else{?>
                                <td><p><?php echo $row["PROPERTY_STREET"] ?>,<br>
                                       <?php echo $row["PROPERTY_SUBURB"] ?>,
                                       <?php echo $row["PROPERTY_STATE"] ?>,<br>
                                       <?php echo $row["PROPERTY_PC"] ?></p></td>
                            <?php }
                            echo "<td><input class='form-check-input' type='checkbox' name='checkbox[]' value=".$curimg." ></td> </tr> ";
                        }
                    }
                    ?>
                    </tbody>
                </table>
                    <button type="submit" class="btn btn-danger" name="imgDelete" onClick="window.location='Images.php'" >Delete Selected Image(s)</button>
                    <br>

                    <?php
                    if (isset($sponsorError)){
                        ?>
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Notice!</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo $sponsorError; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
            </form>
            <br>
            <a href="Source_Code.php?filename=<?php echo $_SERVER["SCRIPT_FILENAME"]?>">
                <image src="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/IMAGE_SC.JPG" width="120" height="30"></image>
            </a>

            <script>

                function confirmDelete() {
                    if(confirm('Are you sure you want to delete the selected image(s). This action cannot be undone.')){
                        return true;

                    }else{
                        return false;
                    }
                }

            </script>
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