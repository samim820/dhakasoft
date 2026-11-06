<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 

$sec = $_SESSION['sec'];


$sql = "SELECT  * FROM payment WHERE  sec='$sec' ";

$selectedUser = isset($_POST['recive']) ? $_POST['recive'] : null;
$startDateFilter = isset($_POST['date1']) ? $_POST['date1'] : null;
$endDateFilter = isset($_POST['date2']) ? $_POST['date2'] : null;
$type = isset($_POST['type']) ? $_POST['type'] : null;



if ($selectedUser !== null) {
    $sql .= " AND  reciveby Like '$selectedUser%' ";
}
if ($type !== null) {
    $sql .= " AND  type Like '$type%' ";
}

if ($startDateFilter !== null && $endDateFilter !== null) {
    $sql .= " AND datee BETWEEN '$startDateFilter' AND '$endDateFilter'";
}

$sql .= " ORDER BY id DESC ";



?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Payments</h1>
     
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


        <?php 

        $date = $time = date('Y-m-d', strtotime('+0 day'));
              $date1 =  date('Y-m-d', strtotime('+1 day'));

         ?>

          <div class="card">
                    <div class="card-header">
                <!-- <form method="post"> -->
                   <form method="post">
                <div class="row">
                 
                  <div class="form-group col-md-2">
                    <label >Date from</label>
                    <input id="startDateInput"  name="date1" type="date" value="<?php echo $startDateFilter; ?>" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label >Date to</label>
                    <input id="endDateInput" name="date2" type="date" value="<?php echo $date1; ?>" class="form-control">
                  </div>
                    <div class="form-group col-md-2">
                    <label >Payment Methode</label>
                    <select id="methode" name="type" class="form-control">
                      <option value="">All</option>
                      <option value="cash">Cash</option>
                      <option value="bkash">Bkash</option>
                      <option value="nagad">Nagad</option>

                    </select>
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
                </form>
                
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

                $sql1 = "SELECT  count(*) as count, sum(receve_amount) as total FROM payment WHERE  sec='$sec' ";

$selectedUser1 = isset($_POST['recive']) ? $_POST['recive'] : null;
$startDateFilter1 = isset($_POST['date1']) ? $_POST['date1'] : null;
$endDateFilter1 = isset($_POST['date2']) ? $_POST['date2'] : null;
$type1 = isset($_POST['type']) ? $_POST['type'] : null;



if ($selectedUser1 !== null) {
    $sql1 .= " AND  reciveby Like '$selectedUser1%' ";
}

if ($type1 !== null) {
    $sql1 .= " AND  type Like '$type1%' ";  
}

if ($startDateFilter1 !== null && $endDateFilter1 !== null) {
    $sql1 .= " AND datee BETWEEN '$startDateFilter' AND '$endDateFilter'";
}
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
                ?>
                <span class="info-box-number"><?php echo $row1['count']; ?></span>
               
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
                <span class="info-box-number"><?php echo $row1['total']; ?></span>
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
                    <th> C.ID </th>
                    <th>User Name</th>
                    <th>Notes</th>
                    <th style="white-space: nowrap;">Rec Amount</th>
                    <th style="white-space: nowrap;">Total Amount</th>
                    <th style="white-space: nowrap;">Recive By</th>
                    <th style="white-space: nowrap;">Methode</th>
                    <th>Date</th>
                    <th>Action</th>
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
                    <td><a href="profile.php?id=<?php echo $row['custid']; ?>"><?php echo $row['custid']; ?></a> </td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['notes']; ?></td>
                    <td><?php echo $row['receve_amount']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['reciveby']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td style="white-space: nowrap;"><?php echo $row['datee']; ?></td>
                    <td> <a href="data_add/return.php?id=<?php echo $row['custid']; ?>&inv=<?php echo $row['invoice_id']; ?>"><button class="btn btn-primary">Return</button></a> </td>
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



<!-- <script>
$(document).ready(function() {

  applyFilter();
    // Trigger filtering on change events
    $('#userSelect, #startDateInput, #endDateInput').change(function() {
        applyFilter();
    });

    // Initial filtering on page load
    

    function applyFilter() {
        var selectedUser = $('#userSelect').val();
        var startDateFilter = $('#startDateInput').val();
        var endDateFilter = $('#endDateInput').val();

        $.ajax({
            url: 'data_chak/payments.php',
            method: 'POST',
            data: { user: selectedUser, startDate: startDateFilter, endDate: endDateFilter },
            dataType: 'json',
            success: function(data) {
                //$('#paymentslist').html(data);
                $('#result span .res').html(data);

                // Call a separate function to populate the table
                populateTable(data.rows);
            },
            error: function(error) {
                console.error('Error fetching filtered data:', error);
            }
        });
    }
    function populateTable(rows) {
        // Clear existing rows
        $('#dataTable tbody').empty();

        // Populate table rows based on the data received from the server
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var htmlRow = '<tr>';
            htmlRow += '<td>' + row.i + '</td>';
            htmlRow += '<td>' + row.custid + '</td>';
            htmlRow += '<td>' + row.custid + '</td>';
            // Add more columns as needed
            htmlRow += '</tr>';
            
            $('#dataTable tbody').append(htmlRow);
        }
    }
});
</script>

 -->












