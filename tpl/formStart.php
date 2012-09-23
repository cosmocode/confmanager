<?php global $ID; ?>
<h2>Config</h2>
<div class="level2">
    <form action="<?php echo wl($ID, 'do=admin,page=confmanager') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="do" value="admin" />
        <input type="hidden" name="page" value="confmanager" />
        <input type="hidden" name="configFile" value="<?php echo hsc($id) ?>" />