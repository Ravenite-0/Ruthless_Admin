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

    <title>Modifying Feature</title>

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
//Connecting to the database.
include "Connection.php";
$connection = mysqli_connect($Host,$User_Name,$Pass_Word,
    $Database) or die;
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
                        Property Feature Modification
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="index.php">Home</a>
                        </li>
                        <li>
                            <i class="fa fa-ellipsis-h"></i> <a href="Features.php">Property Features</a>
                        </li>
                        <li class="active">
                            Modifying
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <?php
            switch($_GET['Action']){
                case "Delete":
                    $query="SELECT * FROM FEATURE WHERE FEATURE_ID =".$_GET["featureid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <div>
                        <div class="col-lg-6">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="deleteFeatureID">Feature ID:</label>
                                        <input class="form-control" id="deleteFeatureID" type="text" value="<?php echo $row["FEATURE_ID"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteFeatureName">Feature Name:</label>
                                        <input class="form-control" id="deleteFeatureName" type="text" value="<?php echo $row["FEATURE_NAME"]?>" disabled/>
                                    </div>
                                    <p class="text-danger" style="font-size: small">This action cannot be undone!</p>
                                    <button type="button" class="btn btn-danger" OnClick="confirm_delete();">Delete Anyway</button>
                                    &nbsp;
                                    <button type="button" class="btn btn-default" OnClick = 'window.location="Features.php"'>Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <?php break;

                case "ConfirmDelete":
                    $query="SELECT * FROM FEATURE WHERE FEATURE_ID =".$_GET["featureid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();

                    $query="DELETE FROM FEATURE WHERE FEATURE_ID=".$_GET["featureid"];
                    if($connection->query($query)) {
                        ?>
                        <div>
                            <div class="alert alert-success">
                                <strong>Success!</strong> Selected Property Feature has been deleted.
                            </div>
                            <p class="form-control-static"><b>Feature ID: </b><?php echo $row["FEATURE_ID"]?></p>
                            <p class="form-control-static"><b>Feature Name: </b><?php echo $row["FEATURE_NAME"]?></p>
                        </div>
                    <?php }
                    else { ?>
                        <div class="alert alert-danger">
                            <strong>Failed!</strong>
                            Something went wrong in the deletion progress. <br><br>
                            (If there is a property with the designated feature, please make modifications to it before deleting this feature.)
                        </div>
                    <?php }
                    ?>
                    <button type="button" class="btn btn-default" OnClick = 'window.location="Features.php"'>Return to Data</button>
                    <?php break;

                case "Update":
                    $query="SELECT * FROM FEATURE WHERE FEATURE_ID =".$_GET["featureid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <div>
                        <div class="col-lg-6">
                            <form method="post" action=Feature_Modify.php?featureid=<?php echo $_GET["featureid"];?>&Action=ConfirmUpdate>
                                <fieldset>
                                    <superscript class="text-danger" style="font-size: x-small">*Required Field</superscript>
                                    <div class="form-group">
                                        <label for="updateFeatureID">Feature ID:</label>
                                        <input class="form-control" id="updateFeatureID" type="text" value="<?php echo $row["FEATURE_ID"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updateFeatureName">Feature Name:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="FeatureName" type="text" value="<?php echo $row["FEATURE_NAME"]?>" maxlength="30" onInvalid="verifyEntry(this,'feature name');"
                                               onInput="verifyEntry(this,'feature name');" placeholder="Feature Name" required/>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Update"/>
                                    &nbsp;
                                    <button type="button" class="btn btn-default" OnClick = 'window.location="Features.php"'>Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <?php break;

                case "ConfirmUpdate":
                    $query="SELECT * FROM FEATURE WHERE FEATURE_ID =".$_GET["featureid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    $query="UPDATE FEATURE SET FEATURE_NAME=? WHERE FEATURE_ID=".$row["FEATURE_ID"];
                    $queryprep = mysqli_prepare($connection, $query);
                    $queryprep->bind_param('s', $featurename);

                    $featurename = $_POST["FeatureName"];
                    if ($queryprep->execute()){
                    ?>
                    <fieldset>
                        <div class="alert alert-success">
                            <strong>Success!</strong> Selected Property Feature has been updated!
                        </div>
                        <table>
                            <thead>
                            <tr>
                                <th></th>
                                <th><h4><b>Original:</b></h4></th>
                                <td></td>
                                <th><h4><b>Updated:</b></h4></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td valign="center"><h5><b>Feature ID: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateFeatureID" type="text" value="<?php echo $row["FEATURE_ID"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedFeatureID" type="text" value="<?php echo $row["FEATURE_ID"]?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>Feature Name: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateFeatureName" type="text" value="<?php echo $row["FEATURE_NAME"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedFeatureName" type="text" value="<?php echo $_POST['FeatureName']?>" disabled/>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <?php }else{
                        ?>
                        <div class="alert alert-danger">
                            <strong>Failed!</strong> Something went wrong during the updating process.
                        </div>
                        <?php
                        }?>
                        <button type="button" class="btn btn-default" OnClick = 'window.location="Features.php"'>Return To Data</button>
                    </fieldset>
                    <?php
                    break;

                case "Insert":
                    if(empty($_POST['insertFeatureName'])){?>
                        <div>
                            <div class="col-lg-6">
                                <form method="post" action="Feature_Modify.php?Action=Insert">
                                    <superscript class="text-danger" style="font-size: x-small">Required Field*</superscript>
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="insertFeatureID">Feature ID: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertFeatureID" type="text" value="Automatically generated upon successful insertion." disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertFeatureName">Feature Name: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertFeatureName" type="text" placeholder="Feature Name"  maxlength="30" onInvalid="verifyEntry(this,'feature name');"
                                                   onInput="verifyEntry(this,'feature name');" required>
                                        </div>
                                        <input type="submit" class="btn btn-success" value="Insert"/>
                                        &nbsp;
                                        <button type="button" class="btn btn-default" OnClick = 'window.location="Features.php"'>Cancel</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    <?php } else{
                        $query="INSERT INTO FEATURE (FEATURE_NAME) VALUES (?)";
                        $queryprep = mysqli_prepare($connection, $query);
                        $queryprep->bind_param('s', $featurename);

                        $featurename = $_POST["insertFeatureName"];
                        if ($queryprep->execute()) {
                            ?>
                            <div>
                                <div class="alert alert-success">
                                    <strong>Success!</strong> A new Feature has been added.
                                </div>
                                <p class="form-control-static"><b>Feature
                                        ID: </b><?php echo mysqli_insert_id($connection) ?></p>
                                <p class="form-control-static"><b>Feature
                                        Name: </b><?php echo $_POST['insertFeatureName'] ?></p>
                                <br>
                                <button type="button" class="btn btn-default" OnClick='window.location="Features.php"'>
                                    Return To Data
                                </button>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="alert alert-success">
                                <strong>Failed!</strong> Something went wrong in the insertion process.
                            </div>
                            <?php
                        }
                            ?>
                    <?php }?>

                    <?php break;}
            ?>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <br>
        <a href="Source_Code.php?filename=<?php echo $_SERVER["SCRIPT_FILENAME"]?>">
            <image src="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Feature_SC.JPG" width="120" height="30"></image>
        </a>
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
    <?php
}else{
    //If the session does not exist, user will be prompted to login.
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
        window.location='Feature_Modify.php?featureid=<?php echo $_GET["featureid"];?>&Action=ConfirmDelete';
    }
</script>

</body>

</html>
