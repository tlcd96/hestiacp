<?php
use function Hestiacp\quoteshellarg\quoteshellarg;

ob_start();

include $_SERVER["DOCUMENT_ROOT"] . "/inc/main.php";

// Check token
verify_csrf($_POST);

$action = $_POST["action"];
$backup = quoteshellarg($_POST["backup"]);

$web = "no";
$dns = "no";
$mail = "no";
$db = "no";
$cron = "no";
$udir = "no";

if (!empty($_POST["web"])) {
	$web = quoteshellarg(implode(",", $_POST["web"]));
}
if (!empty($_POST["dns"])) {
	$dns = quoteshellarg(implode(",", $_POST["dns"]));
}
if (!empty($_POST["mail"])) {
	$mail = quoteshellarg(implode(",", $_POST["mail"]));
}
if (!empty($_POST["db"])) {
	$db = quoteshellarg(implode(",", $_POST["db"]));
}
if (!empty($_POST["cron"])) {
	$cron = "yes";
}
if (!empty($_POST["udir"])) {
	$udir = quoteshellarg(implode(",", $_POST["udir"]));
}

if ($action == "restore") {
	exec(
		HESTIA_CMD .
			"v-schedule-user-restore " .
			$user .
			" " .
			$backup .
			" " .
			$web .
			" " .
			$dns .
			" " .
			$mail .
			" " .
			$db .
			" " .
			$cron .
			" " .
			$udir,
		$output,
		$return_var,
	);
	if ($return_var == 0) {
		$_SESSION["error_msg"] = _("RESTORE_SCHEDULED");
	} else {
		$_SESSION["error_msg"] = implode("<br>", $output);
		if (empty($_SESSION["error_msg"])) {
			$_SESSION["error_msg"] = _("Error: Hestia did not return any output.");
		}
		if ($return_var == 4) {
			$_SESSION["error_msg"] = _("RESTORE_EXISTS");
		}
	}
}

header("Location: /list/backup/?backup=" . $_POST["backup"]);
