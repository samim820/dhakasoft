<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 

$sec = $_SESSION['sec'];



if (empty($_GET['id'])) {

 $_SESSION['success'] = "User ID Not Found";
echo "<script>window.location.replace('index.php')</script>";


}else{
  $id = $_GET['id'];
  $sql = "SELECT * FROM userinfo WHERE custid='$id'";
  $row = mysqli_fetch_assoc($conn->query($sql) );


  if (empty($row['custid'])) {

     $_SESSION['success'] = "User ID Not Found";
    echo "<script>window.location.replace('index.php')</script>";
  }else{

  }

 
  


}

?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark">IP Address</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">IP Address</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


          <div class="card">
   <!--            <div class="card-header">

      </div> -->

              <!-- /.card-header -->
              
        <div id="output"  class="card-body">
        

<table  class="table table-bordered">
                  <tbody>
         
              <form method="post" action="data_update/ipchange.php">
                <input style="display: none;" type="text" class="form-control" id="custid" name="custid" value="<?= $row['custid']?>">
                
                    <tr>
                      <td><strong>Current IP Address:</strong></td> 
                      <td><div class="col-md-4"><input readonly type="text" class="form-control"  value="<?= $row['ip']?>"></div></td>
                    </tr>
                    <tr>
                      <td><strong>New IP Address:</strong></td>
                    <td style="white-space: nowrap;"><div class="col-md-4"><input  type="text" class="form-control" id="ipchak"  name="ip" placeholder="Enter Your New IP"> <span style="padding-top: 5px;" id="datachak"></span></div>
                    
                    
                    </td>
                    
                
                  
                    </tr>
                    <tr>
                      <td><strong>Action</strong></td>
                      <td> <div class=" col-md-8"> <button id="submit" type="submit" class="btn btn-primary">Submit</button></div></td>
                    </tr>
                    </form>
                    

                  </tbody>
                  </table>

                

              </div>   
                 
          
               
      </div>







          </section>

        </div>






  <!-- Control Sidebar -->
<?php include 'inc/foter.php'; ?>
   



   <script>
            $(document).ready(function(){

                $("#ipchak").keyup(function(){

                    var ip = $(this).val().trim();
            
                    if(ip != ''){
            
                       
            
                        $.ajax({
                            url: './data_chak/ipchak.php',
                            type: 'post',
                            data: {ip: ip},
                            success: function(response){
                
                                $('#datachak').html(response);
                                $('#submit').html(res);
                
                             }
                        });
                    }else{
                        $("#datachak").html("");
                        $('#submit').html(res);
                    }
            
                });

            });
        </script>