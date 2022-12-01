<!-- Begin toolbar -->
<div class="toolbar">
	<div class="toolbar-inner">
		<div class="toolbar-buttons">
			<a class="button button-secondary" id="btn-back" href="/list/firewall/ipset/"><i class="fas fa-arrow-left status-icon blue"></i><?=_('Back');?></a>
		</div>
		<div class="toolbar-buttons">
			<a href="#" class="button" data-action="submit" data-id="vstobjects"><i class="fas fa-floppy-disk status-icon purple"></i><?=_('Save');?></a>
		</div>
	</div>
</div>
<!-- End toolbar -->

<div class="l-center animate__animated animate__fadeIn">

	<form id="vstobjects" name="v_add_ipset" method="post">
		<input type="hidden" name="token" value="<?=$_SESSION['token']?>">
		<input type="hidden" name="ok" value="Add">

		<div class="form-container">
			<h1 class="form-title"><?=_('Adding Firewall Ipset List');?></h1>
			<?php show_alert_message($_SESSION);?>
			<div class="u-mb10">
				<label for="v_ipname" class="form-label"><?=_('Ip List Name') ?></label>
				<input type="text" class="form-control" name="v_ipname" id="v_ipname" maxlength="255" value="<?=htmlentities(trim($v_ipname, "'"))?>">
			</div>
			<div class="u-mb10">
				<label for="v_datasource" class="form-label">
					<?=_('Data Source') ?> <span class="optional">(<?=_('url, script or file');?>)</span>
				</label>
				<div class="u-pos-relative">
					<select class="form-select" tabindex="-1" id="datasource_list" onchange="this.nextElementSibling.value=this.value">
						<option value="">clear</option>
					</select>
					<input type="text" class="form-control list-editor" name="v_datasource" id="v_datasource" maxlength="255" value="<?=htmlentities(trim($v_datasource, "'"))?>">
				</div>
			</div>
			<div class="u-mb10">
				<label for="v_ipver" class="form-label"><?=_('Ip Version') ?></label>
				<select class="form-select" name="v_ipver" id="v_ipver">
					<option value="v4" <?php if ((!empty($v_ipver)) && ( $v_ipver == "'v4'" )) echo 'selected'?>><?=_('ip v4');?></option>
					<option value="v6" <?php if ((!empty($v_ipver)) && ( $v_ipver == "'v6'" )) echo 'selected'?>><?=_('ip v6');?></option>
				</select>
			</div>
			<div class="u-mb10">
				<label for="v_autoupdate" class="form-label"><?=_('Autoupdate') ?></label>
				<select class="form-select" name="v_autoupdate" id="v_autoupdate">
					<option value="yes" <?php if ((!empty($v_autoupdate)) && ( $v_autoupdate == "'yes'" )) echo 'selected'?>><?=_('yes');?></option>
					<option value="no" <?php if ((!empty($v_autoupdate)) && ( $v_autoupdate == "'no'" )) echo 'selected'?>><?=_('no');?></option>
				</select>
			</div>
		</div>

	</form>

</div>

<script>
	var country_iplists = [
		<?php
			$country = array('ca' => 'Canada', 'cn' => 'China', 'fr' => 'French', 'de' => 'Germany', 'in' => 'India', 'nl' => 'Netherlands', 'ro' => 'Romania', 'ru' => 'Russia', 'es' => 'Spain', 'ch' => 'Switzerland', 'tr' => 'Turkey', 'ua' => 'Ukraine',	'gb' => 'United Kingdom', 'us' => 'United States');
			foreach($country as $iso =>$name){
				echo '{name: "[IPv4] Country - '.$name.'",	source:"https://raw.githubusercontent.com/ipverse/rir-ip/master/country/'.$iso.'/ipv4-aggregated.txt"},'."\n";
			}
		?>
		// Define IPv6 country lists
		/*
		<?php
			foreach($country as $iso =>$name){
				echo '{name: "[IPv6] Country - '.$name.'",	source:"https://raw.githubusercontent.com/ipverse/rir-ip/master/country/'.$iso.'/ipv6-aggregated.txt"},'."\n";
			}
		?>
		*/
	];

	var blacklist_iplists = [
		{ name: "[IPv4] Block Malicious IPs", source: "script:/usr/local/hestia/install/deb/firewall/ipset/blacklist.sh" },
		/*
		{name: "[IPv6] Block Malicious IPs",			 source:"script:/usr/local/hestia/install/deb/firewall/ipset/blacklist.ipv6.sh"},
		*/
	];

	country_iplists.sort(function (a, b) {
		return a.name > b.name;
	});

	blacklist_iplists.sort(function (a, b) {
		return a.name > b.name;
	});

	$(function () {
		var targetElement = document.getElementById('datasource_list');

		// Blacklist
		var newEl = document.createElement("option");
		newEl.text = "<?=_('BLACKLIST') ?>";
		newEl.disabled = true;
		targetElement.appendChild(newEl);

		blacklist_iplists.forEach(iplist => {
			var newEl = document.createElement("option");
			newEl.text = iplist.name;
			newEl.value = iplist.source;
			targetElement.appendChild(newEl);
		});

		// IPVERSE
		var newEl = document.createElement("option");
		newEl.text = "<?=_('IPVERSE') ?>";
		newEl.disabled = true;
		targetElement.appendChild(newEl);

		country_iplists.forEach(iplist => {
			var newEl = document.createElement("option");
			newEl.text = iplist.name;
			newEl.value = iplist.source;
			targetElement.appendChild(newEl);
		});
	});
</script>
