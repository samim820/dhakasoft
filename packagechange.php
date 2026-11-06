<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/classes.php'; 

$sec = $_SESSION['sec'];

if (empty($_GET['custid'])) {

    $_SESSION['error'] = "User ID Not Found";
    echo "<script>window.location.replace('index.php')</script>";
    exit;

} else {
    $id = $_GET['custid'];
    $newpackage = $_POST['newpackage'];

    $row = $db->fetchRow("userinfo", "custid", $id);
    $newpackageinfo = $db->fetchRow("package", "id", $newpackage);
    $oldpackageinfo = $db->fetchRow("package", "id", $row['package']);

    // ---- Check conditions ----
    if ($oldpackageinfo['id'] == $newpackageinfo['id']) {
        $_SESSION['error'] = "You selected the same package!";
        echo "<script>window.location.replace('profile.php?id=$id')</script>";
        exit;
    }

    if ($row['routerid'] != $newpackageinfo['routerid']) {
        $_SESSION['error'] = "Package not available in this router!";
        echo "<script>window.location.replace('profile.php?id=$id')</script>";
        exit;
    }

    // ---------- এখানে থেকে calculation হবে ----------
$now = date('d/m/y');
$exp = $row['expire']; // Example: 15/07/26

$nowDate = DateTime::createFromFormat('d/m/y', $now);
$expDate = DateTime::createFromFormat('d/m/y', $exp);

if ($nowDate && $expDate) {
    $diff = $nowDate->diff($expDate);

    // Remaining days
    $days = $diff->days;

    // যদি expire হয়ে যায়
    if ($expDate < $nowDate) {
        $days = -$days;
    }
} else {
    $days = 0; // Invalid date format
}

$oldrent = $row['amount'];
$newrent = $newpackageinfo['mbill'];

$d = date('t'); // বর্তমান মাসের মোট দিন

if ($days < 0) {
    $sts = 'expire';
    $total = 0;
    $oldcalculatbill = 0;
    $newcalculatbill = 0;
} else {
    $sts = 'active';

    $oldperdaybill = $oldrent / $d;
    $newperdaybill = $newrent / $d;

    $oldcalculatbill = $oldperdaybill * $days;
    $newcalculatbill = $newperdaybill * $days;

    $total = round($newcalculatbill - $oldcalculatbill);
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

            <h1 class="m-0 text-dark">Package Change</h1>
     
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Package Change</li>
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
                      <td><strong>Old Package:</strong></td>
                      <td><?= $oldpackageinfo['name']?> @ <?= $row['amount']?></td>
                    </tr>
                    <tr>
                      <td><strong>New Package:</strong></td>
                      <td><?= $newpackageinfo['name']?> @ <?= $newpackageinfo['mbill']?></td>
                    </tr>
                    <tr>
                      <td><strong>Expiry Date:</strong></td>
                      <td><?= $row['expire']?></td>
                    </tr>
    
                    <tr>
                      <td><strong>Bill For :</strong></td>
                      <td><?= $days ?> Days</td>
                    </tr>
                    <?php

                    if ($total > 0) {



                      ?>

                      <tr>
                      <td><strong>Details :</strong></td>
                      <td><?= 'Return for old package = '.round($oldcalculatbill) .' tk, New Package Charg = '.round($newcalculatbill).' tk | Please Pay '.$total.' tk' ?></td>
                    </tr>

                      <?php
                   
                    }else{



                    ?>
                    <tr>
                      <td><strong>Details :</strong></td>
                      <td><?= 'Return for old package = '.round($oldcalculatbill) .' tk, New Package Charg = '.round($newcalculatbill).' tk | Now We Are Back  '.$total.' tk to Your Portal Balance.' ?></td>
                    </tr>

                    <?php 
                      }

                    ?>

                    <?php 

                    $total1 = round($oldcalculatbill-$newcalculatbill);

                    if ($total > 0) {


                     
                    

                     ?>



                    <form action="data_add/packagechange.php" method="post">
                    <tr>
                      <td><strong>Grand Total:</strong></td>
                      <td> <div class=" col-md-4">
                    <input readonly type="text" class="form-control" id="gtotal" name="gtotal" value="<?= $total ?>">
                    <input style="display: none;" type="text" class="form-control"  name="newpackage" value="<?= $newpackageinfo['id'] ?>">
                    <input style="display: none;" type="text" class="form-control"  name="oldpackage" value="<?= $row['package']?>">
                    <input style="display: none;" type="text" class="form-control"  name="custid" value="<?= $id ?>">
                  </div></td>
                    </tr>
                    <tr>
                      <td><strong>Receve Amount:</strong></td>
                      <td> <div class=" col-md-4">
                    <input readonly  type="text" class="form-control"  name="receve"  value="<?= $total ?>">
                  </div></td>
                    </tr>
               <tr>
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

<tr id="moneyRow">
  <td><strong id="moneyLabel">Money Receit No:</strong></td>
  <td>
    <div class="col-md-4">
      <input  type="text" id="moneyInput" class="form-control" name="receipt" placeholder="Enter Money Receipt No">
    </div>
  </td>
</tr>

                    <?php
                  }else{
                    ?>
 <form action="data_add/packagechange1.php" method="post">
                    <tr>
                      <td><strong>Grand Total:</strong></td>
                      <td> <div class=" col-md-4">
                    <input readonly type="text" class="form-control" id="gtotal" name="gtotal" value="<?= $total1 ?>"><span> * This Amount are back to User Balance</span>
                    <input style="display: none;" type="text" class="form-control"  name="newpackage" value="<?= $newpackage ?>">
                    <input style="display: none;" type="text" class="form-control"  name="oldpackage" value="<?= $row['package']?>">
                    <input style="display: none;" type="text" class="form-control"  name="custid" value="<?= $id ?>">
                  </div></td>
                    </tr>

                    <?php
                  }

                    ?>
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


<script>
function updatePaymentFields() {
    var method = document.getElementById("payment").value;
    var moneyRow = document.getElementById("moneyRow");
    var moneyLabel = document.getElementById("moneyLabel");
    var moneyInput = document.getElementById("moneyInput");

    if (method === "Cash") {
        moneyRow.style.display = "table-row";
        moneyLabel.innerText = "Money Receit No:";
        moneyInput.placeholder = "Enter Money Receipt No";
        moneyInput.name = "receipt";
    } 
    else if (method === "Bkash") {
        moneyRow.style.display = "table-row";
        moneyLabel.innerText = "Bkash Transaction No:";
        moneyInput.placeholder = "Enter Bkash Transaction No";
        moneyInput.name = "bkash";
    } 
    else if (method === "Nagad") {
        moneyRow.style.display = "table-row";
        moneyLabel.innerText = "Nagad Transaction No:";
        moneyInput.placeholder = "Enter Nagad Transaction No";
        moneyInput.name = "nagad";
    } 
    else if (method === "Credit") {
        moneyRow.style.display = "none"; // Hide row
    }
}

// যখন select change হবে তখন call হবে
document.getElementById("payment").addEventListener("change", updatePaymentFields);

// Page load এর সময়ও একবার check করবে
window.addEventListener("load", updatePaymentFields);
</script>


  <!-- Control Sidebar -->
<?php include 'inc/foter.php'; ?>
   




  <script>

      $(document).ready(function(){

     
           $("#month").change(function () {
        var month = $(this).find("option:selected").text();
      

   var amount = parseFloat($('#amount').val()) || 0;
   $('#gtotal,#receve').val(amount*month);


});
 





});




        </script>