<?php
 include "../dbConnect.php";
 session_start();
if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
        echo "<script>alert('Unauthorized access!Please login! ');window.location.href='../login.php';</script>";
    }
 include("includes/header.php"); 
include_once("actions/PT-Trend-ClientLevel-Action.php"); ?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Client Level Frequency</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.php">
                                        <i class="material-icons">dashboard</i> Dashboard
                                    </a>
                                </li>
                                <li class="active">
                                   Personal Training - Trends - Client Level Frequency
                                </li>
                            </ol>
            </div>
        </div>
    <?php include("PT-Report-List.php"); ?>
           <div class="card">
                    <div class="header">
                       <h2>Client Level Frequency</h2>
                    </div>
                    <div class="body">
                <select id="filteryear" class="validate[required] select form-control show-tick" style="margin-top: -25px; width: 30%;" data-live-search="true">
                    <option>Select Year...</option>
                    <?php
                    for($year=2013; $year<=2025; $year++){
                    ?>
                    <option value="<?php echo $year ?>">
                        <?php echo $year; ?>
                    </option>
                    <?php
                    }
                    ?>
                </select>

        <script>
            $(document).ready(function(){   
                $("#filteryear").on('change', function(){
                    var year=$(this).val();
                    window.location.href = 'PT-Trend-ClientLevel.php?year='+year;
                });
            });
        </script>
            </div>

                  <div class="body">
                    <div class="col-s-12">
                         <div id="clientlevel" style="width: 100%; height: 400px"></div>
                    </div>
                 </div>
            </div>

            </section>
    <?php include("includes/footer.php"); ?>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
      <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/js/pages/tables/jquery-datatable.js"></script>\

    <script src="../assets/plugins/chartjs/Chart.bundle.js"></script>

    <script src="../assets/js/pages/charts/ptEnrollees.js"></script>
    <script src="canvas/jquery.min.js"></script>
    <script src="canvas/jquery.canvasjs.min.js"></script>
    

    <!-- Demo Js -->
    <script src="../assets/js/demo.js"></script>
    
</body>

</html>