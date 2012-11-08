<?php $helper = plugin_load('helper', 'confmanager'); ?>
<div class="table">
	<h3><?php echo $helper->getLang('user_defined_values') ?></h3>
	<table class="inline confmanager_twoLineLeftImage">
		<tr>
            <th><?php echo $helper->getLang('key') ?></th>
            <th><?php echo $helper->getLang('value') ?></th>
            <th><?php echo $helper->getLang('actions') ?></th>
        </tr>
        <?php $configCounter = 0 ?>
        <?php foreach($local as $key => $value):?>
        <?php $image = $this->getImage($key); ?>
        <tr>
                <td>
                	<?php if ($image !== ''): ?>
                		<img src="<?php echo hsc($image) ?>" alt="" />
                	<?php endif ?>
                	<input id="confmanager_item_key<?php echo $configCounter ?>" value="<?php echo hsc($key) ?>" />
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
	                    <a href="#">
	                        <img src="lib/plugins/confmanager/icons/delete.png"
	                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
	                        	title="<?php echo hsc($helper->getLang('delete_action_tooltip')) ?>"
	                        />
                        </a>
                    	<a href="#">
	                    	<img src="<?php echo 'lib/plugins/confmanager/icons/picture_edit.png' ?>"
	                        	alt="<?php echo hsc($helper->getLang('edit_icon_action')) ?>"
	                        	title="<?php echo hsc($helper->getLang('edit_icon_action_tooltip')) ?>" />
                    	</a>
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
	<?php $this->helper->tplSaveButton() ?>
	<h3><?php echo $helper->getLang('default_values') ?></h3>
    <table class="inline confmanager_twoLineLeftImage">
        <tr>
            <th><?php echo $helper->getLang('key') ?></th>
            <th><?php echo $helper->getLang('value') ?></th>
            <th><?php echo $helper->getLang('actions') ?></th>
        </tr>
        <?php foreach ($default as $key => $value): ?>
            <?php $image = $this->getImage($key); ?>
            <tr>
                <td>
                	<div class="defaultValue" title="<?php echo hsc($helper->getLang('default_value_tooltip')) ?>">
                		<?php if ($image !== ''): ?>
                            <img src="<?php echo hsc($image) ?>" alt="" />
                        <?php endif ?>
                        <?php echo hsc($key) ?>
                	</div>
                </td>
                <td>
                	<div class="defaultValue" title="<?php echo hsc($helper->getLang('default_value_tooltip')) ?>">
                        <?php echo hsc($value) ?>
                    </div>
                </td>
                <td class="default_value">
                       <img src="lib/plugins/confmanager/icons/delete_disabled.png"
                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
                        	title="<?php echo hsc($helper->getLang('delete_action_tooltip_disabled')) ?>" />
                        <img src="<?php echo 'lib/plugins/confmanager/icons/picture_edit_disabled.png' ?>"
                        	alt="<?php echo hsc($helper->getLang('edit_icon_action')) ?>"
                        	title="<?php echo hsc($helper->getLang('edit_icon_action_tooltip_disabled')) ?>" />
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>