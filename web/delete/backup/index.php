<?php
// Init
error_reporting(NULL);
ob_start();
session_start();
include($_SERVER['DOCUMENT_ROOT']."/inc/main.php");

if (($_SESSION['userContext'] === "admin") && (!empty($_GET['user']))) {
    $user=$_GET['user'];
}

// Check token
if ((!isset($_GET['token'])) || ($_SESSION['token'] != $_GET['token'])) {
    header('location: /login/');
    exit();
}

if (!empty($_GET['backup'])) {
    $v_username = escapeshellarg($user);
    $v_backup = escapeshellarg($_GET['backup']);
    exec (HESTIA_CMD."v-delete-user-backup ".$v_username." ".$v_backup, $output, $return_var);
}
check_return_code($return_var,$output);
unset($output);

$back = $_SESSION['back'];
if (!empty($back)) {
    header("Location: ".$back);
    exit;
}

header("Location: /list/backup/");
exit;
