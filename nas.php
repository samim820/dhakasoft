<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 
 
require('inc/api.php');

$sec = $_SESSION['sec'];


if ($sec == 'main') {
              
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
<h1 class="m-0 text-dark">NAS List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">NAS LIST</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Add NAS</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="2%">SL</th>
                    <th width="20%">Name</th>
                    <th width="10%">IP</th>
                    <th width="10%">User Name</th>
                    <th width="10%">Password</th>
                    <th width="10%">API Port</th>
                    <th width="10%">Status</th>
                    <th width="10%">Identy</th>
                    <th width="10%">Action</th>
              

                  </tr>
                  </thead>
                  <tbody>
                    <?php 
            

                    $sql = "SELECT * FROM nas ";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    	$i = 0;
        while($row = mysqli_fetch_array($result)){

        	$i++;

                    ?>

                

                  <tr>
                    <td width="2%"><?php echo $i; ?></td>
                    <td width="20%"><?php echo $row['shortname']; ?></td>
                    <td width="10%"><?php echo $row['nasname']; ?></td>
                    <td width="10%"><?php echo $row['username']; ?></td>
                    <td width="10%"><?php echo $row['password']; ?></td>
                    <td width="10%"><?php echo $row['api']; ?></td>
                    <td width="10%" style="text-align: center;"><?php

              $API = new routeros_api();
              $API->debug = false;
              $API->port = $row['api'];
              if ($API->connect($row['nasname'] , $row['username'], $row['password'])) {



                    echo '<button class="btn btn-success">Connected</button>';

                    }else{

                     echo '<button class="btn btn-danger">Disconeted</button>';
                    }



                    ?></td>

                    <td width="10%" style="text-align: center;"><?php

 
              if ($API->connect($row['nasname'] , $row['username'], $row['password'])) {


                  $identity = $API->comm('/system/identity/print');
  
                
                   echo $identity[0]['name'];
             

                    }else{

                     echo '-----';
                    }



                    ?></td>


                    <td width="20%"><button class="btn btn-primary" data-toggle="modal" data-target="#nas<?= $row['id'];?>">Edit</button> <a href="nasdetails.php?id=<?= $row['id']?>"><button class="btn btn-primary">Details</button></a></td>
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
            

                    $sql = "SELECT * FROM nas ";

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
                    <input required name="name" type="text" class="form-control"  value="<?= $row['shortname']; ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">IP Address</label>
                    <input required name="ip" type="text" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$" class="form-control"  value="<?= $row['nasname']; ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">API Port</label>
                    <input required name="api" type="number" class="form-control" value="<?= $row['api']; ?>">
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
              <h4 class="modal-title">New NAS Add</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             
            <div class="modal-body">
            	<form action="data_add/nas.php" method="POST">
            	<div class="row">
                <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Name</label>
                    <input required name="name" type="text" class="form-control"  placeholder="Enter Your NAS Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">IP Address</label>
                    <input required name="ip" type="text" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$" class="form-control"  placeholder="Enter Your NAS IP Address">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">API Port</label>
                    <input required name="api" type="number" class="form-control"  placeholder="API Port">
                  </div>
                   <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Device Username</label>
                    <input required name="username" type="text" class="form-control"  placeholder="Enter Your NAS Username">
                  </div>
                   <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Device Password</label>
                    <input required name="password" type="text" class="form-control"  placeholder="Enter Your NAS Password">
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
}else{

echo '<script>window.location.href = "/reseller.php";</script>';
exit;
}

?>

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