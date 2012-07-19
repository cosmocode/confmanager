<?php global $ID; ?>
<h1><?php echo $this->helper->getLang('welcomehead') ?></h1>
<div class="level1">
    <p>
        <?php echo $this->helper->getLang('welcome') ?>
    </p>
    <form action="<?php echo wl($ID, 'do=admin,page=confmanager') ?>" method="get">
        <input type="hidden" name="do" value="admin" />
        <input type="hidden" name="page" value="confmanager" />
        <label for="confmanager__config__files">
            <?php echo $this->helper->getLang('select_config') ?>
        </label>
        <select name="configFile" id="confmanager__config__files" class="edit">
            <?php foreach ($configFiles as $config): ?>
            <?php $id = $this->helper->getConfigId($config) ?>
            <option value="<?php echo hsc($id) ?>"
                <?php if ($default === $id): ?>selected="selected"<?php endif ?>>
                <?php echo hsc($config->getName()) ?>
            </option>
            <?php endforeach ?>
        </select>
        <input type="submit" value="<?php echo $this->helper->getLang('edit') ?>" class="button" />
    </form>
</div>
