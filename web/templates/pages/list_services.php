<!-- Begin toolbar -->
<div class="toolbar">
	<div class="toolbar-inner">
		<div class="toolbar-buttons">
			<a href="/edit/server/" class="button button-secondary"><i class="fas fa-gear status-icon maroon"></i><?=_('Configure');?></a>
			<a href="/list/rrd/" class="button button-secondary"><i class="fas fa-chart-area status-icon blue"></i><?=_('Graphs');?></a>
			<a href="/list/updates/" class="button button-secondary"><i class="fas fa-arrows-rotate status-icon green"></i><?=_('Updates');?></a>
			<?php if (!empty($_SESSION['FIREWALL_SYSTEM']) && $_SESSION['FIREWALL_SYSTEM'] == "iptables" ) {?>
			<a href="/list/firewall/" class="button button-secondary"><i class="fas fa-shield-halved status-icon red"></i><?=_('Firewall');?></a>
			<?php }?>
			<a href="/list/log/?user=system&token=<?=$_SESSION['token']?>" class="button button-secondary"><i class="fas fa-binoculars status-icon orange"></i><?=_('Logs');?></a>
			<div class="actions-panel" key-action="js">
				<a class="data-controls do_servicerestart button button-secondary button-danger">
					<i class="do_servicerestart fas fa-arrow-rotate-left status-icon red"></i><?=_('Restart');?>
					<input type="hidden" name="servicerestart_url" value="/restart/system/?hostname=<?=$sys['sysinfo']['HOSTNAME'] ?>&token=<?=$_SESSION['token']?>&system_reset_token=<?=time(); ?>">
					<div class="dialog js-confirm-dialog-servicerestart" title="<?=_('Confirmation');?>">
						<p><?=sprintf(_('RESTART_CONFIRMATION'), 'Server');?></p>
					</div>
				</a>
			</div>
		</div>
		<div class="toolbar-right">
			<form action="/bulk/service/" method="post" id="objects">
				<input type="hidden" name="token" value="<?=$_SESSION['token']?>">
				<select class="form-select" name="action">
					<option value=""><?=_('apply to selected');?></option>
					<option value="stop"><?=_('stop');?></option>
					<option value="start"><?=_('start');?></option>
					<option value="restart"><?=_('restart');?></option>
				</select>
				<button type="submit" class="toolbar-submit" value="" title="<?=_('apply to selected');?>">
					<i class="fas fa-arrow-right"></i>
				</button>
			</form>
		</div>
	</div>
</div>
<!-- End toolbar -->

<div class="l-center units">

	<div>
		<div class="l-unit__col l-unit__col--right server-info">
			<div class="icon-server-info"><i class="fas fa-server"></i></div>
			<div class="l-unit__servername separate server-info-name"><?=$sys['sysinfo']['HOSTNAME']?></div>
			<div class="server-info-data">
				<table class="u-text-small">
					<tr>
						<td>
							<div class="l-unit__stat-cols clearfix">
								<div class="l-unit__stat-col l-unit__stat-col--left wide"><b><?=_('Hestia Control Panel');?>:</b></div>
								<div class="l-unit__stat-col l-unit__stat-col--right">
									<?php if ($sys['sysinfo']['RELEASE'] != 'release') { ?>
										<i class="fas fa-flask icon-large status-icon red" title="<?=$sys['sysinfo']['RELEASE'];?>"></i>
									<?php } ?>
									<?php if ($sys['sysinfo']['RELEASE'] == 'release') { ?>
										<i class="fas fa-cube icon-large status-icon" title="<?=_('Production release');?>"></i>
									<?php } ?>
									&nbsp;v<?=$sys['sysinfo']['HESTIA']?></div>
							</div>
						</td>
						<td>
							<div class="l-unit__stat-cols clearfix">
								<div class="l-unit__stat-col l-unit__stat-col--left wide"><b><?=_('Operating System');?>:</b></div>
								<div class="l-unit__stat-col l-unit__stat-col--right"><?=$sys['sysinfo']['OS']?> <?=$sys['sysinfo']['VERSION']?> (<?=$sys['sysinfo']['ARCH']?>)</div>
							</div>
						</td>
						<td>
							<div class="l-unit__stat-cols clearfix">
								<div class="l-unit__stat-col l-unit__stat-col--left wide"><b><?=_('Load Average');?>:</b></div>
								<div class="l-unit__stat-col l-unit__stat-col--right"><?=$sys['sysinfo']['LOADAVERAGE']?></div>
							</div>
						</td>
						<td>
							<div class="l-unit__stat-cols clearfix last">
								<div class="l-unit__stat-col l-unit__stat-col--left wide"><b><?=_('Uptime');?>:</b></div>
								<div class="l-unit__stat-col l-unit__stat-col--right"><?=humanize_time($sys['sysinfo']['UPTIME'])?></div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="table-header">
		<div class="l-unit__col l-unit__col--right">
			<div class="clearfix l-unit__stat-col--left super-compact">
				<input id="toggle-all" type="checkbox" name="toggle-all" value="toggle-all" title="<?=_('Select all');?>" onchange="checkedAll('objects');">
			</div>

			<div class="clearfix l-unit__stat-col--left wide-2"><b><?=_('Service');?></b></div>
			<div class="clearfix l-unit__stat-col--left text-right compact-2">&nbsp;</div>
			<div class="clearfix l-unit__stat-col--left wide-3"><b><?=_('Description');?></b></div>
			<div class="clearfix l-unit__stat-col--left text-center"><b><?=_('Uptime');?></b></div>
			<div class="clearfix l-unit__stat-col--left text-center"><b><?=_('CPU');?></b></div>
			<div class="clearfix l-unit__stat-col--left text-center"><b><?=_('Memory');?></b></div>
		</div>
	</div>

	<!-- Begin services status list item loop -->
	<?php
		foreach ($data as $key => $value) {
		++$i;
			if ($data[$key]['STATE'] == 'running') {
				$status = 'active';
				$action = 'stop';
				$spnd_icon = 'fa-stop';
				$state_icon = 'fa-circle-check status-icon green';
			} else {
				$status = 'suspended';
				$action = 'start';
				$spnd_icon = 'fa-play';
				$state_icon = 'fa-circle-minus status-icon red';
			}
			if(in_array($key, $phpfpm)){
				$edit_url="php";
			} else {
				$edit_url=$key;
			}

			$cpu = $data[$key]['CPU'] / 10;
			$cpu = number_format($cpu, 1);
			if ($cpu == '0.0')	$cpu = 0;
		?>
		<div class="l-unit <?php if ($status == 'suspended') echo 'l-unit--suspended';?> animate__animated animate__fadeIn" sort-name="<?=strtolower($key)?>"
			sort-memory="<?=$data[$key]['MEM']?>" sort-cpu="<?=$cpu;?>" sort-uptime="<?=$data[$key]['RTIME']?>">
			<div class="l-unit__col l-unit__col--right">
				<div class="clearfix l-unit__stat-col--left super-compact">
					<input id="check<?=$i ?>" class="ch-toggle" type="checkbox" title="<?=_('Select');?>" name="service[]" value="<?=$key?>">
				</div>
				<div class="clearfix l-unit__stat-col--left wide-2">
					<i class="fas <?=$state_icon;?> icon-pad-right"></i>
					<b><a href="/edit/server/<? echo $edit_url ?>/" title="<?=_('edit');?>: <?=$key?>"><?=$key?></a></b>
				</div>
				<div class="clearfix l-unit__stat-col--left text-center compact-2">
					<div class="actions-panel clearfix">
						<div class="actions-panel__col actions-panel__edit shortcut-enter" key-action="href">
							<a href="/edit/server/<? echo $edit_url ?>/" title="<?=_('edit');?>"><i class="fas fa-pencil status-icon orange status-icon dim icon-large"></i></a>
						</div>
						<div class="actions-panel__col actions-panel__stop shortcut-s" key-action="js">
							<a id="restart_link_<?=$i?>" class="data-controls do_servicerestart" title="<?=_('restart');?>">
								<i class="do_servicerestart data-controls fas fa-arrow-rotate-left status-icon highlight status-icon dim icon-large"></i>
								<input type="hidden" name="servicerestart_url" value="/restart/service/?srv=<?=$key?>&token=<?=$_SESSION['token']?>">
								<div id="restart_link_dialog_<?=$i?>" class="dialog js-confirm-dialog-servicerestart" title="<?=_('Confirmation');?>">
									<p><?=sprintf(_('RESTART_CONFIRMATION'),$key); ?></p>
								</div>
							</a>
						</div>
						<div class="actions-panel__col actions-panel__delete shortcut-delete" key-action="js">
							<a id="delete_link_<?=$i?>" class="data-controls do_servicestop" title="<?=_($action)?>">
								<i class="do_servicestop fas <?=$spnd_icon?> status-icon red status-icon dim icon-large"></i>
								<input type="hidden" name="servicestop_url" value="/<?=$action ?>/service/?srv=<?=$key?>&token=<?=$_SESSION['token']?>">
								<div id="delete_dialog_<?=$i?>" class="dialog js-confirm-dialog-servicestop" title="<?=_('Confirmation');?>">
									<p><?php if($action == 'stop'){ echo sprintf(_('Are you sure you want to stop service'),$key); }else{ echo sprintf(_('Are you sure you want to start service'),$key); }?></p>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="clearfix l-unit__stat-col--left wide-3"><?=_($data[$key]['SYSTEM'])?></div>
				<div class="clearfix l-unit__stat-col--left text-center"><b><?=humanize_time($data[$key]['RTIME'])?></b></div>
				<div class="clearfix l-unit__stat-col--left text-center"><b><?=$cpu?></b></div>
				<div class="clearfix l-unit__stat-col--left text-center"><b><?=$data[$key]['MEM']?> <?=_('mb');?></b></div>
			</div>
		</div>
	<?php } ?>
</div>

<div id="vstobjects">
	<div class="l-separator"></div>
	<div class="l-center">
		<div class="l-unit-ft">
			<div class="l-unit__col l-unit__col--left clearfix"></div>
			<div class="l-unit__col l-unit__col--right"></div>
		</div>
	</div>
</div>
