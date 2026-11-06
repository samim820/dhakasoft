<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 

$sec = $_SESSION['sec'];




?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">User List</li>
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
                <a href="data_delete/deletelog.php"><button class="btn btn-danger">Delete Log</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%">Userid</th>
                    <th width="10%">Password</th>
                    <th width="15%">MAC</th>
                    <th width="15%">Router</th>
                    <th width="15%">VLAN</th>
                    <th width="10%">Time</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                   // $sql= "SELECT * FROM userinfo LEFT JOIN radacct ON userinfo.username = radacct.username WHERE sec='$sec' AND acctstoptime  IS NULL AND acctupdatetime IN (SELECT  MAX(acctupdatetime) FROM radacct GROUP BY username)";

                // $sql ="SELECT *  FROM radpostauth order by id DESC "; 
                 $sql= "SELECT * FROM radpostauth  order by id DESC limit 500";   
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){

                    ?>

                  <tr style="color: <?php 

                  if ($row['reply'] == 'Access-Reject') {
                    echo "red";
                  }else{
                    echo "black";
                  }

                  ?>;">
                 
                    <td width="15%"><?php echo $row['username']; ?></td>
                    <td width="10%"><?php echo $row['pass']; ?></td>
                    <td width="10%"><?php echo $row['mac']; ?></td>
                    <td width="10%"><?php echo $row['nasname']; ?></td>
                    <td width="10%"><?php echo $row['nasport']; ?></td>
                    <th width="15%"><?php echo $row['authdate']; ?></th>
                    <th width="10%"><?php echo $row['reply'];?></th>
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