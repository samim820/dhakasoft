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

            <h1 class="m-0 text-dark">Cost Category</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Cost Category</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Add Category</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="2%">SL</th>
                    <th width="10%">Name</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                   // 

// $sql = "SELECT * FROM radacct WHERE acctstoptime  IS NULL AND acctupdatetime IN (SELECT  MAX(acctupdatetime) FROM radacct GROUP BY Username)";
                    $sql = "SELECT * FROM cost_category WHERE sec='$sec'";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    	$i = 0;
        while($row = mysqli_fetch_array($result)){

        	$i++;

                    ?>

                  <tr>
                    <td width="2%"><?php echo $i; ?></td>
                    <td width="10%"><?php echo $row['name']; ?></td>
                    <td width="10%"><a href="#"><button class="btn btn-primary">Edite</button></a> <a href="data_delete/cost_cat_delete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
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
              <h4 class="modal-title">Category Add</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             
            <div class="modal-body">
            	<form action="data_add/cost_category.php" method="POST">
            	 <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Name</label>
                    <input required name="name" type="text" class="form-control"  placeholder="Cost Category Name">
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





