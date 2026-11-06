<?php
//include 'inc/sessaion.php';
//include 'inc/config.php';
include 'inc/heder.php'; 
//include 'inc/menu.php'; 
$sec = $_SESSION['sec'];

?>



  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

 <div class="row" id="status">
       <div class="col-md-2 col-sm-4 col-12">
      
       <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-microchip"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CPU</span>
                <span class="info-box-number">Lodding ..</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-4 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-hdd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SPACE USED</span>
                <span class="info-box-number">Lodding ..</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-4 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-hdd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">FREE SPACE</span>
                <span class="info-box-number">Lodding ..</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-4 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-cloud-download-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL SPACE</span>
                <span class="info-box-number">Lodding ..</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-4 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-sd-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Memory USED</span>
                <span class="info-box-number">Lodding ..</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
            <div class="col-md-3 col-sm-4 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-sd-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Memory</span>
                <span class="info-box-number">Lodding ..</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      





          </section>

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



               setInterval(function(){ 
   userstatus();     
}, 1000);
   

   function userstatus(){

                          $.ajax({
                            type: 'json',
                            url: './data_chak/cpu.php',
                            success: function(data){
                           

                  $('#status').html(data);
                                 
                            
                               
                
                             }
                        });
                      }


        </script>


