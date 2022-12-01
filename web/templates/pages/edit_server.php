<!-- Begin toolbar -->
<div class="toolbar">
	<div class="toolbar-inner">
		<div class="toolbar-buttons">
			<a class="button button-secondary" id="btn-back" href="/list/server/"><i class="fas fa-arrow-left status-icon blue"></i><?=_('Back');?></a>
			<a href="/list/ip/" class="button button-secondary"><i class="fas fa-ethernet status-icon blue"></i><?=_('IP');?></a>
			<?php if ((isset($_SESSION['FIREWALL_SYSTEM'])) && (!empty($_SESSION['FIREWALL_SYSTEM']))) {?>
				<a href="/list/firewall/" class="button button-secondary"><i class="fas fa-shield-halved status-icon red"></i><?=_('Firewall');?></a>
			<?php }?>
		</div>
		<div class="toolbar-buttons">
			<a href="#" class="button" data-action="submit" data-id="vstobjects"><i class="fas fa-floppy-disk status-icon purple"></i><?=_('Save');?></a>
		</div>
	</div>
</div>
<!-- End toolbar -->

<div class="l-center animate__animated animate__fadeIn">

	<form id="vstobjects" name="v_configure_server" method="post">
		<input type="hidden" name="token" value="<?=$_SESSION['token']?>">
		<input type="hidden" name="save" value="save">

		<div class="form-container">
			<h1 class="form-title"><?=_('Configuring Server');?></h1>
			<?php show_alert_message($_SESSION);?>

			<!-- Basic options tab -->
			<details class="collapse u-mb10">
				<summary class="collapse-header">
					<i class="fas fa-gear u-mr15"></i><?=_('Basic options');?>
				</summary>
				<div class="collapse-content">
					<div class="u-mb10">
						<label for="v_hostname" class="form-label"><?=_('Hostname');?></label>
						<input type="text" class="form-control" name="v_hostname" id="v_hostname" value="<?=htmlentities(trim($v_hostname, "'"))?>">
					</div>
					<div class="u-mb10">
						<label for="v_timezone" class="form-label"><?=_('Time Zone');?></label>
						<select class="form-select" name="v_timezone" id="v_timezone">
							<?php
								foreach ($v_timezones as $key => $value) {
									echo "\t\t\t\t<option value=\"".$value."\"";
									if ((!empty($v_timezone)) && ( $value == $v_timezone)){
										echo ' selected' ;
									}
									echo ">".$value."</option>\n";
								}
							?>
						</select>
					</div>
					<div class="u-mb10">
						<label for="v_theme" class="form-label"><?=_('Theme');?></label>
						<select class="form-select" name="v_theme" id="v_theme">
							<?php
								foreach ($theme as $key => $value) {
									echo "\t\t\t\t<option value=\"".$value."\"";
									if (($value == $_SESSION['THEME'])){
										echo ' selected' ;
									}
									echo ">".$value."</option>\n";
								}
							?>
						</select>
					</div>
					<div class="form-check u-mb20">
						<input class="form-check-input" type="checkbox" name="v_policy_user_change_theme" id="v_policy_user_change_theme" <?php if ((isset($_SESSION['POLICY_USER_CHANGE_THEME'])) && (!empty($_SESSION['POLICY_USER_CHANGE_THEME'])) && ($_SESSION['POLICY_USER_CHANGE_THEME'] == "no")) echo 'checked' ?>>
						<label for="v_policy_user_change_theme">
							<?=_('Set as selected theme for all users');?>
						</label>
					</div>
					<div class="u-mb10">
						<label for="v_language" class="form-label"><?=_('Default Language');?></label>
						<select class="form-select" name="v_language" id="v_language">
							<?php
								foreach ($languages as $key => $value) {
									echo "\n\t\t\t\t\t\t\t\t\t<option value=\"".$key."\"";
									if (( $key == $_SESSION['LANGUAGE'] && (empty($v_language)) )) {
										echo 'selected' ;
									}
									echo ">".htmlentities($value)."</option>\n";
								}
							?>
						</select>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="v_language_update" id="v_language_update">
						<label for="v_language_update">
							<?=_('Set as default language for all users');?>
						</label>
					</div>
				</div>
			</details>

			<!-- Updates tab -->
			<details class="collapse u-mb10">
				<summary class="collapse-header">
					<i class="fas fa-code-branch u-mr15"></i><?=_('Updates');?>
				</summary>
				<div class="collapse-content">
					<p class="u-mb10">
						<?=_('Version');?>: <span class="optional"><?=$_SESSION['VERSION'];?></span>
					</p>
					<?php if ($_SESSION['RELEASE_BRANCH'] !== 'release') {?>
						<p><?=_('Release');?>: <span class="optional"><?=$_SESSION['RELEASE_BRANCH'];?></span></p>
					<?php } ?>
					<p class="u-mb5"><?=_('Options');?></p>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="v_debug_mode" id="v_debug_mode" <?php if ((isset($_SESSION['DEBUG_MODE'])) && (!empty($_SESSION['DEBUG_MODE'])) && ($_SESSION['DEBUG_MODE'] == "true")) echo 'checked' ?>>
						<label for="v_debug_mode">
							<?=_('Enable debug mode');?>
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="v_experimental_features" id="v_experimental_features" <?php if ((isset($_SESSION['POLICY_SYSTEM_ENABLE_BACON'])) && (!empty($_SESSION['POLICY_SYSTEM_ENABLE_BACON'])) && ($_SESSION['POLICY_SYSTEM_ENABLE_BACON'] == "true")) echo 'checked' ?>>
						<label for="v_experimental_features">
							<?=_('Enable preview features');?>
						</label>
						<span class="hint">(<a href="/list/server/preview/"><?=_('View');?></a>)</span>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="v_upgrade_send_notification_email" id="v_upgrade_send_notification_email" <?php if ((isset($_SESSION['UPGRADE_SEND_EMAIL'])) && (!empty($_SESSION['UPGRADE_SEND_EMAIL'])) && ($_SESSION['UPGRADE_SEND_EMAIL'] == "true")) echo 'checked' ?>>
						<label for="v_upgrade_send_notification_email">
							<?=_('SYSTEM_UPGRADE_SEND_NOTIFICATION_EMAIL');?>
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="v_upgrade_send_email_log" id="v_upgrade_send_email_log" <?php if ((isset($_SESSION['UPGRADE_SEND_EMAIL_LOG'])) && (!empty($_SESSION['UPGRADE_SEND_EMAIL_LOG'])) && ($_SESSION['UPGRADE_SEND_EMAIL_LOG'] == "true")) echo 'checked' ?>>
						<label for="v_upgrade_send_email_log">
							<?=_('SYSTEM_UPGRADE_SEND_EMAIL_LOG');?>
						</label>
					</div>
				</div>
			</details>

			<!-- Web Server tab -->
			<details class="collapse u-mb10">
				<summary class="collapse-header">
					<i class="fas fa-earth-americas u-mr15"></i><?=_('Web Server');?>
				</summary>
				<div class="collapse-content">
					<?php if (!empty($_SESSION['PROXY_SYSTEM'])) { ?>
						<p>
							<?=_('Proxy Server');?>: <span class="optional"><?=$_SESSION['PROXY_SYSTEM']; ?> <a href="/edit/server/<? echo $_SESSION['PROXY_SYSTEM'] ?>/"><i class="fas fa-pencil status-icon orange icon-pad-right"></i></a></span>
						</p>
					<?php } ?>
					<?php if (!empty($_SESSION['WEB_SYSTEM'])) { ?>
						<p>
							<?=_('Web Server');?>: <span class="optional"><?=$_SESSION['WEB_SYSTEM']; ?> <a href="/edit/server/<? echo $_SESSION['WEB_SYSTEM'] ?>/"><i class="fas fa-pencil status-icon orange icon-pad-right"></i></a></span>
						</p>
					<?php } ?>
					<?php if (!empty($_SESSION['WEB_BACKEND'])) { ?>
						<p>
							<?=_('Backend Server');?>: <span class="optional"><?=$_SESSION['WEB_BACKEND']; ?> <a href="/edit/server/<? echo $_SESSION['WEB_BACKEND'] ?>/"><i class="fas fa-pencil status-icon orange icon-pad-right"></i></a></span>
						</p>
					<?php } ?>
					<?php if (!empty($_SESSION['WEB_BACKEND_POOL'])) { ?>
						<p>
							<?=_('Backend Pool Mode');?>: <span class="optional"><?=$_SESSION['WEB_BACKEND_POOL']; ?></span>
						</p>
					<?php } ?>
					<?php if(count($v_php_versions)): ?>
						<div class="u-mt15">
							<p class="u-mb10"><?=_('Enabled multi PHP versions');?></p>
							<div class="alert alert-info alert-with-icon u-mb10" role="alert">
								<i class="fas fa-info"></i>
								<p><?=_('Please wait while php is installed or removed');?></p>
							</div>
						</div>
						<?php foreach($v_php_versions as $php_version): ?>
							<div class="form-check">
								<input class="form-check-input" type="checkbox"
									<?=$php_version->installed?'checked':''; ?>
									<?=$php_version->protected?'disabled':''; ?>
									id="<?=$php_version->name?>"
									name="v_php_versions[<?=$php_version->tpl?>]">
								<label for="<?=$php_version->name?>">
									<?=$php_version->name?>
								</label>
							</div>
							<?php foreach($php_version->usedby as $wd_user => $wd_domains ): ?>
								<?php foreach($wd_domains as $wd_domain ): ?>
									<p class="u-side-by-side" style="border: 1px lightgrey; padding:0 10px;">
										<span>
											<i class="fas fa-user"></i>
											<?=$wd_user;?>
										</span>
										<span class="optional"><?=$wd_domain;?></span>
									</p>
								<?php endforeach; ?>
							<?php endforeach; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<?php if(!empty($_SESSION['WEB_BACKEND'])){ ?>
						<div class="u-mt10">
							<label for="v_php_default_version" class="form-label"><?=_('System PHP version');?></label>
							<select class="form-select" name="v_php_default_version" id="v_php_default_version">
								<?php
									foreach ($v_php_versions as $php_version) {
									if ($php_version -> installed) {
								?>
								<option value="<?=$php_version->version; ?>" <?php if($php_version->name == DEFAULT_PHP_VERSION){ echo "selected" ;}?> ><?=$php_version->name; ?></option>
								<?php
								}
								}
								?>
							</select>
						</div>
					<?php } ?>
				</div>
			</details>

			<!-- DNS Server tab -->
			<?php if (!empty($_SESSION['DNS_SYSTEM'])) { ?>
				<details class="collapse u-mb10">
					<summary class="collapse-header">
						<i class="fas fa-book-atlas u-mr15"></i><?=_('DNS Server');?>
					</summary>
					<div class="collapse-content">
						<p>
							<?=_('DNS Server');?>: <span class="optional"><?=$_SESSION['DNS_SYSTEM']; ?> <a href="/edit/server/<? echo $_SESSION['DNS_SYSTEM'] ?>/"><i class="fas fa-pencil status-icon orange icon-pad-right"></i></a></span>
						</p>
						<p>
							<?=_('DNS Cluster');?>: <span class="optional"><?php if ($v_dns_cluster == 'yes') { echo _('Yes'); } else { echo _('No'); } ?></span>
						</p>
						<?php if ($v_dns_cluster == 'yes') {
							$i = 0;
							foreach ($dns_cluster as $key => $value) {
								$i++;
							?>
							<div>
								<label for="v_dns_remote_host" class="form-label"><?=_('Host'). ' #'.$i ?></label>
								<input type="text" class="form-control" name="v_dns_remote_host" id="v_dns_remote_host" value="<?=$key; ?>" disabled>
							</div>
						<?php } } ?>
					</div>
				</details>
			<?php } ?>

			<!-- Mail Server tab -->
			<?php if ((!empty($_SESSION['MAIL_SYSTEM']))) { ?>
				<details class="collapse u-mb10">
					<summary class="collapse-header">
						<i class="fas fa-envelopes-bulk u-mr15"></i><?=_('Mail Server');?>
					</summary>
					<div class="collapse-content">
						<p>
							<?=_('Mail Server');?>: <span class="optional"><?=$_SESSION['MAIL_SYSTEM']; ?> <a href="/edit/server/<? echo $_SESSION['MAIL_SYSTEM'] ?>/"><i class="fas fa-pencil status-icon orange icon-pad-right"></i></a></span>
						</p>
						<?php if (!empty($_SESSION['ANTIVIRUS_SYSTEM'])) { ?>
							<p>
								<?=_('Antivirus');?>: <span class="optional"><?=$_SESSION['ANTIVIRUS_SYSTEM']; ?> <a href="/edit/server/<? echo $_SESSION['ANTIVIRUS_SYSTEM'] ?>/"><i class="fas fa-pencil status-icon orange icon-pad-right"></i></a></span>
							</p>
						<?php } ?>
						<?php if (!empty($_SESSION['ANTISPAM_SYSTEM'])) { ?>
							<p>
								<?=_('AntiSpam');?>: <span class="optional"><?=$_SESSION['ANTISPAM_SYSTEM']; ?> <a href="/edit/server/<? echo $_SESSION['ANTISPAM_SYSTEM'] ?>/"><i class="fas fa-pencil status-icon orange icon-pad-right"></i></a></span>
							</p>
						<?php } ?>
						<?php if($_SESSION['WEBMAIL_SYSTEM']){?>
							<div class="u-mt15 u-mb10">
								<label for="v_webmail_alias" class="form-label">
									<?=_('Webmail URL');?> <span class="hint">(<?=$_SESSION['WEBMAIL_ALIAS'];?>.example.com)</span>
								</label>
								<input type="text" class="form-control" name="v_webmail_alias" id="v_webmail_alias" value="<?=$_SESSION['WEBMAIL_ALIAS']; ?>">
							</div>
						<?php } ?>
						<div class="form-check u-mt20">
							<input class="form-check-input" type="checkbox" name="v_smtp_relay" id="v_smtp_relay" <?php if ($v_smtp_relay == 'true') echo 'checked'; ?> onclick="javascript:elementHideShow('smtp_relay_table');">
							<label for="v_smtp_relay">
								<?=_('Global SMTP Relay');?>
							</label>
						</div>
						<div id="smtp_relay_table" class="u-pl30 u-mt20" style="display:<?php if ($v_smtp_relay == 'true') {echo 'block';} else {echo 'none';}?> ;">
							<div class="u-mb10">
								<label for="v_smtp_relay_host" class="form-label"><?=_('Host');?></label>
								<input type="text" class="form-control" name="v_smtp_relay_host" id="v_smtp_relay_host" value="<?=htmlentities(trim($v_smtp_relay_host, "'"))?>">
							</div>
							<div class="u-mb10">
								<label for="v_smtp_relay_port" class="form-label"><?=_('Port');?></label>
								<input type="text" class="form-control" name="v_smtp_relay_port" id="v_smtp_relay_port" value="<?=htmlentities(trim($v_smtp_relay_port, "'"))?>">
							</div>
							<div class="u-mb10">
								<label for="v_smtp_relay_user" class="form-label"><?=_('Username');?></label>
								<input type="text" class="form-control" name="v_smtp_relay_user" id="v_smtp_relay_user" value="<?=htmlentities(trim($v_smtp_relay_user, "'"))?>">
							</div>
							<div class="u-mb10">
								<label for="v_smtp_relay_pass" class="form-label"><?=_('Password');?></label>
								<div class="u-pos-relative">
									<input type="text" class="form-control js-password-input" name="v_smtp_relay_pass" id="v_smtp_relay_pass">
								</div>
							</div>
						</div>
					</div>
				</details>
			<?php } ?>

			<!-- Databases tab -->
			<?php if (!empty($_SESSION['DB_SYSTEM'])) { ?>
				<details class="collapse u-mb10">
					<summary class="collapse-header">
						<i class="fas fa-database u-mr15"></i><?=_('Databases');?>
					</summary>
					<div class="collapse-content">
						<div class="u-mb10">
							<label for="v_mysql" class="form-label">
								<?=_('MySQL Support');?> <a href="/edit/server/mysql/"><i class="fas fa-pencil status-icon orange icon-pad-right"></i></a>
							</label>
							<select class="form-select" name="v_mysql" id="v_mysql" disabled>
								<option value="no"><?=_('No');?></option>
								<option value="yes" <?php if($v_mysql == 'yes') echo 'selected' ?>><?=_('Yes');?></option>
							</select>
						</div>
						<!-- MySQL / MariaDB Options-->
						<?php if ($v_mysql == 'yes') { ?>
							<div class="u-mb20">
								<label for="v_mysql_url" class="form-label"><?=_('phpMyAdmin URL');?></label>
								<input type="text" class="form-control" name="v_mysql_url" id="v_mysql_url" value="<?=$_SESSION['DB_PMA_ALIAS']; ?>">
							</div>
							<div class="u-mb10">
								<label for="v_phpmyadmin_key" class="form-label">
									<?=_('phpMyAdmin Single Sign On');?><span class="hint">(<a href="https://docs.hestiacp.com/admin_docs/database/phpmyadmin-sso.html" target="_blank"><?=_('More info');?></a>)</span>
								</label>
								<select class="form-select" name="v_phpmyadmin_key" id="v_phpmyadmin_key" <?php if ($_SESSION['API'] != 'yes'){ echo "disabled"; }?>>
									<option value="no"><?=_('Disabled');?></option>
									<option value='yes' <?php if($_SESSION['PHPMYADMIN_KEY'] != ''){ echo 'selected="selected"'; }; ?>><?=_('Enabled');?></option>
								</select>
							</div>
						<?php } ?>
						<?php if ($v_mysql == 'yes') {
							$i = 0;
							foreach ($v_mysql_hosts as $value) {
								$i++;
							?>
							<div class="u-pl30">
								<div class="u-mb10">
									<label for="v_mysql_host" class="form-label"><?=_('Host'). ' #'.$i ?></label>
									<input type="text" class="form-control" name="v_mysql_host" id="v_mysql_host" value="<?=$value['HOST']?>" disabled>
								</div>
								<div class="u-mb10">
									<label for="v_mysql_password" class="form-label"><?=_('Password');?></label>
									<div class="u-pos-relative">
										<input type="text" class="form-control js-password-input" name="v_mysql_password" id="v_mysql_password">
									</div>
								</div>
								<div class="u-mb10">
									<label for="v_mysql_max" class="form-label">
										<?=_('Maximum Number Of Databases');?>
									</label>
									<input type="text" class="form-control" name="v_mysql_max" id="v_mysql_max" value="<?=$value['MAX_DB']; ?>" disabled>
								</div>
								<div class="u-mb10">
									<label for="v_mysql_current" class="form-label">
										<?=_('Current Number Of Databases');?>
									</label>
									<input type="text" class="form-control" name="v_mysql_current" id="v_mysql_current" value="<?=$value['U_DB_BASES']; ?>" disabled>
								</div>
							</div>
						<?php }} ?>
						<!-- PostgreSQL Options-->
						<?php if ($v_pgsql == 'yes') { ?>
							<div class="u-mb10">
								<label for="v_pgsql" class="form-label">
									<?=_('PostgreSQL Support');?> <a href="/edit/server/postgresql/"><i class="fas fa-pencil status-icon orange icon-pad-right"></i></a>
								</label>
								<select class="form-select" name="v_pgsql" id="v_pgsql" disabled>
									<option value="no"><?=_('No');?></option>
									<option value='yes' <?php if($v_pgsql == 'yes') echo 'selected' ?>><?=_('Yes');?></option>
								</select>
							</div>
							<div class="u-mb20">
								<label for="v_pgsql_url" class="form-label">
									<?=_('phpPgAdmin URL');?>
								</label>
								<input type="text" class="form-control" name="v_pgsql_url" id="v_pgsql_url" value="<?=$_SESSION['DB_PGA_ALIAS']; ?>">
							</div>
						<?php } ?>
						<?php if ($v_pgsql == 'yes') {
							$i = 0;
							foreach ($v_pgsql_hosts as $value) {
								$i++;
							?>
							<div class="u-pl30">
								<div class="u-mb10">
									<label for="v_pgsql_host" class="form-label"><?=_('Host'). ' #'.$i ?></label>
									<input type="text" class="form-control" name="v_pgsql_host" id="v_pgsql_host" value="<?=$value['HOST']?>" disabled>
								</div>
								<div class="u-mb10">
									<label for="v_psql_max" class="form-label">
										<?=_('Maximum Number Of Databases');?>
									</label>
									<input type="text" class="form-control" name="v_psql_max" id="v_psql_max" value="<?=$value['MAX_DB']; ?>" disabled>
								</div>
								<div class="u-mb10">
									<label for="v_pgsql_max" class="form-label">
										<?=_('Current Number Of Databases');?>
									</label>
									<input type="text" class="form-control" name="v_pgsql_max" id="v_pgsql_max" value="<?=$value['U_DB_BASES']; ?>" disabled>
								</div>
							</div>
						<?php }} ?>
					</div>
				</details>
			<?php } ?>

			<!-- Backups tab -->
			<details class="collapse u-mb10">
				<summary class="collapse-header">
					<i class="fas fa-arrow-rotate-left u-mr15"></i><?=_('Backups');?>
				</summary>
				<div class="collapse-content">
					<div class="u-mb10">
						<label for="v_backup" class="form-label"><?=_('Local backup');?></label>
						<select class="form-select" name="v_backup" id="v_backup">
							<option value="no"><?=_('No');?></option>
							<option value="yes" <?php if($v_backup == 'yes') echo 'selected' ?>><?=_('Yes');?></option>
						</select>
					</div>
					<div class="u-mb10">
						<label for="v_backup_mode" class="form-label">
							<?=_('Compression');?> <a target="_blank" href="http://docs.hestiacp.com/admin_docs/backups.html#what-is-the-difference-between-zstd-and-gzip"><i class="fas fa-circle-question"></i></a>
						</label>
						<select class="form-select" name="v_backup_mode" id="v_backup_mode">
							<option value="gzip" <?php if($v_backup_mode != 'zstd') echo 'selected' ?>>gzip</option>
							<option value="zstd" <?php if($v_backup_mode == 'zstd') echo 'selected' ?>>zstd</option>
						</select>
					</div>
					<div class="u-mb10">
						<label for="v_backup_gzip" class="form-label">
							<?=_('Compression level');?> <a target="_blank" href="http://docs.hestiacp.com/admin_docs/backups.html#what-is-the-optimal-compression-ratio"><i class="fas fa-circle-question"></i></a>
						</label>
						<select class="form-select" name="v_backup_gzip" id="v_backup_gzip">
							<?php for ($level = 1; $level < 20; $level++) { ?>
								<option value='<?=$level;?>' <?php if($v_backup_gzip == $level) echo 'selected' ?>><?=$level;?><?php if($level > 9){ echo sprintf(' (%s)', _('zstd only')); } ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="u-mb20">
						<label for="v_backup_dir" class="form-label">
							<?=_('Directory');?> <a target="_blank" href="https://docs.hestiacp.com/admin_docs/backups.html#how-to-change-default-backup-folder"><i class="fas fa-circle-question"></i></a>
						</label>
						<input type="text" class="form-control" name="v_backup_dir" id="v_backup_dir" value="<?=trim($v_backup_dir, "'")?>" disabled="disabled">
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="v_backup_remote_adv" id="v_backup_remote_adv" <?php if (!empty($v_backup_remote_adv)) echo 'checked' ?> onclick="javascript:elementHideShow('remote_backup');">
						<label for="v_backup_remote_adv">
							<?=_('Remote backup');?>
						</label>
					</div>
					<div id="remote_backup" class="u-pl30 u-mt20" style="display:<?php if (empty($v_backup_remote_adv)) echo 'none';?> ;">
						<div class="u-mb10">
							<label for="backup_type" class="form-label">
								<?=_('Protocol');?> <a target="_blank" href="http://docs.hestiacp.com/admin_docs/backups.html#what-kind-of-protocols-are-currently-supported"><i class="fas fa-circle-question"></i></a>
							</label>
							<select class="form-select" name="v_backup_type" id="backup_type">
								<option value='ftp'><?=_('ftp');?></option>
								<option value='sftp' <?php if((!empty($v_backup_type)) && (trim($v_backup_type,"'")	== 'sftp' )) echo 'selected="selected"'; ?>><?=_('sftp');?></option>
								<option value="b2" <?php if((!empty($v_backup_type)) && (trim($v_backup_type,"'")	== 'b2' )) echo 'selected="selected"'; ?>><?=_('Backblaze');?>
								<option value="rclone" <?php if((!empty($v_backup_type)) && (trim($v_backup_type,"'")	== 'rclone' )) echo 'selected="selected"'; ?>><?=_('Rclone');?>
							</select>
						</div>
						<div id="backup_sftp" style="display: <?php if ((!empty($v_backup_type)) && !in_array(trim($v_backup_type, "'"),array('ftp','sftp'))){ echo 'none';} else {echo 'block';} ?>">
							<div class="u-mb10">
								<label for="v_backup_host" class="form-label"><?=_('Host');?></label>
								<input type="text" class="form-control" name="v_backup_host" id="v_backup_host" value="<?=trim($v_backup_host, "'")?>">
							</div>
							<div class="u-mb20">
								<label for="v_backup_port" class="form-label"><?=_('Port');?></label>
								<input type="text" class="form-control" name="v_backup_port" id="v_backup_port" value="<?=trim($v_backup_port, "'")?>">
							</div>
							<div class="u-mb10">
								<label for="v_backup_username" class="form-label"><?=_('Username');?></label>
								<input type="text" class="form-control" name="v_backup_username" id="v_backup_username" value="<?=trim($v_backup_username, "'")?>">
							</div>
							<div class="u-mb20">
								<label for="v_backup_password" class="form-label"><?=_('Password');?></label>
								<div class="u-pos-relative">
									<input type="text" class="form-control js-password-input" name="v_backup_password" id="v_backup_password" value="<?=trim($v_backup_password, "'")?>">
								</div>
							</div>
							<div class="u-mb10">
								<label for="v_backup_bpath" class="form-label"><?=_('Directory');?></label>
								<input type="text" class="form-control" name="v_backup_bpath" id="v_backup_bpath" value="<?=trim($v_backup_bpath, "'")?>">
							</div>
						</div>
						<div id="backup_bucket" style="display: <?php if ((empty($v_backup_type)) || !in_array(trim($v_backup_type, "'"),array('b2'))){ echo 'none';} else {echo 'block';} ?>">
							<div class="u-mb10">
								<label for="v_backup_bucket" class="form-label"><?=_('Bucket');?></label>
								<input type="text" class="form-control" name="v_backup_bucket" id="v_backup_bucket" value="<?=trim($v_backup_bucket, "'")?>">
							</div>
							<div class="u-mb10">
								<label for="v_backup_application_id" class="form-label"><?=_('Key ID');?></label>
								<input type="text" class="form-control" name="v_backup_application_id" id="v_backup_application_id" value="<?=trim($v_backup_application_id, "'")?>">
							</div>
							<div class="u-mb10">
								<label for="v_backup_application_key" class="form-label"><?=_('Application Key');?></label>
								<input type="text" class="form-control" name="v_backup_application_key" id="v_backup_application_key" value="<?=trim($v_backup_application_key, "'")?>">
							</div>
						</div>
						<div id="backup_rclone" style="display: <?php if ((empty($v_backup_type)) || !in_array(trim($v_backup_type, "'"),array('rclone'))){ echo 'none';} else {echo 'block';} ?>">
							<div class="u-mb10">
								<label for="v_rclone_host" class="form-label"><?=_('Host');?></label>
								<input type="text" class="form-control" name="v_rclone_host" id="v_rclone_host" value="<?=trim($v_rclone_host, "'")?>">
							</div>
							<div class="u-mb10">
								<label for="v_rclone_path" class="form-label"><?=_('Directory');?></label>
								<input type="text" class="form-control" name="v_rclone_path" id="v_rclone_path" value="<?=trim($v_rclone_path, "'")?>">
							</div>
						</div>
					</div>
				</div>
			</details>

			<!-- SSL tab -->
			<details class="collapse u-mb10">
				<summary class="collapse-header">
					<i class="fas fa-lock u-mr15"></i><?=_('SSL');?>
				</summary>
				<div class="collapse-content">
					<div class="u-mb20">
						<label for="v_ssl_crt" class="form-label">
							<?=_('SSL Certificate');?>
							<span id="generate-csr"> / <a class="generate" target="_blank" href="/generate/ssl/?domain=<?=htmlentities(trim($v_hostname,'"'));?>"><?=_('Generate CSR');?></a></span>
						</label>
						<textarea class="form-control u-min-height100 u-console" name="v_ssl_crt" id="v_ssl_crt"><?=htmlentities(trim($v_ssl_crt, "'"))?></textarea>
					</div>
					<div class="u-mb20">
						<label for="v_ssl_key" class="form-label"><?=_('SSL Key');?></label>
						<textarea class="form-control u-min-height100 u-console" name="v_ssl_key" id="v_ssl_key"><?=htmlentities(trim($v_ssl_key, "'"))?></textarea>
					</div>
					<table class="additional-info">
						<tr>
							<td>
								<b><?=_('SUBJECT');?>:</b>
							</td>
							<td class="details">
								<?=$v_ssl_subject?>
							</td>
						</tr>
						<?php if ($v_ssl_aliases){?>
							<tr>
								<td>
									<b><?=_('Aliases');?>:</b>
								</td>
								<td class="details">
									<?=$v_ssl_aliases?>
								</td>
							</tr>
						<?php } ?>
						<tr>
							<td>
								<b><?=_('NOT_BEFORE');?>:</b>
							</td>
							<td class="details">
								<?=$v_ssl_not_before?>
							</td>
						</tr>
						<tr>
							<td>
								<b><?=_('NOT_AFTER');?>:</b>
							</td>
							<td class="details">
								<?=$v_ssl_not_after?>
							</td>
						</tr>
						<tr>
							<td>
								<b><?=_('SIGNATURE');?>:</b>
							</td>
							<td class="details">
								<?=$v_ssl_signature?>
							</td>
						</tr>
						<tr>
							<td>
								<b><?=_('PUB_KEY');?>:</b>
							</td>
							<td class="details">
								<?=$v_ssl_pub_key?>
							</td>
						</tr>
						<tr>
							<td>
								<b><?=_('ISSUER');?>:</b>
							</td>
							<td class="details">
								<?=$v_ssl_issuer?>
							</td>
						</tr>
					</table>
				</div>
			</details>

			<!-- Security tab -->
			<details class="collapse u-mb10">
				<summary class="collapse-header">
					<i class="fas fa-key u-mr15"></i><?=_('Security');?>
				</summary>
				<div class="collapse-content">
					<h3 class="section-title" onclick="javascript:elementHideShow('security-system-table',this);">
						<?=_('System');?>
						<i class="fas fa-square-plus status-icon dim maroon js-section-toggle-icon"></i>
					</h3>
					<div id="security-system-table" style="display: none;">
						<p class="u-pt18" style="font-size:1rem;padding-bottom:12px;">
							<?=_('API');?>
						</p>
						<div class="u-mb10">
							<label for="api-system" class="form-label"><?=_('Enable API access');?></label>
							<select class="form-select" name="v_api_system" id="api-system">
								<option value='0' <?php if(empty($_SESSION['API_SYSTEM']) || $_SESSION['API_SYSTEM'] == '0') echo 'selected' ?>><?=_('Disabled');?></option>
								<option value='1' <?php if($_SESSION['API_SYSTEM'] == '1') echo 'selected' ?>><?=_('Enabled for admin');?></option>
								<option value='2' <?php if($_SESSION['API_SYSTEM'] == '2') echo 'selected' ?>><?=_('Enabled for all users');?></option>
							</select>
						</div>
						<div class="u-mb10">
							<label for="api" class="form-label"><?=_('Enable legacy API access');?></label>
							<select class="form-select" name="v_api" id="api">
								<option value="yes"><?=_('Yes');?></option>
								<option value="no" <?php if($_SESSION['API'] == 'no') echo 'selected' ?>><?=_('No');?></option>
							</select>
						</div>
						<div id="security_ip" style="<?php if ($_SESSION['API'] == "no" && $_SESSION['API_SYSTEM'] == '0') echo 'display:none;';?>">
							<div class="u-mb10">
								<label for="v_api_allowed_ip" class="form-label u-side-by-side">
									<?=_('Allowed IP addresses for API');?> <span class="optional">1 IP address per line</span>
								</label>
								<textarea class="form-control" name="v_api_allowed_ip" id="v_api_allowed_ip"><?php
										foreach(explode(',',$_SESSION['API_ALLOWED_IP']) as $ip ){
											echo trim($ip)."\n";
										}
									?></textarea>
							</div>
						</div>
						<p class="u-pt18" style="font-size:1rem;padding-bottom:12px;">
							<?=_('Login');?>
						</p>
						<div class="u-mb10">
							<label for="v_login_style" class="form-label"><?=_('Login screen style');?></label>
							<select class="form-select" name="v_login_style" id="v_login_style">
								<option value="default"><?=_('Default');?></option>
								<option value="old" <?php if($_SESSION['LOGIN_STYLE'] == 'old') echo 'selected' ?>><?=_('Old Style');?></option>
							</select>
						</div>
						<div class="u-mb10">
							<label for="v_policy_system_password_reset" class="form-label"><?=_('Allow users to reset their passwords');?></label>
							<select class="form-select" name="v_policy_system_password_reset" id="v_policy_system_password_reset">
								<option value="yes"><?=_('Yes');?></option>
								<option value="no" <?php if($_SESSION['POLICY_SYSTEM_PASSWORD_RESET'] == 'no') echo 'selected' ?>><?=_('No');?></option>
							</select>
						</div>
						<div class="u-mb20">
							<label for="v_inactive_session_timeout" class="form-label">
								<?=_('Inactive session timeout');?> (<?=_('Minutes');?>)
							</label>
							<input type="text" class="form-control" name="v_inactive_session_timeout" id="v_inactive_session_timeout" value="<?=trim($_SESSION['INACTIVE_SESSION_TIMEOUT'], "'")?>">
						</div>
						<div class="u-mb10">
							<label for="v_policy_csrf_strictness" class="form-label"><?=_('Prevent CSRF');?></label>
							<select class="form-select" name="v_policy_csrf_strictness" id="v_policy_csrf_strictness">
								<option value="0"	<?php if($_SESSION['POLICY_CSRF_STRICTNESS'] == '0') echo 'selected' ?>><?=_('Disabled');?></option>
								<option value="1"	<?php if($_SESSION['POLICY_CSRF_STRICTNESS'] == '1') echo 'selected' ?>><?=_('Enabled');?></option>
								<option value="2"	<?php if($_SESSION['POLICY_CSRF_STRICTNESS'] == '2') echo 'selected' ?>><?=_('Strict');?></option>
							</select>
						</div>
					</div>
					<?php if (($_SESSION['userContext'] === "admin") && ($_SESSION['user'] === 'admin')) {?>
						<h3 class="section-title" onclick="javascript:elementHideShow('security-sysadminprotect-table',this);">
							<?=_('System Protection');?>
							<i class="fas fa-square-plus status-icon dim maroon js-section-toggle-icon"></i>
						</h3>
						<div id="security-sysadminprotect-table" style="display: none;">
							<p class="u-pt18" style="font-size:1rem;padding-bottom:12px;">
								<?=_('System Administrator account');?>
							</p>
							<div class="u-mb10">
								<label for="v_policy_system_protected_admin" class="form-label"><?=_('Restrict access to read-only for other administrators');?></label>
								<select class="form-select" name="v_policy_system_protected_admin" id="v_policy_system_protected_admin">
									<option value="yes"><?=_('Yes');?></option>
									<option value="no" <?php if($_SESSION['POLICY_SYSTEM_PROTECTED_ADMIN'] !== 'yes') echo 'selected' ?>><?=_('No');?></option>
								</select>
							</div>
							<div class="u-mb10">
								<label for="v_policy_system_hide_admin" class="form-label"><?=_('Hide account from other administrators');?></label>
								<select class="form-select" name="v_policy_system_hide_admin" id="v_policy_system_hide_admin">
									<option value="yes"><?=_('Yes');?></option>
									<option value="no" <?php if($_SESSION['POLICY_SYSTEM_HIDE_ADMIN'] !== 'yes') echo 'selected' ?>><?=_('No');?></option>
								</select>
							</div>
							<div class="u-mb10">
								<label for="v_policy_system_hide_services" class="form-label"><?=_('Do not allow other administrators to access Server Settings');?></label>
								<select class="form-select" name="v_policy_system_hide_services" id="v_policy_system_hide_services">
									<option value="yes"><?=_('Yes');?></option>
									<option value="no" <?php if($_SESSION['POLICY_SYSTEM_HIDE_SERVICES'] !== 'yes') echo 'selected' ?>><?=_('No');?></option>
								</select>
							</div>
						</div>
					<?php } ?>
					<h3 class="section-title" onclick="javascript:elementHideShow('security-policies-table',this);">
						<?=_('Policies');?>
						<i class="fas fa-square-plus status-icon dim maroon js-section-toggle-icon"></i>
					</h3>
					<div id="security-policies-table" style="display: none;">
						<p class="u-pt18" style="font-size:1rem;padding-bottom:12px;">
							<?=_('Users');?>
						</p>
						<?php if ($_SESSION['POLICY_SYSTEM_ENABLE_BACON'] === 'true') { ?>
							<div class="u-mb10">
								<label for="v_policy_user_view_suspended" class="form-label">
									<?=_('Allow suspended users to log in with read-only access');?> <span class="hint">(<?=_('Preview');?>)</span>
								</label>
								<select class="form-select" name="v_policy_user_view_suspended" id="v_policy_user_view_suspended">
									<option value="yes" <?php if($_SESSION['POLICY_USER_VIEW_SUSPENDED'] !== 'no') echo 'selected' ?>><?=_('Yes');?></option>
									<option value="no" <?php if($_SESSION['POLICY_USER_VIEW_SUSPENDED'] == 'no') echo 'selected' ?>><?=_('No');?></option>
								</select>
							</div>
						<?php } ?>
						<div class="u-mb10">
							<label for="v_policy_user_edit_details" class="form-label"><?=_('Allow users to edit their account details');?></label>
							<select class="form-select" name="v_policy_user_edit_details" id="v_policy_user_edit_details">
								<option value="yes" <?php if($_SESSION['POLICY_USER_EDIT_DETAILS'] !== 'no') echo 'selected' ?>><?=_('Yes');?></option>
								<option value="no" <?php if($_SESSION['POLICY_USER_EDIT_DETAILS'] == 'no') echo 'selected' ?>><?=_('No');?></option>
							</select>
						</div>
						<div class="u-mb10">
							<label for="v_policy_user_edit_web_templates" class="form-label"><?=_('Allow users to change templates when editing web domains');?></label>
							<select class="form-select" name="v_policy_user_edit_web_templates" id="v_policy_user_edit_web_templates">
								<option value="yes" <?php if($_SESSION['POLICY_USER_EDIT_WEB_TEMPLATES'] !== 'no') echo 'selected' ?>><?=_('Yes');?></option>
								<option value="no" <?php if($_SESSION['POLICY_USER_EDIT_WEB_TEMPLATES'] == 'no') echo 'selected' ?>><?=_('No');?></option>
							</select>
						</div>
						<div class="u-mb10">
							<label for="v_policy_user_edit_dns_templates" class="form-label"><?=_('Allow users to change templates when editing DNS zones');?></label>
							<select class="form-select" name="v_policy_user_edit_dns_templates" id="v_policy_user_edit_dns_templates">
								<option value="yes" <?php if($_SESSION['POLICY_USER_EDIT_DNS_TEMPLATES'] !== 'no') echo 'selected' ?>><?=_('Yes');?></option>
								<option value="no" <?php if($_SESSION['POLICY_USER_EDIT_DNS_TEMPLATES'] == 'no') echo 'selected' ?>><?=_('No');?></option>
							</select>
						</div>
						<div class="u-mb10">
							<label for="v_policy_user_view_logs" class="form-label"><?=_('Allow users to view action and login history logs');?></label>
							<select class="form-select" name="v_policy_user_view_logs" id="v_policy_user_view_logs">
								<option value="yes" <?php if($_SESSION['POLICY_USER_VIEW_LOGS'] !== 'no') echo 'selected' ?>><?=_('Yes');?></option>
								<option value="no" <?php if($_SESSION['POLICY_USER_VIEW_LOGS'] == 'no') echo 'selected' ?>><?=_('No');?></option>
							</select>
						</div>
						<div class="u-mb10">
							<label for="v_policy_user_delete_logs" class="form-label"><?=_('Allow users to delete log history');?></label>
							<select class="form-select" name="v_policy_user_delete_logs" id="v_policy_user_delete_logs">
								<option value="yes" <?php if($_SESSION['POLICY_USER_DELETE_LOGS'] !== 'no') echo 'selected' ?>><?=_('Yes');?></option>
								<option value="no" <?php if($_SESSION['POLICY_USER_DELETE_LOGS'] == 'no') echo 'selected' ?>><?=_('No');?></option>
							</select>
						</div>
						<p class="u-pt18" style="font-size:1rem;padding-bottom:12px;">
							<?=_('Domains');?>
						</p>
						<div class="u-mb10">
							<label for="v_enforce_subdomain_ownership" class="form-label"><?=_('Enforce subdomain ownership');?></label>
							<select class="form-select" name="v_enforce_subdomain_ownership" id="v_enforce_subdomain_ownership">
								<option value="yes"><?=_('Yes');?></option>
								<option value="no" <?php if($_SESSION['ENFORCE_SUBDOMAIN_OWNERSHIP'] == 'no') echo 'selected' ?>><?=_('No');?></option>
							</select>
						</div>
					</div>
				</div>
			</details>

			<!-- Plugins tab -->
			<details class="collapse u-mb10">
				<summary class="collapse-header">
					<i class="fas fa-puzzle-piece u-mr15"></i><?=_('Hestia Control Panel Plugins');?>
				</summary>
				<div class="collapse-content">
					<div class="u-mb10">
						<label for="v_plugin_app_installer" class="form-label"><?=_('Quick App Installer');?></label>
						<select class="form-select" name="v_plugin_app_installer" id="v_plugin_app_installer">
							<option value="false"><?=_('No');?></option>
							<option value="true" <?php if($_SESSION['PLUGIN_APP_INSTALLER'] == 'true') echo 'selected' ?>><?=_('Yes');?></option>
						</select>
					</div>
					<div class="u-mb10">
						<label for="v_filemanager" class="form-label"><?=_('Filemanager');?></label>
						<select class="form-select" name="v_filemanager" id="v_filemanager">
							<option value="false"><?=_('No');?></option>
							<option value="true" <?php if($_SESSION['FILE_MANAGER'] == 'true') echo 'selected' ?>><?=_('Yes');?></option>
						</select>
					</div>
					<div class="u-mb10">
						<label for="v_quota" class="form-label"><?=_('FileSystem Disk Quota');?></label>
						<select class="form-select" name="v_quota" id="v_quota">
							<option value="no"><?=_('No');?></option>
							<option value="yes" <?php if($_SESSION['DISK_QUOTA'] == 'yes') echo 'selected' ?>><?=_('Yes');?></option>
						</select>
					</div>
					<div class="u-mb10">
						<label for="v_firewall" class="form-label"><?=_('Firewall');?></label>
						<select class="form-select" name="v_firewall" id="v_firewall">
							<option value="no"><?=_('No');?></option>
							<option value="yes" <?php if($_SESSION['FIREWALL_SYSTEM'] == 'iptables') echo 'selected' ?>><?=_('Yes');?></option>
						</select>
					</div>
				</div>
			</details>

		</div>

	</form>

</div>
