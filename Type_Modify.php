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

    <title>Modifying Type</title>

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

<script language="JavaScript">
    function verifyEntry(textbox, name)
    {
        if(textbox.value=='')
        {
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
//Checks if the user have logged in.
if (isset($_SESSION['User'])){
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
                <li class="active">
                    <a href="#"><i class="fa fa-cube"></i> Property Types</a>
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
                        Property Type Modification
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i> <a href="index.php">Home</a>
                        </li>
                        <li>
                            <i class="fa fa-cube"></i> <a href="Types.php">Property Types</a>
                        </li>
                        <li class="active">
                            Modifying
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <?php
            //Connecting to the database.
            include "Connection.php";
            $connection = mysqli_connect($Host, $User_Name, $Pass_Word, $Database);
            switch ($_GET['Action']) {
                //If the action code is to delete.
                case "Delete":
                    $query = "SELECT * FROM TYPE WHERE TYPE_ID =" . $_GET["typeid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <!-- Form that shows the details of the row before deletion. -->
                    <div>
                        <div class="col-lg-6">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="deleteTypeID">Type ID:</label>
                                        <input class="form-control" id="deleteTypeID" type="text"
                                               value="<?php echo $row["TYPE_ID"] ?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteTypeName">Type Name:</label>
                                        <input class="form-control" id="deleteTypeName" type="text"
                                               value="<?php echo $row["TYPE_NAME"] ?>" disabled/>
                                    </div>
                                    <p class="text-danger" style="font-size: small">This action cannot be undone!</p>
                                    <button type="button" class="btn btn-danger" OnClick="confirm_delete();">Delete
                                        Anyway
                                    </button>
                                    &nbsp;
                                    <button type="button" class="btn btn-default"
                                            OnClick='window.location="Types.php"'>Cancel
                                    </button>
                                </fieldset>
                            </form>
                        </div>
                    </div>

                    <?php break;
                //This case is triggered when the deletion action is confirmed to execute.
                case "ConfirmDelete":
                    $query = "SELECT * FROM TYPE WHERE TYPE_ID =" . $_GET["typeid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    $query = "DELETE FROM TYPE WHERE TYPE_ID=" . $_GET["typeid"];
                    if ($connection->query($query)) {
                        //Notification will be displayed based on whether the action succeeds or fails.
                        ?>
                        <div>
                            <div class="alert alert-success">
                                <strong>Success!</strong> Selected Property Type has been deleted.
                            </div>
                            <p class="form-control-static"><b>Type ID: </b><?php echo $row["TYPE_ID"] ?></p>
                            <p class="form-control-static"><b>Type Name: </b><?php echo $row["TYPE_NAME"] ?></p>
                        </div>
                        <br>
                    <?php } else { ?>
                        <div class="alert alert-danger">
                            <strong>Failed!</strong>
                            Something went wrong in the deletion progress. <br><br>
                            (If there is a property with the designated type, please allocate a new type to it before deleting this type.)
                        </div>
                    <?php }
                    ?>
                    <button type="button" class="btn btn-default" OnClick='window.location="Types.php"'>Return
                        to Data
                    </button>
                    <?php break;

                //This is triggered when the user updates an existing type.
                case "Update":
                    //First get the data based off the specific row.
                    $query = "SELECT * FROM TYPE WHERE TYPE_ID =" . $_GET["typeid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <!-- Form for user to update the data. -->
                    <div>
                        <div class="col-lg-6">
                            <form method="post"
                                  action=Type_Modify.php?typeid=<?php echo $_GET["typeid"]; ?>&Action=ConfirmUpdate>
                                <superscript class="text-danger" style="font-size: x-small">*Required Fields</superscript>
                                    <div class="form-group">
                                        <label for="updateTypeID">Type ID:</label>
                                        <input class="form-control" id="TypeID" name="TypeID" type="text"
                                               value="<?php echo $row["TYPE_ID"] ?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updateTypeName">Type Name:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" id="TypeName" name="TypeName" type="text" value="<?php echo $row["TYPE_NAME"]; ?>" maxlength="30" onInvalid="verifyEntry(this,'type name');"
                                               onInput="verifyEntry(this,'type name');" placeholder="Type Name" required/>
                                    </div>

                                    <input type="submit" class="btn btn-primary" value="Update"/>
                                    &nbsp;
                                    <button type="button" class="btn btn-default"
                                            OnClick='window.location="Types.php"'>Cancel
                                    </button>
                            </form>
                        </div>
                    </div>
                    <?php break;

                //This is triggered when an update action is confirmed.
                case "ConfirmUpdate":
                    $query = "SELECT * FROM TYPE WHERE TYPE_ID =" . $_GET["typeid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();

                    $query = "UPDATE TYPE SET TYPE_NAME=? WHERE TYPE_ID=" . $_GET["typeid"];
                    $queryprep = mysqli_prepare($connection, $query);
                    $queryprep->bind_param('s', $typename);

                    $typename = $_POST["TypeName"];
                    if ($queryprep->execute()) { ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong> Selected Property Type has been updated.
                        </div>
                        <table>
                            <thead>
                            <tr>
                                <th></th>
                                <th><h4><b>Original:</b></h4></th>
                                <th></th>
                                <th><h4><b>Updated:</b></h4></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><h5><b>Type ID: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateTypeID" type="text"
                                               value="<?php echo $_GET["typeid"]; ?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedTypeID" type="text"
                                               value="<?php echo $_GET["typeid"]; ?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>Type Name: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateTypeName" type="text"
                                               value="<?php echo $row["TYPE_NAME"] ?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedTypeName" type="text"
                                               value="<?php echo $_POST['TypeName'] ?>" disabled/>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <?php
                    }else{
                        ?>
                        <div class="alert alert-danger">
                            <strong>Failed!</strong> Something went wrong during the updating process.
                        </div>
                        <?php
                    }
                        ?>
                    <button type="button" class="btn btn-default" OnClick='window.location="Types.php"'>Return To Data</button>
                    <?php
                    break;

                //This is when a new record is being inserted.
                case "Insert":
                    if (empty($_POST['insertTypeName'])) {
                        ?>
                        <div>
                            <div class="col-lg-6">
                                <form method="post" action="Type_Modify.php?Action=Insert">
                                    <fieldset>
                                        <superscript class="text-danger" style="font-size: x-small">*Required Fields</superscript>
                                        <div class="form-group">
                                            <label for="insertTypeID">Type ID:</label>
                                            <input class="form-control" name="insertTypeID" type="text"
                                                   value="Automatically generated upon successful insertion." disabled/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertTypeName">Type Name:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertTypeName" type="text" placeholder="Type Name" maxlength="30" onInvalid="verifyEntry(this,'type name');"
                                                   onInput="verifyEntry(this,'type name');" required/>
                                        </div>
                                        <input type="submit" class=" btn btn-success" value="Insert"/>
                                        &nbsp;
                                        <button type="button" class="btn btn-default"
                                                OnClick='window.location="Types.php"'>Cancel
                                        </button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    <?php } else {
                        $query = "INSERT INTO TYPE (TYPE_NAME) VALUES (?)";
                        $queryprep = mysqli_prepare($connection, $query);
                        $queryprep->bind_param('s', $typename);

                        $typename = $_POST["insertTypeName"];
                        if($queryprep->execute()) {
                            ?>
                            <div class="alert alert-success">
                                <strong>Success!</strong> A new Type has been added.
                            </div>
                            <p class="form-control-static"><b>Type ID: </b><?php echo mysqli_insert_id($connection) ?>
                            </p>
                            <p class="form-control-static"><b>Type Name: </b><?php echo $_POST['insertTypeName'] ?></p>
                            <br>
                            <button type="button" class="btn btn-default"
                                    OnClick='window.location="Types.php"'>Return To Data
                            </button>
                            <?php
                        }else{
                            ?>
                            <div class="alert alert-success">
                                <strong>Failed!</strong> Something went wrong in the insertion process.
                            </div>
                            <?php
                        }
                        }
                    break;}
                        $connection->close();
                    ?>
            <!-- /.row -->
        </div>
        <br>
        <a href="Source_Code.php?filename=<?php echo $_SERVER["SCRIPT_FILENAME"]?>">
            <image src="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Type_SC.JPG" width="120" height="30"></image>
        </a>
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

<script>
    function confirm_delete()
    {
        window.location='Type_Modify.php?typeid=<?php echo $_GET["typeid"];?>&Action=ConfirmDelete';
    }
</script>

</body>

</html>
