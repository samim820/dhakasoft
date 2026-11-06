<?php
include 'inc/sessaion.php';
include 'inc/classes.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
$sec = $_SESSION['sec'];
$crunetuserid = $_SESSION['id'];




// $chak_permation = $db->fetchRows("user_permitaion", [
//     "user_id" => $crunetuserid,
//     "name"   => "dashboard"
// ]);




?>



<?php

if ($sec == 'main') {
  


?>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard / <?= date('F-Y'); ?>  (Time: <?= date('H:i A'); ?>)</h1>
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

<!-- START ALL INFORMATION TAB -->


<div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <?php 

                $result = $conn->query("select * from userinfo");
                $totalalluser = $result->num_rows;



                ?>
                <span class="info-box-number"><?php echo $totalalluser; ?></span>
                <span class="info-box-text">Total User (ALL)</span>
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
                  <?php 

                $result = $conn->query("select * from userinfo where userstatus='active' ");
                $activeuser =$result->num_rows;



                ?>
                <span class="info-box-number"><?php echo $activeuser;?></span>
                <span class="info-box-text">Active User (ALL)</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-dark"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <?php 

                $result = $conn->query("select * from userinfo where userstatus='disabled'");
                $inactiveuser =$result->num_rows;



                ?>
                <span class="info-box-number"><?php echo $inactiveuser; ?></span>
                <span class="info-box-text">Inactive User (ALL)</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <?php 

                $result = $conn->query("SELECT COUNT(*) AS total FROM userinfo WHERE billstatus='expire'");
$row = $result->fetch_assoc();
$expireuser = $row['total'];

echo $expireuser;



                ?>
                <span class="info-box-number"><?php echo $expireuser; ?></span>
                <span class="info-box-text">Expire User (ALL)</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>


<!-- END ALL INFORMATION TAB -->

        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php 
$result = $conn->query("select * from userinfo where userstatus='active' AND sec='$sec'");
$totaluser =$result->num_rows;



                ?>
                <h4><?php echo $totaluser; ?></h4>

                <p>Total User (HOME)</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="userlist.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
$sql = "SELECT SUM(receve_amount) AS total_collection
        FROM payment
        WHERE sec='$sec'
        AND MONTH(datee)=MONTH(CURDATE())
        AND YEAR(datee)=YEAR(CURDATE())";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$totalCollection = $row['total_collection'] ?? 0;
                ?>


                <h4><?= number_format($totalCollection, 2)?></h4>

                <p>Total Collection (HOME)</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">

                <?php 
                $sql = "SELECT SUM(receve_amount) AS today_collection
        FROM payment
        WHERE sec='$sec'
        AND DATE(datee)=CURDATE()";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$todayCollection = $row['today_collection'] ?? 0;

                ?>

                <h4><?= number_format($todayCollection, 2)?></h4>
                <p>Today Collection (HOME)</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                               <?php

                $today = date('d/m/y');

$result = $conn->query("
    SELECT COUNT(*) AS total
    FROM userinfo
    WHERE billstatus='expire'
      AND expire='$today'
");

$row = $result->fetch_assoc();
$todayExpireUser = $row['total'];




                ?>


                <h4><?= $todayExpireUser; ?></h4>

                <p>Today Expire (HOME)</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="todayexpire.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Network Monitor</span>
                <span class="info-box-number"><span id="">10</span> / 2</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                  Online / Offline
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Temporaly Disabaled </span>


                <?php 

                $result = $conn->query("
    SELECT
        SUM(CASE WHEN sec = 'main' AND userstatus = 'locked' THEN 1 ELSE 0 END) AS main_locked,
        SUM(CASE WHEN sec <> 'main' AND userstatus = 'locked' THEN 1 ELSE 0 END) AS reseller_locked
    FROM userinfo
");

$row = $result->fetch_assoc();

$mainLocked = $row['main_locked'];
$resellerLocked = $row['reseller_locked'];




                ?>
                <span class="info-box-number"><?= $mainLocked ?>/<?= $resellerLocked ?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                  HOME/STD
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="fas fa-user-plus"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New User</span>

                <?php

 $result = $conn->query("
    SELECT
        COUNT(CASE WHEN sec = 'main' THEN 1 END) AS main_user,
        COUNT(CASE WHEN sec <> 'main' THEN 1 END) AS reseller_user
    FROM userinfo
");

$row = $result->fetch_assoc();

$mainUser = $row['main_user'];
$resellerUser = $row['reseller_user'];




                ?>


                <span class="info-box-number"><?= $mainUser;?>/<?= $resellerUser;?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                  HOME/STD
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fas fa-comments"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Left User</span>
                <span class="info-box-number">working</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  HOME/STD
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>



<div class="row">


          <!-- /.col -->
        <div class="col-md-8">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-exclamation-triangle"></i>
                  Reseller Information
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">


<div id="" class="row">
    <div class="col-md-3">
   <div class="small-box bg-success">
<div class="inner" style="text-align: center;">
  <h4  id="">Working</h4>
  <p>Total Reseller</p>
</div>
</div>
</div>
      <div class="col-md-3">
   <div class="small-box bg-dark">
<div class="inner" style="text-align: center;">
  <h4  id="onlineuse">Working</h4>
  <p>Total User</p>
</div>
</div>
</div>
      <div class="col-md-3">
   <div class="small-box bg-info">
<div class="inner" style="text-align: center;">
  <h4  id="onlineuse">Working</h4>
  <p>Total Online</p>
</div>
</div>
</div>
      <div class="col-md-3">
   <div class="small-box bg-danger">
<div class="inner" style="text-align: center;">
  <h4  id="onlineuse">Working</h4>
  <p>Total Offline</p>
</div>
</div>
</div>

  
</div>




</div>       
  </div>
              <!-- /.card-body -->
    </div>
  


   <div class="col-md-4">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-exclamation-triangle"></i>
                  Online / Offline User
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">


<div id="status" class="row">
    <div class="col-md-6">
   <div class="small-box bg-success">
<div class="inner" style="text-align: center;">

  <h4  id="onlineuse"><div class="spinner-border" role="status">
  <span class="visually-hidden"></span>
</div></h4>
  <p>Total Online User</p>
</div>
</div>
</div>
      <div class="col-md-6">
   <div class="small-box bg-danger">
<div class="inner" style="text-align: center;">
  <h4  id="onlineuse"><div class="spinner-border" role="status">
  <span class="visually-hidden"></span>
</div></h4>
  <p>Total Offline User</p>
</div>
</div>
</div>

  
</div>




</div>       
  </div>
              <!-- /.card-body -->
    </div>

 
    <div class="col-md-4">
            <div class="card card-info">
              <div class="card-body">
                <div class="chart">
                  <div id="useractivity"></div>
                </div>
              </div>
   
            </div>

          </div>




        </div>





          </section>

<?php 

}else{

  echo '<script>window.location.href = "/reseller.php";</script>';
exit;
}


?>
      

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
    // Highcharts global config
    Highcharts.setOptions({
        time: {
            useUTC: false   // লোকাল টাইম 그대로 ব্যবহার করো
        }
    });

    function fetchData() {
        fetch('data_chak/useractivity.php')
        .then(res => res.json())
        .then(data => {
            Highcharts.chart('useractivity', {
                chart: { 
                    type: 'line' 
                },
                title: { 
                    text: 'Active Users (Last 3 Hour)' 
                },
                xAxis: {
                    type: 'datetime',
                    title: { text: 'Time' },
                    dateTimeLabelFormats: {
                        second: '%I:%M:%S %p', // 12h format with AM/PM
                        minute: '%I:%M %p',
                        hour: '%I:%M %p'
                    }
                },
                yAxis: { 
                    title: { text: 'User Count' } 
                },
                series: [
                    { 
                        name: 'Online Users', 
                        data: data.online, 
                        type: 'line', 
                        color: 'green' 
                    }
                ],
                tooltip: {
                    xDateFormat: '%I:%M:%S %p', // tooltip এও AM/PM
                    shared: true
                },
                credits: { enabled: false }
            });
        })
        .catch(err => console.error('Error fetching data:', err));
    }

    // Initial load
    fetchData();

    // Refresh every 1 minute
    setInterval(fetchData, 60000);
</script>


  <!-- Control Sidebar -->
<?php include 'inc/foter.php'; ?>



<script>
function userstatus(){
    $.ajax({
        type: 'GET',
        url: 'usercount.php', // তোমার small-box page
        success: function(data){
            $('#status').html(data); // #status div এ small-box HTML বসবে
        },
        error: function(xhr,status,error){
            console.log('AJAX error:', status, error);
        }
    });
}

// Initial load
userstatus();
// Refresh every 2 seconds
setInterval(userstatus, 10000);
</script>


