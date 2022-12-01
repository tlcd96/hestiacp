<link rel="alternate icon" href="/images/favicon.png" type="image/png">
<link rel="icon" href="/images/logo.svg" type="image/svg+xml">
<link rel="stylesheet" href="/css/themes/default.min.css?<?=JS_LATEST_UPDATE?>">
<?php
		$selected_theme = (!empty($_SESSION['userTheme'])) ? $_SESSION['userTheme'] : $_SESSION['THEME'];
// Load custom theme
		if ($selected_theme !== 'default') {
// Load HestiaCP-shipped themes (minified, updated/overwritten with updates) - ($HESTIA/web/css/themes/*.min.css)
				if (file_exists($_SERVER['HESTIA'] . '/web/css/themes/' . $selected_theme . '.min.css')) {
?>
<link rel="stylesheet" href="/css/themes/<?=$selected_theme?>.min.css?<?=JS_LATEST_UPDATE?>">
<?php
				}
// Load custom theme files ($HESTIA/web/css/themes/custom/*.css)
				elseif (file_exists($_SERVER['HESTIA'] . '/web/css/themes/custom/' . $selected_theme . '.min.css')) {
?>
<link rel="stylesheet" href="/css/themes/custom/<?=$selected_theme?>.min.css?<?=JS_LATEST_UPDATE?>">
<?php
				}else{
				?>
<link rel="stylesheet" href="/css/themes/custom/<?=$selected_theme?>.css?<?=JS_LATEST_UPDATE?>>">
				<?php
				}
		}
?>
