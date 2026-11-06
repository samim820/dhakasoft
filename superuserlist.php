<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 
 
require('inc/api.php');

$secid = $_SESSION['sec'];
              
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
<h1 class="m-0 text-dark">Super User List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Super User LIST</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        

          <div class="card">
              <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Add User</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="2%">SL</th>
                    <th width="20%">Full Name</th>
                    <th width="10%">User ID</th>
                    <th width="10%">Password</th>
                    <th width="10%">Status</th>
                    <th width="10%">Action</th>
              

                  </tr>
                  </thead>
                  <tbody>
                    <?php 
            

                    $sql = "SELECT * FROM operators WHERE sec='$secid'";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    	$i = 0;
        while($row = mysqli_fetch_array($result)){

        	$i++;

                    ?>

                

                  <tr>
                    <td width="2%"><?php echo $i; ?></td>
                    <td width="20%"><?php echo $row['firstname']; ?></td>
                    <td width="10%"><?php echo $row['username']; ?></td>
                    <td width="10%">*********</td>
                    <td width="10%" style="text-align: center;"></td>

                    <td width="20%"><button class="btn btn-primary" data-toggle="modal" data-target="#nas<?= $row['id'];?>">Edit</button> <a href="#"><button class="btn btn-primary">Details</button></a> <a href="#"></a></td>
                  </tr>

<?php
}
}}else{


}
?>
                 
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>    








          </section>
        </div>

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- NAS EDITE CODE BELOW -->


  <?php 
            

                    $sql = "SELECT * FROM operators WHERE sec='$secid'";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
      $i = 0;
        while($row = mysqli_fetch_array($result)){

          $i++;

                    ?>

<div class="modal fade" id="nas<?= $row['id']; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">NAS Update</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             
            <div class="modal-body">
              <form action="data_update/nas.php?id=<?= $row['id'];?>" method="POST">
              <div class="row">
                <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Name</label>
                    <input required name="name" type="text" class="form-control"  value="<?= $row['name']; ?>">
                  </div>
                   <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Device Username</label>
                    <input required name="username" type="text" class="form-control"  value="<?= $row['username']; ?>">
                  </div>
                   <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Device Password</label>
                    <input required name="password" type="text" class="form-control" value="<?= $row['password']; ?>">
                  </div>
                  <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div> 
              </div>
                  

                   </form>
            
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>

           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      <?php 
    }}}

      ?>

<!-- NAS EDITE CODE END -->













     <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             
            <div class="modal-body">
            	<form action="data_add/nas.php" method="POST">
            	<div class="row">
                <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Full User Name</label>
                    <input required name="name" type="text" class="form-control"  placeholder="Enter Your User Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">User ID</label>
                    <input required name="api" type="number" class="form-control"  placeholder="Enter login ID">
                  </div>
               <div class="form-group col-md-6">
                        <label>Role</label>
                        <select id="nas" name="nas" class="form-control">
                          <option value="admin">Admin</option>
                          <option value="accounts">Accounts</option>
                          <option value="support">Support</option>
                          <option value="noc">NOC</option>
                    </select>
                      </div>
                   <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Password</label>
                    <input required name="pass" type="password" class="form-control"  placeholder="Enter Your password">
                  </div>
                   <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input required name="conpass" type="password" class="form-control"  placeholder="Enter Your Confirm Password">
                  </div>
                  <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div> 
              </div>
                  

                   </form>
            
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>

           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



  <!-- Control Sidebar -->
<?php include 'inc/foter.php'; ?>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "lengthMenu": [ [50, 100, 250, 500, -1], [50, 100, 250, 500, "All"] ]
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>