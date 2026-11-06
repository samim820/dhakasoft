<?php 
include 'inc/sessaion.php';
include 'inc/config.php';
include 'inc/classes.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 

$sec = $_SESSION['sec'];

$hasBalance = true;
$resellerchargs = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['register_preview'] = $_POST;

} elseif (isset($_SESSION['register_preview'])) {

    $_POST = $_SESSION['register_preview'];

} else {

    $_SESSION['error'] = "Invalid Request";
    header("Location: adduser.php"); // তোমার form page
    exit;
}


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
              <li class="breadcrumb-item active">New User Registration</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <div class="card card-primary" style="max-width: 800px;margin: 0 auto;">

        <?php 
$custid = $_POST['custid'];
$fullname = $_POST['fullname'];
$userid = $_POST['userid'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$gender = $_POST['gender'];
$postcode = $_POST['postcode'];
$nid = $_POST['nid'];
$house = $_POST['house'];
$road = $_POST['road'];
$flat = $_POST['flat'];
$zone = $_POST['zone'];
$thana = $_POST['thana'];
$distric = $_POST['distric'];
$remark = $_POST['remark'];
$password = $_POST['password'];
$packageid = $_POST['package'];
$cycle = $_POST['cycle'];
$type = $_POST['type'];
$onumac = $_POST['onumac'];


$sql = "SELECT * FROM package WHERE id='$packageid'";
$row = mysqli_fetch_assoc($conn->query($sql) );

$package = $row['id']; 
$packagename = $row['name']; 
$rent = $row['mbill'];








$month = date('m');
$year = date('Y');
$date = date('d');
$d=cal_days_in_month(CAL_GREGORIAN,$month,$year);

if ($cycle > $date) {
  $time = date('Y-m-'.$cycle, strtotime('+0 month'));
}else{

  $time = date('Y-m-'.$cycle, strtotime('+1 month'));
}







$date1 = date_create(date('Y-m-d'));
$date2 = date_create($time);
$diff = date_diff($date1,$date2);
$count = $diff->format("%a");
$expiredate=Date('d M Y', strtotime('+'.$count.' days'));
//$expire=Date('d/M/Y', strtotime('+'.$count.' days'));
$expire=Date('Y/m/d', strtotime('+'.$count.' days'));


// Reseller balance debit section


if ($sec == 'main') {
  
}else{


  $resellerprice = $row['resrat'];

  $perdayresellerprice = $resellerprice/$d;
$calculatbillreseller = $perdayresellerprice*$diff->format("%a");

$resellerchargs = round($calculatbillreseller);

$resellerbalance = $db->fetchRow('profile','sec',$sec);


  $getresellerbalance = $resellerbalance['balance'];


 $hasBalance = $getresellerbalance >= $resellerchargs;





}


$perdaybill = $rent/$d;
$calculatbill = $perdaybill*$diff->format("%a");

$total = round($calculatbill);

        ?>


        <?php if (!$hasBalance): ?>
    <div class="alert alert-danger">
        আপনার ব্যালেন্স পর্যাপ্ত নয়। ইউজার তৈরি করতে <strong><?= $resellerchargs ?> Tk.</strong> লাগবে।
    </div>
<?php endif; ?>


        <div class="card-header">
                <h3 class="card-title">New Connection (Payment Info)</h3>
              </div>

              <form action="data_add/register.php" method="post" >

<table class="table table-md">
  <thead>
                  </thead>
                  <?php

                  $rentcustom = '';

                  ?>
                  <tbody>
                    <tr>
                      <td>Customer ID</td>
                      <td><?php echo $custid; ?></td>
                    </tr>
                    <tr>
                      <td>User Name</td>
                      <td><?php echo $fullname; ?></td>
                    </tr>
                    <tr>
                      <td>Package</td>
                      <td><?php echo $packagename; ?></td>
                    </tr>
                    <tr>
                      <td>Monthly Bill</td>
                      <td><input readonly class="form-control col-md-4 " name="rent" value="<?php echo $rent; ?>"></td>
                    </tr>
                      <tr>
                      <td>Billing Cycle</td>
                      <td>Day of <?php echo $cycle; ?></td>
                    </tr>
                     <tr>
                      <td>New Expiry Date</td>
                      <td><?php echo $time; ?></td>
                    </tr>
                     <tr>
                      <td>Day Count</td>
                      <td><?php echo $diff->format("%a"); ?></td>
                    </tr>
                     <tr>
                      <td>Bill for <?php echo $diff->format("%a"); ?> days</td>
                      <td><?php echo $total; ?> BDT</td>
                    </tr>

                    <?php if ($sec == 'main') {

  
}else{

 ?>
                     <tr>
                      <td style="color: red;">Reseller Charges</td>
                      <td><?php echo $resellerchargs; ?> BDT</td>
                    </tr>

                  <?php } ?>

                     <tr>
                      <td>Installation Charge/OTC</td>
                      <td><input id="otc"  name="otc" value="0" type="text" class="form-control col-md-4 "></td>
                      <td style="display: none;"><input id="amount" name="daysbill" value="<?php echo $total; ?>" type="text" class=""></td>
                    </tr>
                     <tr>
                      <td>Discount</td>
                      <td><input  id="dis" value="0"  name="discount" value="" type="text" class="form-control col-md-4   "></td>
                    </tr>
                     <tr>
                      <td>Deposit</td>
                      <td><input  id="deposit" value="0"  name="depo" type="text" class="form-control col-md-4  total"></td>
                    </tr>
                     <tr>
                      <td>Grand Total</td>
                      <td><input readonly  id="sum"  name="gtotal" value="<?php echo $total; ?>"  type="text" class="form-control col-md-4 "></td>
                    </tr>
                     <tr>
                      <tr>
                      <td>Receve Amount</td>
                      <td><input id="rec" name="recive" value="<?php echo $total; ?>"  type="text" class="form-control col-md-4 "></td>
                    </tr>
                     <tr>
                      <td>Payment Method</td>
                      <td><select name="payment_methode" class="form-control col-md-4">
                      <option value="Cash">Cash</option>
                      <option value="Bkash">Bkash</option>
                    </select></td>
                    
                    </tr>

                     <tr>
                      <td>Remarks</td>
                      <td><input  name="remark" type="text" class="form-control col-md-6"></td>
                    </tr>
                    <input type="hidden" name="custid" value="<?php echo $custid; ?>">
                    <input type="hidden" name="fullname" value="<?php echo $fullname; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="mobile" value="<?php echo $mobile; ?>">
                    <input type="hidden" name="nid" value="<?php echo $nid; ?>">
                    <input type="hidden" name="house" value="<?php echo $house; ?>">
                    <input type="hidden" name="resellerchargs" value="<?php echo $resellerchargs; ?>">
                    <input type="hidden" name="road" value="<?php echo $road; ?>">
                    <input type="hidden" name="flat" value="<?php echo $flat; ?>">
                    <input type="hidden" name="zone" value="<?php echo $zone; ?>">
                    <input type="hidden" name="thana" value="<?php echo $thana; ?>">
                    <input type="hidden" name="distric" value="<?php echo $distric; ?>">
                    <input type="hidden" name="remark" value="<?php echo $remark; ?>">
                    <input type="hidden" name="password" value="<?php echo $password; ?>">
                    <input type="hidden" name="package" value="<?php echo $package; ?>">
                    <input type="hidden" name="packageid" value="<?php echo $packageid; ?>">
                    <input type="hidden" name="cycle" value="<?php echo $cycle; ?>">
                    <input type="hidden" name="type" value="<?php echo $type; ?>">
                    <input type="hidden" name="onumac" value="<?php echo $onumac; ?>">
                    <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                    <input type="hidden" name="postcode" value="<?php echo $postcode; ?>">
                    <input type="hidden" name="expiredate" value="<?php echo $expiredate; ?>">
                    <input type="hidden" name="expire" value="<?php echo $expire; ?>">
                    <input type="hidden" name="daycount" value="<?php echo $count; ?>">



                  </tbody>
                </table>
                 <div style="text-align: center;margin: 0 auto;">
<button type="submit"  <?= !$hasBalance ? 'disabled' : '' ?>
 class="btn btn-primary" style="width: 100px;padding: 10px;margin: 10px;">Submit</button>
</div>

 </form>            
</div>
</div>
</section>

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
<?php include 'inc/foter.php'; ?>
<script>
       $(document).ready(function(){

             $('#otc,#dis,#amount, #deposit,#gtotal,#due').keyup(function(){
   var otc = parseFloat($('#otc').val()) || 0;
   var dis = parseFloat($('#dis').val()) || 0;
   var amount = parseFloat($('#amount').val()) || 0;
   var deposit = parseFloat($('#deposit').val()) || 0;
   var gtotal = parseFloat($('#gtotal').val()) || 0;
   var ttl = $('#sum,#rec').val(otc+amount+deposit+gtotal-dis);




});


});
</script>