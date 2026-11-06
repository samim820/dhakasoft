<?php 
include 'inc/sessaion.php';
include 'inc/heder.php'; 
include 'inc/menu.php'; 
include 'inc/config.php'; 
include 'inc/classes.php'; 

$sec = $_SESSION['sec'];

if (empty($_GET['id'])) {
    $_SESSION['success'] = "User ID Not Found";
    echo "<script>window.location.replace('index.php')</script>";
    exit;
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM userinfo WHERE custid='$id'";
    $row = mysqli_fetch_assoc($conn->query($sql));

    if (empty($row['custid'])) {
        $_SESSION['success'] = "User ID Not Found";
        echo "<script>window.location.replace('index.php')</script>";
        exit;
    }
}
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">User Recharge</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">User Recharge</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="card">
      <div id="output" class="card-body">

        <form action="data_add/recharge.php" method="post">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td><strong>Customer ID:</strong></td>
              <td><?= $row['custid']?></td>
            </tr>
            <tr>
              <td><strong>Mobile Number:</strong></td>
              <td><?= $row['mobilephone']?></td>
            </tr>
            <tr>
              <td><strong>Package:</strong></td>
              <td>










    <?= $userObj->getPackageById($row['package'])['name']; ?></td>
            </tr>
            <tr>
              <td><strong>Price:</strong></td>
              <td>
                <?= $row['amount']; ?> tk</td>
            </tr>
            <tr>
              <td><strong>Billing Cycle:</strong></td>
              <td>Day of <?= $row['cycle']?></td>
            </tr>
            <tr>
              <td><strong>OLD Expiry Date:</strong></td>
              <td>
                <span style="color: red;">
<?php
$date = $row['expire']; // 11/07/26

$dateObj = DateTime::createFromFormat('d/m/y', $date);

echo $dateObj->format('d-M-Y');
?>


</span>
              </td>
            </tr>
          <tr>
    <td><strong>New Expiry Date:</strong></td>
    <td>
        <?php
        $expObj = DateTime::createFromFormat('d/m/y', $row['expire']);
        ?>
        <span style="color: green;"
              id="expiry"
              data-expiry="<?= $row['expire'] ?>">
              <?= $expObj ? $expObj->format('d-M-Y') : $row['expire'] ?>
        </span>

        <input type="hidden"
               id="expiry_new"
               name="expiry_new"
               value="<?= $row['expire'] ?>">
    </td>
</tr>

            <tr>
              <td><strong>No of Months:</strong></td>
              <td>
                <div class="col-md-4">
                  <select id="month" name="month" class="form-control">
                    <?php for($i=1;$i<=12;$i++){ ?>
                      <option value="<?= $i ?>"><?= str_pad($i,2,'0',STR_PAD_LEFT) ?></option>
                    <?php } ?>
                  </select>
                </div>
              </td>
              <input type="hidden" id="amount" name="amount" value="<?= $row['amount']?>">
              <input type="hidden" id="custid" name="custid" value="<?= $row['custid']?>">
            </tr>
            <tr>
              <td><strong>Grand Total:</strong></td>
              <td>
                <div class="col-md-4">
                  <input readonly type="text" class="form-control" id="gtotal" name="gtotal" value="<?= $row['amount']?>">
                </div>
              </td>
            </tr>
            <tr>
              <td><strong>Receive Amount:</strong></td>
              <td>
                <div class="col-md-4">
                  <input type="text" class="form-control" id="receve" name="receve" value="<?= $row['amount']?>">
                </div>
              </td>
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

            <tr id="moneyRow">
              <td><strong id="moneyLabel">Money Receipt No:</strong></td>
              <td>
                <div class="col-md-4">
                  <input type="text" id="moneyInput" class="form-control" name="receipt" placeholder="Enter Money Receipt No">
                </div>
              </td>
            </tr>

            <tr>
              <td><strong>Remarks:</strong></td>
              <td>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="remarks" placeholder="Enter Your Comments">
                </div>
              </td>
            </tr>
            <tr>
              <td><strong>Action</strong></td>
              <td>
                <div class="col-md-8">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        </form>

      </div>
    </div>
  </section>
</div>

<?php include 'inc/foter.php'; ?>

<script>
// Payment method field toggle
function updatePaymentFields() {
    var method = document.getElementById("payment").value;
    var moneyRow = document.getElementById("moneyRow");
    var moneyLabel = document.getElementById("moneyLabel");
    var moneyInput = document.getElementById("moneyInput");

    if (method === "Cash") {
        moneyRow.style.display = "table-row";
        moneyLabel.innerText = "Money Receipt No:";
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
        moneyInput.value = "";
    }
}
document.getElementById("payment").addEventListener("change", updatePaymentFields);
window.addEventListener("load", updatePaymentFields);

$(document).ready(function(){

    function parseDate(dateStr) {
        let parts = dateStr.split('/');
        return new Date(
            2000 + parseInt(parts[2]), // yy -> 20yy
            parseInt(parts[1]) - 1,
            parseInt(parts[0])
        );
    }

function updateExpiry() {

    var month = parseInt($("#month").val()) || 0;
    var amount = parseFloat($('#amount').val()) || 0;

    $('#gtotal,#receve').val(amount * month);

    var currentExpiry = $("#expiry").data("expiry");
    var expireDate = parseDate(currentExpiry);

    var today = new Date();
    today.setHours(0,0,0,0);

    var startDate = (expireDate < today) ? today : expireDate;

    startDate = new Date(startDate);
    startDate.setMonth(startDate.getMonth() + month);

    var day = ("0" + startDate.getDate()).slice(-2);
    var monthNum = ("0" + (startDate.getMonth() + 1)).slice(-2);
    var year2 = startDate.getFullYear().toString().slice(-2);
    var year4 = startDate.getFullYear();

    var monthNames = [
        "Jan","Feb","Mar","Apr","May","Jun",
        "Jul","Aug","Sep","Oct","Nov","Dec"
    ];

    var monthText = monthNames[startDate.getMonth()];

    var dbExpiry = day + "/" + monthNum + "/" + year2;
    var displayExpiry = day + "-" + monthText + "-" + year4;

    $("#expiry").text(displayExpiry);
    $("#expiry_new").val(dbExpiry);
}

$("#month").on("change", updateExpiry);

updateExpiry();

}); // document.ready end
</script>
</script>
