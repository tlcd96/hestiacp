<!-- Begin toolbar -->
<div class="toolbar">
	<div class="toolbar-inner">
		<div class="toolbar-buttons">
			<a class="button button-secondary" id="btn-back" href="/list/backup/exclusions/">
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

	<form id="vstobjects" name="v_edit_backup_exclusions" method="post" class="<?= _($v_status) ?>">
		<input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
		<input type="hidden" name="save" value="save">

		<div class="form-container">
			<h1 class="form-title"><?= _("Editing Backup Exclusions") ?></h1>
			<?php show_alert_message($_SESSION); ?>
			<div class="u-mb10">
				<label for="v_web" class="form-label"><?= _("Web Domains") ?></label>
				<textarea class="form-control" name="v_web" id="v_web" placeholder="<?= _("WEB_EXCLUSIONS") ?>"><?= htmlentities(trim($v_web, "'")) ?></textarea>
			</div>
			<div class="u-mb10">
				<label for="v_mail" class="form-label"><?= _("Mail Domains") ?></label>
				<textarea class="form-control" name="v_mail" id="v_mail" placeholder="<?= _("MAIL_EXCLUSIONS") ?>"><?= htmlentities(trim($v_mail, "'")) ?></textarea>
			</div>
			<div class="u-mb10">
				<label for="v_db" class="form-label"><?= _("Databases") ?></label>
				<textarea class="form-control" name="v_db" id="v_db" placeholder="<?= _("DB_EXCLUSIONS") ?>"><?= htmlentities(trim($v_db, "'")) ?></textarea>
			</div>
			<div class="u-mb10">
				<label for="v_userdir" class="form-label"><?= _("User Directories") ?></label>
				<textarea class="form-control" name="v_userdir" id="v_userdir" placeholder="<?= _("USER_EXCLUSIONS") ?>"><?= htmlentities(trim($v_userdir, "'")) ?></textarea>
			</div>
		</div>

	</form>

</div>
