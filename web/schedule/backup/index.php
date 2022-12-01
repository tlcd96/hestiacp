<?php

ob_start();
include $_SERVER["DOCUMENT_ROOT"] . "/inc/main.php";

// Check token
verify_csrf($_GET);

exec(HESTIA_CMD . "v-schedule-user-backup " . $user, $output, $return_var);
if ($return_var == 0) {
	$_SESSION["error_msg"] = _("BACKUP_SCHEDULED");
} else {
	$_SESSION["error_msg"] = implode("<br>", $output);
	if (empty($_SESSION["error_msg"])) {
		$_SESSION["error_msg"] = _("Error: Hestia did not return any output.");
	}

	if ($return_var == 4) {
		$_SESSION["error_msg"] = _("BACKUP_EXISTS");
	}
}
unset($output);
header("Location: /list/backup/");
exit();
