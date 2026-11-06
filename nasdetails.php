<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 
 
require('inc/api.php');

$sec = $_SESSION['sec'];


if ($sec == 'main') {
  


$id = $_GET['id'];

$sql1 = "SELECT * FROM nas WHERE id='$id'";
$router = mysqli_fetch_assoc($conn->query($sql1));

$ip       = $router['nasname'];
$username = $router['username'];
$pass     = $router['password'];
$apiport  = $router['api'];

$API = new routeros_api();
$API->debug = false;
$API->port = $apiport;

if ($API->connect($ip , $username, $pass)) {


  $secrets = $API->comm('/ppp/secret/print');

    $totalUsers = count($secrets);

    $totalppp = $totalUsers;

    $API->disconnect();

} else {
    $totalppp = 'connection error';
}
              
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
<h1 class="m-0 text-dark">NAS Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">NAS Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        
<div class="container-fluid">
        
              <!-- /.card-header -->
              <div class="row mb-2">

                <div class="col-md-6">
                
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">NAS Health</h3>
      
    </div>
              
              <div class="card-body" id="status">
                

                <p>Lodding....</p>

              </div>
              </div>


              <!-- /.card-body -->
            </div>    

            <div class="col-md-6">
                
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Radius For This NAS</h3>
      
    </div>
              
              <div class="card-body">
                 <table class="table">
                  <tbody>
                    <tr>
                      <td>Total User Avalable in Radius</td>
                      <td><span style="font-size: 20px;"> <?php 

                $result = $conn->query("select * from userinfo where routerid='$id' ");
                $activeuser =$result->num_rows;

                echo $activeuser;



                ?></span></td>
                    </tr>
                    <tr>
                      <td>Total User Avalable in NAS</td>
                      <td><span style="font-size: 20px;"><?= $totalppp?></span></td>
                    </tr>
                    <tr>
                      <td>Total User In Radius</td>
                      <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                    <tr>
                      <td>Fix and squish bugs</td>
                      <td><span class="badge bg-success">90%</span></td>
                    </tr>
                  </tbody>
                </table>

              </div>
              </div>


              <!-- /.card-body -->
            </div>  
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


<!-- NAS EDITE CODE BELOW -->


 

<!-- NAS EDITE CODE END -->











<?php 
}else{

echo '<script>window.location.href = "/reseller.php";</script>';
exit;
}

?>

     



  <!-- Control Sidebar -->
<?php include 'inc/foter.php'; ?>


<script>
function userstatus(){
    $.ajax({
        url: './data_chak/nasstatus.php?id=<?= $id; ?>',
        type: 'GET',
        dataType: 'html',
        success: function(data){
            $('#status').html(data);
        },
        error: function(xhr, status, error){
            console.log("AJAX Error:", error);
            console.log("Response Text:", xhr.responseText);
        }
    });
}

// প্রথমবার 1 সেকেন্ড পরে load হবে
setTimeout(function(){
    userstatus();

    // এরপর প্রতি 10 সেকেন্ড পর পর load হবে
    setInterval(userstatus, 10000);

}, 1000);
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
