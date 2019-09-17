<?php
ob_start();
session_start();
define('MB', 1048576);
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
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modifying Property</title>

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

<script language="JavaScript">
    function verifyDate(textbox, name)
    {
        if(((textbox.value >= 0) && (textbox.value <= )))
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
if (isset($_SESSION['User'])){
//Connecting to the database.
include"Connection.php";
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo $_SESSION['User'];?> <b class="caret"></b></a>
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
                <li class="active">
                    <a href="#"><i class="fa fa-building-o"></i> Properties</a>
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
                        Property Modification
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>  <a href="Index.php">Home</a>
                        </li>
                        <li>
                            <i class="fa fa-building-o"></i> <a href="Property.php">Properties</a>
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
                    $query="SELECT * FROM PROPERTY p JOIN TYPE t on p.PROPERTY_TYPE = t.TYPE_ID JOIN CLIENT c ON p.SELLER_ID = c.CLIENT_ID WHERE PROPERTY_ID =".$_GET["propertyid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <div>
                        <div class="col-lg-6">
                            <form method="post" action="Property_Modify.php?propertyid=<?php echo $_GET["propertyid"];?>&Action=ConfirmDelete">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="deletePropertyID">Property ID:</label>
                                        <input class="form-control" id="deletePropertyID" type="text" value="<?php echo $row["PROPERTY_ID"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertyStreet">Property Street:</label>
                                        <input class="form-control" name="deletePropertyStreet" type="text" value="<?php echo $row["PROPERTY_STREET"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertySuburb">Property Suburb:</label>
                                        <input class="form-control" name="deletePropertySuburb" type="text" value="<?php echo $row["PROPERTY_SUBURB"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertyState">Property State:</label>
                                        <input class="form-control" name="deletePropertyState" type="text" value="<?php echo $row["PROPERTY_STATE"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertyPC">Property Postcode:</label>
                                        <input class="form-control" name="deletePropertyPC" type="text" value="<?php echo $row["PROPERTY_PC"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertyType">Property Type:</label>
                                        <input class="form-control" name="deletePropertyPC" type="text" value="<?php echo $row["TYPE_NAME"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertySeller">Property Seller:</label>
                                        <input class="form-control" name="deletePropertySeller" type="text" value="<?php echo $row["CLIENT_GNAME"]?> <?php echo $row["CLIENT_FNAME"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertyListD">Property List Date:</label>
                                        <input class="form-control" name="deletePropertyListD" type="text" value="<?php echo $row["LISTING_DATE"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertyListP">Property List Price:</label>
                                        <input class="form-control" name="deletePropertyListP" type="text" value="<?php echo $row["LISTING_PRICE"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertySaleD">Property Sale Date:</label>
                                        <input class="form-control" name="deletePropertySaleD" type="text" value="<?php echo $row["SALE_DATE"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertySaleP">Property Sale Price:</label>
                                        <input class="form-control" name="deletePropertySaleP" type="text" value="<?php echo $row["SALE_PRICE"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="deletePropertyImage">Property Image:</label>
                                        <input class="form-control" name="deletePropertyImage" type="text" value="<?php echo $row["IMAGE_NAME"]?>" disabled/>
                                    </div>


                                    <div class="form-group">
                                        <label for="deletePropertyDesc">Property Description:</label>
                                        <textarea class="form-control" rows="5" name="deletePropertyDesc" disabled><?php echo $row["PROPERTY_DESC"]?></textarea>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <h3>Property - Feature Management</h3>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped col-lg-5">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Allocated Feature</th>
                                                <th class="text-center">Description</th>
                                            </tr>
                                            </thead>
                                            <tbody id="FeatureTable">
                                            <?php
                                            $query="SELECT * FROM PROPERTYFEATURE pf LEFT JOIN FEATURE ON pf.FEATURE_ID = feature.FEATURE_ID WHERE PROPERTY_ID=".$row["PROPERTY_ID"];
                                            $result = mysqli_query($connection,$query);
                                            while ($row = $result->fetch_array()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row["FEATURE_NAME"]?></td>
                                                    <td>
                                                        <input class="form-control" type="text" name="<?php echo $row["FEATURE_ID"]?>" value="<?php echo $row["FEATURE_DESC"]?>" disabled>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <p class="text-danger" style="font-size: small">This action cannot be undone!</p>
                                    <button type="button" class="btn btn-danger" OnClick="confirm_delete();">Delete Anyway</button>
                                    &nbsp;
                                    <button type="button" class="btn btn-default" OnClick = 'window.location="Property.php"'>Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <?php break;

                case "ConfirmDelete":
                    $query="SELECT * FROM PROPERTY p JOIN TYPE t on p.PROPERTY_TYPE = t.TYPE_ID JOIN CLIENT c ON p.SELLER_ID = c.CLIENT_ID WHERE PROPERTY_ID =".$_GET["propertyid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();

                    $featurequery="SELECT * FROM PROPERTYFEATURE pf JOIN FEATURE f ON pf.FEATURE_ID = f.FEATURE_ID WHERE PROPERTY_ID =".$_GET["propertyid"];
                    $featureresult=$connection->query($featurequery);

                    $query="DELETE FROM PROPERTY WHERE PROPERTY_ID=".$_GET["propertyid"];
                    $deletequery="DELETE FROM PROPERTYFEATURE WHERE PROPERTY_ID=".$_GET["propertyid"];
                    if($connection->query($deletequery)){
                        ?>
                        <div>
                            <div class="alert alert-success">
                                <strong>Success!</strong> Selected Property has been deleted.
                            </div>
                            <p class="form-control-static"><b>Property ID: </b><?php echo $row["PROPERTY_ID"]?></p>
                            <p class="form-control-static"><b>Property Address: </b><?php echo $row["PROPERTY_STREET"]?>, <?php echo $row["PROPERTY_SUBURB"]?>, <?php echo $row["PROPERTY_STATE"]?>, <?php echo $row["PROPERTY_PC"]?></p>
                            <p class="form-control-static"><b>Property Type: </b><?php echo $row["TYPE_NAME"]?></p>
                            <p class="form-control-static"><b>Property Seller: </b><?php echo $row["CLIENT_GNAME"]?> <?php echo $row["CLIENT_FNAME"]?></p>
                            <p class="form-control-static"><b>Property Listing Date: </b><?php echo $row["LISTING_DATE"]?></p>
                            <p class="form-control-static"><b>Property Listing Price: </b><?php echo $row["LISTING_PRICE"]?></p>
                            <p class="form-control-static"><b>Property Sale Date: </b><?php echo $row["SALE_DATE"]?></p>
                            <p class="form-control-static"><b>Property Sale Price: </b><?php echo $row["SALE_PRICE"]?></p>
                            <p class="form-control-static"><b>Property Image: </b><?php echo $row["IMAGE_NAME"]?></p>
                            <p class="form-control-static"><b>Property Description: </b><?php echo $row["PROPERTY_DESC"]?></p>
                        </div>
                    <?php
                        if($connection->query($query)){
                            unlink('property_image/'.$row["IMAGE_NAME"]);
                            ?>
                            <br>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <h4>Deleted Features:</h4>
                                <div class="row">
                                <div class="col-lg-6">
                                <table class="table table-bordered table-hover table-striped col-lg-5">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Feature Name</th>
                                        <th class="text-center">Description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($featurerow = $featureresult->fetch_array()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $featurerow["FEATURE_NAME"]?></td>
                                            <td>
                                                <input class="form-control" type="text" name="<?php echo $featurerow["FEATURE_ID"]?>" value="<?php echo $featurerow["FEATURE_DESC"]?>" disabled>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                                </div>
                            </div>

                            <?php
                        }else{
                            ?>
                            <div class="alert alert-danger">
                                <strong>Failed!</strong> There is something wrong in the deletion process of Property Features.
                            </div>
                            <?php
                        }
                    }
                    else { ?>
                        <div class="alert alert-danger">
                            <strong>Failed!</strong> There is something wrong in the deletion process of the Property.
                        </div>
                    <?php }
                    ?>
                    <button type="button" class="btn btn-default" OnClick = 'window.location="Property.php"'>Return to Data</button>
                    <?php break;

                case "Update":
                    $query="SELECT * FROM PROPERTY p 
                            JOIN TYPE t on p.PROPERTY_TYPE = t.TYPE_ID 
                            JOIN CLIENT c ON p.SELLER_ID = c.CLIENT_ID 
                            WHERE PROPERTY_ID =".$_GET["propertyid"];
                    $result = $connection->query($query);
                    $row = $result->fetch_assoc();
                    ?>
                    <div>
                        <div class="col-lg-6">
                            <form method="post" action="Property_Modify.php?propertyid=<?php echo $_GET["propertyid"];?>&Action=ConfirmUpdate" enctype="multipart/form-data">
                                <fieldset>
                                    <superscript class="text-danger" style="font-size: x-small">*Required Fields</superscript>
                                    <div class="form-group">
                                        <label for="updatePropertyID">Property ID:</label>
                                        <input class="form-control" name="updatePropertyID" type="text" value="<?php echo $row["PROPERTY_ID"]?>" disabled/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertyStreet">Property Street:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updatePropertyStreet" type="text" value="<?php echo $row["PROPERTY_STREET"]?>" maxlength="100" onInvalid="verifyEntry(this,'street');"
                                               onInput="verifyEntry(this,'street');" placeholder="Street" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertySuburb">Property Suburb:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updatePropertySuburb" type="text" value="<?php echo $row["PROPERTY_SUBURB"]?>" maxlength="50" onInvalid="verifyEntry(this,'suburb');"
                                               onInput="verifyEntry(this,'suburb');" placeholder="Suburb" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertyState">Property State:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updatePropertyState" type="text" value="<?php echo $row["PROPERTY_STATE"]?>" maxlength="5" onInvalid="verifyEntry(this,'state');"
                                               onInput="verifyEntry(this,'state');" placeholder="State" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertyPC">Property Postcode:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updatePropertyPC" type="text" value="<?php echo $row["PROPERTY_PC"]?>" maxlength="10" onInvalid="verifyEntry(this,'postcode');"
                                               onInput="verifyEntry(this,'postcode');" placeholder="Postcode" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertyType">Property Type:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <select class="form-control" name="updatePropertyType" onInvalid="verifyEntry(this,'type');"
                                                onInput="verifyEntry(this,'type');" required/>
                                        <?php
                                        $typequery="SELECT * FROM TYPE ORDER BY TYPE_NAME asc";
                                        $typeresult=$connection->query($typequery);
                                            while ($typerow = $typeresult->fetch_assoc()) { ?>
                                                <option value="<?php echo $typerow["TYPE_ID"];?>"<?php echo fSelect($row["TYPE_ID"],$typerow["TYPE_ID"])?>>
                                                    <?php echo $typerow["TYPE_NAME"];?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertySeller">Property Seller:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <?php
                                        $sellerquery="SELECT * FROM CLIENT ORDER BY CLIENT_GNAME asc";
                                        $sellerresult=$connection->query($sellerquery);
                                        ?>
                                        <select class="form-control" name="updatePropertySeller" onInvalid="verifyEntry(this,'seller');"
                                                onInput="verifyEntry(this,'seller');" required>
                                            <?php
                                            while ($sellerrow = $sellerresult->fetch_assoc()) { ?>
                                                <option value="<?php echo $sellerrow["CLIENT_ID"];?>"<?php echo fSelect($row["SELLER_ID"],$sellerrow["CLIENT_ID"])?>><?php echo $sellerrow["CLIENT_GNAME"];?> <?php echo $sellerrow["CLIENT_FNAME"];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertyListD">Property Listing Date: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" id="updatePropertyListD" placeholder="Listing Date" name="updatePropertyListD" type="date" value="<?php echo $row["LISTING_DATE"]?>" onInvalid="verifyEntry(this,'list date');"
                                               onInput="verifyEntry(this,'list date');" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertyListP">Property Listing Price: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <input class="form-control" name="updatePropertyListP" placeholder="Listing Price" type="number" min="0" max="99999999.99" value="<?php echo $row["LISTING_PRICE"]?>" onInvalid="verifyPrice(this,'list price');"
                                               onInput="verifyEntry(this,'list price');" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertySaleD">Property Sale Date:</label>
                                        <input class="form-control" name="updatePropertySaleD" placeholder="Sale Date" type="date" value="<?php echo $row["SALE_DATE"]?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertySaleP">Property Sale Price:</label>
                                        <input class="form-control" name="updatePropertySaleP" placeholder="Sale Price" type="number" min="0" max="99999999.99" value="<?php echo $row["SALE_PRICE"]?>" onInvalid="verifyNULLPrice(this,'updatePropertyListD' ,'sale price');"
                                               onInput="verifyNULLPrice(this,'sale price');"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertyImage">Property Image: <superscript class="text-danger" style="font-size: x-small">*File must be of JPG/JPEG/PNG format with maximum of 10 MB file size!</superscript></label>
                                        <?php
                                        $dirname = "property_image/";
                                        echo "<td><div><a href=".$dirname.$row["IMAGE_NAME"].">Click this link to view currently allocated image</a></div></td>";
                                        ?>
                                        <br>
                                        <input type="file" size="50" name="updatePropertyImage"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="updatePropertyDesc">Property Description:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                        <textarea class="form-control" rows="5" name="updatePropertyDesc" required><?php echo $row["PROPERTY_DESC"]?></textarea>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <h3>Property - Feature Management</h3>
                                    <br>
                                        <table class="table table-bordered table-hover table-striped col-lg-5">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Available Feature</th>
                                                <th class="text-center">Update Flag</th>
                                                <th class="text-center">Description</th>
                                            </tr>
                                            </thead>
                                            <tbody id="FeatureTable">
                                            <?php
                                            $showpid = $_GET["propertyid"];
                                            $ufquery="SELECT f.FEATURE_ID, FEATURE_NAME, FEATURE_DESC, PROPERTY_ID FROM FEATURE f LEFT JOIN (SELECT * FROM PROPERTYFEATURE WHERE PROPERTY_ID=$showpid) AS p on f.FEATURE_ID = p.FEATURE_ID";
                                            $ufresult = $connection->query($ufquery);

                                            while ($ufrow = $ufresult->fetch_array()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $ufrow["FEATURE_NAME"]?></td>
                                                    <td align="center">
                                                        <input class='form-check-input' type='checkbox' name='fcheck[]' value="<?php echo $ufrow["FEATURE_ID"]?>"<?php if($ufrow["PROPERTY_ID"] == $_GET["propertyid"]){echo " checked";} ?>/>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="<?php echo ($ufrow["FEATURE_ID"]) ?>" value="<?php if($ufrow["PROPERTY_ID"] == $_GET["propertyid"]){echo $ufrow["FEATURE_DESC"];}?>"/>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Update"/>
                                    &nbsp;
                                    <button type="button" class="btn btn-default" OnClick = 'window.location="Property.php"'>Cancel</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                   <?php break;

                case "ConfirmUpdate":
                        $query = "SELECT * FROM PROPERTY p 
                            JOIN TYPE t on p.PROPERTY_TYPE = t.TYPE_ID 
                            JOIN CLIENT c ON p.SELLER_ID = c.CLIENT_ID 
                            WHERE PROPERTY_ID =" . $_GET["propertyid"];
                        $result = $connection->query($query);
                        $row = $result->fetch_assoc();
                        $updatequery = "UPDATE PROPERTY SET 
                                      PROPERTY_STREET=?,
                                      PROPERTY_SUBURB=?,
                                      PROPERTY_STATE=?,
                                      PROPERTY_PC=?,
                                      PROPERTY_TYPE=?,
                                      SELLER_ID=?,
                                      LISTING_DATE=?,
                                      LISTING_PRICE=?,
                                      SALE_DATE=?,
                                      SALE_PRICE=?,
                                      IMAGE_NAME=?,
                                      PROPERTY_DESC=? WHERE PROPERTY_ID=" . $_GET["propertyid"];
                        $updateprep = mysqli_prepare($connection, $updatequery);
                        $updateprep->bind_param('ssssiisdsdss',
                            $pstreet, $psuburb, $pstate, $ppostcode, $ptype, $pseller, $plistd, $plistp, $psaled, $psalep, $pimage, $pdesc);

                        $pstreet = $_POST["updatePropertyStreet"];
                        $psuburb = $_POST["updatePropertySuburb"];
                        $pstate = $_POST["updatePropertyState"];
                        $ppostcode = $_POST["updatePropertyPC"];
                        $ptype = $_POST["updatePropertyType"];
                        $pseller = $_POST["updatePropertySeller"];
                        $plistd = $_POST["updatePropertyListD"];
                        $plistp = $_POST["updatePropertyListP"];

                        if (!empty($_POST["updatePropertySaleD"])) {
                            $psaled = $_POST["updatePropertySaleD"];
                        }else{
                            $psaled = NULL;
                        }
                        if (!empty($_POST["updatePropertySaleP"])) {
                            $psalep = $_POST["updatePropertySaleP"];
                        }else{
                            $psalep = NULL;
                        }

                        $checkimage = FALSE;

                        if (empty($_FILES['updatePropertyImage']['name'])){
                            $pimage = $row["IMAGE_NAME"];
                            $checkimage = FALSE;
                        } else {
                            $checkimage = TRUE;
                            $pimage = $_FILES["updatePropertyImage"]["name"];
                        }
                        $pdesc = $_POST["updatePropertyDesc"];

                        $checkupload = TRUE;

                        if ($checkimage === TRUE) {
                            $upfile = "property_image/" . $_FILES["updatePropertyImage"]["name"];
                            if ($_FILES["updatePropertyImage"]["type"] != "image/png" && $_FILES["updatePropertyImage"]["type"] != "image/jpg" && $_FILES["updatePropertyImage"]["type"] != "image/jpeg") { ?>
                                <div class="alert alert-danger">
                                    <strong>Failed!</strong> Only .JPG/.PNG/.JPEG files can be uploaded!
                                </div>
                                <?php
                            } elseif ($_FILES["updatePropertyImage"]["size"] > (10 * MB)) {
                                ?>
                                <div class="alert alert-danger">
                                    <strong>Failed!</strong> File size must be smaller than 10MB.
                                </div>
                                <?php
                            } else {
                                if (move_uploaded_file($_FILES["updatePropertyImage"]["tmp_name"], $upfile)) {
                                    $checkupload = TRUE;
                                    unlink('property_image/' . $row["IMAGE_NAME"]);
                                }else{
                                    $checkupload = FALSE;
                                }
                            }
                        }
                        if ($checkupload === TRUE) {
                            if ($updateprep->execute()) {
                                $udquery = "SELECT * FROM PROPERTYFEATURE pf LEFT JOIN FEATURE f ON pf.FEATURE_ID = f.FEATURE_ID WHERE PROPERTY_ID=" . $_GET["propertyid"]." ORDER BY FEATURE_NAME";
                                $udresult = $connection->query($udquery);
                                $udrow = $udresult->fetch_assoc();

                                $udfquery = "DELETE FROM PROPERTYFEATURE WHERE PROPERTY_ID=" . $_GET["propertyid"];
                                $connection->query($udfquery);

                                if(isset($_POST["fcheck[]"])) {
                                    foreach ($_POST["fcheck"] as $FID) {
                                        $updatefquery = "INSERT INTO PROPERTYFEATURE (PROPERTY_ID, FEATURE_ID, FEATURE_DESC) VALUES (?,?,?)";
                                        $updatefprep = mysqli_prepare($connection, $updatefquery);
                                        $updatefprep->bind_param('iis', $updatepid, $updatefid, $updatedesc);
                                        $updatepid = $_GET["propertyid"];
                                        $updatefid = $FID;
                                        $updatedesc = $_POST[$FID];
                                        if ($updatefprep->execute()) {
                                            echo "NICE";
                                        } else {
                                            echo "FAIL";
                                        }
                                    }
                                }
                                ?>

                                <fieldset>
                                    <div class="alert alert-success">
                                        <strong>Success!</strong> Data updated successfully.
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
                                            <td valign="center"><h5><b>Property ID: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPID" type="text"
                                                           value="<?php echo $row["PROPERTY_ID"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="updatedPID" type="text"
                                                           value="<?php echo $row["PROPERTY_ID"] ?>" disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Street: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPStreet" type="text"
                                                           value="<?php echo $row["PROPERTY_STREET"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="updatedPStreet" type="text"
                                                           value="<?php echo $_POST['updatePropertyStreet'] ?>"
                                                           disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Suburb: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPSuburb" type="text"
                                                           value="<?php echo $row["PROPERTY_SUBURB"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="updatedPSuburb" type="text"
                                                           value="<?php echo $_POST['updatePropertySuburb'] ?>"
                                                           disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property State: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPState" type="text"
                                                           value="<?php echo $row["PROPERTY_STATE"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="updatedPState" type="text"
                                                           value="<?php echo $_POST['updatePropertyState'] ?>" disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Postcode: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPPC" type="text"
                                                           value="<?php echo $row["PROPERTY_PC"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="updatedClientSuburb" type="text"
                                                           value="<?php echo $_POST['updatePropertyPC'] ?>" disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Type: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPType" type="text"
                                                           value="<?php echo $row["TYPE_NAME"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <?php
                                                    $selectquery = "SELECT * FROM TYPE WHERE TYPE_ID=" . $_POST['updatePropertyType'];
                                                    $selectresult = $connection->query($selectquery);
                                                    $selectrow = $selectresult->fetch_assoc();
                                                    ?>
                                                    <input class="form-control" id="updatedPType" type="text"
                                                           value="<?php echo $selectrow["TYPE_NAME"] ?>" disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Seller: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPSeller" type="text"
                                                           value="<?php echo $row["CLIENT_GNAME"] ?> <?php echo $row["CLIENT_FNAME"] ?>"
                                                           disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <?php
                                                    $selectquery = "SELECT * FROM CLIENT WHERE CLIENT_ID=" . $_POST['updatePropertySeller'];
                                                    $selectresult = $connection->query($selectquery);
                                                    $selectrow = $selectresult->fetch_assoc();
                                                    ?>
                                                    <input class="form-control" id="updatedPSeller" type="text"
                                                           value="<?php echo $selectrow["CLIENT_GNAME"] . " " . $selectrow["CLIENT_FNAME"] ?>"
                                                           disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Listing Date: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPListD" type="text"
                                                           value="<?php echo $row["LISTING_DATE"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="updatedPListD" type="text"
                                                           value="<?php echo $_POST['updatePropertyListD'] ?>" disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Listing Price: &nbsp;&nbsp;</b></h5>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPListP" type="text"
                                                           value="<?php echo $row["LISTING_PRICE"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="updatePListP" type="text"
                                                           value="<?php echo $_POST['updatePropertyListP'] ?>" disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Sale Date: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPSaleD" type="text"
                                                           value="<?php echo $row["SALE_DATE"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="updatedPSaleD" type="text"
                                                           value="<?php echo $_POST['updatePropertySaleD'] ?>" disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Sale Price: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPSaleP" type="text"
                                                           value="<?php echo $row["SALE_PRICE"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="updatedPSaleP" type="text"
                                                           value="<?php echo $_POST['updatePropertySaleP'] ?>" disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Image Name: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="originalPImage" type="text"
                                                           value="<?php echo $row["IMAGE_NAME"] ?>" disabled>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" id="updatedPSaleD" type="text"
                                                           value="<?php echo $pimage ?>"
                                                           disabled>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td valign="center"><h5><b>Property Description: &nbsp;&nbsp;</b></h5></td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="originalPDesc"
                                                              disabled><?php echo $row["PROPERTY_DESC"] ?></textarea>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="updatedPDesc"
                                                              disabled><?php echo $_POST["updatePropertyDesc"] ?></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                                <br>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="table-responsive col-lg-6">
                                        <h4>Original Features:</h4>
                                        <table class="table table-bordered table-hover table-striped col-lg-5">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Feature Name</th>
                                                <th class="text-center">Description</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            mysqli_data_seek($udresult, 0);
                                            while ($xudrow = $udresult->fetch_array()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $xudrow["FEATURE_NAME"] ?></td>
                                                    <td>
                                                        <input class="form-control" type="text"
                                                               name="<?php echo $xudrow["FEATURE_ID"] ?>"
                                                               value="<?php echo $xudrow["FEATURE_DESC"] ?>" disabled>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive col-lg-6">
                                        <h4>Updated Features:</h4>
                                        <table class="table table-bordered table-hover table-striped col-lg-5">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Feature Name</th>
                                                <th class="text-center">Description</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $newudquery = "SELECT * FROM PROPERTYFEATURE pf LEFT JOIN FEATURE f ON pf.FEATURE_ID = f.FEATURE_ID WHERE PROPERTY_ID=" . $_GET["propertyid"] ." ORDER BY FEATURE_NAME";
                                            $newudresult = $connection->query($newudquery);
                                            while ($newudrow = $newudresult->fetch_array()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $newudrow["FEATURE_NAME"] ?></td>
                                                    <td>
                                                        <input class="form-control" type="text"
                                                               name="<?php echo $newudrow["FEATURE_ID"] ?>"
                                                               value="<?php echo $newudrow["FEATURE_DESC"] ?>" disabled>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php
                            } else { ?>
                                <div class="alert alert-danger">
                                    <strong>Failed!</strong> Something went wrong in the update process (Property data was not updated successfully).
                                </div>
                                <?php
                            }
                        }else { ?>
                            <div class="alert alert-danger">
                                <strong>Failed!</strong> Something went wrong in the update process (Image was not updated successfully).
                            </div>
                            <?php
                    }
                    ?>
                    <br>
                    <button type="button" class="btn btn-default" OnClick = 'window.location="Property.php"'>Return To Data</button>
                    <?php
                    break;

                case "Insert":
                    if(!isset($_FILES["insertPropertyImage"]["tmp_name"])){?>
                        <div>
                            <div class="col-lg-6">
                                <form method="post" action="Property_Modify.php?Action=Insert" enctype="multipart/form-data">
                                    <fieldset>
                                        <superscript class="text-danger" style="font-size: x-small">*Required Fields</superscript>
                                        <div class="form-group">
                                            <label for="insertPropertyID">Property ID:</label>
                                            <input class="form-control" name="insertPropertyID" type="text" value="Automatically generated upon successful insertion." disabled/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertPropertyStreet">Property Street:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertPropertyStreet" type="text" placeholder="Street" maxlength="100" onInvalid="verifyEntry(this,'street');"
                                                   onInput="verifyEntry(this,'street');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertPropertySuburb">Property Suburb:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertPropertySuburb" type="text" placeholder="Suburb" maxlength="50" onInvalid="verifyEntry(this,'suburb');"
                                                   onInput="verifyEntry(this,'suburb');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertPropertyState">Property State:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertPropertyState" type="text" placeholder="State" maxlength="5" onInvalid="verifyEntry(this,'state');"
                                                   onInput="verifyEntry(this,'state');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertPropertyPC">Property Postcode:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertPropertyPC" type="text" placeholder="Postcode" maxlength="10" onInvalid="verifyEntry(this,'postcode');"
                                                   onInput="verifyEntry(this,'postcode');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertPropertyType">Property Type:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <?php
                                            $query="SELECT * FROM TYPE ORDER BY TYPE_NAME asc";
                                            $result = mysqli_query($connection,$query);
                                            ?>
                                            <select class="form-control" name="insertPropertyType" onInvalid="verifyEntry(this,'type');"
                                                    onInput="verifyEntry(this,'type');" placeholder="Postcode"required>
                                                <option value="" disabled selected>Select</option>
                                                <?php
                                                while ($row = $result->fetch_array()) { ?>
                                                    <option value="<?php echo $row["TYPE_ID"];?>"><?php echo $row["TYPE_NAME"];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertPropertySeller">Property Seller:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <?php
                                            $query="SELECT * FROM CLIENT ORDER BY CLIENT_GNAME asc";
                                            $result = mysqli_query($connection,$query);
                                            ?>
                                            <select class="form-control" name="insertPropertySeller" onInvalid="verifyEntry(this,'seller');"
                                                    onInput="verifyEntry(this,'seller');" placeholder="Postcode" required>
                                                <option value="" disabled selected>Select</option>
                                                <?php
                                                while ($row = $result->fetch_array()) { ?>
                                                    <option value="<?php echo $row["CLIENT_ID"];?>"><?php echo $row["CLIENT_GNAME"];?> <?php echo $row["CLIENT_FNAME"];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertPropertyListD">Property Listing Date: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertPropertyListD" type="date" placeholder="Listing Date" onInvalid="verifyEntry(this,'list date');"
                                                   onInput="verifyEntry(this,'list date');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertPropertyListP">Property Listing Price: <superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <input class="form-control" name="insertPropertyListP" type="number" placeholder="Listing Price" onInvalid="verifyPrice(this,'list price');"
                                                   onInput="verifyEntry(this,'list price');" max="99999999.99" min="0" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertPropertyImage">Property Image: <superscript class="text-danger" style="font-size: x-small" >*File must be of JPG/JPEG/PNG format with maximum of 10 MB file size!</superscript></label>
                                            <input type="file" size="50" name="insertPropertyImage" value="Select Image" onInvalid="verifyPrice(this,'image');"
                                                   onInput="verifyEntry(this,'image');" required/>
                                        </div>

                                        <div class="form-group">
                                            <label for="insertPropertyDesc">Property Description:<superscript class="text-danger" style="font-size: x-small">*</superscript></label>
                                            <textarea class="form-control" rows="5" name="insertPropertyDesc" placeholder="Description" maxlength="200" onInvalid="verifyEntry(this,'description');"
                                                      onInput="verifyEntry(this,'description');" required></textarea>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                            <h3>Property - Feature Management</h3>
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped col-lg-5">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Available Feature</th>
                                                    <th class="text-center">Insertion Flag</th>
                                                    <th class="text-center">Description</th>
                                                </tr>
                                                </thead>
                                                <tbody id="FeatureTable">
                                                <?php
                                                $query="SELECT * FROM FEATURE ORDER BY FEATURE_NAME";
                                                $result = mysqli_query($connection,$query);
                                                while ($row = $result->fetch_array()) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row["FEATURE_NAME"]?></td>
                                                        <td align="center">
                                                            <input class='form-check-input' type='checkbox' name='checkbox[]' value="<?php echo $row["FEATURE_ID"]?>" >
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="<?php echo $row["FEATURE_ID"]?>" placeholder="Feature Description">
                                                        </td>
                                                    </tr>

                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <input type="submit" class="btn btn-success" value="Insert"/>
                                        &nbsp;
                                        <button type="button" class="btn btn-default" OnClick = 'window.location="Property.php"'>Cancel</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    <?php }
                    else {
                            $upfile = "property_image/" . $_FILES["insertPropertyImage"]["name"];
                                if($_FILES["insertPropertyImage"]["type"] != "image/png" && $_FILES["insertPropertyImage"]["type"] != "image/jpg" && $_FILES["insertPropertyImage"]["type"] != "image/jpeg")
                                {
                                    ?>
                                    <div class="alert alert-danger">
                                        <strong>Failed!</strong> Only .JPG/.PNG/.JPEG files can be uploaded!
                                    </div>
                                    <?php
                                }
                                elseif($_FILES["insertPropertyImage"]["size"] > (10*MB)){
                                    ?>
                                    <div class="alert alert-danger">
                                        <strong>Failed!</strong> File size must be smaller than 10MB.
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    if(!move_uploaded_file($_FILES["insertPropertyImage"]["tmp_name"], $upfile))
                                    {
                                        ?>
                                        <div class="alert alert-danger">
                                            <strong>Failed!</strong> Something went wrong during the image upload process.
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        $query = "INSERT INTO PROPERTY(
                                                 PROPERTY_STREET, PROPERTY_SUBURB, PROPERTY_STATE,
                                                 PROPERTY_PC, PROPERTY_TYPE, SELLER_ID,
                                                 LISTING_DATE, LISTING_PRICE,IMAGE_NAME,
                                                 PROPERTY_DESC)
                                                 VALUES (?,?,?,?,?,?,?,?,?,?)";

                                        $queryprep = mysqli_prepare($connection, $query);
                                        $queryprep->bind_param('ssssiisdss',
                                            $pstreet, $psuburb, $pstate, $ppostcode, $ptype, $pseller, $plistd, $plistp, $pimage, $pdesc);

                                        $pstreet = $_POST["insertPropertyStreet"];
                                        $psuburb = $_POST["insertPropertySuburb"];
                                        $pstate = $_POST["insertPropertyState"];
                                        $ppostcode = $_POST["insertPropertyPC"];
                                        $ptype = $_POST["insertPropertyType"];
                                        $pseller = $_POST["insertPropertySeller"];
                                        $plistd = $_POST["insertPropertyListD"];
                                        $plistp = $_POST["insertPropertyListP"];
                                        if(empty($_POST["insertPropertyImage"])){
                                            $pimage = $_FILES["insertPropertyImage"]["name"];
                                        }else{
                                            $pimage = NULL;
                                        }
                                        $pdesc = $_POST["insertPropertyDesc"];

                                        if ($queryprep->execute()){
                                            $fpid = $connection->insert_id;

                                            foreach($_POST["checkbox"] as $FID)
                                            {
                                                $massquery="INSERT INTO PROPERTYFEATURE (PROPERTY_ID, FEATURE_ID, FEATURE_DESC) VALUES (?,?,?)";
                                                $massqueryprep = mysqli_prepare($connection, $massquery);
                                                $massqueryprep->bind_param('iis', $pid, $fid, $desc);
                                                $pid = $fpid;
                                                $fid = $FID;
                                                $desc = $_POST[$FID];
                                                $massqueryprep->execute();

                                            }
                                        ?>
                                        <div>
                                            <?php
                                            $insertdisplayquery="SELECT * FROM PROPERTY p 
                                                                    JOIN TYPE t on p.PROPERTY_TYPE = t.TYPE_ID 
                                                                    JOIN CLIENT c ON p.SELLER_ID = c.CLIENT_ID 
                                                                    WHERE PROPERTY_ID ='$fpid'";
                                            $insertdisplayresult = $connection->query($insertdisplayquery);
                                            $insertdisplayrow = $insertdisplayresult->fetch_assoc();
                                            ?>
                                            <div class="alert alert-success">
                                                <strong>Success!</strong> A new Property has been added.
                                            </div>
                                            <p class="form-control-static"><b>Property ID: </b><?php echo $fpid; ?></p>
                                            <p class="form-control-static"><b>Property Street: </b><?php echo $_POST['insertPropertyStreet'] ?></p>
                                            <p class="form-control-static"><b>Property Suburb: </b><?php echo $_POST['insertPropertySuburb'] ?></p>
                                            <p class="form-control-static"><b>Property State: </b><?php echo $_POST['insertPropertyState'] ?></p>
                                            <p class="form-control-static"><b>Property Postcode: </b><?php echo $_POST['insertPropertyPC'] ?></p>
                                            <p class="form-control-static"><b>Property Type: </b><?php echo $insertdisplayrow["TYPE_NAME"] ?></p>
                                            <p class="form-control-static"><b>Property Seller: </b><?php echo $insertdisplayrow["CLIENT_GNAME"]." ".$insertdisplayrow["CLIENT_FNAME"] ?></p>
                                            <p class="form-control-static"><b>Property List Date: </b><?php echo $_POST['insertPropertyListD'] ?></p>
                                            <p class="form-control-static"><b>Property List Price: </b><?php echo $_POST['insertPropertyListP'] ?></p>
                                            <p class="form-control-static"><b>Property Sale Date: </b><superscript class="text-danger" style="font-size: x-small">NULL</superscript></p>
                                            <p class="form-control-static"><b>Property Sale Price: </b><superscript class="text-danger" style="font-size: x-small">NULL</superscript></p>
                                            <p class="form-control-static"><b>Property Image: </b><?php echo $_FILES["insertPropertyImage"]["name"] ?></p>
                                            <p class="form-control-static"><b>Property Description: </b><?php echo $_POST['insertPropertyDesc'] ?></p>
                                            <br>
                                            <br>
                                            <br>
                                            <h4>Allocated Features:</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <table class="table table-bordered table-hover table-striped col-lg-5">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center">Feature Name</th>
                                                            <th class="text-center">Description</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                            <?php

                                                    foreach($_POST["checkbox"] as $FID){
                                                        $displayquery="SELECT * FROM PROPERTYFEATURE pf LEFT JOIN FEATURE f ON pf.FEATURE_ID=f.FEATURE_ID WHERE PROPERTY_ID=$fpid AND pf.FEATURE_ID=$FID ORDER BY FEATURE_NAME";
                                                        $displayresult = mysqli_query($connection, $displayquery);
                                                        $displayrow = $displayresult->fetch_assoc();
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $displayrow['FEATURE_NAME']?>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text" name="<?php echo $displayrow["FEATURE_ID"]; ?>" value="<?php echo $displayrow['FEATURE_DESC']?>" disabled/>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                ?>
                                            </tbody>
                                            </table>
                                        </div>
                                        </div>
                                            <?php
                                        }else{
                                            unlink('property_image/' . $upfile);
                                            ?>
                                            <div class="alert alert-success">
                                                <strong>Failed!</strong> Something went wrong in the insertion process.
                                            </div>
                                            <?php
                                        }


                                    }
                                }
                        ?>
                        <br>
                        <button type="button" class="btn btn-default" OnClick = 'window.location="Property.php"'>Return to Data</button>
                        </div>
                        <?php
                    }
                    break;}?>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <br>
        <a href="Source_Code.php?filename=<?php echo $_SERVER["SCRIPT_FILENAME"]?>">
            <image src="http://triton.infotech.monash.edu.au/28056434/ass2/property_image/Property_SC.JPG" width="120" height="30"></image>
        </a>
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
        window.location='Property_Modify.php?propertyid=<?php echo $_GET["propertyid"];?>&Action=ConfirmDelete';
    }
</script>

</body>

</html>
