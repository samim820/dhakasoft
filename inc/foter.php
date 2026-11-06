




 <!--  <aside class="control-sidebar control-sidebar-dark">
 
  </aside> -->
  <!-- /.control-sidebar -->

<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="dist/js/custom.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script> -->

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>




<?php

$start = new DateTime('first day of this month - 6 months');
$end   = new DateTime('last month');
$interval  = new DateInterval('P1M'); // http://www.php.net/manual/en/class.dateinterval.php

$date_period = new DatePeriod($start, $interval, $end);
$months = array();
foreach($date_period as $dates) {
  array_push($months, $dates->format('F').' '.$dates->format('Y'));
}


$get = array($months);


?>

<script>
// function getLast3Months() {

//   var monthNames = ["January", "February", "March", "April", "May", "June",
//     "July", "August", "September", "October", "November", "December"
//   ];

//   var today = new Date();
//   var last3Months = []

//   for (i = 0; i < 6; i++) {
//     last3Months.push(monthNames[(today.getMonth() - i)] + ' - ' +today.getFullYear()  );
//   }
//   return last3Months;
// }



// const yValues = [80,  44, 24, 15, 100, 200];
// const barColors = ["red", "green","blue","orange","brown","brown"];

// new Chart("myChart", {
//   type: "bar",
//   data: {
//     labels: getLast3Months(6),
//     datasets: [{
//       backgroundColor: barColors,
//       data: yValues
//     }]
//   },
//   options: {
//     legend: {display: false},
//     title: {
//       display: true,
//       text: "Last 6 Month Perfomance"
//     }
//   }
// });
</script>



</body>
</html>

<?php

if (isset($_SESSION['success'])) {
  

?>

<script> toastr.success('<?php echo $_SESSION['success']; ?>') </script>
<?php

unset($_SESSION['success']);
}else{

}




if (isset($_SESSION['error'])) {
  

?>

<script> toastr.error('<?php echo $_SESSION['error']; ?>') </script>
<?php

unset($_SESSION['error']);
}else{

}







?>


<?php

if (isset($_SESSION['bigerr'])) {

?>
<script>Swal.fire({title: "The Internet?",text: "<?php echo $_SESSION['bigerr']; ?>",icon: "question"});</script>

<?php

unset($_SESSION['bigerr']);
}else{

}

?>