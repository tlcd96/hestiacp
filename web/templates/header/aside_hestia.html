<?php
  include '/usr/local/hestia/web/inc/policies.php';
  list($http_host, $port) = explode(':', $_SERVER["HTTP_HOST"].":");
  $db_myadmin_link = "//".$http_host."/phpmyadmin/";
  $db_pgadmin_link = "//".$http_host."/phppgadmin/";

  if (!empty($_SESSION['DB_PMA_ALIAS'])) {
    $db_myadmin_link = "//".$http_host."/".$_SESSION['DB_PMA_ALIAS']."/";
  }
  if (!empty($_SESSION['DB_PGA_ALIAS'])) {
    $db_pgadmin_link = "//".$http_host."/".$_SESSION['DB_PGA_ALIAS']."/";
  }
?>
<aside class="menu left desktop-hide">
  <div class="backdrop" data-action="close-left-menu"></div>
  <div class="contents">
    <div class="panel">
      <div class="js_control">

        <a href="<?=htmlspecialchars($home_url)?>" class="top-bar-logo" title="<?=_('Hestia Control Panel');?>">
          <img src="/images/logo-header.svg" alt="<?=_('Hestia Control Panel');?>" width="54" height="29">
        </a>
        <span class="menu-toggle-square" data-action="menu-left-close"><i class="fa fa-times"></i></span>
      </div>
    </div>
    <ul class="mobile_menu">
      <!-- Records tab -->
      <li class="nav-item">
        <a class="nav-link <?php if(in_array($TAB, ['WEB', 'DNS', 'MAIL', 'DB', 'BACKUP', 'CRON', 'PACKAGE', 'USER', 'LOG'])) echo 'active' ?>"
          href="<?=htmlspecialchars($home_url)?>">
          <div class="box-icon">
            <i class="fas fa-list-check"></i>
          </div>
          <div class="info-legend">
            <p class="legend">
              <?=_('Records');?>
            </p>
          </div>
        </a>
      </li>

      <!-- File Manager tab -->
      <?php if ((isset($_SESSION['FILE_MANAGER'])) && (!empty($_SESSION['FILE_MANAGER'])) && ($_SESSION['FILE_MANAGER'] == "true")) {?>
      <?php if (($_SESSION['userContext'] === 'admin') && (isset($_SESSION['look']) && ($_SESSION['look'] === 'admin') && ($_SESSION['POLICY_SYSTEM_PROTECTED_ADMIN'] == 'yes'))) {?>
      <!-- Hide file manager when impersonating admin-->
      <?php } else { ?>
      <li class="nav-item">
        <a class="nav-link <?php if($TAB == 'FM') echo 'active' ?>" href="/fm/">
          <div class="box-icon">
            <i class="fas fa-folder-open"></i>
          </div>
          <div class="info-legend">
            <p class="legend">
              <?=_('Files');?>
            </p>
          </div>
        </a>
      </li>
      <?php } ?>
      <?php } ?>

      <!-- Statistics tab-->
      <li class="nav-item">
        <a class="nav-link <?php if($TAB == 'STATS') echo 'active' ?>" href="/list/stats/">
          <div class="box-icon">
            <i class="fas fa-chart-line"></i>
          </div>
          <div class="info-legend">
            <p class="legend">
              <?=_('Statistics');?>
            </p>
          </div>
        </a>
      </li>
      <li class="nav-item-separator"></li>
      <!-- content from main menu list-->



      <!-- Users tab -->
      <?php if (($_SESSION['userContext'] == 'admin') && (empty($_SESSION['look']))) {?>
      <?php
          if (($_SESSION['user'] !== 'admin') && ($_SESSION['POLICY_SYSTEM_HIDE_ADMIN'] === 'yes')) {
            $user_count = $panel[$user]['U_USERS'] - 1;
          } else {
            $user_count = $panel[$user]['U_USERS'];
          }
        ?>
      <li class="nav-item">
        <a class="nav-link <?php if(in_array($TAB, ['USER', 'LOG'])) echo 'active' ?>" href="/list/user/"
          title="<?=_('Users');?>: <?=$user_count;?>&#13;<?=_('Suspended');?>: <?=$panel[$user]['SUSPENDED_USERS']?>">
          <div class="box-icon"><i class="fas fa-users u-ml10"></i></div>
          <div class="info-legend">
            <p class="legend">
              <?=_('USER');?>
            </p>
            <p class="info">
              <span>
                <?=_('users');?>: <span>
                  <?=htmlspecialchars($user_count);?>
                </span>
              </span>
              <span>
                <?=_('spnd');?>: <span>
                  <?=$panel[$user]['SUSPENDED_USERS']?>
                </span>
              </span>
            </p>
          </div>
        </a>
        <div class="opener">
          <div class="box-icon" data-action="open-submenu">
            <i class="fa fa-chevron-right"></i>
          </div>
        </div>
        <ul class="sub-menu">
          <li class="nav-item">
            <a href="/add/user/" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-circle-plus status-icon green"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('Add User');?>
                </p>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a href="/list/package/" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-box-open status-icon orange"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('Packages');?>
                </p>
              </div>
            </a>
          </li>
        </ul>
      </li>
      <?php } ?>

      <!-- Web tab -->
      <?php if ((isset($_SESSION['WEB_SYSTEM'])) && (!empty($_SESSION['WEB_SYSTEM']))) {?>
      <?php if($panel[$user]['WEB_DOMAINS'] != "0") { ?>
      <li class="nav-item">
        <a class="nav-link <?php if($TAB == 'WEB') echo 'active' ?>" href="/list/web/"
          title="<?=_('Domains');?>: <?=$panel[$user]['U_WEB_DOMAINS']?>&#13;<?=_('Aliases');?>: <?=$panel[$user]['U_WEB_ALIASES']?>&#13;<?=_('Limit')?>: <?=$panel[$user]['WEB_DOMAINS']=='unlimited' ? "∞" : $panel[$user]['WEB_DOMAINS']?>&#13;<?=_('Suspended');?>:<?=$panel[$user]['SUSPENDED_WEB']?>">
          <div class="box-icon">
            <i class="fas fa-earth-americas u-ml10"></i>
          </div>
          <div class="info-legend">
            <p class="legend">
              <?=_('WEB');?>
            </p>
            <p class="info">
              <span>
                <?=_('domains');?>: <span>
                  <?=$panel[$user]['U_WEB_DOMAINS']?> /
                  <?=$panel[$user]['WEB_DOMAINS']=='unlimited' ? "<b>∞</b>" : $panel[$user]['WEB_DOMAINS']?> (
                  <?=$panel[$user]['SUSPENDED_WEB']?>)
                </span>
              </span>
              <span>
                <?=_('aliases');?>: <span>
                  <?=$panel[$user]['U_WEB_ALIASES']?> /
                  <?=$panel[$user]['WEB_ALIASES']=='unlimited' || $panel[$user]['WEB_DOMAINS']=='unlimited'  ? "<b>∞</b>" : $panel[$user]['WEB_ALIASES'] * $panel[$user]['WEB_DOMAINS']?>
                </span>
              </span>
            </p>
          </div>
        </a>
        <?php if ($read_only !== 'true') {?>
        <div class="opener">
          <div class="box-icon" data-action="open-submenu">
            <i class="fa fa-chevron-right"></i>
          </div>
        </div>
        <ul class="sub-menu">
          <li class="nav-item">
            <a href="/add/web/" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-circle-plus status-icon green"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('Add Web Domain');?>
                </p>
              </div>
            </a>
          </li>
        </ul>
        <?php } ?>
      </li>
      <?php } ?>
      <?php } ?>

      <!-- DNS tab -->
      <?php if ((isset($_SESSION['DNS_SYSTEM'])) && (!empty($_SESSION['DNS_SYSTEM']))) {?>
      <?php if($panel[$user]['DNS_DOMAINS'] != "0") { ?>
      <li class="nav-item">
        <a class="nav-link <?php if($TAB == 'DNS') echo 'active' ?>" href="/list/dns/"
          title="<?=_('Domains');?>: <?=$panel[$user]['U_DNS_DOMAINS']?>&#13;<?=_('Limit')?>: <?=$panel[$user]['DNS_DOMAINS']=='unlimited' ? "∞" : $panel[$user]['DNS_DOMAINS']?>&#13;<?=_('Suspended');?>:<?=$panel[$user]['SUSPENDED_DNS']?>">
          <div class="box-icon">
            <i class="fas fa-book-atlas u-ml10"></i>
          </div>
          <div class="info-legend">
            <p class="legend">
              <?=_('DNS');?>
            </p>
            <p class="info">
              <span>
                <?=_('zones');?>: <span>
                  <?=$panel[$user]['U_DNS_DOMAINS']?> /
                  <?=$panel[$user]['DNS_DOMAINS']=='unlimited' ? "<b>∞</b>" : $panel[$user]['DNS_DOMAINS']?> (
                  <?=$panel[$user]['SUSPENDED_DNS']?>)
                </span>
              </span>
              <span>
                <?=_('records');?>: <span>
                  <?=$panel[$user]['U_DNS_RECORDS']?> /
                  <?=$panel[$user]['DNS_RECORDS']=='unlimited' || $panel[$user]['DNS_DOMAINS']=='unlimited' ? "<b>∞</b>" : $panel[$user]['DNS_RECORDS'] * $panel[$user]['DNS_DOMAINS']?>
                </span>
              </span>
            </p>
          </div>
        </a>
        <?php if ($read_only !== 'true') {?>
        <div class="opener">
          <div class="box-icon" data-action="open-submenu">
            <i class="fa fa-chevron-right"></i>
          </div>
        </div>
        <ul class="sub-menu">
          <li class="nav-item">
            <a href="/add/dns/" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-circle-plus status-icon green"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('Add DNS Domain');?>
                </p>
              </div>
            </a>
          </li>
        </ul>
        <?php } ?>
      </li>
      <?php } ?>
      <?php } ?>

      <!-- Mail tab -->
      <?php if ((isset($_SESSION['MAIL_SYSTEM'])) && (!empty($_SESSION['MAIL_SYSTEM']))) {?>
      <?php if($panel[$user]['MAIL_DOMAINS'] != "0") { ?>
      <li class="nav-item">
        <a class="nav-link <?php if($TAB == 'MAIL') echo 'active' ?>" href="/list/mail/"
          title="<?=_('Domains');?>: <?=$panel[$user]['U_MAIL_DOMAINS']?>&#13;<?=_('Limit')?>: <?=$panel[$user]['MAIL_DOMAINS']=='unlimited' ? "∞" : $panel[$user]['MAIL_DOMAINS']?>&#13;<?=_('Suspended');?>:<?=$panel[$user]['SUSPENDED_MAIL']?>">
          <div class="box-icon">
            <i class="fas fa-envelopes-bulk u-ml10"></i>
          </div>
          <div class="info-legend">
            <p class="legend">
              <?=_('MAIL');?>
            </p>
            <p class="info">
              <span>
                <?=_('domains');?>: <span>
                  <?=$panel[$user]['U_MAIL_DOMAINS']?> /
                  <?=$panel[$user]['MAIL_DOMAINS']=='unlimited' ? "<b>∞</b>" : $panel[$user]['MAIL_DOMAINS']?> (
                  <?=$panel[$user]['SUSPENDED_MAIL']?>)
                </span>
              </span>
              <span>
                <?=_('accounts');?>: <span>
                  <?=$panel[$user]['U_MAIL_ACCOUNTS']?> /
                  <?=$panel[$user]['MAIL_ACCOUNTS']=='unlimited' || $panel[$user]['MAIL_DOMAINS']=='unlimited' ? "<b>∞</b>" : $panel[$user]['MAIL_ACCOUNTS'] * $panel[$user]['MAIL_DOMAINS']?>
                </span>
              </span>
            </p>
          </div>
        </a>
        <?php if ($read_only !== 'true') {?>
        <div class="opener">
          <div class="box-icon" data-action="open-submenu">
            <i class="fa fa-chevron-right"></i>
          </div>
        </div>
        <ul class="sub-menu">
          <li class="nav-item">
            <a href="/add/mail/" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-circle-plus status-icon green"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('Add Mail Domain');?>
                </p>
              </div>
            </a>
          </li>
        </ul>
        <?php } ?>
      </li>
      <?php } ?>
      <?php } ?>

      <!-- Databases tab -->
      <?php if ((isset($_SESSION['DB_SYSTEM'])) && (!empty($_SESSION['DB_SYSTEM']))) {?>
      <?php if($panel[$user]['DATABASES'] != "0") { ?>
      <li class="nav-item">
        <a class="nav-link <?php if($TAB == 'DB') echo 'active' ?>" href="/list/db/"
          title="<?=_('Databases');?>: <?=$panel[$user]['U_DATABASES']?>&#13;<?=_('Limit')?>: <?=$panel[$user]['DATABASES']=='unlimited' ? "∞" : $panel[$user]['DATABASES']?>&#13;
          <?=_('Suspended');?>:
          <?=$panel[$user]['SUSPENDED_DB']?>">
          <div class="box-icon">
            <i class="fas fa-database u-ml10"></i>
          </div>
          <div class="info-legend">
            <p class="legend">
              <?=_('DB');?>
            </p>
            <p class="info">
              <span>
                <?=_('databases');?>: <span>
                  <?=$panel[$user]['U_DATABASES']?> /
                  <?=$panel[$user]['DATABASES']=='unlimited' ? "<b>∞</b>" : $panel[$user]['DATABASES']?> (
                  <?=$panel[$user]['SUSPENDED_DB']?>)
                </span>
              </span>
            </p>
          </div>
        </a>
        <?php if ($read_only !== 'true') {?>
        <div class="opener">
          <div class="box-icon" data-action="open-submenu">
            <i class="fa fa-chevron-right"></i>
          </div>
        </div>
        <ul class="sub-menu">
          <li class="nav-item">
            <a href="/add/db/" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-circle-plus status-icon green"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('Add Database');?>
                </p>
              </div>
            </a>
          </li>
          <?php if (($_SESSION['DB_SYSTEM'] === 'mysql') || ($_SESSION['DB_SYSTEM'] === 'mysql,pgsql') || ($_SESSION['DB_SYSTEM'] === 'pgsql,mysql')) {?>
          <li class="nav-item">
            <a href="<?=$db_myadmin_link; ?>" class="nav-link <?=(ipUsed() ? 'nav-suspended':'');?>" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-database status-icon orange"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('phpMyAdmin');?>
                </p>
              </div>
            </a>
          </li>
          <? }?>

          <?php if (($_SESSION['DB_SYSTEM'] === 'pgsql') || ($_SESSION['DB_SYSTEM'] === 'mysql,pgsql') || ($_SESSION['DB_SYSTEM'] === 'pgsql,mysql')) {?>
          <li class="nav-item">
            <a href="<?=$db_pgadmin_link; ?>" class="nav-link <?=(ipUsed() ? 'nav-suspended':'');?>" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-database status-icon orange"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('phpPgAdmin');?>
                </p>
              </div>
            </a>
          </li>
          <? }?>

          <?php if(ipUsed()){ ?>
          <li class="nav-item">
            <a href="https://docs.hestiacp.com/admin_docs/database.html#why-i-can-t-use-http-ip-phpmyadmin"
              class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-circle-question"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('Why can\'t i use http/ip phpmyadmin');?>
                </p>
              </div>
            </a>
          </li>
          <? }?>
        </ul>
        <?php } ?>
      </li>
      <?php } ?>
      <?php } ?>

      <!-- Cron tab -->
      <?php if ((isset($_SESSION['CRON_SYSTEM'])) && (!empty($_SESSION['CRON_SYSTEM']))) {?>
      <?php if($panel[$user]['CRON_JOBS'] != "0") { ?>
      <li class="nav-item">
        <a class="nav-link <?php if($TAB == 'CRON') echo 'active' ?>" href="/list/cron/"
          title="<?=_('Jobs');?>: <?=$panel[$user]['U_WEB_DOMAINS']?>&#13;<?=_('Limit')?>: <?=$panel[$user]['CRON_JOBS']=='unlimited' ? "∞" : $panel[$user]['CRON_JOBS']?>&#13;
          <?=_('Suspended');?>:
          <?=$panel[$user]['SUSPENDED_CRON']?>">
          <div class="box-icon">
            <i class="fas fa-clock u-ml10"></i>
          </div>
          <div class="info-legend">
            <p class="legend">
              <?=_('CRON');?>
            </p>
            <p class="info">
              <span>
                <?=_('jobs');?>: <span>
                  <?=$panel[$user]['U_CRON_JOBS']?> /
                  <?=$panel[$user]['CRON_JOBS']=='unlimited' ? "<b>∞</b>" : $panel[$user]['CRON_JOBS']?> (
                  <?=$panel[$user]['SUSPENDED_CRON']?>)
                </span>
              </span>
            </p>
          </div>
        </a>
        <?php if ($read_only !== 'true') {?>
        <div class="opener">
          <div class="box-icon" data-action="open-submenu">
            <i class="fa fa-chevron-right"></i>
          </div>
        </div>
        <ul class="sub-menu">

          <li class="nav-item">
            <a href="/add/cron/" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-circle-plus status-icon green"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('Add Cron Job');?>
                </p>
              </div>
            </a>
          </li>

          <?php if($panel[$user_plain]['CRON_REPORTS'] == 'yes') { ?>
          <li class="nav-item">
            <a href="/delete/cron/reports/?token=<?=$_SESSION['token'];?>" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-toggle-on status-icon green"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('turn off notifications');?>
                </p>
              </div>
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a href="/add/cron/reports/?token=<?=$_SESSION['token'];?>" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-toggle-off status-icon green"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('turn off notifications');?>
                </p>
              </div>
            </a>
          </li>
          <?php } ?>
        </ul>
        <?php } ?>
      </li>
      <?php } ?>
      <?php } ?>

      <!-- Backups tab -->
      <?php if ((isset($_SESSION['BACKUP_SYSTEM'])) && (!empty($_SESSION['BACKUP_SYSTEM']))) {?>
      <?php if($panel[$user]['BACKUPS'] != "0") { ?>
      <li class="nav-item">
        <a class="nav-link <?php if($TAB == 'BACKUP') echo 'active' ?>" href="/list/backup/"
          title="<?=_('Backups');?>: <?=$panel[$user]['U_BACKUPS']?>&#13;<?=_('Limit')?>: <?=$panel[$user]['BACKUPS']=='unlimited' ? "∞" : $panel[$user]['BACKUPS']?>">
          <div class="box-icon">
            <i class="fas fa-file-zipper u-ml10"></i>
          </div>
          <div class="info-legend">
            <p class="legend">
              <?=_('BACKUP');?>
            </p>
            <p class="info">
              <span>
                <?=_('backups');?>: <span>
                  <?=$panel[$user]['U_BACKUPS']?> /
                  <?=$panel[$user]['BACKUPS']=='unlimited' ? "<b>∞</b>" : $panel[$user]['BACKUPS']?>
                </span>
              </span>
            </p>
          </div>
        </a>

        <?php if ($read_only !== 'true') {?>
        <div class="opener">
          <div class="box-icon" data-action="open-submenu">
            <i class="fa fa-chevron-right"></i>
          </div>
        </div>
        <ul class="sub-menu">
          <li class="nav-item">
            <a href="/schedule/backup/?token=<?=$_SESSION['token']?>" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-circle-plus status-icon green"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('Create Backup');?>
                </p>
              </div>
            </a>
          </li>
          <li class="nav-item">
            <a href="/list/backup/exclusions/" class="nav-link" title="ctrl+Enter">
              <div class="box-icon"><i class="fas fa-folder-minus status-icon orange"></i></div>
              <div class="info-legend">
                <p class="legend">
                  <?=_('backup exclusions');?>
                </p>
              </div>
            </a>
          </li>
        </ul>
        <?php } ?>
      </li>
      <?php } ?>
      <?php } ?>
      <!-- end content -->
    </ul>
  </div>
</aside>
