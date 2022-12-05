<!-- Begin toolbar -->
<div class="toolbar">
	<div class="toolbar-inner">
		<div class="toolbar-buttons">
			<a class="button button-secondary" id="btn-back" href="/list/server/"><i class="fas fa-arrow-left status-icon blue"></i><?=_('Back');?></a>
			<a href="/list/server/?cpu" class="button button-secondary"><i class="fas fa-chart-pie status-icon green"></i><?=_('show: CPU / MEM / NET / DISK');?></a>
		</div>
		<div class="toolbar-right">
			<a class="toolbar-link<?php if ((empty($period)) || ($period == 'day')) echo " selected" ?>" href="?period=day"><?=_('Daily');?></a>
			<a class="toolbar-link<?php if ((!empty($period)) && ($period == 'week')) echo " selected" ?>" href="?period=week"><?=_('Weekly');?></a>
			<a class="toolbar-link<?php if ((!empty($period)) && ($period == 'month')) echo " selected" ?>" href="?period=month"><?=_('Monthly');?></a>
			<a class="toolbar-link<?php if ((!empty($period)) && ($period == 'year')) echo " selected" ?>" href="?period=year"><?=_('Yearly');?></a>
		</div>
	</div>
</div>
<!-- End toolbar -->

<div class="container animate__animated animate__fadeIn">
	<div class="form-container form-container-wide">
		<!-- Begin graph list item loop -->
		<?php foreach ($data as $key => $value) { ?>
			<div class="u-mb20">
				<h2 class="l-unit__name separate">
					<?=_($data[$key]['TITLE'])?>
				</h2>
				<?php if($data[$key]['TYPE'] != 'net'){?>
				<canvas id="<?=$data[$key]['RRD'];?>" class="js-chart" width="800" height="200" period="<?php echo htmlentities($period);?>"></canvas>
				<?php }else{?>
				<canvas id="net_<?=$data[$key]['RRD'];?>" class="js-chart" width="800" height="200" period="<?php echo htmlentities($period);?>"></canvas>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>

<footer class="app-footer">
	<div class="container"></div>
</footer>
