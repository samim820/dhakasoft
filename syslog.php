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
                <h3 class="card-title"><?php echo $sec;; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive drag" >
                <table id="example1" class="table table-bordered table-striped" style="cursor: move;">
                  <thead>
                  <tr>
                    <th width="2%">SL</th>
                    <th style="white-space: nowrap;" width="10%">CUST ID</th>
                    <th width="10%">User ID</th>
                    <th width="15%">Name</th>
                    <th width="10%">Mobile</th>
                    <th width="10%">Package</th>
                    <th width="10%">Exp Date </th>
                    <th style="white-space: nowrap;" width="15%">Status </th>
                    <th width="10%">M.Bill</th>
                    <th width="15%">Action </th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                   // 


                    $sql = "SELECT * FROM systemevents   ORDER BY id DESC LIMIT 200";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
      $i = 0;
        while($row = mysqli_fetch_array($result)){
          $i++;

                    ?>

                  <tr>
                    <td width="2%"><?php echo $i;?></td>
                    <td width="10%" style="white-space: nowrap;"><?php

                    $dateString = $row['DeviceReportedTime'];
$dateTime = DateTime::createFromFormat('YmdHis', $dateString);

// Format the DateTime object into the desired format
$formattedDateTime = $dateTime->format('Y-m-d H:i:s a');

// Output the formatted date and time
echo $formattedDateTime;


                    ?></td>
                    <td style="white-space: nowrap;" width="10%"><?php

                    $dateString = $row['ReceivedAt'];
$dateTime = DateTime::createFromFormat('YmdHis', $dateString);

// Format the DateTime object into the desired format
$formattedDateTime = $dateTime->format('Y-m-d H:i:s a');

// Output the formatted date and time
echo $formattedDateTime;


                    ?></td>

                    <?php
                     $logEntry = $row['Message'];

// Define regular expressions to extract information from the log entry
$regexSrcMAC = '/src-mac\s+([a-fA-F0-9:]+)/';
$regexProto = '/proto\s+([A-Za-z\s\(\),]+)/';
$regexIPs = '/([0-9.]+:\d+)->([0-9.]+:\d+)/';
$regexNAT = '/NAT\s+\(([^)]+)\)->([^,]+)/';
$regexLen = '/len\s+(\d+)/';

// Match regular expressions to extract relevant information
preg_match($regexSrcMAC, $logEntry, $matchesSrcMAC);
preg_match($regexProto, $logEntry, $matchesProto);
preg_match_all($regexIPs, $logEntry, $matchesIPs);
preg_match($regexNAT, $logEntry, $matchesNAT);
preg_match($regexLen, $logEntry, $matchesLen);

// Extract matched information
$srcMAC = $matchesSrcMAC[1] ?? '';
$protocol = $matchesProto[1] ?? '';
$sourceIP = $matchesIPs[1][0] ?? '';
$sourcePort = $matchesIPs[2][0] ?? '';
$destinationIP = $matchesIPs[1][1] ?? '';
$destinationPort = $matchesIPs[2][1] ?? '';
$translatedSourceIP = $matchesNAT[1] ?? '';
$translatedDestinationIP = $matchesNAT[2] ?? '';
$length = $matchesLen[1] ?? '';

// // Format the extracted information
// $formattedLog = [
//     'srcMAC' => $srcMAC,
//     'protocol' => $protocol,
//     'sourceIP' => $sourceIP,
//     'sourcePort' => $sourcePort,
//     'destinationIP' => $destinationIP,
//     'destinationPort' => $destinationPort,
//     'translatedSourceIP' => $translatedSourceIP,
//     'translatedDestinationIP' => $translatedDestinationIP,
//     'length' => $length,
// ];

// // Output the formatted log entry

// echo $destinationIP;
//print_r($formattedLog);

$ipAndPort = $sourceIP;

// Split the IP address and port number
list($ip, $port) = explode(':', $ipAndPort);

echo '<td style="white-space: nowrap;" width="15%">'.$ip.'</td>';
echo '<td style="white-space: nowrap;" width="15%">'.$port.'</td>';




                    ?>
                    
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <th width="15%" style="text-align: left;">
                      
                    </th>
                    <th width="10%">BDT</th>
                    <th width="10%"></th>
        
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

  <!-- Control Sidebar -->
<?php include 'inc/foter.php'; ?>

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