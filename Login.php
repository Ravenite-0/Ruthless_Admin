<?php
session_start();
if((isset($_SESSION["Previous"]))&&(isset($_SESSION["User"]))){
session_destroy();
}elseif((!isset($_SESSION["Previous"]))&&(isset($_SESSION["User"]))){
session_destroy();
}elseif((isset($_SESSION["Previous"]))&&(!isset($_SESSION["User"]))){
}elseif((!isset($_SESSION["Previous"]))&&(!isset($_SESSION["User"]))){
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

    <title>Login</title>

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
    if (!(isset($_POST['LoginButton']))) { ?>
                <div id="wrapper">
                    <!-- Navigation -->
                    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="Index.php"><b>Ruthless Real Estate - Admin Site</b></a>
                        </div>
                        <!-- Top Menu Items -->
                        <ul class="nav navbar-right top-nav">
                            <button type="button" class="btn btn-primary btn-lg"
                                    OnClick='window.location="Login.php"'>Login
                            </button>
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
                                    <h1 class="page-header" align="center">
                                        Login
                                    </h1>
                                </div>
                            </div>
                            <!-- /.row -->
                            <form role="form" method="post" style="alignment: center" action="Login.php">
                                <fieldset>
                                    <?php
                                        if (isset($_GET['msg'])){
                                            ?>
                                            <div class="alert alert-danger">
                                                <strong>Login Failed!</strong> Incorrect Username/Password.
                                            </div>
                                            <?php
                                        }
                                    ?>
                                    <?php if (isset($_GET["History"])){
                                        $_SESSION["Previous"] = $_GET["History"];
                                    }?>

                                    <div class="container">
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="deleteTypeID">Username:</label>
                                                <input class="form-control" name="Username" type="text"
                                                       placeholder="Username" required>
                                                <br>
                                                <label for="deleteTypeName">Password:</label>
                                                <input class="form-control" name="Password" type="password"
                                                       placeholder="Password" required>
                                                <br>
                                                <button type="submit" class="btn btn-primary" name="LoginButton">
                                                    Login
                                                </button>&nbsp;&nbsp;<button type="reset" class="btn btn-default">Clear
                                                    Fields
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
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
                <?php } else{
                include("Connection.php");
                $connection = new mysqli($Host, $User_Name, $Pass_Word, $Database) or die("Failed logging in to database.");
                $query = "SELECT UNAME,PWORD FROM authenticate
                WHERE UNAME=? AND PWORD=?";
                $login_test = mysqli_prepare($connection, $query);
                $login_test->bind_param('ss', $username, $password);
                $username = $_POST["Username"];
                $password = hash('sha256', $_POST["Password"]);
                $login_test->execute();
                $login_test->bind_result($username, $password);
                $login_test->store_result();
                if (!empty($login_test->fetch())) {
                    $_SESSION['User'] = $_POST["Username"];
                    if(isset($_SESSION["Previous"])){
                        header("Location:".$_SESSION["Previous"]);
                    }else{
                        header("Location:Index.php");
                    }
                } else {
                    session_destroy();
                    header("Location:Login.php?msg=Failed");
                }
                mysqli_close($connection);
    }?>
</body>
</html>