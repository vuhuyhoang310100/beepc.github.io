<?php
// $conn = new Database($conn);
$conn = new Database();
define("ADMIN_PATH", "../uploads/");
define("ADMINEVENT_PATH", "../uploads/events/");
define("USER_PATH", "uploads/");
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__FILE__, 3));
}
