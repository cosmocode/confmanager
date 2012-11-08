<?php $helper = plugin_load('helper', 'confmanager'); ?>
<?php $lineCounter = 0; ?>
<div class="table">
	<h3><?php echo $helper->getLang('user_defined_values') ?></h3>
	<table class="inline confmanager_singleLine">
        <tr>
            <th><?php echo $helper->getLang('value') ?></th>
            <th><?php echo $helper->getLang('actions') ?></th>
        </tr>
        <?php foreach ($local as $config): ?>
            <?php
            $defaultValue = false;
            if (in_array($config, $default)) {
                $defaultValue = true;
            }
            ?>
            <tr id="tableLine<?php echo $lineCounter++ ?>">
                <td>
                <input
                		id="value<?php echo $lineCounter-1 ?>"
                        type="text"
                        name="line[]"
                        value="<?php echo hsc($config) ?>"
                        class="<?php echo $class ?>"
                        <?php if ($defaultValue) echo 'disabled="disabled"' ?>
 				/>
                </td>
                <td>
                    <a onclick="deleteLine(<?php echo $lineCounter-1 ?>)">
	                    <img src="<?php echo 'lib/plugins/confmanager/icons/delete.png' ?>"
	                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
	                        	title="<?php echo hsc($helper->getLang('delete_action_tooltip')) ?>" />
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td>
                <input type="text" name="line[]" />
            </td>
        </tr>
    </table>
    <?php $this->helper->tplSaveButton() ?>
	<h3><?php echo $helper->getLang('default_values') ?></h3>
	<table class="inline confmanager_singleLine">
		<tr>
			<th><?php echo $helper->getLang('value') ?></th>
            <th><?php echo $helper->getLang('actions') ?></th>
		</tr>
		<?php foreach($default as $item): ?>
			<tr>
				<td>
					<div class="defaultValue" title="<?php echo hsc($helper->getLang('default_value_tooltip')) ?>">
                    <?php echo hsc($item) ?>
                    </div>
				</td>
				<td>
					<img src="<?php echo 'lib/plugins/confmanager/icons/delete_disabled.png' ?>"
                        alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
                        title="<?php echo hsc($helper->getLang('delete_action_tooltip_disabled')) ?>" />
                </td>
			</tr>
		<?php endforeach ?>
	</table>
</div>