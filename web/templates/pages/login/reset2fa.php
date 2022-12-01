<div class="login animate__animated animate__zoomIn">
	<a href="/" class="u-block u-mr30 u-mb40">
		<img src="/images/logo.svg" alt="<?=_('Hestia Control Panel');?>" width="100" height="120">
	</a>
	<?php if ($success) {?>
		<div>
			<h1 class="login-title">
				<?=_('2FA Reset successfully');?>
			</h1>
			<?php if (isset($ERROR)) echo $ERROR ?>
			<div class="u-mt20">
				<button type="button" class="button button-secondary" onclick="location.href='/login/'">
					<?=_('Log in');?>
				</button>
			</div>
		</div>
	<?php } else { ?>
		<form method="post" action="/reset2fa/">
			<input type="hidden" name="token" value="<?=$_SESSION['token'];?>">
			<h1 class="login-title">
				<?=_('Reset 2FA');?>
			</div>
			<?php if (isset($ERROR)) echo $ERROR ?>
			<div class="u-mb10">
				<label for="user" class="form-label"><?=_('Username');?></label>
				<input type="text" class="form-control" name="user" id="user">
			</div>
			<div class="u-mb20">
				<label for="twofa" class="form-label"><?=_('2FA Reset Code');?></label>
				<input type="text" class="form-control" name="twofa" id="twofa">
			</div>
			<div class="u-side-by-side">
				<button type="submit" class="button">
					<?=_('Submit');?>
				</button>
				<button type="button" class="button button-secondary" onclick="location.href='/login/?logout'">
					<?=_('Back');?>
				</button>
			</div>
		</form>
	<?php } ?>
</div>

</body>

</html>
