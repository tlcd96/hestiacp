<?php
function Keyboard_Shortcut($num, $name, $keys) {
	$return =
		'<tr><td colspan="2"><br><br><br><a name="' .
		$num .
		'">' .
		$num .
		". " .
		$name .
		'</a><br><br></td>
		</tr>
';
	foreach ($keys as $key => $text) {
		$return .=
			'<tr>
				<td class=\'shortcut\'><span class="kbd">' .
			str_replace(
				["^", "#"],
				['Ctrl</span> + <span class="kbd">', 'Shift</span> + <span class="kbd">'],
				$key,
			) .
			'</span></td>
				<td>' .
			$text .
			'</td>
		</tr>
';
	}
	return $return;
} ?>
<style>
	table span.kbd {
		background: #fafafa none repeat scroll 0 0;
		border: 1px solid #aaa;
		border-radius: 4px;
		line-height: 1.8em;
		margin: 0;
		padding: 0 3px 1px;
		vertical-align: baseline;
		white-space: nowrap;
	}
	h2 {
		color: #ffcc00;
	}
	body {
		background: #777;
		font-family: Arial;
	}
</style>
<title>Hestia Keyboard Shortcuts</title>
<h2>Keyboard Shortcuts</h2>
<table cellspacing="3" width="500px">
<?= Keyboard_Shortcut(1, "Control Panel", [
	"↑" => "Move cursor up",
	"↓" => "Move cursor down",
	"1" => "List user accounts / USER",
	"2" => "List web domains / WEB",
	"3" => "List dns domains / DNS",
	"4" => "List mail domains / MAIL",
	"5" => "List databases / DB",
	"6" => "List cron jobs / CRON",
	"7" => "List user backups / BACKUP",
	"^1" => "List hosting packages / Packages",
	"^2" => "List IP addresses / IP",
	"^3" => "List rrd graphs / Grapsh",
	"^4" => "List user stats / Statistics",
	"^5" => "List user action log / Log",
	"^6" => "List software updates / Updates",
	"^7" => "List firewall rules / Firewall",
	"^8" => "List services / Server",
	"^9" => "List server status / CPU MEM NET DISK",
	"^0" => "List user files / File Manager",
	"f" => "Find user objects / Focus on search bar",
	"h" => "Show help / Help",
	"n" => "Add new object",
	"e" => "Edit selected object",
	"s" => "Suspend selected object",
	"d" => "Delete selected object",
	"^a" => "Select/deselect all objects",
	"#↑" => "Select/deselect object above cursor",
	"#↓" => "Select/deselect object below cursor",
	"^Enter" => "Save form",
	"^Backspace" => "Go back to previous listing",
]) .
	Keyboard_Shortcut(2, "File Manager", [
		"Tab" => "Switch between left and right file list",
		"←" => "Switch between left and right file list",
		"→" => "Switch between left and right file list",
		"↑" => "Move cursor up",
		"↓" => "Move cursor down",
		"Insert" => "Select file or directory",
		"Space" => "Select file or directory (as INSERT)",
		"#↑" => " Select/deselect file above cursor",
		"#↓" => "Select/deselect file below cursor",
		"Enter" => "Change directory / run association action",
		"^a" => "Select all files and directories",
		"^c" => "Copy selected files from active tab to inactive",
		"^x" => "Cut selected files to clipboard",
		"^v" => "Paste from clipboard to current dir",
		"^m" => "Move selected files from active tab to inactive",
		"^d" => "Delete selected files",
		"Del" => "Delete selected files",
		"n" => "Create new file",
		"e" => "Edit selected file",
		"r" => "Rename selected file",
		"m" => "Move selected file",
		"d" => "Delete selected file",
		"g" => "Download selected file",
		"f" => "Search file",
	]) .
	Keyboard_Shortcut(3, "File Editor", [
		"^s" => "Save file",
		"^n" => "New file",
		"^o" => "Open file",
	]) ?>
</table>
