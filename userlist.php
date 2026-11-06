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
                <h3 class="card-title"><?php echo $sec;; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive drag" >
                <table id="example1" class="table table-bordered table-striped" style="cursor: move;">
                  <thead>
                  <tr>
                    <th width="2%">SL</th>
                    <th style="white-space: nowrap;" width="10%">CUST ID</th>
                    <th width="10%">User ID</th>
                    <th width="15%">Name</th>
                    <th width="10%">Mobile</th>
                    <th width="10%">Package</th>
                    <th width="10%">Exp Date </th>
                    <th style="white-space: nowrap;" width="15%">Status </th>
                    <th width="10%">M.Bill</th>
                    <th width="15%">Action </th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                   // 


                    $sql = "SELECT * FROM userinfo  WHERE sec='$sec' AND userstatus='active' AND sec='$sec' order by userstatus ASC";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
      $i = 0;
        while($row = mysqli_fetch_array($result)){
          $i++;

                    ?>

                  <tr>
                    <td width="2%"><?php echo $i;?></td>
                    <td width="10%" style="white-space: nowrap;"><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"> <a href="profile.php?id=<?php echo $row['custid'] ?>"><?php echo $row['custid'] ?></a>
                     


                    </td>
                    <td style="white-space: nowrap;" width="10%"><?php echo $row['username']; ?></td>
                    <td style="white-space: nowrap;" width="15%"><?php echo $row['firstname']; ?></td>
                    <td width="10%"><?php echo $row['mobilephone']; ?></td>
                    <td width="10%"><?php

                     $packageidfind = $row['package'];


   $sql12 = "SELECT * FROM package WHERE id= '$packageidfind' ";
    $row12 = mysqli_fetch_assoc($conn->query($sql12) );

                      if (empty($row12['name'])) {
                        
                        echo '<span style="color:red;">Package not Found</span>';
                      }else{

                        echo $row12['name'];
                      }


                       ?></td>
                    <td width="10%"><?php
$expiretime = $row['expire']; // 02/12/26

$date = DateTime::createFromFormat('d/m/y', $expiretime);
$today = new DateTime();

$color = ($date < $today) ? 'red' : 'green';

echo '<span style="color:' . $color . ';">' . $date->format('d-M-Y') . '</span>';

                     ?>
                      



                    </td>
                    <th width="15%" style="text-align: left;">
                      <?php 
                      if ($row['billstatus'] == 'active') {
                       
                       echo '<span class="badge badge-success">Active</span';
                      }elseif($row['billstatus'] == 'expire'){

                        echo '<span class="badge badge-danger">Expire</span>';

                      }else{
                        echo '<span class="badge badge-danger">error</span>';

                      }

                      ?>
                    </th>
                    <th width="10%"><?php echo $row['amount']; ?> BDT</th>
                    <th width="10%"><div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="<?php echo $row['custid'] ?>">Direct Recharge</a>
    <a class="dropdown-item" href="recharge.php?id=<?php echo $row['custid'] ?>">Manual Recharge</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</div></th>
        
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
      "autoWidth": false,
      "responsive": false,
      "scrollX": true,
      "lengthMenu": [ [50, 100, 250, 500, -1], [50, 100, 250, 500, "All"] ]
    });
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   
    // });
  });

</script>