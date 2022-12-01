<?php
use function Hestiacp\quoteshellarg\quoteshellarg;

ob_start();

include $_SERVER["DOCUMENT_ROOT"] . "/inc/main.php";

// Check token
verify_csrf($_POST);

$service = $_POST["service"];
$action = $_POST["action"];

if ($_SESSION["userContext"] === "admin") {
	switch ($action) {
		case "stop":
			$cmd = "v-stop-service";
			break;
		case "start":
			$cmd = "v-start-service";
			break;
		case "restart":
			$cmd = "v-restart-service";
			break;
		default:
			header("Location: /list/server/");
			exit();
	}

	if (!empty($_POST["system"]) && $action == "restart") {
		exec(HESTIA_CMD . "v-restart-system yes", $output, $return_var);
		$_SESSION["error_srv"] = "The system is going down for reboot NOW!";
		unset($output);
		header("Location: /list/server/");
		exit();
	}

	foreach ($service as $value) {
		$value = quoteshellarg($value);
		exec(HESTIA_CMD . $cmd . " " . $value, $output, $return_var);
	}
}

header("Location: /list/server/");
