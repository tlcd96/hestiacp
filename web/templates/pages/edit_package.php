<!-- Begin toolbar -->
<div class="toolbar">
	<div class="toolbar-inner">
		<div class="toolbar-buttons">
			<a class="button button-secondary" id="btn-back" href="/list/package/">
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
			showWebOptions: false,
			showDnsOptions: false,
			showMailOptions: false,
			showDatabaseOptions: false,
			showSystemOptions: false,
		}"
		id="vstobjects"
		name="v_edit_package"
		method="post"
		class="<?= $v_status ?>"
	>
		<input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
		<input type="hidden" name="save" value="save">

		<div class="form-container">
			<h1 class="form-title"><?= _("Editing Package") ?></h1>
			<?php show_alert_message($_SESSION); ?>
			<div class="u-mb10">
				<label for="v_package_new" class="form-label"><?= _("Package Name") ?></label>
				<input type="text" class="form-control" name="v_package_new" id="v_package_new" value="<?= htmlentities(trim($v_package_new, "'")) ?>">
				<input type="hidden" name="v_package" value="<?= htmlentities(trim($v_package, "'")) ?>">
			</div>
			<div class="u-mb10">
				<label for="v_disk_quota" class="form-label">
					<?= _("Quota") ?> <span class="optional">(<?= _("in megabytes") ?>)</span>
				</label>
				<div class="u-pos-relative">
					<input type="text" class="form-control" name="v_disk_quota" id="v_disk_quota" value="<?= htmlentities(trim($v_disk_quota, "'")) ?>">
					<i class="unlim-trigger fas fa-infinity" title="<?= _("Unlimited") ?>"></i>
				</div>
			</div>
			<div class="u-mb10">
				<label for="v_bandwidth" class="form-label">
					<?= _("Bandwidth") ?> <span class="optional">(<?= _("in megabytes") ?>)</span>
				</label>
				<div class="u-pos-relative">
					<input type="text" class="form-control" name="v_bandwidth" id="v_bandwidth" value="<?= htmlentities(trim($v_bandwidth, "'")) ?>">
					<i class="unlim-trigger fas fa-infinity" title="<?= _("Unlimited") ?>"></i>
				</div>
			</div>
			<div class="u-mb10">
				<label for="v_backups" class="form-label"><?= _("Backups") ?></label>
				<input type="text" class="form-control" name="v_backups" id="v_backups" value="<?= htmlentities(trim($v_backups, "'")) ?>">
			</div>
			<h2 x-on:click="showWebOptions = !showWebOptions" class="section-title">
				<?= _("Web") ?>
				<i
					x-bind:class="showWebOptions ? 'fa-square-minus' : 'fa-square-plus'"
					class="fas status-icon dim maroon js-section-toggle-icon"
				></i>
			</h2>
			<div x-cloak x-show="showWebOptions" id="web-options">
				<div class="u-mt15 u-mb10">
					<label for="v_web_domains" class="form-label"><?= _("Web Domains") ?></label>
					<div class="u-pos-relative">
						<input type="text" class="form-control" name="v_web_domains" id="v_web_domains" value="<?=htmlentities(trim($v_web_domains, "'"))?>">
						<i class="unlim-trigger fas fa-infinity" title="<?= _("Unlimited") ?>"></i>
					</div>
				</div>
				<div class="u-mb10">
					<label for="v_web_aliases" class="form-label">
						<?= _("Web Aliases") ?> <span class="optional">(<?= _("per domain") ?>)</span>
					</label>
					<div class="u-pos-relative">
						<input type="text" class="form-control" name="v_web_aliases" id="v_web_aliases" value="<?=htmlentities(trim($v_web_aliases, "'"))?>">
						<i class="unlim-trigger fas fa-infinity" title="<?= _("Unlimited") ?>"></i>
					</div>
				</div>
				<div class="u-mb10">
					<label for="v_web_template" class="form-label">
						<?= _("Web Template") . " <span class='optional'> " .strtoupper($_SESSION['WEB_SYSTEM']) . "</span>";?>
					</label>
					<select class="form-select" name="v_web_template" id="v_web_template">
						<?php
							foreach ($web_templates as $key => $value) {
								echo "\t\t\t\t<option value=\"".htmlentities($value)."\"";
								if ((!empty($v_web_template)) && ( $value == trim($v_web_template, "'"))){
									echo ' selected' ;
								}
								echo ">".htmlentities($value)."</option>\n";
							}
						?>
					</select>
				</div>
				<?php if (!empty($_SESSION['WEB_BACKEND'])) { echo ""; ?>
					<div class="u-mb10">
						<label for="v_backend_template" class="form-label">
							<?= _("Backend Template") . "<span class='optional'>" .strtoupper($_SESSION['WEB_BACKEND']) . "</span>";?>
						</label>
						<select class="form-select" name="v_backend_template" id="v_backend_template">
							<?php
								foreach ($backend_templates as $key => $value) {
									echo "\t\t\t\t<option value=\"".$value."\"";
									if ((!empty($v_backend_template)) && ( $value == trim($v_backend_template, "'"))){
										echo ' selected' ;
									}
									echo ">".htmlentities($value)."</option>\n";
								}
							?>
						</select>
					</div>
				<?=""; }?>
				<?php if (!empty($_SESSION['PROXY_SYSTEM'])) { echo ""; ?>
					<div class="u-mb10">
						<label for="v_proxy_template" class="form-label">
							<?= _("Proxy Template") . "<span class='optional'>" .strtoupper($_SESSION['PROXY_SYSTEM']) . "</span>";?>
						</label>
						<select class="form-select" name="v_proxy_template" id="v_proxy_template">
							<?php
								foreach ($proxy_templates as $key => $value) {
									echo "\t\t\t\t<option value=\"".htmlentities($value)."\"";
									if ((!empty($v_proxy_template)) && ( $value == trim($v_proxy_template, "'"))){
										echo ' selected' ;
									}
									echo ">".htmlentities($value)."</option>\n";
								}
							?>
						</select>
					</div>
				<?=""; }?>
			</div>
			<h2 x-on:click="showDnsOptions = !showDnsOptions" class="section-title">
				<?= _("DNS") ?>
				<i
					x-bind:class="showDnsOptions ? 'fa-square-minus' : 'fa-square-plus'"
					class="fas status-icon dim maroon js-section-toggle-icon"
				></i>
			</h2>
			<div x-cloak x-show="showDnsOptions" id="dns-options">
				<div class="u-mt15 u-mb10">
					<label for="v_dns_template" class="form-label">
						<?= _("DNS Template") . "<span class='optional'>" .strtoupper($_SESSION['DNS_SYSTEM']) . "</span>";?>
					</label>
					<select class="form-select" name="v_dns_template" id="v_dns_template">
						<?php
							foreach ($dns_templates as $key => $value) {
								echo "\t\t\t\t<option value=\"".htmlentities($value)."\"";
								if ((!empty($v_dns_template)) && ( $value == $v_dns_template)){
									echo ' selected' ;
								}
								if ((!empty($v_dns_template)) && ( $value == trim($v_dns_template, "'"))){
									echo ' selected' ;
								}
								echo ">".htmlentities($value)."</option>\n";
							}
						?>
					</select>
				</div>
				<div class="u-mb10">
					<label for="v_dns_domains" class="form-label"><?= _("DNS domains") ?></label>
					<div class="u-pos-relative">
						<input type="text" class="form-control" name="v_dns_domains" id="v_dns_domains" value="<?=htmlentities(trim($v_dns_domains, "'"))?>">
						<i class="unlim-trigger fas fa-infinity" title="<?= _("Unlimited") ?>"></i>
					</div>
				</div>
				<div class="u-mb10">
					<label for="v_dns_records" class="form-label">
						<?= _("DNS records") ?> <span class="optional">(<?= _("per domain") ?>)</span>
					</label>
					<div class="u-pos-relative">
						<input type="text" class="form-control" name="v_dns_records" id="v_dns_records" value="<?=htmlentities(trim($v_dns_records, "'"))?>">
						<i class="unlim-trigger fas fa-infinity" title="<?= _("Unlimited") ?>"></i>
					</div>
				</div>
				<?php if ((isset($_SESSION['DNS_SYSTEM'])) && (!empty($_SESSION['DNS_SYSTEM']))) {?>
					<p class="form-label u-mb10"><?= _("Name servers") ?></p>
					<div class="u-mb5">
						<input type="text" class="form-control" name="v_ns1" value="<?=htmlentities(trim($v_ns1, "'"))?>">
					</div>
					<div class="u-mb5">
						<input type="text" class="form-control" name="v_ns2" value="<?=htmlentities(trim($v_ns2, "'"))?>">
					</div>
					<?php
						if($v_ns3) {
							echo '<div class="u-side-by-side u-mb5">
								<input type="text" class="form-control" name="v_ns3" value="'.htmlentities(trim($v_ns3, "'")).'">
								<span class="js-remove-ns u-ml10"><i class="fas fa-trash status-icon dim red"></i></span>
							</div>';
						}
						if($v_ns4) {
							echo '<div class="u-side-by-side u-mb5">
								<input type="text" class="form-control" name="v_ns4" value="'.htmlentities(trim($v_ns4, "'")).'">
								<span class="js-remove-ns u-ml10"><i class="fas fa-trash status-icon dim red"></i></span>
							</div>';
						}
						if($v_ns5) {
							echo '<div class="u-side-by-side u-mb5">
								<input type="text" class="form-control" name="v_ns5" value="'.htmlentities(trim($v_ns5, "'")).'">
								<span class="js-remove-ns u-ml10"><i class="fas fa-trash status-icon dim red"></i></span>
							</div>';
						}
						if($v_ns6) {
							echo '<div class="u-side-by-side u-mb5">
								<input type="text" class="form-control" name="v_ns6" value="'.htmlentities(trim($v_ns6, "'")).'">
								<span class="js-remove-ns u-ml10"><i class="fas fa-trash status-icon dim red"></i></span>
							</div>';
						}
						if($v_ns7) {
							echo '<div class="u-side-by-side u-mb5">
								<input type="text" class="form-control" name="v_ns7" value="'.htmlentities(trim($v_ns7, "'")).'">
								<span class="js-remove-ns u-ml10"><i class="fas fa-trash status-icon dim red"></i></span>
							</div>';
						}
						if($v_ns8) {
							echo '<div class="u-side-by-side u-mb5">
								<input type="text" class="form-control" name="v_ns8" value="'.htmlentities(trim($v_ns8, "'")).'">
								<span class="js-remove-ns u-ml10"><i class="fas fa-trash status-icon dim red"></i></span>
							</div>';
						}
					?>
					<div class="u-pt18 js-add-ns" <?php if ($v_ns8) echo 'style="display:none;"'; ?>>
						<span class="js-add-ns-button additional-control add"><?= _("Add one more Name Server") ?></span>
					</div>
				<?php } ?>
			</div>
			<h2 x-on:click="showMailOptions = !showMailOptions" class="section-title">
				<?= _("Mail") ?>
				<i
					x-bind:class="showMailOptions ? 'fa-square-minus' : 'fa-square-plus'"
					class="fas status-icon dim maroon js-section-toggle-icon"
				></i>
			</h2>
			<div x-cloak x-show="showMailOptions" id="mail-options">
				<div class="u-mt15 u-mb10">
					<label for="v_mail_domains" class="form-label"><?= _("Mail Domains") ?></label>
					<div class="u-pos-relative">
						<input type="text" class="form-control" name="v_mail_domains" id="v_mail_domains" value="<?= htmlentities(trim($v_mail_domains, "'")) ?>">
						<i class="unlim-trigger fas fa-infinity" title="<?= _("Unlimited") ?>"></i>
					</div>
				</div>
				<div class="u-mb10">
					<label for="v_mail_accounts" class="form-label">
						<?= _("Mail Accounts") ?> <span class="optional">(<?= _("per domain") ?>)</span>
					</label>
					<div class="u-pos-relative">
						<input type="text" class="form-control" name="v_mail_accounts" id="v_mail_accounts" value="<?= htmlentities(trim($v_mail_accounts, "'")) ?>">
						<i class="unlim-trigger fas fa-infinity" title="<?= _("Unlimited") ?>"></i>
					</div>
				</div>
				<div class="u-mb10">
					<label for="v_ratelimit" class="form-label">
						<?= _("Rate limit") ?> <span class="optional">(<?= _("per account / hour") ?>)</span>
					</label>
					<input type="text" class="form-control" name="v_ratelimit" id="v_ratelimit" value="<?= htmlentities(trim($v_ratelimit, "'")) ?>">
				</div>
			</div>
			<h2 x-on:click="showDatabaseOptions = !showDatabaseOptions" class="section-title">
				<?= _("Databases") ?>
				<i
					x-bind:class="showDatabaseOptions ? 'fa-square-minus' : 'fa-square-plus'"
					class="fas status-icon dim maroon js-section-toggle-icon"
				></i>
			</h2>
			<div x-cloak x-show="showDatabaseOptions" id="database-options">
				<div class="u-mt15 u-mb10">
					<label for="v_databases" class="form-label"><?= _("Databases") ?></label>
					<div class="u-pos-relative">
						<input type="text" class="form-control" name="v_databases" id="v_databases" value="<?= htmlentities(trim($v_databases, "'")) ?>">
						<i class="unlim-trigger fas fa-infinity" title="<?= _("Unlimited") ?>"></i>
					</div>
				</div>
			</div>
			<h2 x-on:click="showSystemOptions = !showSystemOptions" class="section-title">
				<?= _("System") ?>
				<i
					x-bind:class="showSystemOptions ? 'fa-square-minus' : 'fa-square-plus'"
					class="fas status-icon dim maroon js-section-toggle-icon"
				></i>
			</h2>
			<div x-cloak x-show="showSystemOptions" id="system-options">
				<div class="u-mt15 u-mb10">
					<label for="v_cron_jobs" class="form-label"><?= _("Cron Jobs") ?></label>
					<div class="u-pos-relative">
						<input type="text" class="form-control" name="v_cron_jobs" id="v_cron_jobs" value="<?=htmlentities(trim($v_cron_jobs, "'"))?>">
						<i class="unlim-trigger fas fa-infinity" title="<?= _("Unlimited") ?>"></i>
					</div>
				</div>
				<div class="u-mb10">
					<label for="v_shell" class="form-label"><?= _("SSH Access") ?></label>
					<select class="form-select" name="v_shell" id="v_shell">
						<?php
							foreach ($shells as $key => $value) {
								echo "\t\t\t\t<option value=\"".htmlentities($value)."\"";
								if ((!empty($v_shell)) && ( $value == trim($v_shell, "'"))){
									echo ' selected' ;
								}
								echo ">".htmlentities($value)."</option>\n";
							}
						?>
					</select>
				</div>
			</div>
		</div>

	</form>

</div>
