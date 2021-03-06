<?php
 include "../dbConnect.php";
 session_start();
 if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
        echo "<script>alert('Unauthorized access!Please login! ');window.location.href='../login.php';</script>";
    }
 
 include("includes/header.php"); ?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Studio Classes</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    
                           
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.php">
                                        <i class="material-icons">dashboard</i> Dashboard
                                    </a>
                                </li>
                                <li class="active">
                                    Studio Class - Reports - Studio Classes
                                </li>
                            </ol>
            </div>
        </div>
    <?php include("StudioClass-Report-List.php"); ?>
    <div class="card">
        <div class="header">
            <h2>Studio Classes</h2>
        </div>
                        <div class="body">
                                
                                <table class="table table-bordered table-striped table-hover dataTable" id="sclist" role="grid" aria-describedby="sclist">
                                <div class="row clearfix">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
   
                                    <thead>
                                        <tr>
                                            <th align="center">Class Name</th>
                                            <th align="center">Capacity</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php 
                                            $conn = new mysqli("localhost", "root", "", "eclipse_db") or die(mysqli_error());
                                            $class = $conn->query("SELECT * FROM `studioclass` ") or die(mysqli_error());
                                            while($fclass = $class->fetch_array()) {

                                                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $fclass['SC_Name'] ?></td>
                                            <td align="center"><?php echo $fclass['SC_Capacity'] ?></td>
                                        </tr>

                                        <?php 
                                    }
                                    ?>
                                    </tbody>
                                </div>
                            </div>
                            </table>
                </div>
            </div>
            <script>

                    $(document).ready(function() {
    $('#sclist').DataTable( {
        dom: 'Bfrtip',
        buttons: [ 'copy', 'csv', 'excel',
            { 
                extend: 'print',
                title: '',
                responsive: true,
                footer: true,
                className: '',
                customize: function ( win ) {
                    $(win.document.body)
                        .prepend('<center><h4>Studio Class List Report</h4></center>')
                        .prepend('<center><h3>Eclipse Healing and Body Design Center</h3></center>')

                    $(win.document.body).find('h3').css('font-family','Impact'); 
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' )

                    $(win.document.body.innerHTML += "<br><br><center><div><label>Printed By: ____________  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Signed By:____________</label></div></center>")
                }

            }
        ]
    } );


} );
            </script>
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
    <script src="../assets/js/pages/tables/jquery-datatable.js"></script>
    <script src="../assets/js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="../assets/js/demo.js"></script>
</body>

</html>