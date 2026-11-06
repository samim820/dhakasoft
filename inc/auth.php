<?php
/**
 * Include this file at the top of pages that only main users may access.
 */

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (($_SESSION['sec'] ?? '') !== 'main') {
    header('Location: index.php');
    exit;
}

