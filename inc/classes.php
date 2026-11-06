<?php
// inc/classes.php
// Require your DB connection ($conn)
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/api.php';

// ---------------- Activity Logger ----------------
class Activity {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        date_default_timezone_set('Asia/Dhaka');
    }

    /**
     * Log an activity row
     */
    public function log($action_type, $action, $custid = null) {
        $sec      = $_SESSION['sec'] ?? '';
        $actionby = $_SESSION['username'] ?? 'system';
        $ip       = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $date_time = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `activity` (`custid`,`sec`,`actionby`,`action_type`,`action`,`ip`,`date_time`)
                VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssss", $custid, $sec, $actionby, $action_type, $action, $ip, $date_time);
        return $stmt->execute();
    }
}



class ExpiredUsers
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        date_default_timezone_set('Asia/Dhaka');
    }

    public function getUsers()
    {
        $currentTime = date('H:i:s');

        $sql = "
            SELECT *
            FROM userinfo
            WHERE billstatus = 'expire'
              AND grace = 0
              AND conn_status = 'A'
              AND (
                    STR_TO_DATE(TRIM(expire), '%d/%m/%y') < CURDATE()
                    OR (
                        STR_TO_DATE(TRIM(expire), '%d/%m/%y') = CURDATE()
                        AND TIME(
                            COALESCE(
                                NULLIF(TRIM(expire_time), ''),
                                '00:00:00'
                            )
                        ) <= ?
                    )
                  )
        ";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die('Prepare failed: ' . $this->conn->error);
        }

        $stmt->bind_param('s', $currentTime);
        $stmt->execute();

        return $stmt->get_result();
    }
}


// ---------------- Generic Database Helper ----------------
class Database {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Insert associative array into a table
    public function insert($table, $data) {
        $cols = array_keys($data);
        $columns = "`" . implode("`,`", $cols) . "`";
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $types = str_repeat("s", count($data));

        $sql = "INSERT INTO `{$table}` ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...array_values($data));
        return $stmt->execute();
    }

    // Fetch single row by column = value
    public function fetchRow($table, $column, $value) {
        $sql = "SELECT * FROM `{$table}` WHERE `{$column}` = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $value);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Fetch all rows by column = value
    public function fetchAll($table, $column, $value) {
        $sql = "SELECT * FROM `{$table}` WHERE `{$column}` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $res = $stmt->get_result();

        $rows = [];
        while ($r = $res->fetch_assoc()) {
            $rows[] = $r;
        }
        return $rows;
    }

    // Update rows: set $data where $whereCol = $whereVal
    public function update($table, $data, $whereCol, $whereVal) {
        $setParts = [];
        foreach ($data as $col => $val) {
            $setParts[] = "`{$col}` = ?";
        }
        $set = implode(", ", $setParts);

        $types = str_repeat("s", count($data)) . "s";
        $values = array_values($data);
        $values[] = $whereVal;

        $sql = "UPDATE `{$table}` SET {$set} WHERE `{$whereCol}` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    public function deductBalance($sec, $amount) {
    $sql = "UPDATE profile
            SET balance = balance - ?
            WHERE sec = ? AND balance >= ?";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("dsd", $amount, $sec, $amount);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}

    // Delete rows where column = value
    public function delete($table, $column, $value) {
        $sql = "DELETE FROM `{$table}` WHERE `{$column}` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $value);
        return $stmt->execute();
    }

    public function resellerWallet(
    $sec,
    $amount,
    $payType,      // DEBIT / CREDIT
    $payFor,       // NEW_CONNECTION, RENEWAL, PACKAGE_UPGRADE
    $custid = '',
    $remarks = ''
) {

    global $conn;

    $amount = floatval($amount);

    if ($amount <= 0) {
        return [
            'status' => false,
            'message' => 'Invalid Amount'
        ];
    }

    // Reseller Info
    $profile = $this->fetchRow('profile', 'sec', $sec);

    if (empty($profile)) {
        return [
            'status' => false,
            'message' => 'Reseller Not Found'
        ];
    }

    $currentBalance = floatval($profile['balance']);

    // Calculate New Balance
    if ($payType == 'DEBIT') {

        if ($currentBalance < $amount) {
            return [
                'status' => false,
                'message' => 'Insufficient Balance'
            ];
        }

        $newBalance = $currentBalance - $amount;

    } elseif ($payType == 'CREDIT') {

        $newBalance = $currentBalance + $amount;

    } else {

        return [
            'status' => false,
            'message' => 'Invalid Transaction Type'
        ];
    }

    // Update Balance
    $update = mysqli_query(
        $conn,
        "UPDATE profile
         SET balance='$newBalance'
         WHERE sec='$sec'"
    );

    if (!$update) {
        return [
            'status' => false,
            'message' => 'Balance Update Failed'
        ];
    }

    // History Entry
    $entryUser = $_SESSION['username'] ?? 'System';
    $dateTime  = date('Y-m-d H:i:s');

    mysqli_query(
        $conn,
        "INSERT INTO reseller_payment
        (
            amount,
            pay_type,
            pay_for,
            newbalance,
            custid,
            remarks,
            entry,
            date_time,
            sec
        )
        VALUES
        (
            '$amount',
            '$payType',
            '$payFor',
            '$newBalance',
            '$custid',
            '$remarks',
            '$entryUser',
            '$dateTime',
            '$sec'
        )"
    );

    return [
        'status' => true,
        'message' => 'Success',
        'old_balance' => $currentBalance,
        'new_balance' => $newBalance
    ];
}  




    // Simple validator
    public function validate($data, $rules) {
        $errors = [];
        foreach ($rules as $field => $rule) {
            $value = isset($data[$field]) ? trim((string)$data[$field]) : "";
            foreach (explode("|", $rule) as $r) {
                if ($r === "required" && $value === "") {
                    $errors[$field] = ucfirst($field) . " is required!";
                } elseif ($r === "number" && $value !== "" && !is_numeric($value)) {
                    $errors[$field] = ucfirst($field) . " must be a number!";
                } elseif ($r === "date" && $value !== "" && strtotime($value) === false) {
                    $errors[$field] = ucfirst($field) . " must be a valid date!";
                }
            }
        }
        return $errors;
    }
}

class User {
    private $conn;
    private $activity;
    private $api;

    public function __construct($conn, $activity) {
        $this->conn = $conn;
        $this->activity = $activity;
        $this->api = new routeros_api();
        $this->api->debug = false;
    }

    public function getUserById($custid, $secid) {
        $sql = "SELECT * FROM userinfo WHERE custid=? AND sec=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $custid, $secid);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getPackageById($packageid) {
        $sql = "SELECT * FROM package WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $packageid);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();

       
    }

    public function getRouterById($routerid) {
        $sql = "SELECT * FROM nas WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $routerid);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getPPPoESecret($router, $username) {
        $ip = $router['nasname'];
        $user = $router['username'];
        $pass = $router['password'];
        $port = $router['api'];
        $this->api->port = $port;
        if ($this->api->connect($ip, $user, $pass)) {
            $result = $this->api->comm("/ppp/secret/getall", ["?name" => $username]);
            $this->api->disconnect();
            return $result;
        }
        return false;
    }

    public function getActivePPPoE($router) {
        $ip = $router['nasname'];
        $user = $router['username'];
        $pass = $router['password'];
        $port = $router['api'];
        $this->api->port = $port;
        if ($this->api->connect($ip, $user, $pass)) {
            $active = $this->api->comm("/ppp/active/print");
            $this->api->disconnect();
            return $active;
        }
        return [];
    }

    public function disconnectPPPoEUser($router, $username) {
    $ip   = $router['nasname'];
    $user = $router['username'];
    $pass = $router['password'];
    $port = $router['api'];

    $this->api->port = $port;

    if ($this->api->connect($ip, $user, $pass)) {

        $active = $this->api->comm("/ppp/active/print", [
            "?name" => $username
        ]);

        if (!empty($active)) {
            foreach ($active as $a) {
                $this->api->comm("/ppp/active/remove", [
                    ".id" => $a[".id"]
                ]);
            }
        }

        $this->api->disconnect();
        return true;
    }

    return false;
}

    // শুধু PPPoE password change
public function updatePPPoEPassword($router, $username, $newPassword) {
    $ip   = $router['nasname'];
    $user = $router['username'];
    $pass = $router['password'];
    $port = $router['api'];
    $this->api->port = $port;

    if ($this->api->connect($ip, $user, $pass)) {
        $secret = $this->api->comm("/ppp/secret/print", ["?name" => $username]);
        if (count($secret) > 0) {
            $id = $secret[0][".id"];
            $this->api->comm("/ppp/secret/set", [
                ".id"      => $id,
                "password" => $newPassword
            ]);
            $this->api->disconnect();
            return true;
        }
        $this->api->disconnect();
    }
    return false;
}

// শুধু PPPoE profile change
public function updatePPPoEProfile($router, $username, $newProfile) {
    $ip   = $router['nasname'];
    $user = $router['username'];
    $pass = $router['password'];
    $port = $router['api'];
    $this->api->port = $port;

    if ($this->api->connect($ip, $user, $pass)) {
        $secret = $this->api->comm("/ppp/secret/print", ["?name" => $username]);
        if (count($secret) > 0) {
            $id = $secret[0][".id"];
            $this->api->comm("/ppp/secret/set", [
                ".id"     => $id,
                "profile" => $newProfile
            ]);
            $this->api->disconnect();
            return true;
        }
        $this->api->disconnect();
    }
    return false;
}


    
}




// ---------------- Auto-create Objects ----------------
$activity = new Activity($conn);
$db       = new Database($conn);
$userObj  = new User($conn, $activity);
