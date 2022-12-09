<!-- Begin toolbar -->
<div class="toolbar">
	<div class="toolbar-inner">
		<div class="toolbar-buttons">
			<a class="button button-secondary" id="btn-back" href="/list/mail/">
				<i class="fas fa-arrow-left status-icon blue"></i><?= _("Back") ?>
			</a>
		</div>
		<div class="toolbar-buttons">
			<button class="button" type="submit" form="vstobjects">
				<i class="fas fa-floppy-disk status-icon purple"></i><?= _("Save") ?>
			</button>
		</div>
	</div>
</div>
<!-- End toolbar -->

<div class="container animate__animated animate__fadeIn">

	<form
		x-data="{
			sslEnabled: <?= $v_ssl == 'yes' ? 'true' : 'false' ?>,
			letsEncryptEnabled: <?= $v_letsencrypt == 'yes' ? 'true' : 'false' ?>,
			hasSmtpRelay: <?= $v_smtp_relay == 'true' ? 'true' : 'false' ?>
		}"
		id="vstobjects"
		name="v_edit_mail"
		method="post"
		class="<?=$v_status?>"
	>
		<input type="hidden" name="token" value="<?=$_SESSION['token']?>">
		<input type="hidden" name="save" value="save">

		<div class="form-container">
			<h1 class="form-title"><?= _("Editing Mail Domain") ?></h1>
			<?php show_alert_message($_SESSION);?>
			<div class="u-mb20">
				<label for="v_domain" class="form-label"><?= _("Domain") ?></label>
				<input type="text" class="form-control" name="v_domain" id="v_domain" value="<?=htmlentities(trim($v_domain, "'"))?>" disabled>
				<input type="hidden" name="v_domain" value="<?=htmlentities(trim($v_domain, "'"))?>">
			</div>
			<?php if($_SESSION['WEBMAIL_SYSTEM']) {?>
				<div class="u-mb10">
					<label for="v_webmail" class="form-label"><?= _("Webmail Client") ?></label>
					<select class="form-select" name="v_webmail" id="v_webmail" tabindex="6">
						<?php foreach ($webmail_clients as $client){
							echo "\t\t\t\t<option value=\"".htmlentities($client)."\"";
							if (( htmlentities(trim($v_webmail,"'")) == $client )) {
								echo ' selected' ;
							}
							echo ">".htmlentities(ucfirst($client))."</option>\n";
							}
						?>
						<option value="disabled" <?php if (htmlentities(trim($v_webmail,"'")) == 'disabled') { echo "selected";}?>><?= _("Disabled") ?></option>
					</select>
				</div>
			<?php } ?>
			<div class="u-mb10">
				<label for="v_catchall" class="form-label"><?= _("Catchall email") ?></label>
				<input type="email" class="form-control" name="v_catchall" id="v_catchall" value="<?=htmlentities(trim($v_catchall, "'"))?>">
			</div>
			<div class="u-mb20">
				<label for="v_rate" class="form-label">
					<?= _("Rate limit") ?> <span class="optional">(<?= _("Email / hour / account") ?>)</span>
				</label>
				<input type="text" class="form-control" name="v_rate" id="v_rate" value="<?=htmlentities(trim($v_rate, "'"))?>" <?php if($_SESSION['userContext'] != "admin"){ echo "disabled";}?>>
			</div>
			<?php if (!empty($_SESSION['ANTISPAM_SYSTEM'])) {?>
				<div class="form-check u-mb10">
					<input class="form-check-input" type="checkbox" name="v_antispam" id="v_antispam" <?php if ($v_antispam == 'yes') echo 'checked'; ?>>
					<label for="v_antispam">
						<?= _("AntiSpam Support") ?>
					</label>
				</div>
				<div class="form-check u-mb10">
					<input class="form-check-input" type="checkbox" name="v_reject" id="v_reject" <?php if ($v_reject == 'yes') echo 'checked'; ?>>
					<label for="v_reject">
						<?= _("Reject spam") ?>
					</label>
				</div>
			<?php } ?>
			<?php if (!empty($_SESSION['ANTIVIRUS_SYSTEM'])) {?>
				<div class="form-check u-mb10">
					<input class="form-check-input" type="checkbox" name="v_antivirus" id="v_antivirus" <?php if ($v_antivirus == 'yes') echo 'checked'; ?>>
					<label for="v_antivirus">
						<?= _("AntiVirus Support") ?>
					</label>
				</div>
			<?php } ?>
			<div class="form-check u-mb10">
				<input class="form-check-input" type="checkbox" name="v_dkim" id="v_dkim" <?php if ($v_dkim == 'yes') echo 'checked'; ?>>
				<label for="v_dkim">
					<?= _("DKIM Support") ?>
				</label>
			</div>
			<div class="form-check u-mb10">
				<input x-model="sslEnabled" class="form-check-input" type="checkbox" name="v_ssl" id="v_ssl">
				<label for="v_ssl">
					<?= _("SSL Support") ?>
				</label>
			</div>
			<div x-cloak x-show="sslEnabled" id="ssltable" class="u-pl30">
				<div class="form-check u-mb10">
					<input x-model="letsEncryptEnabled" class="form-check-input" type="checkbox" name="v_letsencrypt" id="v_letsencrypt">
					<label for="v_letsencrypt">
						<?= _("Lets Encrypt Support") ?>
					</label>
				</div>
				<div id="le-warning" class="u-mb20">
					<div class="alert alert-info alert-with-icon" role="alert">
						<i class="fas fa-exclamation"></i>
						<p><?php echo $v_webmail_alias;?></p>
						<p><?=sprintf(_("To enable Let's Encrypt SSL, ensure that DNS records exist for mail.%s and %s!"), $v_domain, $v_webmail_alias); ?></p>
					</div>
				</div>
				<div x-cloak x-show="letsEncryptEnabled" id="ssl-details">
					<div class="u-mb10">
						<label for="v_ssl_crt" class="form-label">
							<?= _("SSL Certificate") ?>
							<span x-cloak x-show="!letsEncryptEnabled" id="generate-csr" > / <a class="generate" target="_blank" href="/generate/ssl/?domain=<?=htmlentities($v_domain)?>"><?= _("Generate CSR") ?></a></span>
						</label>
						<textarea x-bind:disabled="!letsEncryptEnabled" class="form-control u-min-height100 u-console" name="v_ssl_crt" id="v_ssl_crt"><?=htmlentities(trim($v_ssl_crt, "'"))?></textarea>
					</div>
					<div class="u-mb10">
						<label for="v_ssl_key" class="form-label"><?= _("SSL Key") ?></label>
						<textarea x-bind:disabled="!letsEncryptEnabled" class="form-control u-min-height100 u-console" name="v_ssl_key" id="v_ssl_key"><?=htmlentities(trim($v_ssl_key, "'"))?></textarea>
					</div>
					<div class="u-mb20">
						<label for="v_ssl_ca" class="form-label">
							<?= _("SSL Certificate Authority / Intermediate") ?> <span class="optional">(<?= _("optional") ?>)</span>
						</label>
						<textarea x-bind:disabled="!letsEncryptEnabled" class="form-control u-min-height100 u-console" name="v_ssl_ca" id="v_ssl_ca"><?=htmlentities(trim($v_ssl_ca, "'"))?></textarea>
					</div>
				</div>
				<?php if ($v_ssl != 'no') {?>
					<ul class="values-list">
						<li class="values-list-item">
							<span class="values-list-label"><?= _("SUBJECT") ?></span>
							<span class="values-list-value"><?=htmlentities($v_ssl_subject);?></span>
						</li>
						<?php if ($v_ssl_aliases) {?>
							<li class="values-list-item">
								<span class="values-list-label"><?= _("Aliases") ?></span>
								<span class="values-list-value"><?=htmlentities($v_ssl_aliases);?></span>
							</li>
						<?php } ?>
						<li class="values-list-item">
							<span class="values-list-label"><?= _("NOT_BEFORE") ?></span>
							<span class="values-list-value"><?=htmlentities($v_ssl_not_before)?></span>
						</li>
						<li class="values-list-item">
							<span class="values-list-label"><?= _("NOT_AFTER") ?></span>
							<span class="values-list-value"><?=htmlentities($v_ssl_not_after)?></span>
						</li>
						<li class="values-list-item">
							<span class="values-list-label"><?= _("SIGNATURE") ?></span>
							<span class="values-list-value"><?=htmlentities($v_ssl_signature)?></span>
						</li>
						<li class="values-list-item">
							<span class="values-list-label"><?= _("PUB_KEY") ?></span>
							<span class="values-list-value"><?=htmlentities($v_ssl_pub_key)?></span>
						</li>
						<li class="values-list-item">
							<span class="values-list-label"><?= _("ISSUER") ?></span>
							<span class="values-list-value"><?=htmlentities($v_ssl_issuer)?></span>
						</li>
					</ul>
				<?php } ?>
			</div>
			<div class="form-check u-mb10">
				<input x-model="hasSmtpRelay" class="form-check-input" type="checkbox" name="v_smtp_relay" id="v_smtp_relay">
				<label for="v_smtp_relay">
					<?= _("SMTP Relay") ?>
				</label>
			</div>
			<div x-cloak x-show="hasSmtpRelay" id="smtp_relay_table" class="u-pl30">
				<div class="u-mb10">
					<label for="v_smtp_relay_host" class="form-label"><?= _("Host") ?></label>
					<input type="text" class="form-control" name="v_smtp_relay_host" id="v_smtp_relay_host" value="<?= htmlentities(trim($v_smtp_relay_host, "'")) ?>">
				</div>
				<div class="u-mb10">
					<label for="v_smtp_relay_port" class="form-label"><?= _("Port") ?></label>
					<input type="text" class="form-control" name="v_smtp_relay_port" id="v_smtp_relay_port" value="<?= htmlentities(trim($v_smtp_relay_port, "'")) ?>">
				</div>
				<div class="u-mb10">
					<label for="v_smtp_relay_user" class="form-label"><?= _("Username") ?></label>
					<input type="text" class="form-control" name="v_smtp_relay_user" id="v_smtp_relay_user" value="<?= htmlentities(trim($v_smtp_relay_user, "'")) ?>">
				</div>
				<div class="u-mb10">
					<label for="v_smtp_relay_pass" class="form-label"><?= _("Password") ?></label>
					<input type="text" class="form-control" name="v_smtp_relay_pass" id="v_smtp_relay_pass">
				</div>
			</div>
		</div>

	</form>

</div>
