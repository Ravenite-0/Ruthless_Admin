<!DOCTYPE html>
<?php
ob_start();
session_start();
function fSelect($value1, $value2)
{
    $strSelect = "";
    if($value1 == $value2)
    {
        $strSelect = " Selected";
    }
    return $strSelect;
}

?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modifying Client</title>

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
                        Client Modification
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="Index.php">Home</a>
                        </li>
                        <li>
                            <i class="fa fa-users"></i> <a href="Client.php">Clients</a>
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
                    $query="SELECT * FROM CLIENT WHERE CLIENT_ID =".$_GET["clientid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <div>
                        <div class="col-lg-6">
                            <form role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="deleteClientID">Client ID:</label>
                                        <input class="form-control" id="deleteClientID" type="text" value="<?php echo $row["CLIENT_ID"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientG">Client Given Name:</label>
                                        <input class="form-control" id="deleteClientG" type="text" value="<?php echo $row["CLIENT_GNAME"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientF">Client Family Name:</label>
                                        <input class="form-control" id="deleteClientF" type="text" value="<?php echo $row["CLIENT_FNAME"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientStreet">Client Address - Street:</label>
                                        <input class="form-control" id="deleteClientStreet" type="text" value="<?php echo $row["CLIENT_STREET"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientSuburb">Client Address - Suburb:</label>
                                        <input class="form-control" id="deleteClientSuburb" type="text" value="<?php echo $row["CLIENT_SUBURB"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientState">Client Address - State:</label>
                                        <input class="form-control" id="deleteClientState" type="text" value="<?php echo $row["CLIENT_STATE"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientPostcode">Client Address - Postcode:</label>
                                        <input class="form-control" id="deleteClientPostcode" type="text" value="<?php echo $row["CLIENT_PC"]?>" disabled/>
                                    </div>


                                    <div class="form-group">
                                        <label for="deleteClientEmail">Client E-Mail:</label>
                                        <input class="form-control" id="deleteClientEmail" type="text" value="<?php echo $row["CLIENT_EMAIL"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientMobile">Client Mobile Number:</label>
                                        <input class="form-control" id="deleteClientMobile" type="text" value="<?php echo $row["CLIENT_MOBILE"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientMobile">On Mailing List:</label>
                                        <input class="form-control" id="deleteClientMail" type="text" value="<?php echo $row["CLIENT_MAIL"]?>" disabled/>
                                    </div>
                                    <p class="text-danger" style="font-size: small">This action cannot be undone!</p>
                                    <button type="button" class="btn btn-danger" OnClick="confirm_delete();">Delete Anyway</button>
                                    &nbsp;
                                    <button type="button" class="btn btn-default" OnClick = 'window.location="Client.php"'>Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <?php break;

                case "ConfirmDelete":
                    $query="SELECT * FROM CLIENT WHERE CLIENT_ID =".$_GET["clientid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();

                    $query="DELETE FROM CLIENT WHERE CLIENT_ID=".$_GET["clientid"];
                    if($connection->query($query)) {
                        ?>
                        <div>
                            <div class="alert alert-success">
                                <strong>Success!</strong> Selected Client has been deleted.
                            </div>
                            <p class="form-control-static"><b>Client ID: </b><?php echo $row["CLIENT_ID"]?></p>
                            <p class="form-control-static"><b>Client Name: </b><?php echo $row["CLIENT_GNAME"]?> <?php echo $row["CLIENT_FNAME"]?></p>
                            <p class="form-control-static"><b>Client Address: </b><?php echo $row["CLIENT_STREET"]?>, <?php echo $row["CLIENT_SUBURB"]?>, <?php echo $row["CLIENT_STATE"]?>, <?php echo $row["CLIENT_PC"]?></p>
                            <p class="form-control-static"><b>Client E-Mail: </b><?php echo $row["CLIENT_EMAIL"]?></p>
                            <p class="form-control-static"><b>Client Mobile Number: </b><?php echo $row["CLIENT_MOBILE"]?></p>
                            <p class="form-control-static"><b>On Mailing List: </b><?php echo $row["CLIENT_MAIL"]?></p>
                        </div>
                    <?php }
                    else { ?>
                        <div class="alert alert-danger">
                            <strong>Failed!</strong>
                            Something went wrong in the deletion progress. <br><br>
                            (If there is a property with the designated client, please make modifications to it before deleting this client.)
                        </div>
                    <?php }
                    ?>
                    <button type="button" class="btn btn-default" OnClick = 'window.location="Client.php"'>Return to Data</button>
                    <?php break;

                case "Update":
                    $query="SELECT * FROM CLIENT WHERE CLIENT_ID =".$_GET["clientid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <div>
                        <div class="col-lg-6">
                            <form method="post" action=Client_Modify.php?clientid=<?php echo $_GET["clientid"];?>&Action=ConfirmUpdate>
                                <fieldset>
                                    <superscript class="text-danger" style="font-size: x-small">*Required Field</superscript>
                                    <div class="form-group">
                                        <label for="deleteClientID">Client ID:</label>
                                        <input class="form-control" name="updateClientID" type="text" value="<?php echo $row["CLIENT_ID"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientG">Client Given Name:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updateClientG" type="text" value="<?php echo $row["CLIENT_GNAME"]?>" maxlength="50" onInvalid="verifyEntry(this,'given name');"
                                               onInput="verifyEntry(this,'given name');" placeholder="Given Name" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientF">Client Family Name:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updateClientF" type="text" value="<?php echo $row["CLIENT_FNAME"]?>" onInvalid="verifyEntry(this,'family name');"
                                               onInput="verifyEntry(this,'family name');"placeholder="Family Name" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientStreet">Client Address - Street:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updateClientStreet" type="text" value="<?php echo $row["CLIENT_STREET"]?>" onInvalid="verifyEntry(this,'street');"
                                               onInput="verifyEntry(this,'street');" placeholder="Street" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientSuburb">Client Address - Suburb:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updateClientSuburb" type="text" value="<?php echo $row["CLIENT_SUBURB"]?>" onInvalid="verifyEntry(this,'suburb');"
                                               onInput="verifyEntry(this,'suburb');" placeholder="Suburb" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientState">Client Address - State:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updateClientState" type="text" value="<?php echo $row["CLIENT_STATE"]?>" onInvalid="verifyEntry(this,'state');"
                                               onInput="verifyEntry(this,'state');" placeholder="State" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientPostcode">Client Address - Postcode:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updateClientPostcode" type="number" value="<?php echo $row["CLIENT_PC"]?>" onInvalid="verifyEntry(this,'postcode');"
                                               onInput="verifyEntry(this,'postcode');" placeholder="Postcode" required/>
                                    </div>


                                    <div class="form-group">
                                        <label for="deleteClientEmail">Client E-Mail:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updateClientEmail" type="text" value="<?php echo $row["CLIENT_EMAIL"]?>" onInvalid="verifyEntry(this,'email address');"
                                               onInput="verifyEntry(this,'email');" placeholder="E-Mail Address" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deleteClientMobile">Client Mobile Number:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updateClientMobile" type="text" value="<?php echo $row["CLIENT_MOBILE"]?>" onInvalid="verifyEntry(this,'mobile number');"
                                               onInput="verifyEntry(this,'mobile number');" placeholder="Mobile Number" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updateClientMail">On Mailing List:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <select class="form-control" name="updateClientMail">
                                            <option value="Y" <?php echo fSelect($row["CLIENT_MAIL"],"Y")?>>Y</option>
                                            <option value="N" <?php echo fSelect($row["CLIENT_MAIL"],"N")?>>N</option>
                                        </select>
                                    </div>

                                    <input type="submit" class="btn btn-primary" value="Update"/>
                                    &nbsp;
                                    <button type="button" class="btn btn-default" OnClick = 'window.location="Client.php"'>Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <?php break;

                case "ConfirmUpdate":
                    $query="SELECT * FROM CLIENT WHERE CLIENT_ID =".$_GET["clientid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    $query="UPDATE CLIENT SET
                            CLIENT_GNAME=?,
                            CLIENT_FNAME=?,
                            CLIENT_STREET=?,
                            CLIENT_SUBURB=?,
                            CLIENT_STATE=?,
                            CLIENT_PC=?,
                            CLIENT_EMAIL=?,
                            CLIENT_MOBILE=?,
                            CLIENT_MAIL=?
                            WHERE CLIENT_ID=".$_GET["clientid"];

                    $queryprep = mysqli_prepare($connection, $query);
                    $queryprep->bind_param('sssssssss', $ClientG,$ClientF,
                                          $ClientStreet, $ClientSuburb, $ClientState,$ClientPostcode,
                                          $ClientEmail, $ClientMobile, $ClientMail);

                    $ClientG = $_POST['updateClientG'];
                    $ClientF = $_POST['updateClientF'];
                    $ClientStreet = $_POST['updateClientStreet'];
                    $ClientSuburb = $_POST['updateClientSuburb'];
                    $ClientState = $_POST['updateClientState'];
                    $ClientPostcode = $_POST['updateClientPostcode'];
                    $ClientEmail = $_POST['updateClientEmail'];
                    $ClientMobile = $_POST['updateClientMobile'];
                    $ClientMail = $_POST['updateClientMail'];

                    if ($queryprep->execute()){
                    ?>
                    <fieldset>
                        <div class="alert alert-success">
                            <strong>Success!</strong> Selected Client has been updated.
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
                                <td valign="center"><h5><b>Client ID: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateClientID" type="text" value="<?php echo $row["CLIENT_ID"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedClientID" type="text" value="<?php echo $row["CLIENT_ID"]?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>Client Given Name: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateClientG" type="text" value="<?php echo $row["CLIENT_GNAME"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedClientG" type="text" value="<?php echo $_POST['updateClientG']?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>Client Family Name: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateClientF" type="text" value="<?php echo $row["CLIENT_FNAME"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedClientF" type="text" value="<?php echo $_POST['updateClientF']?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>Client Street: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateClientStreet" type="text" value="<?php echo $row["CLIENT_STREET"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedClientStreet" type="text" value="<?php echo $_POST['updateClientStreet']?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>Client Suburb: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateClientSuburb" type="text" value="<?php echo $row["CLIENT_SUBURB"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedClientSuburb" type="text" value="<?php echo $_POST['updateClientSuburb']?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>Client State: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateClientState" type="text" value="<?php echo $row["CLIENT_STATE"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedClientState" type="text" value="<?php echo $_POST['updateClientState']?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>Client Postcode: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateClientPostcode" type="text" value="<?php echo $row["CLIENT_PC"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedClientPostcode" type="text" value="<?php echo $_POST['updateClientPostcode']?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>Client E-Mail: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateClientEmail" type="text" value="<?php echo $row["CLIENT_EMAIL"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedClientEmail" type="text" value="<?php echo $_POST['updateClientEmail']?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>Client Mobile: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateClientMobile" type="text" value="<?php echo $row["CLIENT_MOBILE"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedClientMobile" type="text" value="<?php echo $_POST['updateClientMobile']?>" disabled/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td valign="center"><h5><b>On Mailing List: &nbsp;&nbsp;</b></h5></td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updateClientMail" type="text" value="<?php echo $row["CLIENT_MAIL"]?>" disabled/>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="form-group">
                                        <input class="form-control" id="updatedClientMail" type="text" value="<?php echo $_POST['updateClientMail']?>" disabled/>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <?php }else{?>
                        <div class="alert alert-danger">
                            <strong>Failed!</strong> Something went wrong during the updating process.
                        </div>
                        <?php }?>
                    <button type="button" class="btn btn-default" OnClick = 'window.location="Client.php"'>Return To Data</button>
                    </fieldset>
                    <?php
                    break;

                case "Insert":
                    if(empty($_POST['insertClientG'])){?>
                        <div>
                            <div class="col-lg-6">
                                <form method="post" action="Client_Modify.php?Action=Insert">
                                    <fieldset>
                                        <superscript class="text-danger" style="font-size: x-small">*Required Fields</superscript>
                                        <div class="form-group">
                                            <label for="insertClientID">Client ID:</label>
                                            <input class="form-control" id="insertClientID" type="text" value="Automatically generated upon successful insertion." disabled/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertClientG">Client Given Name: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertClientG" type="text" placeholder="Given Name" onInvalid="verifyEntry(this,'given name');"
                                                   onInput="verifyEntry(this,'given name');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertClientF">Client Family Name: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertClientF" type="text" placeholder="Family Name" onInvalid="verifyEntry(this,'family name');"
                                                   onInput="verifyEntry(this,'mobile number');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertClientStreet">Client Street: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertClientStreet" type="text" placeholder="Street" onInvalid="verifyEntry(this,'street');"
                                                   onInput="verifyEntry(this,'street');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertClientSuburb">Client Suburb: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertClientSuburb" type="text" placeholder="Suburb" onInvalid="verifyEntry(this,'suburb');"
                                                   onInput="verifyEntry(this,'suburb');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertClientState">Client State: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertClientState" type="text" placeholder="State" onInvalid="verifyEntry(this,'state');"
                                                   onInput="verifyEntry(this,'state');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertClientPostcode">Client Postcode: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertClientPostcode" type="number" placeholder="Postcode" onInvalid="verifyEntry(this,'postcode');"
                                                   onInput="verifyEntry(this,'postcode');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertClientEmail">Client E-Mail: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertClientEmail" type="text" placeholder="E-Mail Address" onInvalid="verifyEntry(this,'e-mail address');"
                                                   onInput="verifyEntry(this,'e-mail address');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertClientMobile">Client Mobile: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertClientMobile" type="text" placeholder="Mobile Number" onInvalid="verifyEntry(this,'mobile number');"
                                                   onInput="verifyEntry(this,'mobile number');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertClientMail">On Mailing List: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <?php
                                            $query="SELECT DISTINCT CLIENT_MAIL FROM CLIENT ORDER BY CLIENT_MAIL desc";
                                            $result = mysqli_query($connection,$query);
                                            ?>
                                            <select class="form-control" name="insertClientMail" required>
                                                <option value="" disabled selected>Select</option>
                                                    <option>Y</option>
                                                    <option>N</option>
                                            </select>
                                        </div>

                                        <input type="submit" class="btn btn-success" value="Insert">
                                        &nbsp;
                                        <button type="button" class="btn btn-default" OnClick = 'window.location="Client.php"'>Cancel</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    <?php } else{
                        $query="INSERT INTO CLIENT
                                  (CLIENT_GNAME, CLIENT_FNAME, CLIENT_STREET,
                                   CLIENT_SUBURB, CLIENT_STATE, CLIENT_PC,
                                   CLIENT_EMAIL, CLIENT_MOBILE, CLIENT_MAIL) VALUES (?,?,?,?,?,?,?,?,?)";
                    $queryprep = mysqli_prepare($connection, $query);
                    $queryprep->bind_param('sssssssss', $ClientG,$ClientF,
                        $ClientStreet, $ClientSuburb, $ClientState,$ClientPostcode,
                        $ClientEmail, $ClientMobile, $ClientMail);

                    $ClientG = $_POST['insertClientG'];
                    $ClientF = $_POST['insertClientF'];
                    $ClientStreet = $_POST['insertClientStreet'];
                    $ClientSuburb = $_POST['insertClientSuburb'];
                    $ClientState = $_POST['insertClientState'];
                    $ClientPostcode = $_POST['insertClientPostcode'];
                    $ClientEmail = $_POST['insertClientEmail'];
                    $ClientMobile = $_POST['insertClientMobile'];
                    $ClientMail = $_POST['insertClientMail'];

                    if ($queryprep->execute()){
                    ?>
                            <div class="alert alert-success">
                                <strong>Success!</strong> A new Client has been added.
                            </div>
                            <p class="form-control-static"><b>Client ID: </b><?php echo mysqli_insert_id($connection)?></p>
                            <p class="form-control-static"><b>Client Given Name: </b><?php echo $_POST['insertClientG']?></p>
                            <p class="form-control-static"><b>Client Family Name: </b><?php echo $_POST['insertClientF']?></p>
                            <p class="form-control-static"><b>Client Street: </b><?php echo $_POST['insertClientStreet']?></p>
                            <p class="form-control-static"><b>Client Suburb: </b><?php echo $_POST['insertClientSuburb']?></p>
                            <p class="form-control-static"><b>Client State: </b><?php echo $_POST['insertClientState']?></p>
                            <p class="form-control-static"><b>Client Postcode: </b><?php echo $_POST['insertClientPostcode']?></p>
                            <p class="form-control-static"><b>Client E-Mail: </b><?php echo $_POST['insertClientEmail']?></p>
                            <p class="form-control-static"><b>Client Mobile: </b><?php echo $_POST['insertClientMobile']?></p>
                            <p class="form-control-static"><b>On Mailing List: </b><?php echo $_POST['insertClientMail']?></p>
                    <?php }else{
                        ?>
                        <div class="alert alert-danger">
                            <strong>Failed!</strong> Something went wrong in the insertion process.
                        </div>
                        <?php
                    } ?>
                            <br>
                            <button type="button" class="btn btn-default" OnClick = 'window.location="Client.php"'>Return To Data</button>

                        </div>
                    <?php }?>

                    <?php break;}
                    mysqli_close($connection);
            ?>
            <!-- /.row -->
        </div>
    <br>
    <a href="Source_Code.php?filename=<?php echo $_SERVER["SCRIPT_FILENAME"]?>">
        <image src="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Client_SC.JPG" width="120" height="30"></image>
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
        window.location='Client_Modify.php?clientid=<?php echo $_GET["clientid"];?>&Action=ConfirmDelete';
    }
</script>

<script>
    function confirm_update()
    {
        window.location='Client_Modify.php?clientid=<?php echo $_GET["clientid"];?>&Action=ConfirmUpdate';
    }
</script>

<script>
    function setSelectBoxByValue {
        document.getElementById(eid).value = eval;
    }
</script>

    </body>

    </html>
