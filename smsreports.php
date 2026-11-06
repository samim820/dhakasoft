<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 

$sec = $_SESSION['sec'];


$sql = "SELECT  * FROM sms WHERE  sec='$sec' ";

// $selectedUser = isset($_POST['recive']) ? $_POST['recive'] : null;
// $startDateFilter = isset($_POST['date1']) ? $_POST['date1'] : null;
// $endDateFilter = isset($_POST['date2']) ? $_POST['date2'] : null;



// if ($selectedUser !== null) {
//     $sql .= " AND  reciveby Like '$selectedUser%' ";
// }

// if ($startDateFilter !== null && $endDateFilter !== null) {
//     $sql .= " AND datee BETWEEN '$startDateFilter' AND '$endDateFilter'";
// }




?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark">SMS Reports</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">SMS Reports</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        <?php 

        // $date = $time = date('Y-m-d', strtotime('+0 day'));
        //       $date1 =  date('Y-m-d', strtotime('+1 day'));

         ?>

          <div class="card">
                    <div class="card-header">
                <!-- <form method="post"> -->
    <!--                <form method="post">
                <div class="row">
                 
                  <div class="form-group col-md-2">
                    <label >Date from</label>
                    <input id="startDateInput"  name="date1" type="date" value="" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label >Date to</label>
                    <input id="endDateInput" name="date2" type="date" value="" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label >Recive by</label>
                    <select id="userSelect" name="recive" class="form-control">
                      <option value="">All</option>
                      <option value="admin">Admin</option>
                      <option value="samim">samim</option>
                    </select>
                  </div>
                   <div class="form-group col-md-1">
                    <label >Action</label>
                    <button type="submit" class="btn btn-primary">Applay</button>
                  </div>
                 

                </div>
                </form> -->
                
              </div>
              
               <div class="card-header">
                <!-- <form method="post"> -->
               <div id="result" class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Number of Payment</span>
                <?php 

//                 $sql1 = "SELECT  count(*) as count, sum(receve_amount) as cost FROM sms WHERE  sec='$sec' ";

// $selectedUser1 = isset($_POST['recive']) ? $_POST['recive'] : null;
// $startDateFilter1 = isset($_POST['date1']) ? $_POST['date1'] : null;
// $endDateFilter1 = isset($_POST['date2']) ? $_POST['date2'] : null;




// if ($startDateFilter1 !== null && $endDateFilter1 !== null) {
//     $sql1 .= " AND datetime BETWEEN '$startDateFilter' AND '$endDateFilter'";
// }
// $result1 = $conn->query($sql1);
// $row1 = $result1->fetch_assoc();
                ?>
                <span class="info-box-number"></span>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Amount Receive</span>
                <span class="info-box-number"></span>
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
                  <tr>
                    <th width="2%">SL</th>
                    <th width="10%">Cust ID</th>
                    <th>Mobile</th>
                    <th>Message</th>
                    <th>Count</th>
                    <th>Cost</th>
                    <th>Status</th>
                    <th>Time</th>
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
                  <tr>
                    <td width="2%"><?php echo $i; ?></td>
                    <td width="5%"><a href="profile.php?id=<?php echo $row['custid']; ?>"><?php echo $row['custid']; ?></a> </td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['msg']; ?></td>
                    <td><?php echo $row['count']; ?></td>
                    <td><?php echo $row['cost']; ?></td>
                    <td><?php 

                    if ($row['status'] == 'Deliverd') {
                      
                        echo '<span class="badge bg-success">Deliverd</span>';
                    }else{

                      echo '<span class="badge bg-danger">Pending</span>';
                    }

                         ?>
                      

                    </td>
                    <td><?php echo $row['datetimee']; ?></td>
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

<script>
$(document).ready(function() {
    // Handle "Select All" checkbox change event
    $('#selectAll').change(function() {
        // Get the checked status of the "Select All" checkbox
        var isChecked = $(this).prop('checked');
        
        // Set the checked status for all checkboxes in the group
        $('.checkboxItem').prop('checked', isChecked);
    });

    // Handle individual checkbox change events
    $('.checkboxItem').change(function() {
        // Update the "Select All" checkbox based on the individual checkboxes
        var allChecked = $('.checkboxItem:checked').length === $('.checkboxItem').length;
        $('#selectAll').prop('checked', allChecked);
    });
});
</script>
















