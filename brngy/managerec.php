<?php
include("back.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>BRM SYSTEM | Certificate Insuance</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script src="dist/js/1.js"></script>
  <script src="dist/js/2.js"></script>
  <script src="dist/js/3.js"></script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">

      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-slide="true" href="login.php">
          <b>LOGOUT</b></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">BRM SYSTEM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['name_of_user']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="managerec.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Records</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">ADD RECORD</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <div class="card-body">
                    <div align="right">
                      <button class="btn btn-primary add_record" data-toggle="modal" data-target="#add_rec"><i class="fa fa-plus"></i> ADD NEW</button>
                    </div><br/>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead align="center">
                      <tr>
                        <th>FULL NAME</th>
                        <th>AGE</th>
                        <th>CIVIL STATUS</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody align="center">
                        <?php
                        $sql = "SELECT * FROM records";
                        $result = mysqli_query($db, $sql);
                        while($row = mysqli_fetch_array($result))
                        {
                        ?>
                      <tr>
                        <td><?php echo strtoupper($row["full_name"]); ?></td>
                        <td><?php echo strtoupper($row["age"]); ?></td>
                        <td><?php echo strtoupper($row["sex"]); ?></td>
                        <td>
                          <button id="<?php echo $row["id"]; ?>" class="btn btn-info view_rec_info"><i class="fa fa-eye"></i></button>
                          <button id="<?php echo $row["id"]; ?>" class="btn btn-secondary view_history_rec"><i class="fa fa-history"></i></button>
                          <button id="<?php echo $row["id"]; ?>" class="btn btn-success insuance_modal"><i class="fa fa-file-import"></i></button>
                        </td>
                      </tr>
                      <?php
                      }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- ADD ENTRY Modal-->
<div class="modal fade" id="add_rec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADDING -> NEW RECORD</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="back.php">
          <div class="modal-body">
            <b><label>Full Name</label></b>
            <input type = "text" class = "form-control" name = "full_name" placeholder = "First Name, Last Name. Initial" required>
            <b><label>Current Address</label></b>
            <input type = "text" class = "form-control" name = "cur_address" placeholder = "#Num, Street, City, State" required>
            <b><label>Permanent Address</label></b>
            <input type = "text" class = "form-control" name = "per_address" placeholder = "#Num, Street, City, State" required>
            <b><label>Age</label></b>
            <input type = "text" class = "form-control" name = "age" placeholder = "#22" required>
            <b><label>Gender</label></b>
            <input type = "text" class = "form-control" name = "sex" placeholder = "#male, #female" required>
            <b><label>Occupation</label></b>
            <input type = "text" class = "form-control" name = "occupation" placeholder = "#unemployed, etc" required>
            <b><label>Civil Status</label></b>
            <input type = "text" class = "form-control" name = "civil_status" placeholder = "#single, #married, #widow, etc" required>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">CANCEL</button>
            <input type = "submit" class="btn btn-primary" value = "ADD" name = "ADD_RECORD"></a>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- ADD SECTION MODAL -->

<!-- VIEW RECORD Modal-->
<div id="view_rec_info" class="modal fade">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">RECORD INFORMATION</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
                 </button>
               </div>
               <form action="core.php" method="POST" >
               <div class="modal-body" id="view_rec_info_details">
               </div>
               </form>
          </div>
     </div>
</div>

<script>
$(document).ready(function(){
     $('.view_rec_info').click(function(){
       var rec_id = $(this).attr("id");
          $.ajax({
               url:"back.php",
               method:"post",
                  data:{rec_id:rec_id},
               success:function(data){
                    $('#view_rec_info_details').html(data);
                    $('#view_rec_info').modal("show");
               }
          });
     });
});
</script>
<!-- VIEW RECORD Modal-->

<!-- VIEW HISTORY Modal-->
<div id="view_history_rec" class="modal fade">
     <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">INSUANCE HISTORY</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
                 </button>
               </div>
               <form action="core.php" method="POST" >
               <div class="modal-body" id="view_history_details">
               </div>
               </form>
          </div>
     </div>
</div>

<script>
$(document).ready(function(){
     $('.view_history_rec').click(function(){
       var history_id = $(this).attr("id");
          $.ajax({
               url:"back.php",
               method:"post",
                  data:{history_id:history_id},
               success:function(data){
                    $('#view_history_details').html(data);
                    $('#view_history_rec').modal("show");
               }
          });
     });
});
</script>
<!-- VIEW HISTORY Modal-->

<!-- EDIT RECORD Modal-->
<div id="edit_rec" class="modal fade">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">EDIT INFORMATION</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
                 </button>
               </div>
               <form action="core.php" method="POST" >
               <div class="modal-body" id="edit_rec_details">
               </div>
               </form>
          </div>
     </div>
</div>

<script>
$(document).ready(function(){
     $('.edit_rec').click(function(){
       var edit_id = $(this).attr("id");
          $.ajax({
               url:"back.php",
               method:"post",
                  data:{edit_id:edit_id},
               success:function(data){
                    $('#edit_rec_details').html(data);
                    $('#edit_rec').modal("show");
               }
          });
     });
});
</script>
<!-- EDIT RECORD Modal-->

<!-- EDIT RECORD Modal-->
<div id="insuance_modal" class="modal fade">
     <div class="modal-dialog" role="document">
          <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">INSUANCE OF CERTIFICATES</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
                 </button>
               </div>
               <form action="back.php" method="POST" >
               <div class="modal-body" id="insuance_details">
               </div>
               <div class="modal-footer">
                 <input type='submit' value='ISSUE CERTIFICATE' class='btn btn-primary' name='ISSUE'>
               </div>
               </form>
          </div>
     </div>
</div>

<script>
$(document).ready(function(){
     $('.insuance_modal').click(function(){
       var insuance_id = $(this).attr("id");
          $.ajax({
               url:"back.php",
               method:"post",
                  data:{insuance_id:insuance_id},
               success:function(data){
                    $('#insuance_details').html(data);
                    $('#insuance_modal').modal("show");
               }
          });
     });
});
</script>
<!-- EDIT RECORD Modal-->



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

</body>
</html>
