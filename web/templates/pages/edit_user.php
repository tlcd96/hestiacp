<!-- Begin toolbar -->
<div class="toolbar">
	<div class="toolbar-inner">
		<div class="toolbar-buttons">
			<a class="button button-secondary" id="btn-back" href="/list/user/"><i class="fas fa-arrow-left status-icon blue"></i><?=_('Back');?></a>
			<?php
				if (($_SESSION['userContext'] === 'admin') && (!isset($_SESSION['look'])) && ($_SESSION['user'] !== $v_username)) {
					$ssh_key_url = "/list/key/?user=".htmlentities($user_plain)."&token=".$_SESSION['token']."";
					$log_url = "/list/log/?user=".htmlentities($user_plain)."&token=".$_SESSION['token']."";
					$keys_url = "/list/access-key/?user=".htmlentities($user_plain)."&token=".$_SESSION['token']."";
				} else {
					$ssh_key_url = "/list/key/";
					$log_url = "/list/log/";
					$keys_url = "/list/access-key/";
				}
			?>
			<a href="<?=$ssh_key_url; ?>" class="button button-secondary" id="btn-create" title="<?=_('Manage SSH keys');?>"><i class="fas fa-key status-icon orange"></i><?=_('Manage SSH keys');?></a>
			<?php if (($_SESSION['userContext'] == 'admin') || ($_SESSION['userContext'] !== 'admin') && ($_SESSION['POLICY_USER_VIEW_LOGS'] !== 'no')) {?>
				<a href="<?=$log_url; ?>" class="button button-secondary" id="btn-create" title="<?=_('Logs');?>"><i class="fas fa-clock-rotate-left status-icon maroon"></i><?=_('Logs');?></a>
			<?php } ?>
			<?php
				$api_status = (!empty($_SESSION['API_SYSTEM']) && is_numeric($_SESSION['API_SYSTEM'])) ? $_SESSION['API_SYSTEM'] : 0;
				if (($user_plain == 'admin' && $api_status > 0) || ($user_plain != 'admin' && $api_status > 1)) { ?>
				<a href="<?=$keys_url; ?>" class="button button-secondary" id="btn-create" title="<?=_('Access Keys');?>"><i class="fas fa-key status-icon purple"></i><?=_('Access Keys');?></a>
			<?php } ?>
		</div>
		<div class="toolbar-buttons">
			<?php if (($_SESSION['user'] == $v_username) || (isset($_SESSION['look']))) {?>
				<!-- Do not show delete button for currently logged in user-->
			<?} else {?>
				<a href="/login/?loginas=<?=htmlentities($v_username)?>&token=<?=$_SESSION['token']?>" class="button button-secondary" id="btn-create" title="<?=_('login as');?>"><i class="fas fa-right-to-bracket status-icon maroon"></i><?=_('login as');?></a>
				<a class="data-controls do_delete button button-secondary button-danger">
					<i class="do_delete fas fa-circle-xmark status-icon red"></i>
					<?=_('Delete');?>
					<input type="hidden" name="delete_url" value="/delete/user/?user=<?=htmlentities($v_username)?>&token=<?=$_SESSION['token']?>">
					<div class="dialog js-confirm-dialog-delete" title="<?=_('Confirmation');?>">
						<p><?=sprintf(_('DELETE_USER_CONFIRMATION'),htmlentities($v_username))?></p>
					</div>
				</a>
			<?php } ?>
			<a href="#" class="button" data-action="submit" data-id="vstobjects"><i class="fas fa-floppy-disk status-icon purple"></i> <?=_('Save');?></a>
		</div>
	</div>
</div>
<!-- End toolbar -->

<div class="l-center animate__animated animate__fadeIn">

	<form id="vstobjects" method="post" name="v_edit_user" class="<?=$v_status?>">
		<input type="hidden" name="token" value="<?=$_SESSION['token']?>">
		<input type="hidden" name="save" value="save">

		<div class="form-container">
			<h1 class="form-title"><?=_('Editing User');?></h1>
			<?php show_alert_message($_SESSION);?>
			<div class="u-mb10">
				<label for="v_user" class="form-label"><?=_('Username');?></label>
				<input type="text" class="form-control" name="v_user" id="v_user" value="<?=htmlentities(trim($v_username, "'"))?>" disabled>
				<input type="hidden" name="v_username" value="<?=htmlentities(trim($v_username, "'"))?>">
			</div>
			<div class="u-mb10">
				<label for="v_name" class="form-label"><?=_('Contact');?></label>
				<input type="text" class="form-control" name="v_name" id="v_name" value="<?=htmlentities(trim($v_name, "'"))?>" <?php if (($_SESSION['userContext'] !=='admin' ) && ($_SESSION['POLICY_USER_EDIT_DETAILS'] !=='yes' )) { echo 'disabled' ; }?> >
				<?php if (($_SESSION['userContext'] !== 'admin') && ($_SESSION['POLICY_USER_EDIT_DETAILS'] !== 'yes')) {?>
					<input type="hidden" name="v_name" value="<?=htmlentities(trim($v_name, "'"))?>">
				<?php } ?>
			</div>
			<div class="u-mb10">
				<label for="v_email" class="form-label"><?=_('Email');?></label>
				<input type="email" class="form-control" name="v_email" id="v_email" value="<?=htmlentities(trim($v_email, "'"))?>" <?php if (($_SESSION['userContext'] !=='admin' ) && ($_SESSION['POLICY_USER_EDIT_DETAILS'] !=='yes' )) { echo 'disabled' ; }?>>
				<?php if (($_SESSION['userContext'] !== 'admin') && ($_SESSION['POLICY_USER_EDIT_DETAILS'] !== 'yes')) {?>
					<input type="hidden" name="v_email" value="<?=htmlentities(trim($v_email, "'"))?>">
				<?php } ?>
			</div>
			<div class="u-mb10">
				<label for="v_password" class="form-label">
					<?=_('Password');?>
					<a href="javascript:applyRandomString();" title="<?=_('generate');?>" class="u-ml5"><i class="fas fa-arrows-rotate status-icon green icon-large"></i></a>
				</label>
				<div class="u-pos-relative u-mb10">
					<input type="text" class="form-control js-password-input" name="v_password" id="v_password" value="<?=htmlentities(trim($v_password, "'"))?>">
					<meter max="4" class="password-meter"></meter>
				</div>
			</div>
			<div id="password-details" class="u-mb20">
				<p class="u-mb10"><?=_('Your password must have at least');?>:</p>
				<ul class="u-list-bulleted u-mb10">
					<li><?=_('8 characters long');?></li>
					<li><?=_('1 uppercase & 1 lowercase character');?></li>
					<li><?=_('1 number');?></li>
				</ul>
				<?php if ($_SESSION['userContext'] === 'admin') {?>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="v_login_disabled" id="v_login_disabled" onclick="javascript:elementHideShow('password-options');elementHideShow('password-options-ip');" <?php if ($v_login_disabled === "yes") echo 'checked' ?>>
						<label for="v_login_disabled">
							<?=_('Do not allow user to log in to Control Panel');?>
						</label>
					</div>
				<?php } ?>
				<div id="password-options" style="<?php if ($v_login_disabled === 'yes') { echo 'display: none;'; } else { echo 'display: block;'; }?>">
					<div class="form-check u-mt15">
						<input class="form-check-input" type="checkbox" name="v_twofa" id="v_twofa" <?php if(!empty($v_twofa)) echo 'checked' ?>>
						<label for="v_twofa">
							<?=_('Enable 2FA');?>
						</label>
					</div>
					<?php if (!empty($v_twofa)) { ?>
						<p class="u-mb10"><?=_('2FA Reset Code:').' '.$v_twofa; ?></p>
						<p class="u-mb10"><?=_('Please scan the code below in your 2FA application:');?></p>
						<div><img class="qr-code" src="<?=htmlentities($v_qrcode); ?>" alt=""></div>
					<?php } ?>
				</div>
				<div id="password-options-ip" style="<?php if ($v_login_disabled === 'yes') { echo 'display: none;'; } else { echo 'display: block;'; }?>">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="v_login_use_iplist" id="v_login_use_iplist" onclick="javascript:elementHideShow('ip-allowlist')" <?php if ($v_login_use_iplist === "yes") echo 'checked' ?>>
						<label for="v_login_use_iplist">
							<?=_('Use IP address allow list for login attempts');?>
						</label>
					</div>
				</div>
				<div id="ip-allowlist" class="u-mt10" style="<?php if ($v_login_use_iplist === 'yes') { echo 'display: block;'; } else { echo 'display: none;'; } ?>">
					<input type="text" class="form-control" name="v_login_allowed_ips" value="<?=htmlentities(trim($v_login_allowed_ips, "'"))?>" placeholder="<?=_('Example: 127.0.0.1,192.168.1.100');?>">
				</div>
			</div>
			<div class="u-mb10">
				<label for="v_language" class="form-label"><?=_('Language');?></label>
				<select class="form-select" name="v_language" id="v_language">
					<?php
						foreach ($languages as $key => $value) {
							echo "\n\t\t\t\t\t\t\t\t\t<option value=\"".$key."\"";
							$skey = "'".$key."'";
							if (( $key == $v_language ) || ( $skey == $v_language)){
								echo 'selected' ;
							}
							if (( $key == detect_user_language() ) && (empty($v_language))){
								echo 'selected' ;
							}
							echo ">".htmlentities($value)."</option>\n";
						}
					?>
				</select>
			</div>
			<?php if ($v_username == 'admin') {?>
				<!-- Hide option to change 'admin' user's role-->
			<?php } else { ?>
				<?php if (($_SESSION['userContext'] === 'admin') && ($_SESSION['user'] != $v_username)) {?>
					<div class="u-mb10">
						<label for="v_role" class="form-label"><?=_('Role');?></label>
						<select class="form-select" name="v_role" id="v_role">
							<option value="user"><?=_('User');?>
							<option value="admin" <?php if($v_role == "admin" ){ echo "selected"; } ?>><?=_('Administrator');?>
							<option value="dns-cluster" <?php if($v_role == "dns-cluster" ){ echo "selected"; } ?>><?=_('DNS Sync user');?>
						</select>
					</div>
				<?php } ?>
			<?php } ?>
			<?php if ($_SESSION['POLICY_USER_CHANGE_THEME'] !== 'no') {?>
			<div class="u-mb10">
				<label for="v_user_theme" class="form-label"><?=_('Theme') ?></label>
				<select class="form-select" name="v_user_theme" id="v_user_theme">
					<?php
						foreach ($themes as $key => $value) {
							echo "\t\t\t\t<option value=\"".$value."\"";
							if ((!empty($_SESSION['userTheme'])) && ( $value == $v_user_theme )) {
								echo ' selected' ;
							}
							if ((empty($v_user_theme) && (!empty($_SESSION['THEME']))) && ( $value == $_SESSION['THEME'] )) {
								echo ' selected' ;
							}
							echo ">".$value."</option>\n";
						}
					?>
				</select>
			</div>
			<?php } ?>
				<div class="u-mb10">
					<label for="v_sort_order" class="form-label"><?=_('Default list sort order');?></label>
					<select class="form-select" name="v_sort_order" id="v_sort_order">
						<option value='date' <?php if($v_sort_order === 'date') echo 'selected' ?>><?=_('Date');?></option>
						<option value='name' <?php if($v_sort_order === 'name') echo 'selected' ?>><?=_('Name');?></option>
					</select>
				</div>
			<?php if ($_SESSION['userContext'] === 'admin') {?>
				<div class="u-mb20">
					<label for="v_package" class="form-label"><?=_('Package');?></label>
					<select class="form-select" name="v_package" id="v_package">
						<?php
							foreach ($packages as $key => $value) {
								echo "\n\t\t\t\t\t\t\t\t\t<option value=\"".htmlentities($key)."\"";
								$skey = "'".$key."'";
								if (( $key == $v_package ) || ( $skey == $v_package)){
									echo 'selected' ;
								}
								echo ">".htmlentities($key)."</option>\n";
							}
						?>
					</select>
				</div>
				<div class="u-mb20">
					<a href="javascript:elementHideShow('advanced-opts');" class="button button-secondary"><?=_('Advanced options');?></a>
				</div>
				<div id="advanced-opts" style="display: none;">
					<div class="u-mb10">
						<label for="v_shell" class="form-label"><?=_('SSH Access');?></label>
						<select class="form-select" name="v_shell" id="v_shell">
							<?php
								foreach ($shells as $key => $value) {
									echo "\t\t\t\t<option value=\"".htmlentities($value)."\"";
									$svalue = "'".$value."'";
									if (( $value == $v_shell ) || ($svalue == $v_shell )){
										echo 'selected' ;
									}
									echo ">".htmlentities($value)."</option>\n";
								}
							?>
						</select>
					</div>
					<div class="u-mb10">
						<label for="v_phpcli" class="form-label"><?=_('PHP CLI Version');?></label>
						<select class="form-select" name="v_phpcli" id="v_phpcli">
							<?php
								foreach ($php_versions as $key => $value) {
									$php = explode('-',$value);
									echo "\t\t\t\t<option value=\"".$value."\"";
									$svalue = "'".$value."'";
									if ((!empty($v_phpcli)) && ( $value == $v_phpcli ) || ($svalue == $v_phpcli)){
										echo ' selected' ;
									}
									if ((empty($v_phpcli)) && ($value == DEFAULT_PHP_VERSION)){
										echo ' selected' ;
									}
									echo ">".htmlentities($value)."</option>\n";
								}
							?>
						</select>
					</div>
					<?php if ((isset($_SESSION['DNS_SYSTEM'])) && (!empty($_SESSION['DNS_SYSTEM']))) {?>
						<p class="form-label u-mb10"><?=_('Default Name Servers');?></p>
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
							<span class="js-add-ns-button additional-control add"><?=_('Add one more Name Server');?></span>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>

	</form>

</div>
