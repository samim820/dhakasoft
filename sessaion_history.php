<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 

  function formatBytes($size, $precision = 0){
    $unit = ['Byte','KB','MB','GB','TB','PB','EB','ZB','YB'];

    for($i = 0; $size >= 1024 && $i < count($unit)-1; $i++){
        $size /= 1024;
    }

    return round($size, $precision).' '.$unit[$i];
}


$sec = $_SESSION['sec'];

$id = $_GET['id'];
  $sql = "SELECT * FROM userinfo WHERE custid='$id'";
  $row11 = mysqli_fetch_assoc($conn->query($sql) );

  $userid = $row11['username'];


$sql = "SELECT  * FROM radacct WHERE  username='$userid' order by radacctid DESC ";





?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Sessaion Hostory</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Payments</li>
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
                <!-- <form method="post"> -->
               <div id="result" class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info">60d</span>

              <div class="info-box-content">
                <span class="info-box-text">Last 60 Days Usage</span>
                <?php 
                date_default_timezone_set("Asia/Dhaka");
                $Currentdate1 = date("Y-m-d"); 
                $expiry_date1 = new DateTime($Currentdate1);
                $expiry_date1 ->modify("-60 days");
               $before60dyas1 = $expiry_date1 ->format("Y-m-d");

                $sql1 = "SELECT  sum(acctinputoctets) as upload, sum(acctoutputoctets) as download FROM radacct WHERE username='$userid' AND acctstarttime  BETWEEN '$before60dyas1' AND '$Currentdate1'";


$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
                ?>
                <span class="info-box-number">UP: <?php echo formatBytes($row1['upload'], 2);;?> <br>DW: <?php echo formatBytes($row1['download'], 2);;?></span>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success">30d</span>

              <div class="info-box-content">
                <span class="info-box-text">This Month Usages</span>
                <?php
                  date_default_timezone_set("Asia/Dhaka");
                $Currentdate2 = date("Y-m-d"); 
               $startdate2 = date('Y-m-01');

                $sql2 = "SELECT  sum(acctinputoctets) as upload, sum(acctoutputoctets) as download FROM radacct WHERE username='$userid' AND acctstarttime  BETWEEN '$startdate2' AND '$Currentdate2'";


$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();

                ?>
                <span class="info-box-number">UP: <?php echo formatBytes($row2['upload'], 2);;?> <br>DW: <?php echo formatBytes($row2['download'], 2);;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
             <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success">7d</span>

              <div class="info-box-content">
                <span class="info-box-text">Last 7 Days Usages</span>
                <?php
                  date_default_timezone_set("Asia/Dhaka");
                $Currentdate3 = date("Y-m-d"); 
                $expiry_date3 = new DateTime($Currentdate3);
                $expiry_date3 ->modify("-7 days");
               $before60dyas3 = $expiry_date3 ->format("Y-m-d");

                $sql3 = "SELECT  sum(acctinputoctets) as upload, sum(acctoutputoctets) as download FROM radacct WHERE username='$userid' AND acctstarttime  BETWEEN '$before60dyas3' AND '$Currentdate3'";


$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc();




                ?>
                <span class="info-box-number">UP: <?php echo formatBytes($row3['upload'], 2);;?> <br>DW: <?php echo formatBytes($row3['download'], 2);;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
             <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success">3d</span>

              <div class="info-box-content">
                <span class="info-box-text">Last 3 Days Usages</span>
                  <?php
                  date_default_timezone_set("Asia/Dhaka");
                $Currentdate4 = date("Y-m-d"); 
                $expiry_date4 = new DateTime($Currentdate4);
                $expiry_date4 ->modify("-3 days");
               $before60dyas4 = $expiry_date4 ->format("Y-m-d");

                $sql4 = "SELECT  sum(acctinputoctets) as upload, sum(acctoutputoctets) as download FROM radacct WHERE username='$userid' AND acctstarttime  BETWEEN '$before60dyas4' AND '$Currentdate4'";


$result4 = $conn->query($sql4);
$row4 = $result4->fetch_assoc();




                ?>
                <span class="info-box-number">UP: <?php echo formatBytes($row4['upload'], 2);;?> <br>DW: <?php echo formatBytes($row4['download'], 2);;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
              </div>
            </div>

             <!--   </form> -->
              <!-- /.card-header -->
              <div class="card-body" >

                  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr style="text-align: left;">
                    <th>SL</th>
                    <th>User Name</th>
                    <th style="white-space: nowrap;">Uploade</th>
                    <th style="white-space: nowrap;">Download</th>
                    <th style="white-space: nowrap;">IP Address</th>
                    <th style="white-space: nowrap;">Start Time</th>
                    <th style="white-space: nowrap;">End Time</th>
                    <th style="white-space: nowrap;">Disconnect Reason</th>
                    <th>Uptime</th>
                    <th>VLAN/PORT</th>
                
                  </tr>
                  </thead>
                  <tbody>
                    <?php 

                     if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        $i = 0;
        while($row = mysqli_fetch_array($result)){
          $i++;


                    ?>
                  <tr style="text-align: left;">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo formatBytes($row['acctinputoctets'], 2);;?></td>
                    <td><?php echo formatBytes($row['acctoutputoctets'], 2);;?></td>
                    <td><?php echo $row['framedipaddress']; ?></td>
                    <td><?php echo $row['acctstarttime']; ?></td>
                    <td><?php echo $row['acctstoptime']; ?></td>
                    <td><?php echo $row['acctterminatecause']; ?></td>
                    <td style="white-space: nowrap;"><?php

                    $seconds = $row['acctsessiontime'];

        $seconds = round($seconds);
        if (gmdate("i",$seconds) % 15 != 0);

        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");      
        $days = $dtF->diff($dtT)->format('%a');       

        echo $days.'d '.$dtF->diff($dtT)->format('%hh:%im:%s');



                    ?></td>
                    <td><?php echo $row['nasportid']; ?></td>
                  </tr>
                  <?php 

                }}}
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
    $("#paymentslist").DataTable({
      "responsive": true,
       "searching": true,
      "ordering": true,
      "autoWidth": false,
      "lengthMenu": [ [50, 100, 250, 500, -1], [50, 100, 250, 500, "All"] ]
    });
    $('#paymentslist').DataTable({
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












