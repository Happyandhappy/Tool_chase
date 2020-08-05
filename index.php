<?php
set_time_limit(300);
session_start();
require_once('config.php');

$msg = "";
$_SESSION['LoggedIn'] = true;
header('Location: main.php');
exit();
// Checke User logged in status
if (isset($_SESSION['LoggedIn'])) {
    header('Location: main.php');
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if ($user == $_POST['UserName'] and $pass == $_POST['Password']){
        $_SESSION['LoggedIn'] = true;
        header('Location: main.php');
        exit;
    }
    $msg = "Invalid Credentials.";
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Chasedata portal</title>
    <!-- Favicon-->
    <link rel="icon" href="https://www.chasedatacorp.com/Content/img/shared/favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="assets/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="assets/vendors/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="assets/vendors/animate-css/animate.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="assets/vendors/waitme/waitMe.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="assets/css/all-themes.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<body class="login-page">
    <div class="login-box">
        
        <!-- Logo -->
        <div class="logo">
            <a href="javascript:void(0);">Admin <b>ChaseData</b></a>
            <small>Admin Portal</small>
        </div>

        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg"><h3>Sign in</h3></div>

                    <!-- UserName -->
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="UserName" placeholder="User Name" required="" autofocus="" aria-required="true">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">vpn_key</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="Password" placeholder="Password" required="" autofocus="" aria-required="true">
                        </div>
                    </div>
                    
                    <div class="row align-center">
                        <div class="col-xs-8 col-xs-offset-2 ">
                            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
    <!-- Jquery Core Js -->
    <script src="assets/vendors/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="assets/vendors/bootstrap/js/bootstrap.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="assets/vendors/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="assets/vendors/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="assets/vendors/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="assets/vendors/jquery-validation/jquery.validate.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="assets/vendors/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="assets/vendors/momentjs/moment.js"></script>
    
    <!-- Custom Js -->
    <script src="assets/js/admin.js"></script>

    <!-- Custom JS -->    
    <script src="assets/js/utils.js"></script>

    <script src="assets/js/sign-in.js"></script>
</html>

<?php if ($msg != ""){ ?>
<script type="text/javascript">
    $(document).ready(function(){
        var colorName = "alert-danger";
        var message = "<?php echo $msg ?>";
        showNotification(colorName, message, "top", "center", "", "animated fadeOutTop");
    });
</script>
<?php } ?>