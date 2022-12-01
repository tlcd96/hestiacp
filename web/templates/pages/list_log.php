<!-- Begin toolbar -->
<div class="toolbar">
  <div class="toolbar-inner">
    <div class="toolbar-buttons">
      <?php if (($_SESSION['userContext'] === 'admin') && ($_SESSION['look'] === 'admin')) {?>
        <a href="/list/user/" class="button button-secondary" id="btn-back"><i class="fas fa-arrow-left status-icon blue"></i><?=_('Back');?></a>
      <?php } else if (($_SESSION['userContext'] === 'admin') && (htmlentities($_GET['user']) === 'system')) { ?>
        <a href="/list/server/" class="button button-secondary" id="btn-back"><i class="fas fa-arrow-left status-icon blue"></i><?=_('Back');?></a>
      <?php } else { ?>
        <?php if (($_SESSION['userContext'] === 'admin') && (isset($_GET['user'])) && ($_GET['user'] !== 'admin')) { ?>
          <a href="/edit/user/?user=<?=htmlentities($_GET['user']); ?>&token=<?=$_SESSION['token']?>" class="button button-secondary" id="btn-back"><i class="fas fa-arrow-left status-icon blue"></i><?=_('Back');?></a>
        <?php } else { ?>
          <a href="/edit/user/?token=<?=$_SESSION['token']?>" class="button button-secondary" id="btn-back"><i class="fas fa-arrow-left status-icon blue"></i><?=_('Back');?></a>
        <?php } ?>
      <?php } ?>
      <?php if ($_SESSION['DEMO_MODE'] != "yes"){
      if (($_SESSION['userContext'] === 'admin') && (htmlentities($_GET['user']) !== 'admin')) { ?>
        <?php if (($_SESSION['userContext'] === 'admin') && ($_GET['user'] != '') && (htmlentities($_GET['user']) !== 'admin')) { ?>
          <?php if (htmlentities($_GET['user']) !== 'system') {?>
            <a href="/list/log/auth/?user=<?=htmlentities($_GET['user']); ?>&token=<?=$_SESSION['token']?>" class="button button-secondary" id="btn-back" title="<?=_('Login history');?>"><i class="fas fa-binoculars status-icon green"></i><?=_('Login history');?></a>
          <?php } ?>
        <?php } else { ?>
          <a href="/list/log/auth/" class="button button-secondary" id="btn-back" title="<?=_('Login history');?>"><i class="fas fa-binoculars status-icon green"></i><?=_('Login history');?></a>
        <?php } ?>
      <?php } ?>
      <?php if ($_SESSION['userContext'] === 'user') {?>
        <a href="/list/log/auth/" class="button button-secondary" id="btn-back" title="<?=_('Login history');?>"><i class="fas fa-binoculars status-icon green"></i><?=_('Login history');?></a>
      <?php }
      } ?>
    </div>
    <div class="toolbar-buttons">
      <a href="javascript:location.reload();" class="button button-secondary"><i class="fas fa-arrow-rotate-right status-icon green"></i><?=_('Refresh');?></a>
      <?php if (($_SESSION['userContext'] === 'admin') && ($_SESSION['look'] === 'admin') && ($_SESSION['POLICY_SYSTEM_PROTECTED_ADMIN'] === 'yes')) {?>
        <!-- Hide delete buttons-->
      <?php } else { ?>
        <?php if (($_SESSION['userContext'] === 'admin') || (($_SESSION['userContext'] === 'user') && ($_SESSION['POLICY_USER_DELETE_LOGS'] !== 'no'))) {?>
          <div class="actions-panel" key-action="js">
            <a class="data-controls do_delete button button-secondary button-danger">
              <i class="do_delete fas fa-circle-xmark status-icon red"></i><?=_('Delete');?>
              <?php if (($_SESSION['userContext'] === 'admin') && (isset($_GET['user']))) {?>
                <input type="hidden" name="delete_url" value="/delete/log/?user=<?=htmlentities($_GET['user']);?>&token=<?=$_SESSION['token']?>">
              <?php } else { ?>
                <input type="hidden" name="delete_url" value="/delete/log/?token=<?=$_SESSION['token']?>">
              <?php } ?>
              <div class="dialog js-confirm-dialog-delete" title="<?=_('Confirmation');?>">
                <p><?=_('DELETE_LOGS_CONFIRMATION');?></p>
              </div>
            </a>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
</div>
<!-- End toolbar -->

<div class="l-center units">

  <div class="header table-header">
    <div class="l-unit__col l-unit__col--right">
      <div class="clearfix l-unit__stat-col--left super-compact text-center">&nbsp;</div>
      <div class="clearfix l-unit__stat-col--left"><b><?=_('Date');?></b></div>
      <div class="clearfix l-unit__stat-col--left compact-2"><b><?=_('Time');?></b></div>
      <div class="clearfix l-unit__stat-col--left"><b><?=_('Category');?></b></div>
      <div class="clearfix l-unit__stat-col--left"><b><?=_('Message');?></b></div>
    </div>
  </div>

  <!-- Begin log history entry loop -->
  <?php
    foreach ($data as $key => $value) {
      ++$i;

      if ($data[$key]['LEVEL'] === 'Info') {
        $level_icon = 'fa-info-circle status-icon blue';
      }
      if ($data[$key]['LEVEL'] === 'Warning') {
        $level_icon = 'fa-triangle-exclamation status-icon orange';
      }
      if ($data[$key]['LEVEL'] === 'Error') {
        $level_icon = 'fa-circle-xmark status-icon red';
      }
    ?>
    <div class="l-unit header animate__animated animate__fadeIn">
      <div class="l-unit__col l-unit__col--right">
        <div class="clearfix l-unit__stat-col--left super-compact text-center">
          <i class="fas <?=$level_icon;?>"></i>
        </div>
        <div class="clearfix l-unit__stat-col--left"><b><?=translate_date($data[$key]['DATE'])?></b></div>
        <div class="clearfix l-unit__stat-col--left compact-2"><b><?=htmlspecialchars($data[$key]['TIME']);?></b></div>
        <div class="clearfix l-unit__stat-col--left"><b><?=htmlspecialchars($data[$key]['CATEGORY']);?></b></div>
        <div class="clearfix l-unit__stat-col--left wide-7"><?=htmlspecialchars($data[$key]['MESSAGE'], ENT_QUOTES);?></div>
      </div>
    </div>
  <?php } ?>
</div>

<div id="vstobjects">
  <div class="l-separator"></div>
  <div class="l-center">
    <div class="l-unit-ft">
      <div class="l-unit__col l-unit__col--right">
        <?php printf(ngettext('%d log record', '%d log records', $i),$i); ?>
      </div>
    </div>
  </div>
</div>
