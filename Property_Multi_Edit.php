<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modifying Properties</title>

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
<script language="JavaScript">
    function verifyPrice(textbox, name)
    {
        if(parseInt(textbox.value) < 0)
        {
            textbox.setCustomValidity('Please enter a valid '+name+'.');
        }
        else if(parseInt(textbox.value) > 99999999.99){
            textbox.setCustomValidity('Please enter a valid '+name+'.');
        }
        else if (textbox.value==''){
            textbox.setCustomValidity('Please enter a valid '+name+'.');
        }
        else
        {
            textbox.setCustomValidity('');
        }
        return true;
    }
</script>
<?php
if (isset($_SESSION['User'])){
//Connecting to the database.
include "Connection.php";
$connection = mysqli_connect($Host,$User_Name,$Pass_Word,$Database);
$query = "SELECT * FROM PROPERTY";
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
                        <li>
                            <i class="fa fa-building-o"></i> <a href="Property.php">Properties</a>
                        </li>
                        <li class="active">
                            Modifying Property
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div>
                <?php if(empty($_POST["check"])){ ?>
                <form method="post" action="Property_Multi_Edit.php">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">Property Address</th>
                                <th class="text-center">Edit Flag</th>
                                <th class="text-center">List Price</th>
                            </tr>
                            </thead>
                            <tbody id="PropertyTable">
                            <?php
                            while ($row = $result->fetch_array()) {
                                ?>

                                <tr>
                                    <td><?php echo $row[1] ?>,<br>
                                        <?php echo $row[2] ?>,
                                        <?php echo $row[3] ?>,<br>
                                        <?php echo $row[4] ?><br>
                                    </td>
                                    <td align="center">
                                        <input type="checkbox" name="check[]" value="<?php echo $row["PROPERTY_ID"]; ?>"/>
                                    </td>
                                    <td>
                                        <input type="number" name="<?php echo $row["PROPERTY_ID"]; ?>" value="<?php echo $row[8];?>" placeholder="Please insert a list price" onInvalid="verifyPrice(this,'list price');"
                                               onInput="verifyEntry(this,'list price');" max="99999999.99" min="0" required/>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <?php
                        ?>
                        </tbody>
                    </table>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-default" OnClick = 'window.location="Property.php"'>Cancel</button>
                </div>
                </form>
                <?php } else{
                foreach($_POST["check"] as $PID)
                {
                    $massquery="UPDATE PROPERTY SET LISTING_PRICE=? WHERE PROPERTY_ID='$PID'";
                    $massqueryprep = mysqli_prepare($connection, $massquery);
                    $massqueryprep->bind_param('d', $plp);
                    $plp = $_POST[$PID];
                    $massqueryprep->execute();
                }

                ?>
                    <div class="alert alert-success">
                        <strong>Success!</strong> Selected List Price(s) has been updated.
                    </div>
                    <button type="button" class="btn btn-default" OnClick = 'window.location="Property.php"'>Return to Data</button>
                <?php }?>
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