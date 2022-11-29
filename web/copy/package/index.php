<?php
use function Hestiacp\quoteshellarg\quoteshellarg;

ob_start();
include $_SERVER["DOCUMENT_ROOT"] . "/inc/main.php";

// Check token
verify_csrf($_GET);

// Check user
if ($_SESSION["userContext"] != "admin") {
	header("Location: /list/user");
	exit();
}

// Check package argument
if (empty($_GET["package"])) {
	header("Location: /list/package/");
	exit();
}

if ($_SESSION["userContext"] === "admin") {
	if (!empty($_GET["package"])) {
		$v_package = quoteshellarg($_GET["package"]);
		exec(
			HESTIA_CMD . "v-copy-user-package " . $v_package . " " . $v_package . "-copy",
			$output,
			$return_var,
		);
	}

	if ($return_var != 0) {
		$error = implode("<br>", $output);
		if (empty($error)) {
			$error = "Error: unable to copy package.";
		}
		$_SESSION["error_msg"] = $error;
	}
	unset($output);
}

header("Location: /list/package/");
exit();
