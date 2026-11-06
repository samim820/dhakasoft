<?php 

function pingHost($host, $count = 4) {
    $output = [];
    $latency = null;

    // Execute the ping command
    exec("ping -c $count $host", $output, $result);

    // If the command executed successfully
    if ($result === 0) {
        foreach ($output as $line) {
            if (preg_match('/time=(\d+\.\d+)/', $line, $matches)) {
                $latency = $matches[1];
            }
        }
    }

    return $latency ?: "Time Out.";
}

// Host to monitor
$host = isset($_GET['host']) ? $_GET['host'] : '1.1.1.1';
$google = isset($_GET['host']) ? $_GET['host'] : '142.250.77.238';
$facebook = isset($_GET['host']) ? $_GET['host'] : '57.144.150.1';
$yahoo = isset($_GET['host']) ? $_GET['host'] : '151.101.129.55';

// Ping the host
$latency = pingHost($host);
$latency2 = pingHost($google);
$latency3 = pingHost($facebook);
$latency4 = pingHost($yahoo);











$cpu_usage = shell_exec("top -bn1 | grep 'Cpu(s)' | awk '{print $2 + $4}'");


exec("free -m | grep 'Mem:'", $mem_output);

// Parse the output to extract memory usage
$mem_output = implode("", $mem_output);
preg_match_all("/\d+/", $mem_output, $mem_usage);

// Extract memory usage values
$total_memory = $mem_usage[0][0];
$used_memory = $mem_usage[0][1];
$free_memory = $mem_usage[0][2];

// Calculate memory usage percentage
$memory_usage_percentage = ($used_memory / $total_memory) * 100;


$number = $memory_usage_percentage;
$rounded_number = round($number, 2); // Round to 2 decimal places

$cpunmbr = $total_cpu_usage;
$cpuusg = round($cpunmbr, 2); // Round to 2 decimal places


$memory_output = exec("grep MemTotal /proc/meminfo");
$memory_array = explode(" ", $memory_output);
$memory_kb = $memory_array[8]; // Memory size is in the 9th element

// Convert memory size from kilobytes to megabytes
$memory_mb = $memory_kb / 1024;

$disk_total = disk_total_space("/www/wwwroot/radius.dhakasoft.org");
$disk_total_space = $disk_total / (1024 * 1024 * 1024); // Convert bytes to gigabytes

$root_info = shell_exec("df -h / | awk 'NR==2 {print $2, $3, $4}'");

// Split the result to get total, used, and free space
list($total, $used, $free) = explode(" ", trim($root_info));



$disk_free = disk_free_space("/www/wwwroot/radius.dhakasoft.org");
$disk_free_speac = $disk_free / (1024 * 1024 * 1024); // Convert bytes to gigabytes


$disk_used_space = $disk_total_space - $disk_free_speac;

$ubuntu_version =  shell_exec("lsb_release -d | awk -F':' '{print $2}'");;

// Display the result


 $total_dis =   round($disk_total_space, 2) . " GB";
// echo "<br>";

$diskk_free = round($disk_free_speac, 2) . " GB";
// echo "<br>";



$disk_used = round($disk_used_space, 2) . " GB";
// echo "<br>";

$ttl_memory = round($memory_mb, 2) . " MB";


//Docker Status

$docker_status = shell_exec("systemctl is-active docker");
$apache_status = shell_exec("systemctl is-active apache2");





echo  ' <div class="col-md-3 col-sm-4 col-12">
      
       <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-microchip"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CPU</span>
                <span class="info-box-number">'.$cpu_usage.'% </span>
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
                <span class="info-box-number">'.$used .'</span>
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
                <span class="info-box-number">'.$free.'</span>
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
                <span class="info-box-number">'.$total.'</span>
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
                <span class="info-box-number">'.$rounded_number.' %</span>
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
                <span class="info-box-number">'.$ttl_memory.'</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
            <div class="col-md-3 col-sm-4 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-sd-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Docker</span>
                <span class="info-box-number">'.$docker_status.'</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
           <div class="col-md-3 col-sm-4 col-12">
      
       <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-microchip"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Web Server</span>
                <span class="info-box-number">'.$apache_status.' </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-12">
          
           <h3 style="font-wegiht:bold;">Destination Latency Checker</h2>
           </div>
           
           
           
             <div class="col-md-3 col-sm-4 col-12">
            
      
       <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-hdd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Cloud DNS (1.1.1.1) </span>
                <span class="info-box-number">'.$latency.' </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
              <div class="col-md-3 col-sm-4 col-12">
      
       <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-hdd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Google.com (142.250.77.238) </span>
                <span class="info-box-number">'.$latency2.' </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
                        <div class="col-md-3 col-sm-4 col-12">
      
       <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-hdd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> Facebook.com (57.144.150.1) </span>
                <span class="info-box-number">'.$latency3.' </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
                        <div class="col-md-3 col-sm-4 col-12">
      
       <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-hdd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> Kernel.org (151.101.129.55) </span>
                <span class="info-box-number">'.$latency4.' </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          
          <!-- /.col -->
  '
          
          ;





?>


