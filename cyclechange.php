<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 

$sec = $_SESSION['sec'];



if (empty($_POST['custid'])) {

 $_SESSION['success'] = "User ID Not Found";
echo "<script>window.location.replace('index.php')</script>";


}else{


  $id = $_POST['custid'];
  $newcycle = $_POST['newcycle'];
  $sql = "SELECT * FROM userinfo WHERE custid='$id'";
  $row = mysqli_fetch_assoc($conn->query($sql) );
  $packname = $row['package'];

    $sql6 = "SELECT * FROM package WHERE name='$packname' AND sec='$sec'";
    $pac = mysqli_fetch_assoc($conn->query($sql6) );



$exp = DateTime::createFromFormat('d/m/y', $row['expire']);
$currentDay = (int)$exp->format('d');

$newCycle = (int)$_POST['newcycle'];

$newExpire = clone $exp;

if ($newCycle > $currentDay) {
    // এই মাস
    $newExpire->setDate(
        $newExpire->format('Y'),
        $newExpire->format('m'),
        $newCycle
    );
} else {
    // পরের মাস
    $newExpire->modify('+1 month');
    $newExpire->setDate(
        $newExpire->format('Y'),
        $newExpire->format('m'),
        $newCycle
    );
}

// কতদিন extend হলো
$extendDays = $exp->diff($newExpire)->days;
$finalexpire = $newExpire->format('d/m/y');

// Monthly Bill
$monthlyBill = $row['amount'];

// Expire month-এ মোট কতদিন
$daysInMonth = $exp->format('t'); // 28/29/30/31

// প্রতিদিনের বিল
$perDayBill = $monthlyBill / $daysInMonth;

// Extra Bill
$extraBill = round($extendDays * $perDayBill);


}





?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Cycle Change</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Cycle Change</li>
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
                    <tr>
                      <td><strong>Customer ID:</strong></td>
                      <td><?= $row['custid']?></td>
                    <tr>
                      <tr>
                      <td><strong>Mobile Number:</strong></td>
                      <td><?= $row['mobilephone']?></td>
                    </tr>
                    <tr>
                      <td><strong>Package:</strong></td>
                      <td><?= $row['package']?></td>
                    </tr>
                    <tr>
                      <td><strong>Package Price:</strong></td>
                      <td><?= $row['amount']?> tk</td>
                    </tr>
                    <tr>
                      <td><strong>Old Billing Cycle:</strong></td>
                      <td>Day of <?= $row['cycle']?></td>
                    </tr>
                     <tr>
                      <td><strong>New Billing Cycle:</strong></td>
                      <td>Day of <?= $newcycle?></td>
                    </tr>
                    <tr>
                      <td><strong>Old Expiry Date:</strong></td>
                      <td><?= $row['expire']?></td>
                    </tr>
                    <tr>
                      <td><strong>New Expiry Date:</strong></td>
                      <td><?= $finalexpire ?></td>
                    </tr>
                    <tr>
                      <td><strong>Bill For :</strong></td>
                      <td> <?= $extendDays ?> Days</td>
                    </tr>
                    <form action="data_add/cyclechange.php" method="post">
                    <tr>
                      <td><strong>Grand Total:</strong></td>
                      <td> <div class=" col-md-4">
                    <input readonly type="text" class="form-control" id="gtotal" name="gtotal" value="<?= $extraBill ?>">
                    <input style="display: none;" type="text" class="form-control"  name="newexpire" value="<?= $finalexpire ?>">
                    <input style="display: none;" type="text" class="form-control"  name="oldexpire" value="<?= $row['expire']?>">

                    <input style="display: none;" type="text" class="form-control"  name="custid" value="<?= $id ?>">
                    <input style="display: none;" type="text" class="form-control"  name="newcycle" value="<?= $newcycle ?>">
                    <input style="display: none;" type="text" class="form-control"  name="days" value="<?= $newcycle ?>">
                  </div></td>
                    </tr>
                    <tr>
                      <td><strong>Receve Amount:</strong></td>
                      <td> <div class=" col-md-4">
                    <input readonly  type="text" class="form-control"  name="receve"  value="<?= $extraBill ?>">
                  </div></td>
                    </tr>
             <tr>
    <td><strong>Payment Method:</strong></td>
    <td>
        <div class="col-md-4">
            <select id="payment" name="methode" class="form-control">
                <option value="Cash">Cash</option>
                <option value="Bkash">Bkash</option>
                <option value="Nagad">Nagad</option>
                <option value="Credit">Credit/Due</option>
            </select>
        </div>
    </td>
</tr>

<tr id="paymentInfoRow">
    <td><strong id="paymentLabel">Money Receipt No:</strong></td>
    <td>
        <div class="col-md-4">
            <input type="text" class="form-control" id="paymentInput" name="receipt" placeholder="Enter Money Receipt No" required>
        </div>
    </td>
</tr>
                    <tr>
                      <td><strong>Remarks:</strong></td>
                      <td> <div class=" col-md-8">
                    <input  type="text" class="form-control" name="remarks" placeholder="Enter Your Comments">
                  </div></td>
                    </tr>
                    <tr>
                      <td><strong>Action</strong></td>
                      <td> <div class=" col-md-8">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div></td>
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
const payment = document.getElementById('payment');
const paymentRow = document.getElementById('paymentInfoRow');
const paymentLabel = document.getElementById('paymentLabel');
const paymentInput = document.getElementById('paymentInput');

function updatePaymentField() {
    switch (payment.value) {

        case 'Cash':
            paymentRow.style.display = '';
            paymentLabel.innerText = 'Money Receipt No:';
            paymentInput.placeholder = 'Enter Money Receipt No';
            paymentInput.name = 'receipt';
            paymentInput.required = true;
            break;

        case 'Bkash':
            paymentRow.style.display = '';
            paymentLabel.innerText = 'Bkash TxID:';
            paymentInput.placeholder = 'Enter Bkash TxID';
            paymentInput.name = 'bkash_txid';
            paymentInput.required = true;
            break;

        case 'Nagad':
            paymentRow.style.display = '';
            paymentLabel.innerText = 'Nagad TxID:';
            paymentInput.placeholder = 'Enter Nagad TxID';
            paymentInput.name = 'nagad_txid';
            paymentInput.required = true;
            break;

        case 'Credit':
            paymentRow.style.display = 'none';
            paymentInput.required = false;
            paymentInput.value = '';
            break;
    }
}

payment.addEventListener('change', updatePaymentField);

// Page load হলে একবার call হবে
updatePaymentField();
</script>




  <script>



      $(document).ready(function(){

     
           $("#month").change(function () {
        var month = $(this).find("option:selected").text();
      

   var amount = parseFloat($('#amount').val()) || 0;
   $('#gtotal,#receve').val(amount*month);


});
 





});




        </script>