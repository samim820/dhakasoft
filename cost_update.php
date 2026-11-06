<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 

$sec = $_SESSION['sec'];

$cat_id = $_GET['id'];



        $query = "SELECT * FROM cost WHERE id='$cat_id' ";
        $cat_name = mysqli_fetch_assoc($conn->query($query) );


?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Cost Update</h1>
     
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

             
            <div class="modal-body">
              <form action="data_update/cost_update.php?id=<?=$cat_name['id'];?>" method="POST">
               <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Details</label>
                    <input required name="details" type="text" class="form-control" value="<?=$cat_name['details'];?>">
                  </div>
                     <div class="form-group">
                        <label>Cost Category</label>
                        <select id="nas" name="cost_cat" class="form-control">
                          <option selected value="<?=$cat_name['category'];?>">


                            <?php
 
                    $cat_id = $cat_name['category'];
        $query = "SELECT * FROM cost_category WHERE id='$cat_id' ";
        $cat_namee = mysqli_fetch_assoc($conn->query($query) );
echo $cat_namee['name'];

        


                          ?></option>

                          
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
                    <input required name="amount" type="number" class="form-control"  value="<?=$cat_name['amount'];?>">
                  </div>
                  <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                  

                   </form>
            
            </div>

           
        
 
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





