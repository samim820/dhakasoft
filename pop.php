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

            <h1 class="m-0 text-dark">POP List</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">POP List</li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Add POP</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="2%">SL</th>
                    <th width="10%">POP Name</th>
                    <th width="10%">Allow Mikrotik</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                   
                    $sql = "SELECT * FROM pop";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    	$i = 0;
        while($row = mysqli_fetch_array($result)){

        	$i++;

                    ?>

                  <tr>
                    <td width="2%"><?php echo $i; ?></td>
                    <td width="10%"><?php echo $row['name']; ?></td>
                    <td width="10%"><?php 
                    $id = $row['mikrotik'];
                    $sql = "SELECT * FROM nas WHERE id='$id'";
                    $raw = mysqli_fetch_assoc($conn->query($sql) );


                    echo $raw['shortname'].'/'.$raw['nasname'];





                    ?>
                      





                    </td>
                    <td width="10%"><a href="#"><button class="btn btn-primary">Edite</button></a> <a href="data_delete/pop_delete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
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
              <h4 class="modal-title">New POP Add</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             
            <div class="modal-body">
            	<form action="data_add/pop.php" method="POST">
            	 <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">POP Name</label>
                    <input required name="name" type="text" class="form-control"  placeholder="POP Name">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="exampleInputPassword1">Add Mikrotik</label>
                    <select class="form-control" name="mikrotik">
                       <?php 
                   
                    $sql = "SELECT * FROM nas";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
      $i = 0;
        while($row = mysqli_fetch_array($result)){


                    ?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['shortname']; ?>/<?php echo $row['nasname']; ?></option>
                      <?php
}
}}else{


}
?>
                    </select>
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





