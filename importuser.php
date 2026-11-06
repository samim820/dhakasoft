<?php 
include 'inc/sessaion.php';
include 'inc/auth.php'; 
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
                <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Import User CSV File Only</h3>
              </div>
              <div class="card-body">
                <div class="row">
                 <div class="form-group col-12">
                  <form action="data_update/importuserlist.php" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="file" type="file" class="custom-file-input" id="myFile">
                        <label class="custom-file-label" id="myFile" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <button name="Import" type="submit" class="btn btn-primary">Upload</button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

             
<script>
function myFunction() {
  var x = document.getElementById("myFile").name;
  document.getElementById("demo").innerHTML = x;
}
</script>
              <!-- /.card-body -->
            </div>
              </div>
                 <div class="card-header">
                <a href="data_delete/deleteimportuser.php"><button class="btn btn-danger">Delete Data</button></a> <button class="btn btn-success" data-toggle="modal" data-target="#modal-default">Insert Data</button> <a href="demo.csv"><button class="btn btn-success">Sample Download</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive drag" >
                <table id="example1" class="table table-head-fixed text-nowrap" style="cursor: move;">
                  <thead>
                  <tr>
                    <th width="2%">SL</th>
                    <th style="white-space: nowrap;" width="10%">CUST ID</th>
                    <th width="10%">UserName</th>
                    <th width="10%">User ID</th>
                    <th width="10%">Mobile</th>
                    <th width="10%">Address</th>
                    <th width="10%">Password </th>
                    <th width="10%">Package</th>
                    <th width="10%">Amount</th>
                    <th width="10%">Area</th>
                    <th width="15%">Action </th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                   // 


                    $sql = "SELECT * FROM importuser ";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
      $i = 0;
        while($row = mysqli_fetch_array($result)){
          $i++;

                    ?>

                  <tr>
                    <td width="2%"><?php echo $i;?></td>
                    <td width="10%" style="white-space: nowrap;"><?= $row['custid']; ?></td>
                    <td style="white-space: nowrap;" width="10%"><?php echo $row['name']; ?></td>
                    <td style="white-space: nowrap;" width="10%"><?php echo $row['username']; ?></td>
                    <td width="10%" style="white-space: nowrap;"><?php echo $row['mobilephone']; ?></td>
                    <td width="10%" style="white-space: nowrap;"><?= $row['address']; ?></td>
                    <td width="15%" style="text-align: left;"><?= $row['portalloginpassword']; ?></td>
                    <td width="15%" style="text-align: left;"><?= $row['packageid']; ?></td>
                    <td width="15%" style="text-align: left;"><?= $row['amount']; ?></td>
                    <td width="15%" style="text-align: left;"><?= $row['area']; ?></td>
                    <td width="10%"><?php echo $row['amount']; ?> BDT</td>
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
</div></td>
        
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
              <h4 class="modal-title">Insert Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             
            <div class="modal-body">
              <form action="data_add/importuserinsert.php" method="POST">

                     <div class="form-group col-md-12">
                        <label>Select POP</label>
                        <select  name="popname" class="form-control">
                          <option value="<?= $sec?>">MAIN-POP</option>
                            <?php
        $query = "SELECT * FROM pop";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row['popid']."'>".$row['name']."</option>";
        }
        ?> 
                        </select>
                      </div>
<div class="form-group col-md-12">
                        <label for="profile">Select Mikrotik:</label>
    <select  name="deviceid" class="form-control">
                              <?php
        $query = "SELECT * FROM nas";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            echo "<option value='".$row['id']."'>".$row['shortname'].'/'.$row['nasname']."</option>";
        }
        ?> 
    </select>
 </div>

                  <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary">Update Now</button>
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