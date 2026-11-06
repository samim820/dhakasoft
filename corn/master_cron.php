<?php
include __DIR__ . '/../inc/config.php';
require_once __DIR__ . '/../inc/api.php';

// Set timezone
date_default_timezone_set('Asia/Dhaka');

// Current datetime
$now = time();
$today_date = date('Y-m-d');
$current_hour = date('H'); // 24-hour format
$current_minute = date('i'); // 00-59

// ----------------- Helper functions -----------------

function runTaskEveryMinute() {
    // প্রতি মিনিটে run হওয়া কাজ
    echo "1-minute task running...\n";

    include 'log_onlineuser.php';
    include 'delete_old_activity.php';
    include 'sms_send.php';
    include 'set_expire.php';
    include 'expierd.php';
}

function runTaskEvery7Days() {
    echo "7-day task running...\n";

}

function runTaskEvery30Days() {
    echo "30-day task (month start at 01:00 AM) running...\n";
}

// ----------------- Cron Logic -----------------

// 1. Always run every minute task
runTaskEveryMinute();

// 2. 7-day task
$sevenDayFile = __DIR__ . '/cron_last7.txt';
$last7 = file_exists($sevenDayFile) ? intval(file_get_contents($sevenDayFile)) : 0;
if (($now - $last7) >= 7*24*60*60) {
    runTaskEvery7Days();
    file_put_contents($sevenDayFile, $now);
}

// 3. 30-day / month-start task at 01:00 AM
$thirtyDayFile = __DIR__ . '/cron_last30.txt';
$last30 = file_exists($thirtyDayFile) ? intval(file_get_contents($thirtyDayFile)) : 0;

// Check if today is 1st day of month AND time is 01:00
if (date('j') == 1 && $current_hour == 1 && $current_minute == 0) {
    // Prevent duplicate runs if cron runs multiple times in same minute
    if (($now - $last30) > 55) { // at least 55 seconds since last run
        runTaskEvery30Days();
        file_put_contents($thirtyDayFile, $now);
    }
}

echo "Cron tasks checked at " . date('Y-m-d H:i:s') . "\n";
?>
