<?php
use function Hestiacp\quoteshellarg\quoteshellarg;

ob_start();
$TAB = "DB";

// Main include
include $_SERVER["DOCUMENT_ROOT"] . "/inc/main.php";

// Check POST request
if (!empty($_POST["ok"])) {
	// Check token
	verify_csrf($_POST);

	// Check empty fields
	if (empty($_POST["v_database"])) {
		$errors[] = _("database");
	}
	if (empty($_POST["v_dbuser"])) {
		$errors[] = _("username");
	}
	if (empty($_POST["v_password"])) {
		$errors[] = _("password");
	}
	if (empty($_POST["v_type"])) {
		$errors[] = _("type");
	}
	if (empty($_POST["v_host"])) {
		$errors[] = _("host");
	}
	if (empty($_POST["v_charset"])) {
		$errors[] = _("charset");
	}
	if (!empty($errors[0])) {
		foreach ($errors as $i => $error) {
			if ($i == 0) {
				$error_msg = $error;
			} else {
				$error_msg = $error_msg . ", " . $error;
			}
		}
		$_SESSION["error_msg"] = sprintf(_('Field "%s" can not be blank.'), $error_msg);
	}

	// Validate email
	if (!empty($_POST["v_db_email"]) && empty($_SESSION["error_msg"])) {
		if (!filter_var($_POST["v_db_email"], FILTER_VALIDATE_EMAIL)) {
			$_SESSION["error_msg"] = _("Please enter valid email address.");
		}
	}

	// Check password length
	if (empty($_SESSION["error_msg"])) {
		if (!validate_password($_POST["v_password"])) {
			$_SESSION["error_msg"] = _("Password does not match the minimum requirements");
		}
	}

	// Protect input
	$v_database = quoteshellarg($_POST["v_database"]);
	$v_dbuser = quoteshellarg($_POST["v_dbuser"]);
	$v_type = $_POST["v_type"];
	$v_charset = $_POST["v_charset"];
	$v_host = $_POST["v_host"];
	$v_db_email = $_POST["v_db_email"];

	// Add database
	if (empty($_SESSION["error_msg"])) {
		$v_type = quoteshellarg($_POST["v_type"]);
		$v_charset = quoteshellarg($_POST["v_charset"]);
		$v_host = quoteshellarg($_POST["v_host"]);
		$v_password = tempnam("/tmp", "vst");
		$fp = fopen($v_password, "w");
		fwrite($fp, $_POST["v_password"] . "\n");
		fclose($fp);
		exec(
			HESTIA_CMD .
				"v-add-database " .
				$user .
				" " .
				$v_database .
				" " .
				$v_dbuser .
				" " .
				$v_password .
				" " .
				$v_type .
				" " .
				$v_host .
				" " .
				$v_charset,
			$output,
			$return_var,
		);
		check_return_code($return_var, $output);
		unset($output);
		unlink($v_password);
		$v_password = quoteshellarg($_POST["v_password"]);
		$v_type = $_POST["v_type"];
		$v_host = $_POST["v_host"];
		$v_charset = $_POST["v_charset"];
	}

	// Get database manager url
	if (empty($_SESSION["error_msg"])) {
		[$http_host, $port] = explode(":", $_SERVER["HTTP_HOST"] . ":");
		if ($_POST["v_host"] != "localhost") {
			$http_host = $_POST["v_host"];
		}
		if ($_POST["v_type"] == "mysql") {
			$db_admin = "phpMyAdmin";
		}
		if ($_POST["v_type"] == "mysql") {
			$db_admin_link = "http://" . $http_host . "/phpmyadmin/";
		}
		if ($_POST["v_type"] == "mysql" && !empty($_SESSION["DB_PMA_ALIAS"])) {
			$db_admin_link = "http://" . $http_host . "/" . $_SESSION["DB_PMA_ALIAS"];
		}
		if ($_POST["v_type"] == "pgsql") {
			$db_admin = "phpPgAdmin";
		}
		if ($_POST["v_type"] == "pgsql") {
			$db_admin_link = "http://" . $http_host . "/phppgadmin/";
		}
		if ($_POST["v_type"] == "pgsql" && !empty($_SESSION["DB_PGA_ALIAS"])) {
			$db_admin_link = "http://" . $http_host . "/" . $_SESSION["DB_PGA_ALIAS"];
		}
	}

	// Email login credentials
	if (!empty($v_db_email) && empty($_SESSION["error_msg"])) {
		$to = $v_db_email;
		$subject = _("Database Credentials");
		$hostname = get_hostname();
		$from = "noreply@" . $hostname;
		$from_name = _("Hestia Control Panel");
		$mailtext = sprintf(
			_("DATABASE_READY"),
			$user_plain . "_" . $_POST["v_database"],
			$user_plain . "_" . $_POST["v_dbuser"],
			$_POST["v_password"],
			$db_admin_link,
		);
		send_email($to, $subject, $mailtext, $from, $from_name);
	}

	// Flush field values on success
	if (empty($_SESSION["error_msg"])) {
		$_SESSION["ok_msg"] = sprintf(
			_("DATABASE_CREATED_OK"),
			htmlentities($user_plain) . "_" . htmlentities($_POST["v_database"]),
			htmlentities($user_plain) . "_" . htmlentities($_POST["v_database"]),
		);
		$_SESSION["ok_msg"] .=
			" / <a href=" .
			$db_admin_link .
			" target='_blank'>" .
			sprintf(_("open %s"), $db_admin) .
			"</a>";
		unset($v_database);
		unset($v_dbuser);
		unset($v_password);
		unset($v_type);
		unset($v_charset);
	}
}

// Get user email
$v_db_email = "";
if (empty($v_database)) {
	$v_database = "";
}
if (empty($v_dbuser)) {
	$v_dbuser = "";
}

// List avaiable database types
$db_types = explode(",", $_SESSION["DB_SYSTEM"]);

// List available database servers
exec(HESTIA_CMD . "v-list-database-hosts json", $output, $return_var);
$db_hosts_tmp1 = json_decode(implode("", $output), true);
$db_hosts_tmp2 = array_map(function ($host) {
	return $host["HOST"];
}, $db_hosts_tmp1);
$db_hosts = array_values(array_unique($db_hosts_tmp2));
unset($output);
unset($db_hosts_tmp1);
unset($db_hosts_tmp2);

render_page($user, $TAB, "add_db");

// Flush session messages
unset($_SESSION["error_msg"]);
unset($_SESSION["ok_msg"]);
