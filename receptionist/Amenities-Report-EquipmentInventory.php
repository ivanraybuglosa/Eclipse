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
                <h2>Equipment Inventory Report</h2>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    
                           
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.php">
                                        <i class="material-icons">dashboard</i> Dashboard
                                    </a>
                                </li>
                                <li class="active">
                                    Amenities - Reports - Equipment Inventory Report
                                </li>
                            </ol>
            </div>
        </div>
    </div>
    <?php include("Amenities-Report-List.php"); ?>
    <div class="card">
        <div class="header">
            <h2>Equipment Inventory Report</h2>
        </div>
        
                        <div class="body">
                        <form method="POST">
                            <div class="row clearfix">
                                <div class="col-md-5">
                                    <div class="form-group">
                                       <div class="form-line">
                                        <div class="col-md-6">
                                         <input type="date" class="form-control"  id="filterstart" name="filter_start"/>
                                        </div>
                                        <div class="col-md-6">
                                         <input type="date" class="form-control"  id="filterend" name="filter_end"/>
                                       </div>
                                     </div>
                                    </div>  
                                </div>

                                <div class="col-md-4">
                            <select class="form-control show-tick" data-live-search="true" id="equips" name="equips">
                                        <option value="null">Choose Equipment Type</option>
                                            <?php 
                                            $conn = new mysqli("localhost", "root", "", "eclipse_db") or die(mysqli_error());

                                            $equip = $conn->query("SELECT DISTINCT E_Type FROM equipment") or die(mysql_error());

                                            while($eq = $equip->fetch_array()) {
                                                ?>

                                        <option id = "<?php echo $eq['E_Type']; ?>" value="<?php echo $eq['E_Type']; ?>">
                                                <?php echo $eq['E_Type']; ?>
                                        </option>
                                            <?php 
                                                }
                                            ?>
                                </select>

                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" name="action_type" value="filter"/>
                                    <button type="submit" name= "filter" class="btn bg-teal btn-block btn-lg waves-effect">Filter</button>
                                </div>
                            </div>
                        </form>
                        <div id="print">
                         <table class="table table-bordered table-striped table-hover dataTables" id="equipmentreport" name="equipmentreport" role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                        <tr>
                                            <th>Equipment Type</th>
                                            <th>Equipment Model</th>
                                            <th>Delivery Date</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 

                                         $conn = new mysqli("localhost", "root", "", "eclipse_db") or die(mysqli_error()); 


                                if(isset($_REQUEST['action_type']) && !empty($_REQUEST['action_type'])){
                                        if($_REQUEST['action_type'] == 'filter') {

                                            $filterstart = date('Y-m-d', strtotime($_POST['filter_start']));
                                            $filterend = date('Y-m-d', strtotime($_POST['filter_end']));
                                            $equipName = $_POST['equips'];

                                            if($equipName != "null" && $filterstart == $_POST['filter_start']) {
                                                $equip = $conn->query("SELECT * FROM equipmentinventory INNER JOIN equipment ON equipmentinventory.E_Code = equipment.E_Code WHERE EI_DeliveryDate BETWEEN '$filterstart' AND '$filterend' AND equipment.E_Type = '$equipName' ") or die(mysql_error());

                                         while($eq = $equip->fetch_array()) { 
                                              ?>  
                                              <tr>
                                                    <td><?php echo $eq['E_Type'] ?></td>
                                                    <td><?php echo $eq['E_Model'] ?></td>
                                                    <td><?php echo date("F j, Y", strtotime($eq['EI_DeliveryDate'])) ?></td>
                                                    <td><?php echo $eq['EI_Quantity'] ?></td>
                                             </tr>
                                                 <?php
                                              } 
                                            } else if($equipName == "null" && ($filterstart != $_POST['filter_start'] || $filterend != $_POST['filter_end'])) {

                                                $equip = $conn->query("SELECT * FROM equipmentinventory INNER JOIN equipment ON equipmentinventory.E_Code = equipment.E_Code ") or die(mysql_error());

                                                 while($eq = $equip->fetch_array()) { 
                                                    ?>  

                                                 <tr>
                                                    <td><?php echo $eq['E_Type'] ?></td>
                                                    <td><?php echo $eq['E_Model'] ?></td>
                                                    <td><?php echo date("F j, Y", strtotime($eq['EI_DeliveryDate'])) ?></td>
                                                    <td><?php echo $eq['EI_Quantity'] ?></td>
                                                </tr>

                                                    <?php

                                                 }
                                                
                                         } else {

                                            $equip = $conn->query("SELECT * FROM equipmentinventory INNER JOIN equipment ON equipmentinventory.E_Code = equipment.E_Code WHERE EI_DeliveryDate BETWEEN '$filterstart' AND '$filterend' OR equipment.E_Type = '$equipName' ") or die(mysql_error());

                                         while($eq = $equip->fetch_array()) { 
                                              ?>  
                                              <tr>
                                                    <td><?php echo $eq['E_Type'] ?></td>
                                                    <td><?php echo $eq['E_Model'] ?></td>
                                                    <td><?php echo date("F j, Y", strtotime($eq['EI_DeliveryDate'])) ?></td>
                                                    <td><?php echo $eq['EI_Quantity'] ?></td>
                                             </tr>
                                             <?php

                                                 }
                                            }
                                        }

                                    }  else {

                                         $equip = $conn->query("SELECT * FROM equipmentinventory INNER JOIN equipment ON equipmentinventory.E_Code = equipment.E_Code ") or die(mysql_error());

                                         while($eq = $equip->fetch_array()) { 
                                              ?>
                                              <tr>
                                                    <td><?php echo $eq['E_Type'] ?></td>
                                                    <td><?php echo $eq['E_Model'] ?></td>
                                                    <td><?php echo date("F j, Y", strtotime($eq['EI_DeliveryDate'])) ?></td>
                                                    <td><?php echo $eq['EI_Quantity'] ?></td>
                                             </tr>
                                         <?php

                                        }
                                    }
                                        ?>

                                    </tbody>
                                    <footer></footer>
                                </table>
                                </div>
                            </div>
                        </div>

                    <script>
                      $(document).ready(function() {
    $('#equipmentreport').DataTable( {
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
                        .prepend('<center><h4>Equipment Inventory Report</h4></center>')
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