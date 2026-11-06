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

            <h1 class="m-0 text-dark">Package</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Package</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        

          <div class="card">
            <?php if ($isMain): ?>
              <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Add Package</button>
              </div>
            <?php endif ?>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="2%">SL</th>
                    <th width="10%">Package ID</th>
                    <th width="10%">Radius Profile</th>
                    <th width="10%">Mikrotik Profile</th>
                    <th width="15%">Customer Rate</th>
                    <th width="10%">Reseller Rat</th>
                    <th width="10%">VAT (%)</th>
                      <?php if ($isMain): ?>

                    <th width="10%">Action</th>
                  <?php endif;?>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                   // 
if ($_SESSION['sec'] == 'main') {

            $sql = "SELECT * FROM package";

            }else{

              $sql = "SELECT * FROM package WHERE sec='$sec'";
          };

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    	$i = 0;
        while($row = mysqli_fetch_array($result)){

        	$i++;

                    ?>

                  <tr>
                    <td width="2%"><?php echo $i; ?></td>
                    <td width="10%"><?php echo $row['id']; ?></td>
                    <td width="10%"><?php echo $row['name']; ?></td>
                    <td width="10%"><?php echo $row['profile']; ?></td>
                    <td width="15%"><?php echo $row['mbill']; ?></td>
                    <td width="10%"><?php echo $row['resrat']; ?></td>
                    <td width="10%"><?php echo $row['vat']; ?> %</td>
                      <?php if ($isMain): ?>

                    <td width="10%"><a href="#">


                      <button class="btn btn-primary">Edite</button></a> <a href="data_delete/package_delete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a>




                    </td>
                  <?php endif;?>
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
              <h4 class="modal-title">New Package Add</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             
            <div class="modal-body">
            	<form action="data_add/package.php" method="POST">
            	 <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Profile Name</label>
                    <input required name="name" type="text" class="form-control"  placeholder="Profile Name">
                  </div>
                     <div class="form-group">
                        <label>Select Mikrotik</label>
                        <select id="nas" name="nas" class="form-control">
                          <option value="">Select Mikrotik</option>
                            <?php
        $query = "SELECT * FROM nas";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row['id']."'>".$row['shortname']."</option>";
        }
        ?> 
                        </select>
                      </div>

                        <label for="profile">Select Mikrotik Profile:</label>
    <select id="mikrotikprofile" name="profile" class="form-control">
        <option value="">Select Mikrotik Profile</option>
    </select>

                    
                 
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Customer Rate</label>
                    <input required name="mbill" type="number" class="form-control"  placeholder="Customer Rate">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Reseller Rate</label>
                    <input required name="rbill" type="number" class="form-control"  placeholder="Reseller Rate">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">VAT (%)</label>
                    <input required name="vat" type="number" class="form-control"  placeholder="VAT">
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





