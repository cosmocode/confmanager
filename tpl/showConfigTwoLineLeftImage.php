<?php $helper = plugin_load('helper', 'confmanager'); ?>
<div class="table">
    <table class="inline confmanager_twoLineLeftImage">
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

            $image = $this->getImage($key);
            ?>
            <tr>
                <td>
                	<?php if ($defaultValue): ?>
                	<div class="defaultValue" title="<?php echo hsc($helper->getLang('default_value_tooltip')) ?>">
                		<?php if ($image !== ''): ?>
                            <img src="<?php echo hsc($image) ?>" alt="" />
                        <?php endif ?>
                        <?php echo hsc($key) ?>
                	</div>
                	<?php else: ?>
                    <label for="confmanager_item<?php echo $configCounter ?>">
                        <?php if ($image !== ''): ?>
                            <img src="<?php echo hsc($image) ?>" alt="" />
                        <?php endif ?>
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
                        type="text"
                        name="line[<?php echo hsc($key) ?>]"
                        value="<?php echo hsc($value) ?>"
                        class="edit"
                        id="confmanager_item<?php echo $configCounter ?>"
                        />
                <?php endif ?>
                </td>
                <td <?php if($defaultValue): ?> class="default_value"<?php endif ?>>
                    <?php if ($defaultValue): ?>
                       <img src="lib/plugins/confmanager/icons/delete_disabled.png"
                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
                        	title="<?php echo hsc($helper->getLang('delete_action_tooltip_disabled')) ?>" />
                        <img src="<?php echo 'lib/plugins/confmanager/icons/textfield_key_disabled.png' ?>"
                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
                        	title="<?php echo hsc($helper->getLang('edit_key_action_tooltip_disabled')) ?>" />
                        <img src="<?php echo 'lib/plugins/confmanager/icons/picture_edit_disabled.png' ?>"
                        	alt="<?php echo hsc($helper->getLang('edit_icon_action')) ?>"
                        	title="<?php echo hsc($helper->getLang('edit_icon_action_tooltip_disabled')) ?>" />
                    <?php else: ?>
                        <!--
                        	<input
	                            type="file"
	                            name="icon[<?php echo hsc($key) ?>]"
	                            class="edit"
	                            />
	                    -->
	                    <a href="#">
	                        <img src="lib/plugins/confmanager/icons/delete.png"
	                        	alt="<?php echo hsc($helper->getLang('delete_action')) ?>"
	                        	title="<?php echo hsc($helper->getLang('delete_action_tooltip')) ?>"
	                        />
                        </a>
                        <a href="#">
	                    	<img src="<?php echo 'lib/plugins/confmanager/icons/textfield_key.png' ?>"
	                        	alt="<?php echo hsc($helper->getLang('edit_key_action')) ?>"
	                        	title="<?php echo hsc($helper->getLang('edit_key_action_tooltip')) ?>" />
                    	</a>
                    	<a href="#">
	                    	<img src="<?php echo 'lib/plugins/confmanager/icons/picture_edit.png' ?>"
	                        	alt="<?php echo hsc($helper->getLang('edit_icon_action')) ?>"
	                        	title="<?php echo hsc($helper->getLang('edit_icon_action_tooltip')) ?>" />
                    	</a>
                    <?php endif ?>
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