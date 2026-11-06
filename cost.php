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

            <h1 class="m-0 text-dark">Running Month Cost</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Cost</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Add Cost</button>
              </div>
              <div class="card-header">
                <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Collected Bill</span>
                <span class="info-box-number">1,410</span>
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
                <span class="info-box-text">Total Available Balance</span>
                <span class="info-box-number">410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <?php 

$month = $_GET['month'] ?? date('m');
$year  = $_GET['year']  ?? date('Y');

   $sql = "SELECT SUM(amount) AS total_amount FROM cost WHERE MONTH(cost.date_time) = $month AND YEAR(cost.date_time) = $year AND cost.sec ='$sec'";

     

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
      $i = 0;
        while($cat_fetch = mysqli_fetch_array($result)){

          $i++;

                    ?>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Expense</span>
                <span class="info-box-number"><?= number_format($cat_fetch['total_amount']);?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


        <?php }}}?>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">93,139</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
              </div>
              <div class="card-header">
                <div class="row">
          



 <?php 

 $month = $_GET['month'] ?? date('m');
$year  = $_GET['year']  ?? date('Y');

   $sql = "SELECT cost_category.name, SUM(cost.amount) AS total_amount
FROM cost
JOIN cost_category ON cost.category = cost_category.id WHERE MONTH(cost.date_time) = $month AND YEAR(cost.date_time) = $year AND cost.sec ='$sec'
GROUP BY cost.category  ";

     

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
      $i = 0;
        while($cat_fetch = mysqli_fetch_array($result)){

          $i++;

                    ?>
                    <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?=$cat_fetch['name'];?></span>
                <span class="info-box-number"><?=number_format($cat_fetch['total_amount']);?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
 </div>
          <?php }}} ?>

            <!-- /.info-box -->
         
          <!-- /.col -->

          <!-- /.col -->
  
          <!-- /.col -->

          <!-- /.col -->
        </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="2%">SL</th>
                    <th width="10%">Date & Time</th>
                    <th width="15%">Details</th>
                    <th width="5%">Amount</th>
                    <th width="10%">Category</th>
                    <th width="10%">Add Person</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                   // 

// $sql = "SELECT * FROM radacct WHERE acctstoptime  IS NULL AND acctupdatetime IN (SELECT  MAX(acctupdatetime) FROM radacct GROUP BY Username)";
                  $month = $_GET['month'] ?? date('m');
$year  = $_GET['year']  ?? date('Y');

   $sql = "SELECT * FROM cost WHERE MONTH(cost.date_time) = $month AND YEAR(cost.date_time) = $year AND cost.sec ='$sec'";


if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    	$i = 0;
        while($row = mysqli_fetch_array($result)){

        	$i++;

                    ?>

                  <tr>
                    <td width="2%"><?php echo $i; ?></td>
                    <td width="10%"><?php echo $row['date_time']; ?></td>
                    <td width="15%"><?php echo $row['details']; ?></td>
                    <td width="5%"><?php echo number_format($row['amount']); ?></td>
                    <td width="10%">

                    <?php

                    $cat_id = $row['category'];
        $query = "SELECT * FROM cost_category WHERE id='$cat_id' ";
        $cat_name = mysqli_fetch_assoc($conn->query($query) );
echo $cat_name['name'];

        ?>


                  </td>
                    <td width="10%"><?php echo $row['user']; ?></td>


                    <td width="10%">
                   
                      <a href="cost_update.php?id=<?=$row['id']?>"><button class="btn btn-primary">Edit</button></a> <a href="data_delete/cost_delete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a>


                    </td>
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

     <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Cost Add</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             
            <div class="modal-body">
            	<form action="data_add/cost_add.php" method="POST">
            	 <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Details</label>
                    <input required name="details" type="text" class="form-control"  placeholder="Cost Details">
                  </div>
                     <div class="form-group">
                        <label>Cost Category</label>
                        <select id="nas" name="cost_cat" class="form-control">

                               <?php

                    $cat_id = $row['category'];
        $query = "SELECT * FROM cost_category WHERE id='$cat_id' ";
        $cat_name = mysqli_fetch_assoc($conn->query($query) );
echo $cat_name['name'];

        ?>

                          
                            <?php
        $query = "SELECT * FROM cost_category";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
        }
        ?> 
                        </select>
                      </div>

                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Cost Amount</label>
                    <input required name="amount" type="number" class="form-control"  placeholder="Enter Expense Amount">
                  </div>
                  <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
        document.getElementById("nas").addEventListener("change", function() {
            var nasID = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "data_view/getprofile.php?nasid=" + nasID, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    document.getElementById("mikrotikprofile").innerHTML = this.responseText;
                }
            };
            xhr.send();
        });
    </script>

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





