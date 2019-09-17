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

    <title>Sending E-Mail</title>

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
    function verifyEntry(textbox, name)
    {
        if(textbox.value=='')
        {
            textbox.setCustomValidity('Please do not send E-Mails with empty '+name+'.');
        }
        else
        {
            textbox.setCustomValidity('');
        }
        return true;
    }
</script>
<?php
//Checks if the user have logged in.
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
                <li class="active">
                    <a href="#"><i class="fa fa-users"></i> Clients</a>
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
                        Clients
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="Index.php">Home</a>
                        </li>
                        <li>
                            <i class="fa fa-users"></i> <a href="Client.php">Clients</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> E-Mail
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <?php if (empty($_POST['EmailTitle'])){ ?>
                <div class="col-lg-6">
                    <form role="form" method="post" action="EMail.php">
                        <fieldset>
                            <div class="form-group">
                                <label for="EmailTitle">Subject:</label>
                                <input class="form-control" name="EmailTitle" type="text" placeholder="E-Mail Title Here" onInvalid="verifyEntry(this,'title');"
                                       onInput="verifyEntry(this,'title');" required/>
                            </div>
                            <div class="form-group">
                                    <label for="EmailContent">Message:</label>
                                <textarea class="form-control" rows="5" name="EmailContent" placeholder="E-Mail Content Here" required/></textarea>
                            </div>
                                <input type="submit" class="btn btn-primary" value="Send"/>
                                <button type="button" class="btn btn-default" OnClick = 'window.location="Client.php"'>Cancel</button>
                        </fieldset>
                    </form>
                </div>
            <?php }else{
                include "Connection.php";
                $connection = mysqli_connect($Host,$User_Name,$Pass_Word,$Database);
                $query="SELECT CLIENT_EMAIL FROM CLIENT WHERE CLIENT_MAIL='Y'";
                $result = mysqli_query($connection, $query);

                while ($row = $result->fetch_array()) {
                    $from = "From: Ruthless Real Estate <ruthlessrealestate.admin.com>";
                    $to = $row["CLIENT_EMAIL"];
                    $msg = $_POST["EmailContent"];
                    $subject = $_POST["EmailTitle"];
                }
                    if(mail($to, $subject, $msg, $from))
                    {
                        ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong> E-Mail has been sent to registered candidates.
                        </div>
                        <?php
                    }
                    else {
                        ?>
                        <div class="alert alert-danger">
                            <strong>Failure!</strong> Something went wrong in the sending process.
                        </div>
                        <?php
                    }
                $result->free_result();
                $connection->close();
                ?><button type="button" class="btn btn-default" OnClick = 'window.location="Client.php"'>Return To Data</button>
                <br>
                <br>
                <a href="Source_Code.php?filename=<?php echo $_SERVER["SCRIPT_FILENAME"]?>">
                    <image src="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Client_SC.JPG" width="120" height="30"></image>
                </a>
                <?php
            }
            ?>
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
