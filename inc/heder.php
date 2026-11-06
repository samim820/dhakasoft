<?php


$isMain = ($_SESSION['sec'] ?? '') === 'main';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dhaka-Soft | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
<!--   <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css"> -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="dist/css/from.css">
  <link rel="stylesheet" href="dist/css/custom.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

 
 <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="https://isp.dhakasoft.org/public/dist/img/logo.png">


  <style>
  .search-box .input-group {
    width: 250px;
  }

  .search-result {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    background: #fff;
    border: 1px solid #ccc;
    border-top: 0;
    z-index: 9999;
    display: none;
  }

  .search-item {
    padding: 7px 8px;
    cursor: pointer;
    color: #333;
    border-bottom: 1px solid #f1f1f1;
  }

  .search-item:hover,
  .search-item.active {
    background: #5795ed;
    color: #fff;
  }

  .search-item small {
    display: block;
    font-size: 13px;
  }
.reseller-balance {
  height: 31px;
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 0 10px;
  background: #f4f6f9;
  border: 1px solid #dee2e6;
  border-radius: .2rem;
  white-space: nowrap;
}

.balance-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  color: #28a745;
  font-size: 14px;
}

.reseller-balance small {
  margin: 0;
  color: #6c757d;
  font-size: 12px;
  font-weight: 400;
}

.reseller-balance strong {
  color: #343a40;
  font-size: 13px;
  font-weight: 700;
}
</style>


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
  <form action="profile.php" method="get" class="form-inline ml-3 search-box">
  <div class="input-group input-group-sm position-relative">
    <input
      id="searchInput"
      name="id"
      class="form-control form-control-navbar"
      type="search"
      placeholder="Enter ID / Username / IP..."
      autocomplete="off"
    >

    <div class="input-group-append">
      <button class="btn btn-primary" type="submit">
        <i class="fas fa-search"></i>
      </button>
    </div>

    <div id="searchResult" class="search-result"></div>
  </div>
</form>

<?php if (!$isMain): ?>
<div class="reseller-balance ml-3">
  <span class="balance-icon">
    <i class="fas fa-wallet"></i>
  </span>
  <small>Balance:</small>

<?php 
include_once __DIR__ . '/classes.php';

$sec = $_SESSION['sec'];


$reseller_balance = $db->fetchRow('profile','sec',$sec);

?>
  <strong><?= number_format((float)($reseller_balance['balance'] ?? 0)) ?> Tk</strong>


</div>
<?php endif;?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link"  href="logout.php">
          <i class="fas fa-sign-out-alt"></i>
        </a>

      </li>
    </ul>
  </nav>
  <!-- /.navbar -->



<script>
$(document).ready(function () {
  $("#searchInput").on("keyup", function () {
    var searchid = $(this).val().trim();

    if (searchid === "") {
      $("#searchResult").html("").hide();
      return;
    }

    $.ajax({
      url: "./data_chak/usersearch.php",
      type: "POST",
      data: { searchid: searchid },
      success: function (response) {
        $("#searchResult").html(response).show();
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      }
    });
  });

  $(document).on("click", ".search-item:not(.no-result)", function () {
    var custid = $(this).data("id");

    if (custid) {
      window.open("profile.php?id=" + encodeURIComponent(custid), "_blank");
    }
  });
});
</script>