<?php
include '../inc/sessaion.php';
include '../inc/config.php'; 

$sec = $_SESSION['sec'];

if (isset($_POST["Import"])) {

    $filename = $_FILES["file"]["tmp_name"];    
    $handle = fopen($filename, 'r');

    if ($handle !== false) {
        $header = fgetcsv($handle);

        // BOM remove করা (UTF-8 CSV problem fix)
        $header[0] = preg_replace('/^\x{FEFF}/u', '', $header[0]);

        // Expected header
        $expectedHeader = ['custid','name','userid','mobile','address','password','packageid','amount','expire','cycle','area','nid','balance','status'];
        if ($header === false || array_map('strtolower', $header) !== $expectedHeader) {
            $_SESSION['error'] = "CSV File Header format error";
            header("Location: ../importuser.php");
            exit;
        }

        $lineNumber   = 1;
        $errors       = []; 
        $rowsToInsert = []; 
        $csvUserIds   = [];

        while (($row = fgetcsv($handle)) !== false) {
            $lineNumber++;

            if (count($row) !== count($expectedHeader)) {
                $errors[] = "Row $lineNumber: Invalid column count.";
                continue;
            }

            list($custid,$name,$userid,$mobile,$address,$password,$packageid,$amount,$expire,$cycle,$area,$nid,$balance,$status) = $row;

            // প্রতি row এর জন্য আলাদা error list
            $rowErrors = [];

            // -------- Validation --------

            if (empty($custid)) {
                $rowErrors[] = "Row $lineNumber: custid is empty.";
            }

            if (empty($userid)) {
                $rowErrors[] = "Row $lineNumber: userid is empty.";
            }

            // Duplicate userid in same CSV
            if (in_array($userid, $csvUserIds)) {
                $rowErrors[] = "Row $lineNumber: Duplicate userid in CSV.";
            }
            $csvUserIds[] = $userid;

            // Duplicate userid in DB
            $checkUser = $conn->query("SELECT COUNT(*) as cnt 
                                       FROM importuser 
                                       WHERE username='".mysqli_real_escape_string($conn,$userid)."'");
            $checkRow  = mysqli_fetch_assoc($checkUser);
            if ($checkRow['cnt'] > 0) {
                $rowErrors[] = "Row $lineNumber: userid already exists in database.";
            }

            // -------- Numeric validations --------
            if (empty($mobile) || !is_numeric($mobile)) {
                $rowErrors[] = "Row $lineNumber: Mobile must be numeric.";
            }
            if (empty($amount) || !is_numeric($amount)) {
                $rowErrors[] = "Row $lineNumber: Amount must be numeric.";
            }
            if (empty($cycle) || !is_numeric($cycle)) {
                $rowErrors[] = "Row $lineNumber: Cycle must be numeric.";
            }

            if ($balance !== "" && !is_numeric($balance)) {
                $rowErrors[] = "Row $lineNumber: Balance must be numeric.";
            }

            // -------- যদি এই row valid হয় --------
            if (empty($rowErrors)) {
                $rowsToInsert[] = [
                    'custid'   => $custid,
                    'name'   => $name,
                    'userid'   => $userid,
                    'mobile'   => $mobile,
                    'address'  => $address,
                    'password' => $password,
                    'packageid'=> $packageid,
                    'amount'   => $amount,
                    'expire'   => $expire, // just store as-is
                    'cycle'    => $cycle,
                    'area'     => $area,
                    'nid'      => $nid,
                    'balance'  => $balance,
                    'sec'=>$sec,
                    'status'   => strtolower($status), // store as-is
                ];
            } else {
                // rowErrors গুলো main errors এ যোগ হবে
                $errors = array_merge($errors, $rowErrors);
            }
        }

        fclose($handle);

        // -------- যদি error থাকে --------
        if (!empty($errors)) {
            $_SESSION['error'] = implode("<br>", $errors);
            header("Location: ../importuser.php");
            exit;
        }

        // -------- সব valid হলে DB insert --------
        $conn->begin_transaction();
        try {
            foreach ($rowsToInsert as $r) {
                $sql = "INSERT INTO importuser 
                (custid,name,username,mobilephone,address,portalloginpassword,packageid,amount,expire,cycle,area,nid,balance,status,sec) 
                VALUES (
                    '".mysqli_real_escape_string($conn,$r['custid'])."',
                    '".mysqli_real_escape_string($conn,$r['name'])."',
                    '".mysqli_real_escape_string($conn,$r['userid'])."',
                    '".mysqli_real_escape_string($conn,$r['mobile'])."',
                    '".mysqli_real_escape_string($conn,$r['address'])."',
                    '".mysqli_real_escape_string($conn,$r['password'])."',
                    '".mysqli_real_escape_string($conn,$r['packageid'])."',
                    '".mysqli_real_escape_string($conn,$r['amount'])."',
                    '".mysqli_real_escape_string($conn,$r['expire'])."',
                    '".mysqli_real_escape_string($conn,$r['cycle'])."',
                    '".mysqli_real_escape_string($conn,$r['area'])."',
                    '".mysqli_real_escape_string($conn,$r['nid'])."',
                    '".mysqli_real_escape_string($conn,$r['balance'])."',
                    '".mysqli_real_escape_string($conn,$r['status'])."',
                     '".mysqli_real_escape_string($conn,$r['sec'])."'
                )";
                if (!$conn->query($sql)) {
                    throw new Exception("Insert failed: ".$conn->error."<br>SQL=".$sql);
                }
            }
            $conn->commit();
            $_SESSION['success'] = count($rowsToInsert)." user(s) imported successfully.";
        } catch (Exception $e) {
            $conn->rollback();
            $_SESSION['error'] = "Import failed: ".$e->getMessage();
        }

        header("Location: ../importuser.php");
        exit;

    } else {
        $_SESSION['error'] = "Could not open file.";
        header("Location: ../importuser.php");
        exit;
    }
}
?>
