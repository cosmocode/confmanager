<?php global $ID; ?>
<div id="plugin__confmanager">

    <h1><?php echo $this->getLang('welcomehead') ?></h1>
    <div class="level1">
        <p>
            <?php echo $this->getLang('welcome') ?>
        </p>
        <form action="<?php echo wl($ID, 'do=admin,page=confmanager') ?>" method="get">
            <input type="hidden" name="do" value="admin" />
            <input type="hidden" name="page" value="confmanager" />
            <label for="confmanager__config__files">
                <?php echo $this->getLang('select_config') ?>
            </label>
            <select name="configFiles" id="confmanager__config__files" class="edit">
                <?php foreach ($configFiles as $config): ?>
                <option><?php echo hsc($config->getFileName()) ?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" value="<?php echo $this->getLang('edit') ?>" class="button" />
        </form>
    </div>
</div>