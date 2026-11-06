<?php
class Database {
    private $conn;

    // কনস্ট্রাক্টরে config থেকে কানেকশন নেবে
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Insert Function
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $types = str_repeat("s", count($data)); // সব ফিল্ড string ধরে নিচ্ছি

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param($types, ...array_values($data));
        return $stmt->execute();
    }
}