<?php
    $page = "Account";  
    require_once('utils.php');
    
    $msg = "";
    $msg_kind = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if ($_SESSION['Password'] != $_POST['Old_Password']){
            $msg = "Old Password is wrong.";
            $msg_kind = "alert-danger";
        }else{
            $_SESSION['Password'] = $_POST['New_Password'];
            $msg = "Successfully Updated.";
            $msg_kind = "alert-success";
        }
    }
?>

<?php require_once('layout/header.php'); ?>
    <!-- Home Section -->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Account</h2>
            </div>
            <!-- Input -->
            <div class="row clearfix" id="home">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Change Password? </h2>
                        </div>
                        <div class="body credential_body">
                            <div class="row clearfix">
                                <form method="post">
                                    <div class="col-lg-8 col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- UserName -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">person</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="UserName" value="<?php echo $user; ?>" disabled>
                                                    </div>
                                                </div>

                                                <!-- Old Password -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">vpn_key</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" name="Old_Password" placeholder="Old Password" required="" autofocus="" aria-required="true">
                                                    </div>
                                                </div>

                                                <!-- Old Password -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">vpn_key</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" name="New_Password" placeholder="New  Password" required="" autofocus="" aria-required="true">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 m-t-120">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-block bg-orange waves-effect" disabled>
                                                        <i class="material-icons">save</i>
                                                        <span>Change Password</span>
                                                    </button>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
            <!-- Textarea -->
            <div class="row clearfix hidden" id="setting">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>TEXTAREA</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Basic Example</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h2 class="card-inside-title">
                                Auto Growing Vertical Direction
                                <small>Taken from <a href="https://github.com/jackmoore/autosize/tree/master" target="_blank">github.com/jackmoore/autosize/tree/master</a></small>
                            </h2>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="1" class="form-control no-resize auto-growth" placeholder="Please type what you want... And please don't forget the ENTER key press multiple times :)"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Textarea -->
        </div>
    </section>
    <!-- End Home Section -->
<?php require_once('layout/footer.php'); ?>

<?php if ($msg != ""){ ?>
<script type="text/javascript">
    $(document).ready(function(){
        var colorName = "<?php echo $msg_kind ?>";
        var message = "<?php echo $msg ?>";
        showNotification(colorName, message, "center", "center", "", "animated fadeOutRight");
    });
</script>
<?php } ?>