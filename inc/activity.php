<?php
class Activity {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Log activity
     * 
     * @param string $action_type
     * @param string $action
     * @param string|null $custid Optional, user ID
     */
    public function log($action_type, $action, $custid = null) {
        $sec = $_SESSION['sec'] ?? '';
        $actionby = $_SESSION['username'] ?? 'system';
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $date_time = date("Y-m-d H:i:s");

        $stmt = $this->conn->prepare("
            INSERT INTO activity (custid, sec, actionby, action_type, action, ip, date_time)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("sssssss", $custid, $sec, $actionby, $action_type, $action, $ip, $date_time);
        return $stmt->execute();
    }
}
