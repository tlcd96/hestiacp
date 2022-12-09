<!-- Begin toolbar -->
<div class="toolbar">
	<div class="toolbar-inner">
		<div class="toolbar-buttons">
			<a class="button button-secondary" id="btn-back" href="/list/user/">
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
			sendWelcomeMail: <?= $v_login_disabled == "yes" ? "true" : "false" ?>
		}"
		id="vstobjects"
		name="v_add_user"
		method="post"
	>
		<input type="hidden" name="token" value="<?=$_SESSION['token']?>">
		<input type="hidden" name="ok" value="Add">

		<div class="form-container">
			<h1 class="form-title"><?= _("Adding User") ?></h1>
			<?php show_alert_message($_SESSION);?>
			<div class="u-mb10">
				<label for="v_username" class="form-label"><?= _("Username") ?></label>
				<input type="text" class="form-control" name="v_username" id="v_username" value="<?=htmlentities(trim($v_username, "'"))?>" tabindex="1">
			</div>
			<div class="u-mb10">
				<label for="v_name" class="form-label"><?= _("Contact") ?></label>
				<input type="text" class="form-control" name="v_name" id="v_name" value="<?=htmlentities(trim($v_name, "'"))?>" tabindex="2">
			</div>
			<div class="u-mb10">
				<label for="v_email" class="form-label"><?= _("Email") ?></label>
				<input type="email" class="form-control" name="v_email" id="v_email" value="<?=htmlentities(trim($v_email, "'"))?>" tabindex="3">
			</div>
			<div class="u-mb10">
				<label for="v_password" class="form-label">
					<?= _("Password") ?>
					<a href="javascript:applyRandomString();" title="<?= _("generate") ?>" class="u-ml5"><i class="fas fa-arrows-rotate status-icon green icon-large"></i></a>
				</label>
				<div class="u-pos-relative u-mb10">
					<input type="text" class="form-control js-password-input" name="v_password" id="v_password" value="<?=htmlentities(trim($v_password, "'"))?>" tabindex="4">
					<meter max="4" class="password-meter"></meter>
				</div>
			</div>
			<p class="u-mb10"><?= _("Your password must have at least") ?>:</p>
			<ul class="u-list-bulleted u-mb10">
				<li><?= _("8 characters long") ?></li>
				<li><?= _("1 uppercase & 1 lowercase character") ?></li>
				<li><?= _("1 number") ?></li>
			</ul>
			<div class="form-check u-mb10">
				<input x-model="sendWelcomeMail" class="form-check-input" type="checkbox" name="v_login_disabled" id="v_login_disabled">
				<label for="v_login_disabled">
					<?= _("Do not allow user to log in to Control Panel") ?>
				</label>
			</div>
			<div x-cloak x-show="sendWelcomeMail" id="send-welcome">
				<div class="form-check u-mb10">
					<input class="form-check-input" type="checkbox" name="v_email_notice" id="v_email_notify" tabindex="5">
					<label for="v_email_notify">
						<?= _("Send welcome email") ?>
					</label>
				</div>
			</div>
			<div class="u-mb10">
				<label for="v_language" class="form-label"><?= _("Language") ?></label>
				<select class="form-select" name="v_language" id="v_language" tabindex="6">
					<?php
						foreach ($languages as $key => $value) {
							echo "\n\t\t\t\t\t\t\t\t\t<option value=\"".htmlentities($key)."\"";
							if (( $key == $_SESSION['LANGUAGE'] ) && (empty($v_language))){
								echo ' selected' ;
							}
							if (isset($v_language)){
								if ( htmlentities($key) == trim($v_language,"'") ){
									echo ' selected' ;
								}
							}
							echo ">".htmlentities($value)."</option>\n";
						}
					?>
				</select>
			</div>
			<div class="u-mb10">
				<label for="v_role" class="form-label"><?= _("Role") ?></label>
				<select class="form-select" name="v_role" id="v_role">
					<option value="user"><?= _("User") ?>
					<option value="admin" <?php if($v_role == "admin" ){ echo "selected"; } ?>><?= _("Administrator") ?>
					<option value="dns-cluster" <?php if($v_role == "dns-cluster" ){ echo "selected"; } ?>><?= _("DNS Sync user") ?>
				</select>
			</div>
			<div class="u-mb10">
				<label for="v_package" class="form-label"><?= _("Package") ?></label>
				<select class="form-select" name="v_package" id="v_package" tabindex="8">
					<?php
						foreach ($data as $key => $value) {
							echo "\n\t\t\t\t\t\t\t\t\t\t\t\t\t<option value=\"".htmlentities($key)."\"";
							if ((!empty($v_package)) && ( $key == $_POST['v_package'])){
								echo 'selected' ;
							} else {
								if ( $key == 'default'){
									echo 'selected' ;
								}
							}
							echo ">".htmlentities($key)."</option>\n";
						}
					?>
				</select>
			</div>
			<div class="u-mb10">
				<label for="v_notify" class="form-label">
					<?= _("Send login credentials to email address") ?>
				</label>
				<input type="email" class="form-control" name="v_notify" id="v_notify" value="<?=htmlentities(trim($v_notify, "'"))?>" tabindex="8">
			</div>
		</div>

	</form>

</div>
