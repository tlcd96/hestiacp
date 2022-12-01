<!-- Begin toolbar -->
<div class="toolbar">
  <div class="toolbar-inner">
    <div class="toolbar-buttons">
      <?php if ($read_only !== 'true') {?>
        <a href="/add/web/" class="button button-secondary" id="btn-create"><i class="fas fa-circle-plus status-icon green"></i><?=_('Add Web Domain');?></a>
      <?php } ?>
    </div>
    <div class="toolbar-right">
      <div class="toolbar-sorting">
        <ul class="context-menu sort-order animate__animated animate__fadeIn" style="display:none;">
          <li entity="sort-bandwidth" sort_as_int="1"><span class="name"><?=_('Bandwidth');?> <i class="fas fa-arrow-down-a-z"></i></span><span class="up"><i class="fas fa-arrow-up-a-z"></i></span></li>
          <li entity="sort-date" sort_as_int="1"><span class="name <?php if ($_SESSION['userSortOrder'] === 'date') { echo 'active'; } ?>"><?=_('Date');?> <i class="fas fa-arrow-down-a-z"></i></span><span class="up"><i class="fas fa-arrow-up-a-z"></i></span></li>
          <li entity="sort-disk" sort_as_int="1"><span class="name"><?=_('Disk');?> <i class="fas fa-arrow-down-a-z"></i></span><span class="up"><i class="fas fa-arrow-up-a-z"></i></span></li>
          <li entity="sort-name"><span class="name <?php if ($_SESSION['userSortOrder'] === 'name') { echo 'active'; } ?>"><?=_('Name');?> <i class="fas fa-arrow-down-a-z"></i></span><span class="up"><i class="fas fa-arrow-up-a-z"></i></span></li>
          <li entity="sort-ip" sort_as_int="1"><span class="name"><?=_('IP address');?> <i class="fas fa-arrow-down-a-z"></i></span><span class="up"><i class="fas fa-arrow-up-a-z"></i></span></li>
        </ul>
        <div class="sort-by" title="<?=_('Sort items');?>">
          <?=_('sort by');?>:
          <b>
            <?php if ($_SESSION['userSortOrder'] === 'name') { $label = ('Name'); } else { $label = _('Date'); } ?>
            <?=$label?> <i class="fas fa-arrow-down-a-z"></i>
          </b>
        </div>
        <?php if ($read_only !== 'true') {?>
          <form action="/bulk/web/" method="post" id="objects">
            <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
            <select class="form-select" name="action">
              <option value=""><?=_('apply to selected');?></option>
              <?php if ($_SESSION['userContext'] === 'admin') {?>
                <option value="rebuild"><?=_('rebuild');?></option>
              <?php } ?>
              <option value="suspend"><?=_('suspend');?></option>
              <option value="unsuspend"><?=_('unsuspend');?></option>
              <option value="delete"><?=_('delete');?></option>
            </select>
            <button type="submit" class="toolbar-submit" value="" title="<?=_('apply to selected');?>">
              <i class="fas fa-arrow-right"></i>
            </button>
          </form>
        <?php } ?>
      </div>
      <div class="toolbar-search">
        <form action="/search/" method="get">
          <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
          <input type="search" class="form-control js-search-input" name="q" value="<? echo isset($_POST['q']) ? htmlspecialchars($_POST['q']) : '' ?>" title="<?=_('Search');?>">
          <button type="submit" class="toolbar-submit" onclick="return doSearch('/search/')" value="" title="<?=_('Search');?>">
            <i class="fas fa-magnifying-glass"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End toolbar -->

<div class="l-center units">

  <!-- Table header -->
  <div class="header table-header">
    <div class="l-unit__col l-unit__col--right">
      <div class="clearfix l-unit__stat-col--left super-compact">
        <input id="toggle-all" type="checkbox" name="toggle-all" value="toggle-all" title="<?=_('Select all');?>" onchange="checkedAll('objects');" <?=$display_mode;?>>
      </div>
      <div class="clearfix l-unit__stat-col--left wide-4"><b><?=_('Name');?></b></div>
      <div class="clearfix l-unit__stat-col--left compact-4 text-right"><b>&nbsp;</b></div>
      <div class="clearfix l-unit__stat-col--left text-center"><b><?=_('IP address');?></b></div>
      <div class="clearfix l-unit__stat-col--left text-center"><b><?=_('Disk');?></b></div>
      <div class="clearfix l-unit__stat-col--left text-center compact"><b><?=_('Bandwidth');?></b></div>
      <div class="clearfix l-unit__stat-col--left text-center"><b><?=_('SSL');?></b></div>
      <div class="clearfix l-unit__stat-col--left text-center compact"><b><?=_('Statistics');?></b></div>
    </div>
  </div>

  <!-- Begin web domain list item loop -->
  <?php
    foreach ($data as $key => $value) {
        ++$i;
        if ($data[$key]['SUSPENDED'] == 'yes') {
            $status = 'suspended';
            $spnd_action = 'unsuspend';
            $spnd_icon = 'fa-play';
            $spnd_confirmation = _('UNSUSPEND_DOMAIN_CONFIRMATION');
        } else {
            $status = 'active';
            $spnd_action = 'suspend';
            $spnd_icon = 'fa-pause';
            $spnd_confirmation = _('SUSPEND_DOMAIN_CONFIRMATION');
        }
        if (!empty($data[$key]['SSL_HOME'])) {
            if ($data[$key]['SSL_HOME'] == 'same') {
                $ssl_home = 'public_html';
            } else {
                $ssl_home = 'public_shtml';
            }
        } else {
            $ssl_home = '';
        }
        $web_stats='no';
        if (!empty($data[$key]['STATS'])) {
            $web_stats=$data[$key]['STATS'];
        }
        $ftp_user='no';
        if (!empty($data[$key]['FTP_USER'])) {
            $ftp_user=$data[$key]['FTP_USER'];

        }
        if (strlen($ftp_user) > 24 ) {
            $ftp_user = str_replace(':', ', ', $ftp_user);
            $ftp_user = substr($ftp_user, 0, 24);
            $ftp_user = trim($ftp_user, ":");
            $ftp_user = str_replace(':', ', ', $ftp_user);
            $ftp_user = $ftp_user.", ...";
        } else {
            $ftp_user = str_replace(':', ', ', $ftp_user);
        }

        $backend_support='no';
        if (!empty($data[$key]['BACKEND'])) {
            $backend_support='yes';
        }

        $proxy_support='no';
        if (!empty($data[$key]['PROXY'])) {
            $proxy_support='yes';
        }
        if (strlen($data[$key]['PROXY_EXT']) > 24 ) {
            $proxy_ext_title = str_replace(',', ', ', $data[$key]['PROXY_EXT']);
            $proxy_ext = substr($data[$key]['PROXY_EXT'], 0, 24);
            $proxy_ext = trim($proxy_ext, ",");
            $proxy_ext = str_replace(',', ', ', $proxy_ext);
            $proxy_ext = $proxy_ext.", ...";
        } else {
            $proxy_ext_title = '';
            $proxy_ext = str_replace(',', ', ', $data[$key]['PROXY_EXT']);
        }
        if ($data[$key]['SUSPENDED'] === 'yes') {
          if ($data[$key]['SSL'] == 'no') {
            $icon_ssl = 'fas fa-circle-xmark';
          }
          if ($data[$key]['SSL'] == 'yes') {
            $icon_ssl = 'fas fa-circle-check';
          }
          if ($web_stats == 'no') {
            $icon_webstats = 'fas fa-circle-xmark';
          } else {
            $icon_webstats = 'fas fa-circle-check';
          }
        } else {
          if ($data[$key]['SSL'] == 'no') {
            $icon_ssl = 'fas fa-circle-xmark status-icon red';
          }
          if ($data[$key]['SSL'] == 'yes') {
            $icon_ssl = 'fas fa-circle-check status-icon green';
          }
          if ($web_stats == 'no') {
            $icon_webstats = 'fas fa-circle-xmark status-icon red';
          } else {
            $icon_webstats = 'fas fa-circle-check status-icon green';
          }
        }
      ?>
      <div class="l-unit <?php if ($data[$key]['SUSPENDED'] == 'yes') echo 'l-unit--suspended';?> animate__animated animate__fadeIn" v_section="web" v_unit_id="<?=$key?>"
        id="web-unit-<?=$i?>" sort-ip="<?=str_replace('.', '', $data[$key]['IP'])?>"
        sort-date="<?=strtotime($data[$key]['DATE'].' '.$data[$key]['TIME'])?>"
        sort-name="<?=$key?>" sort-bandwidth="<?=$data[$key]['U_BANDWIDTH']?>" sort-disk="<?=$data[$key]['U_DISK']?>">
        <div class="l-unit__col l-unit__col--right">
          <div class="clearfix l-unit__stat-col--left super-compact">
            <input id="check<?=$i?>" class="ch-toggle" type="checkbox" title="<?=_('Select');?>" name="domain[]" value="<?=$key?>" <?=$display_mode;?>>
          </div>
          <div class="clearfix l-unit__stat-col--left wide-4 truncate">
            <b>
              <?php if ($read_only === 'true') {?>
                <?=$key?>
              <?php } else {
                $aliases = explode(',', $data[$key]['ALIAS']);
                $alias_new = array();
                foreach($aliases as $alias){
                  if($alias != 'www.'.$key){
                    $alias_new[] = trim($alias);
                  }
                }
                ?>
                <a href="/edit/web/?domain=<?=$key?>&token=<?=$_SESSION['token']?>" title="<?=_('Editing Domain');?>: <?=$key?>"><?=$key?><?php if( !empty($alias_new) && !empty($data[$key]['ALIAS']) ){ echo " <span class=\"hint\">(".implode(',',$alias_new).")"; } ?></a>
              <?php } ?>
            </b>
          </div>
          <!-- START QUICK ACTION TOOLBAR AREA -->
          <div class="clearfix l-unit__stat-col--left compact-4 text-right">
            <div class="l-unit-toolbar__col l-unit-toolbar__col--right u-noselect">
              <div class="actions-panel clearfix">
                <?php if (!empty($data[$key]['STATS'])) { ?>
                  <div class="actions-panel__col actions-panel__logs shortcut-w" key-action="href"><a href="http://<?=$key?>/vstats/" rel="noopener" target="_blank" rel="noopener" title="<?=_('Statistics');?>"><i class="fas fa-chart-bar status-icon maroon status-icon dim"></i></a></div>
                <?php } ?>
                  <div class="actions-panel__col actions-panel__view" key-action="href"><a href="http://<?=$key?>/" rel="noopener" target="_blank"><i class="fas fa-square-up-right status-icon lightblue status-icon dim"></i></a></div>
                <?php if ($read_only === 'true') {?>
                  <!-- Restrict ability to edit, delete, or suspend web domains when impersonating the 'admin' account -->
                  &nbsp;
                <?php } else { ?>
                  <?php if ($data[$key]['SUSPENDED'] == 'no') {?>
                    <div class="actions-panel__col actions-panel__edit shortcut-enter" key-action="href"><a href="/edit/web/?domain=<?=$key?>&token=<?=$_SESSION['token']?>" title="<?=_('Editing Domain');?>"><i class="fas fa-pencil status-icon orange status-icon dim"></i></a></div>
                  <?php } ?>
                  <div class="actions-panel__col actions-panel__logs shortcut-l" key-action="href"><a href="/list/web-log/?domain=<?=$key?>&type=access#" title="<?=_('AccessLog');?>"><i class="fas fa-binoculars status-icon purple status-icon dim"></i></a></div>
                  <div class="actions-panel__col actions-panel__suspend shortcut-s" key-action="js">
                    <a id="<?=$spnd_action ?>_link_<?=$i?>" class="data-controls do_<?=$spnd_action?>" title="<?=_($spnd_action)?>">
                      <i class="fas <?=$spnd_icon?> status-icon highlight status-icon dim do_<?=$spnd_action?>"></i>
                      <input type="hidden" name="<?=$spnd_action?>_url" value="/<?=$spnd_action?>/web/?domain=<?=$key?>&token=<?=$_SESSION['token']?>">
                      <div id="<?=$spnd_action?>_dialog_<?=$i?>" class="dialog js-confirm-dialog-suspend" title="<?=_('Confirmation');?>">
                        <p><?=sprintf($spnd_confirmation,$key)?></p>
                      </div>
                    </a>
                  </div>
                  <div class="actions-panel__col actions-panel__delete shortcut-delete" key-action="js">
                    <a id="delete_link_<?=$i?>" class="data-controls do_delete" title="<?=_('delete');?>">
                      <i class="fas fa-trash status-icon red status-icon dim do_delete"></i>
                      <input type="hidden" name="delete_url" value="/delete/web/?domain=<?=$key?>&token=<?=$_SESSION['token']?>">
                      <div id="delete_dialog_<?=$i?>" class="dialog js-confirm-dialog-delete" title="<?=_('Confirmation');?>">
                        <p><?=sprintf(_('DELETE_DOMAIN_CONFIRMATION'),$key)?></p>
                      </div>
                    </a>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- END QUICK ACTION TOOLBAR AREA -->
          <div class="clearfix l-unit__stat-col--left text-center"><?=empty($ips[$data[$key]['IP']]['NAT']) ? $data[$key]['IP'] : "{$ips[$data[$key]['IP']]['NAT']}"; ?></div>
          <div class="clearfix l-unit__stat-col--left text-center"><b><?=humanize_usage_size($data[$key]['U_DISK'])?></b> <span class="u-text-small"><?=humanize_usage_measure($data[$key]['U_DISK'])?></span></div>
          <div class="clearfix l-unit__stat-col--left text-center compact"><b><?=humanize_usage_size($data[$key]['U_BANDWIDTH'])?></b> <span class="u-text-small"><?=humanize_usage_measure($data[$key]['U_BANDWIDTH'])?></span></div>
          <div class="clearfix l-unit__stat-col--left text-center">
            <i class="fas <?=$icon_ssl;?>"></i>
          </div>
          <div class="clearfix l-unit__stat-col--left text-center compact">
            <i class="fas <?=$icon_webstats;?>"></i>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<div id="vstobjects">
  <div class="l-separator"></div>
  <div class="l-center">
    <div class="l-unit-ft">
      <div class="l-unit__col l-unit__col--right">
        <?php printf(ngettext('%d web domain', '%d web domains', $i),$i); ?>
      </div>
    </div>
  </div>
</div>
