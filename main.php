<?php
    $page = "Home";
    require_once('utils.php');

    $msg = "";
    $msg_kind = "";
?>

<?php require_once('layout/header.php'); ?>
    <!-- For Material Design Colors -->
    <div class="modal fade" id="settingModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Change credentials</h4>
                </div>
                <input type="hidden" name="GroupID_A"       value="<?php echo getValue($_SESSION, 'GroupID_A') ?>">
                <input type="hidden" name="SecurityCode_A"  value="<?php echo getValue($_SESSION, 'SecurityCode_A') ?>">
                <input type="hidden" name="GroupID_B"       value="<?php echo getValue($_SESSION, 'GroupID_B') ?>">
                <input type="hidden" name="SecurityCode_B"  value="<?php echo getValue($_SESSION, 'SecurityCode_B') ?>">

                <div class="modal-body">
                    <form method="POST" id="settingsForm">
                        <input type="hidden" name="action" value="settings">
                        <div class="row clearfix  m-t-20">

                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <h4 class="m-b-20"><?php echo SYSTEM_A; ?></h4>

                                    <!-- Campaign A -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Campaign_A" 
                                            value="<?php echo getValue($_SESSION, 'Campaign_A') ?>"
                                            required="" aria-required="true">
                                            <label class="form-label">Campaign</label>
                                        </div>
                                    </div>
                                    
                                    <!-- Subcampaign A -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Subcampaign_A" 
                                            value="<?php echo getValue($_SESSION, 'Subcampaign_A') ?>">
                                            <label class="form-label">Subcampaign</label>
                                        </div>
                                    </div>

                                    <!-- Rate A -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control percentage" name="Rate_A" 
                                            value="<?php echo getValue($_SESSION, 'Rate_A') ?>"
                                            max="100" min="0" id="Rate_A"
                                            required="" aria-required="true">
                                            <label class="form-label">Percentage</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <h4 class="m-b-20"><?php echo SYSTEM_B; ?></h4>

                                    <!-- Campaign B -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Campaign_B" 
                                            value="<?php echo getValue($_SESSION, 'Campaign_B') ?>"
                                            required="" aria-required="true">
                                            <label class="form-label">Campaign</label>
                                        </div>
                                    </div>
                                    
                                    <!-- Subcampaign B -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="Subcampaign_B" 
                                            value="<?php echo getValue($_SESSION, 'Subcampaign_B') ?>">
                                            <label class="form-label">Subcampaign</label>
                                        </div>
                                    </div>

                                    <!-- Rate B -->
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control percentage" name="Rate_B"  
                                            value="<?php echo getValue($_SESSION, 'Rate_B') ?>"
                                            max="100" min="0" id="Rate_B"
                                            required="" aria-required="true">
                                            <label class="form-label">Percentage</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 no-margin-bottom text-center hidden" id="setting_spinner">
                            <div class="preloader">
                                <div class="spinner-layer pl-orange">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
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
                <button type="button" class="btn btn-link waves-effect hidden" data-dismiss="modal" id="settingModal_close">CLOSE</button>
            </div>
        </div>
    </div>

    <!-- Home Section -->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>HOME</h2>
            </div>


            <!-- Credentials Information -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Information
                            </h2>
                        </div>
                        <div class="body clearfix">
                            <div class="col-sm-10 no-margin-bottom">
                                <div class="table-responsive">
                                    <table class="table table-hover infor" id="settingsTable">
                                        <thead>
                                            <tr>
                                                <th>System</th>
                                                <th>Campaign</th>
                                                <th>Subcampaign</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo SYSTEM_A; ?></th>
                                                <td><?php echo getValue($_SESSION, 'Campaign_A') ?></td>
                                                <td><?php echo getValue($_SESSION, 'Subcampaign_A') ?></td>
                                                <td><?php echo getValue($_SESSION, 'Rate_A') ?> %</td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><?php echo SYSTEM_B; ?></th>
                                                <td><?php echo getValue($_SESSION, 'Campaign_B') ?></td>
                                                <td><?php echo getValue($_SESSION, 'Subcampaign_B') ?></td>
                                                <td><?php echo getValue($_SESSION, 'Rate_B') ?> %</td>
                                            </tr>                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-2 m-t-85 no-margin-bottom">
                                <div class="form-group no-margin-bottom">
                                    <a class="btn btn-block bg-orange waves-effect settings">
                                        <i class="material-icons">settings</i>
                                        <span>Change</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Credentials Information -->

            <!-- File Uploading -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>CSV uploading</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form id="file_upload">
                                    <input type="hidden" name="action" value="upload">
                                    <div class="col-sm-4 no-margin-bottom">
                                        <div class="form-group  no-margin-bottom">
                                            <input name="file" type="file" class="form-control" id="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required /> <!--multiple-->
                                        </div>
                                    </div>

                                    <div class="col-sm-4 no-margin-bottom">
                                        <button type="submit" class="btn btn-block bg-orange waves-effect">
                                            <i class="material-icons">file_upload</i>
                                            <span>Upload</span>                                            
                                        </button>                                        
                                    </div>

                                    <div class="col-sm-12 no-margin-bottom text-center hidden" id="uploading_spinner">
                                        <div class="preloader">
                                            <div class="spinner-layer pl-orange">
                                                <div class="circle-clipper left">
                                                    <div class="circle"></div>
                                                </div>
                                                <div class="circle-clipper right">
                                                    <div class="circle"></div>
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
            <!-- #END# File Uploading -->


            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CSV Results
                            </h2>                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>PrimaryPhone</th>
                                            <th>CallStatus</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>ZipCode</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-4 no-margin-bottom">
                                        <button type="button" class="btn btn-block btn bg-deep-orange waves-effect" id="import_button">
                                            <i class="material-icons">autorenew</i>
                                            <span>Import Leads</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>
    <!-- End Home Section -->
<?php require_once('layout/footer.php'); ?>