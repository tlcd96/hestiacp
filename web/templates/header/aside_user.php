-<?php
// Data
exec (HESTIA_CMD."v-list-sys-info json", $output, $return_var);
$sys = json_decode(implode('', $output), true);
unset($output);

//autoupdates
exec (HESTIA_CMD."v-list-sys-hestia-autoupdate plain", $output, $return_var);
$autoupdate = $output['0'];
unset($output);
?>
<aside class="menu right desktop-hide">
  <div class="backdrop" data-action="close-right-menu"></div>
  <div class="contents">
    <div class="panel">
      <div class="js_control">
        <span class="menu-toggle-square" data-action="menu-right-close"><i class="fa fa-times"></i></span>
        <?php if (($_SESSION['userContext'] === 'admin') && (isset($_SESSION['look']) && ($user == 'admin'))) {?>
          <a href="/list/log/" class="<?php if($TAB == 'LOG') echo 'active' ?>"><i class="fas fa-clock-rotate-left"></i> <?=_('Logs');?></a>
        <?php } ?>
        <?php if ($panel[$user]['SUSPENDED'] === 'no') {?>
          <div class="context-user">
            <i class="fas fa-circle-user"></i>
            <span><?=htmlspecialchars($user)?> (<?=htmlspecialchars($panel[$user]['NAME'])?>)</span>
          </div>
          <a href="/edit/user/?user=<?=$user; ?>&token=<?=$_SESSION['token']?>"  class="menu-toggle-square">
            <i class="fas fa-pencil"></i>
          </a>
        <?php } ?>
      </div>
    </div>
    <div class="sub_panel">
      <div class="usage_card">
        <div class="legend">
          <span><?=_("Disk")?></span>
        </div>
        <div class="constant">
          <b><?=humanize_usage_size($panel[$user]['U_DISK'])?></b> <?=humanize_usage_measure($panel[$user]['U_DISK'])?>
        </div>
      </div>
      <div class="usage_card">
        <div class="legend">
          <span><?=_("Bandwidth")?></span>
        </div>
        <div class="constant">
          <b><?=humanize_usage_size($panel[$user]['U_BANDWIDTH'])?></b> <?=humanize_usage_measure($panel[$user]['U_BANDWIDTH'])?>
        </div>
      </div>
    </div>
    <ul class="mobile_menu">
      <?php if (($_SESSION['userContext'] === 'admin') && ($_SESSION['POLICY_SYSTEM_HIDE_SERVICES'] !== 'yes') || ($_SESSION['user'] === 'admin')) {?>
        <?php if (($_SESSION['userContext'] === 'admin') && (!empty($_SESSION['look']))) {?>
          <!-- Hide 'Server Settings' button when impersonating 'admin' or other users -->
        <?php } else { ?>
          <li class="nav-item">
            <a title="<?=_('Server');?>" class="nav-link <?php if(in_array($TAB, ['SERVER', 'IP', 'RRD', 'FIREWALL'])) echo 'active' ?>" href="/list/server/">
              <div class="box-icon">
                <i class="fas fa-gear"></i>
              </div>
              <div class="info-legend">
                <p class="legend"><?=_('Server');?></p>
              </div>
            </a>
            <div class="opener">
              <div class="box-icon" data-action="open-submenu">
                <i class="fa fa-chevron-right"></i>
              </div>
            </div>
            <ul class="sub-menu">
                <!-- Start of admin menu -->
                <li class="nav-item">
                  <a href="/edit/server/" class="nav-link" title="ctrl+Enter">
                    <div class="box-icon">
                      <i class="fas fa-gear status-icon maroon"></i>
                    </div>
                    <div class="info-legend">
                      <p class="legend">
                        <?=_('Configure');?>
                      </p>
                    </div>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/list/rrd/" class="nav-link" title="ctrl+Enter">
                    <div class="box-icon">
                      <i class="fas fa-chart-area status-icon blue"></i>
                    </div>
                    <div class="info-legend">
                      <p class="legend">
                        <?=_('Graphs');?>
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
                      <a href="/list/server/?cpu" class="nav-link" title="ctrl+Enter">
                        <div class="box-icon"><i class="fas fa-chart-pie status-icon green"></i></div>
                        <div class="info-legend">
                          <p class="legend">
                            <?=_('View Advanced Details');?>
                          </p>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="/list/updates/" class="nav-link" title="ctrl+Enter">
                    <div class="box-icon">
                      <i class="fas fa-arrows-rotate status-icon green"></i>
                    </div>
                    <div class="info-legend">
                      <p class="legend">
                        <?=_('Updates');?>
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
                      <?php
                        if($autoupdate == 'Enabled') {
                          $btn_url = '/delete/cron/autoupdate/?token='.$_SESSION['token'].'';
                          $btn_icon = 'fa-toggle-on status-icon green';
                          $btn_label = _('Disable automatic updates');
                        } else {
                          $btn_url = '/add/cron/autoupdate/?token='.$_SESSION['token'].'';
                          $btn_icon = 'fa-toggle-off status-icon red';
                          $btn_label = _('Enable automatic updates');
                        }
                      ?>
                      <a href="<?=$btn_url;?>" class="nav-link" title="ctrl+Enter">
                        <div class="box-icon"><i class="fas <?=$btn_icon;?>"></i></div>
                        <div class="info-legend">
                          <p class="legend">
                            <?=$btn_label;?>
                          </p>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="/list/ip/" class="nav-link" title="ctrl+Enter">
                    <div class="box-icon">
                      <i class="fas fa-ethernet status-icon blue"></i>
                    </div>
                    <div class="info-legend">
                      <p class="legend">
                        <?=_('Network');?>
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
                      <a href="/add/ip/" class="nav-link" title="ctrl+Enter">
                        <div class="box-icon"><i class="fas fa-circle-plus status-icon green"></i></div>
                        <div class="info-legend">
                          <p class="legend">
                            <?=_('Add IP Address');?>
                          </p>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>
                <?php if (!empty($_SESSION['FIREWALL_SYSTEM']) && $_SESSION['FIREWALL_SYSTEM'] == "iptables" ) {?>
                  <li class="nav-item">
                    <a href="/list/firewall/" class="nav-link" title="ctrl+Enter">
                      <div class="box-icon">
                        <i class="fas fa-shield-halved status-icon red"></i>
                      </div>
                      <div class="info-legend">
                        <p class="legend">
                          <?=_('Firewall');?>
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
                        <a href="/add/firewall/" class="nav-link" title="ctrl+Enter">
                          <div class="box-icon"><i class="fas fa-circle-plus status-icon green"></i></div>
                          <div class="info-legend">
                            <p class="legend">
                              <?=_('Add Rule');?>
                            </p>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/list/firewall/banlist/" class="nav-link" title="ctrl+Enter">
                          <div class="box-icon"><i class="fas fa-eye status-icon red"></i></div>
                          <div class="info-legend">
                            <p class="legend">
                              <?=_('Manage Banned IPs');?>
                            </p>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/list/firewall/ipset/" class="nav-link" title="ctrl+Enter">
                          <div class="box-icon"><i class="fas fa-list status-icon blue"></i></div>
                          <div class="info-legend">
                            <p class="legend">
                              <?=_('Manage IP lists');?>
                            </p>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                <?php }?>
                <li class="nav-item">
                  <a href="/list/log/?user=system&token=<?=$_SESSION['token']?>" class="nav-link" title="ctrl+Enter">
                    <div class="box-icon">
                      <i class="fas fa-binoculars status-icon orange"></i>
                    </div>
                    <div class="info-legend">
                      <p class="legend">
                        <?=_('Logs');?>
                      </p>
                    </div>
                  </a>
                </li>
                <!-- No Restart here because of messing with unknown javascript -->
                <!-- End of admin menu -->

                <li class="nav-item-separator"></li>
                <li class="nav-item">
                  <a class="nav-link" title="ctrl+Enter">
                    <div class="box-icon">
                      <i class="fas icon-large status-icon <?php echo ($sys['sysinfo']['RELEASE'] == 'release')?'fa-cube':'fa-flask red'; ?>" title="<?=$sys['sysinfo']['RELEASE'];?>"></i>
                    </div>
                    <div class="info-legend">
                      <p class="legend">
                        v<?=$sys['sysinfo']['HESTIA']?>
                      </p>
                    </div>
                  </a>
                </li>
            </ul>
          </li>
        <?php } ?>
      <?php } ?>
      <!-- Help / Documentation-->
      <li class="nav-item">
        <a title="<?=_('Help');?>" class="nav-link" href="https://docs.hestiacp.com/" target="_blank" rel="noopener">
          <div class="box-icon">
            <i class="fas fa-circle-question"></i>
          </div>
          <div class="info-legend">
            <p class="legend"><?=_('Help');?></p>
          </div>
        </a>
      </li>
      <!-- Logout -->
      <?php if (isset($_SESSION['look']) && (!empty($_SESSION['look']))) { ?>
        <li class="nav-item">
          <a title="<?=_('Log out');?> (<?=$user?>)" class="nav-link nav-link-logout" href="/logout/?token=<?=$_SESSION['token']?>">
            <div class="box-icon">
              <i class="fas fa-circle-up"></i>
            </div>
            <div class="info-legend">
              <p class="legend"><?=_('Log out');?> (<?=$user?>)</p>
            </div>
          </a>
        </li>
      <?php } else { ?>
        <li class="nav-item">
          <a title="<?=_('Log out');?>" class="nav-link nav-link-logout" href="/logout/?token=<?=$_SESSION['token']?>">
            <div class="box-icon">
              <i class="fas fa-right-from-bracket"></i>
            </div>
            <div class="info-legend">
              <p class="legend"><?=_('Log out');?></p>
            </div>
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>
</aside>
