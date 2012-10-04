<?php $helper = plugin_load('helper', 'confmanager'); ?>
<div class="table">
    <table class="inline confmanager_singleLine">
        <tr>
            <th><?php echo $helper->getLang('value') ?></th>
            <th><?php echo $helper->getLang('actions') ?></th>
        </tr>
        <?php foreach ($configs as $config): ?>
            <?php
            $defaultValue = false;
            if (in_array($config, $default)) {
                $defaultValue = true;
            }
            ?>
            <tr>
                <td>
                <?php if ($defaultValue): ?>
                	<div class="defaultValue" title="<?php echo hsc($helper->getLang('default_value_tooltip')) ?>">
                    <?php echo hsc($config) ?>
                    </div>
                <?php else: ?>
                <input
                        type="text"
                        name="line[]"
                        value="<?php echo hsc($config) ?>"
                        class="<?php echo $class ?>"
                        <?php if ($defaultValue) echo 'disabled="disabled"' ?>
 				/>
                <?php endif ?>
                </td>
                <td>
                	<?php if ($defaultValue): ?>
                	<img src="<?php echo 'lib/plugins/confmanager/icons/delete_disabled.png' ?>"
                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
                        	title="<?php echo hsc($helper->getLang('delete_action_tooltip_disabled')) ?>" />
                    <?php else: ?>
                    <a href="#">
	                    <img src="<?php echo 'lib/plugins/confmanager/icons/delete.png' ?>"
	                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
	                        	title="<?php echo hsc($helper->getLang('delete_action_tooltip')) ?>" />
                    </a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td>
                <input type="text" name="line[]" />
            </td>
        </tr>
    </table>
</div>