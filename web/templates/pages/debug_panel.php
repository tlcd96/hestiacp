<div class="debug-panel-header"><?=_('Debug mode is enabled.');?> <a href="javascript:elementHideShow('debug-panel')"><?=_('Show / Hide Panel');?></a></div>
<div class="debug-panel-contents animate__animated animate__fadeIn" id="debug-panel" style="display:none;">
  <?php
    echo "<h3>Server Variables</h3>";
    foreach ($_SERVER as $key=>$val)
    echo "<b>".$key."= </b> ".$val."  ";
  ?>
  <?php
    echo "<h3>Session Variables</h3>";
    foreach ($_SESSION as $key=>$val)
    echo "<b>".$key."= </b> ".$val."  ";
  ?>
  <?php
    echo "<h3>POST Variables</h3>";
    foreach ($_POST as $key=>$val)
    echo "<b>".$key."= </b> ".$val."  ";
  ?>
  <?php
    echo "<h3>GET Variables</h3>";
    foreach ($_GET as $key=>$val)
    echo "<b>".$key."= </b> ".$val."  ";
  ?>
</div>
