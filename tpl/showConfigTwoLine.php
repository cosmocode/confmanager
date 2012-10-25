<?php $helper = plugin_load('helper', 'confmanager'); ?>
<div class="table">
	<h3><?php echo $helper->getLang('user_defined_values') ?></h3>
    <table class="inline confmanager_twoLine">
        <tr>
            <th><?php echo $helper->getLang('key') ?></th>
            <th><?php echo $helper->getLang('value') ?></th>
            <th><?php echo $helper->getLang('actions') ?></th>
        </tr>
        <?php $lineCounter = 0; ?>
        <?php foreach ($local as $key => $value): ?>
            <tr id="tableLine<?php echo $lineCounter ?>">
                <td>
                	<label for="value<?php echo $lineCounter ?>" id="key<?php echo $lineCounter ?>">
                        <?php echo hsc($key) ?>
                    </label>
                </td>
                <td>
                    <input
                    	id="value<?php echo $lineCounter ?>"
                        type="text"
                        name="line[<?php echo hsc($key) ?>]"
                        value="<?php echo hsc($value) ?>"
                        class="edit"
                        />
                </td>
                <td>
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
    <h3><?php echo $helper->getLang('default_values') ?></h3>
	<table class="inline confmanager_twoLine">
		<tr>
			<th><?php echo $helper->getLang('key') ?></th>
            <th><?php echo $helper->getLang('value') ?></th>
		</tr>
		<?php foreach($default as $key => $value): ?>
			<tr>
				<td class="defaultValue">
					<?php echo hsc($key); ?>
				</td>
				<td class="defaultValue">
					<?php echo hsc($value); ?>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
</div>