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

            <h1 class="m-0 text-dark">Bill Collection</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Bill Collection</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">



          <div class="card" style="max-width: 1000px;margin: 0 auto;">
              <div class="card-header">
        <div class="input-group input-group-lg">
        <input id="chakuser" name="chakuser" type="text" class="form-control" placeholder="Serach User for Bill Collection">
        </div>
      </div>

              <!-- /.card-header -->
              <div id="datachak" class="card-body">
               
        

              </div>
           
                 
          
               
      

<p style="margin-bottom: 20px;"></p>




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
            $(document).ready(function(){

                $("#chakuser").keyup(function(){

                    var searchid = $(this).val().trim();
            
            
                       
            
                        $.ajax({
                            url: './data_chak/billcollection.php',
                            type: 'post',
                            data: {searchid: searchid},
                            success: function(response){
                
                                $('#datachak').html(response);

                
                             }
                        });
               
            
                });

            });
        </script>



