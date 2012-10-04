<?php $helper = plugin_load('helper', 'confmanager'); ?>
<div class="table">
    <table class="inline confmanager_twoLine">
        <tr>
            <th><?php echo $helper->getLang('key') ?></th>
            <th><?php echo $helper->getLang('value') ?></th>
            <th><?php echo $helper->getLang('actions') ?></th>
        </tr>
        <?php $configCounter = 0 ?>
        <?php foreach ($configs as $key => $value): ?>
            <?php
            $defaultValue = false;
            if (array_key_exists($key, $default)) {
                if ($default[$key] === $value) {
                    $defaultValue = true;
                }
            }
            ?>
            <tr<?php if ($defaultValue) echo ' class="confmanager_defaultValue"' ?>>
                <td>
                    <label for="confmanager_item<?php echo $configCounter ?>">
                        <?php echo hsc($key) ?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="line[<?php echo hsc($key) ?>]"
                        value="<?php echo hsc($value) ?>"
                        class="edit"
                        id="confmanager_item<?php echo $configCounter ?>"
                        />
                </td>
                <td>
                	<img src="icons/delete.png"
                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
                        	title="<?php echo hsc($helper->getLang('delete_action_tooltip')) ?>"
                        />
                </td>
            </tr>
            <?php $configCounter++ ?>
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