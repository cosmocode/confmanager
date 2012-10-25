<?php $helper = plugin_load('helper', 'confmanager'); ?>
<?php $lineCounter = 0; ?>
<div class="table">
    <table class="inline confmanager_twoLine">
        <tr>
            <th><?php echo $helper->getLang('key') ?></th>
            <th><?php echo $helper->getLang('value') ?></th>
            <th><?php echo $helper->getLang('actions') ?></th>
        </tr>
        <?php foreach ($configs as $key => $value): ?>
            <?php
            $defaultValue = false;
            if (array_key_exists($key, $default)) {
                if ($default[$key] === $value) {
                    $defaultValue = true;
                }
            }
            ?>
            <tr id="tableLine<?php echo $lineCounter ?>">
                <td>
                <?php if ($defaultValue): ?>
                	<div class="defaultValue" title="<?php echo hsc($helper->getLang('default_value_tooltip')) ?>">
                        <?php echo hsc($key) ?>
                    </div>
                <?php else: ?>
                	<label for="value<?php echo $lineCounter ?>" id="key<?php echo $lineCounter ?>">
                        <?php echo hsc($key) ?>
                    </label>
                <?php endif ?>
                </td>
                <td>
                <?php if ($defaultValue): ?>
                	<div class="defaultValue" title="<?php echo hsc($helper->getLang('default_value_tooltip')) ?>">
                        <?php echo hsc($value) ?>
                    </div>
                <?php else: ?>
                    <input
                    	id="value<?php echo $lineCounter ?>"
                        type="text"
                        name="line[<?php echo hsc($key) ?>]"
                        value="<?php echo hsc($value) ?>"
                        class="edit"
                        />
                <?php endif ?>
                </td>
                <td>
                	<?php if ($defaultValue): ?>
                	<img src="<?php echo 'lib/plugins/confmanager/icons/delete_disabled.png' ?>"
                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
                        	title="<?php echo hsc($helper->getLang('delete_action_tooltip_disabled')) ?>" />
                    <img src="<?php echo 'lib/plugins/confmanager/icons/textfield_key_disabled.png' ?>"
                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
                        	title="<?php echo hsc($helper->getLang('edit_key_action_tooltip_disabled')) ?>" />
                    <?php else: ?>
                    <a onclick="deleteLine(<?php echo $lineCounter ?>)">
	                    <img src="<?php echo 'lib/plugins/confmanager/icons/delete.png' ?>"
	                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
	                        	title="<?php echo hsc($helper->getLang('delete_action_tooltip')) ?>" />
                    </a>
                    <a onclick="renameLine(<?php echo $lineCounter ?>)">
	                    <img src="<?php echo 'lib/plugins/confmanager/icons/textfield_key.png' ?>"
	                        	alt="<?php echo hsc($helper->getLang('edit_key_action')) ?>"
	                        	title="<?php echo hsc($helper->getLang('edit_key_action_tooltip')) ?>" />
                    </a>
                    <?php endif ?>
                </td>
            </tr>
            <?php $lineCounter++ ?>
        <?php endforeach ?>
        <tr>
            <td>
                <input type="text" name="newKey[]">
            </td>
            <td>
                <input type="text" name="newValue[]" />
            </td>
        </tr>
    </table>
</div>