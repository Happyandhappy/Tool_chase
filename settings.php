<?php
    $page = "Cred";
	require_once('utils.php');

    $msg = "";
    $msg_kind = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if ($_POST['Rate_A'] + $_POST['Rate_B'] > 100) {
            $msg = "Rates cant be over 100";
            $msg_kind = "alert-danger";
        }else{
            foreach ($names as $name) {
                if (!setValue($_POST,$name)){
                    $msg = str_replace("_", " of ", $name) . " is missing.";
                    $msg_kind = "alert-danger";
                    break;
                }
            }

            if ($msg == ""){
                $msg = "Successfully Submitted.";
                $msg_kind = "alert-success";

                header('Location: main.php');
                exit();
            }
        }
    }    
?>

<?php require_once('layout/header.php'); ?>
    <!-- Credential Section -->
    <section class="content hidden" id="cred_sec">
        <div class="container-fluid">
            <div class="block-header">
                <h2>CREDENTIALS</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="header">
                            <h2> Credentials </h2>
                        </div>

                        <div class="body credential_body">
                            <form method="POST">
                                <div class="row clearfix  m-t-20">

                                    <div class="col-sm-6">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <h4 class="m-b-20"><?php echo SYSTEM_A; ?></h4>

                                            <!-- Campaign A -->
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="Campaign_A" 
                                                    value="<?php echo getValue($_SESSION, 'Campaign_A') ?>"
                                                    placeholder=" "
                                                    required="" aria-required="true">
                                                    <label class="form-label">Campaign</label>
                                                </div>
                                            </div>
                                            
                                            <!-- Subcampaign A -->
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="Subcampaign_A"
                                                    value="<?php echo getValue($_SESSION, 'Subcampaign_A') ?>"
                                                    placeholder=" ">
                                                    <label class="form-label">Subcampaign</label>
                                                </div>
                                            </div>

                                            <!-- Rate A -->
                                            <div class="form-group form-float">
                                                <div class="form-line focused">
                                                    <input type="number" class="form-control percentage" name="Rate_A"
                                                    value="<?php echo getValue($_SESSION, 'Rate_A') ?>"
                                                    max="100" placeholder=" " min="0" id="Rate_A"
                                                    required="" aria-required="true">
                                                    <label class="form-label">Percentage</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <h4 class="m-b-20"><?php echo SYSTEM_B; ?></h4>

                                            <!-- Campaign B -->
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="Campaign_B"
                                                    value="<?php echo getValue($_SESSION, 'Campaign_B') ?>"
                                                    placeholder=" "
                                                    required="" aria-required="true">
                                                    <label class="form-label">Campaign</label>
                                                </div>
                                            </div>
                                            
                                            <!-- Subcampaign B -->
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="Subcampaign_B"
                                                    value="<?php echo getValue($_SESSION, 'Subcampaign_B') ?>"
                                                    placeholder=" ">
                                                    <label class="form-label">Subcampaign</label>
                                                </div>
                                            </div>

                                            <!-- Rate B -->
                                            <div class="form-group form-float">
                                                <div class="form-line focused">
                                                    <input type="number" class="form-control percentage" name="Rate_B"
                                                    value="<?php echo getValue($_SESSION, 'Rate_B') ?>"
                                                    max="100" placeholder=" " min="0" id="Rate_B"
                                                    required="" aria-required="true">
                                                    <label class="form-label">Percentage</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-4 m-t-5 m-b-5">
                                            <button type="submit" class="btn btn-block bg-orange waves-effect">
                                                <i class="material-icons">save</i>
                                                <span>SAVE</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Credential Section -->
<?php require_once('layout/footer.php'); ?>

<?php if ($msg != ""){ ?>
<script type="text/javascript">
    $(document).ready(function(){
        var colorName = "<?php echo $msg_kind ?>";
        var message = "<?php echo $msg ?>";
        showNotification(colorName, message, "top", "center", "", "animated fadeOutRight");
    });
</script>
<?php } ?>