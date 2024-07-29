<?php $helper = plugin_load('helper', 'confmanager');
/**
 * @var ConfigManagerTwoLineLeftImageConfigCascade|ConfigManagerTwoLineRightImageConfigCascade $this
 * @var array $local
 * @var array $default
 * @var array[] $configs
 */ ?>
<div class="table">
	<h3><?php echo $helper->getLang('user_defined_values') ?></h3>
	<table class="inline confmanager_twoLine<?php echo ucfirst($this->imageAlignment) ?>Image">
		<tr>
            <th><?php echo $helper->getLang('key') ?></th>
            <th><?php echo $helper->getLang('value') ?></th>
            <th><?php echo $helper->getLang('actions') ?></th>
        </tr>
        <?php foreach($local as $key => $value):?>
        <?php $image = $this->getImage('local', $key); ?>
        <?php $isDefault = array_key_exists($key, $default) ?>
        <tr>
                <td>
                	<?php if ($image !== '' && $this->imageAlignment == 'left'): ?>
                		<img src="<?php echo hsc($image) ?>" alt="" class="exampleimage <?php echo hsc($this->internalName) ?>" />
                	<?php endif ?>
                	<input
                        name="keys[]"
                        value="<?php echo hsc($key) ?>"
                        class="key"
                    />
                </td>
                <td>
                    <?php if ($image !== '' && $this->imageAlignment == 'right'): ?>
                        <img src="<?php echo hsc($image) ?>" alt="" class="exampleimage <?php echo hsc($this->internalName) ?>" />
                    <?php endif ?>
                    <input
                        type="text"
                        name="values[]"
                        value="<?php echo hsc($value) ?>"
                        class="edit value"
                        />
                    <?php if($isDefault): ?>
                        <br>
                        <span class="overriddenValue">
                            <?php if($value === ''): ?>
                                <?php echo $helper->getLang('disablesdefault') ?>
                            <?php else : ?>
                                <?php echo $helper->getLang('modifiesdefault') ?>
                            <?php endif ?>
                        </span>
                    <?php endif ?>
                </td>
                <td>
                    <?php include DOKU_PLUGIN . 'confmanager/tpl/deleteButton.php' ?>

                    <?php if($isDefault) : ?>
	                    <img class="upload_image_button"
							src="<?php echo DOKU_PLUGIN_ICONS.'picture_edit_disabled.png' ?>"
							alt="<?php echo hsc($helper->getLang('edit_icon_action_disabled')) ?>"
							title="<?php echo hsc($helper->getLang('edit_icon_action_tooltip_disabled')) ?>" />
                    <?php else : ?>
	                    <img class="upload_image_button clickable"
							src="<?php echo DOKU_PLUGIN_ICONS.'picture_edit.png' ?>"
							alt="<?php echo hsc($helper->getLang('edit_icon_action')) ?>"
							title="<?php echo hsc($helper->getLang('edit_icon_action_tooltip')) ?>" />
                    <?php endif ?>


					<?php if($image !== '' && !$isDefault) : ?>
						<img class="delete_image_button clickable"
                       		src="<?php echo DOKU_PLUGIN_ICONS.'picture_delete.png' ?>"
                       		alt="<?php echo hsc($helper->getLang('delete_icon_action')) ?>"
                       		title="<?php echo hsc($helper->getLang('delete_icon_action_tooltip')) ?>" />
                    <?php else : ?>
                       	<img src="<?php echo DOKU_PLUGIN_ICONS.'picture_delete_disabled.png' ?>"
                       		 alt="<?php echo hsc($helper->getLang('delete_icon_action_disabled')) ?>"
                       		title="<?php echo hsc($helper->getLang('delete_icon_action_tooltip_disabled')) ?>" />
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td>
                <input class="newItem key" type="text" name="newKey[]">
            </td>
            <td>
                <input class="newItem value submitOnTab" type="text" name="newValue[]" />
            </td>
            <td/>
        </tr>
	</table>
	<?php $this->helper->tplSaveButton() ?>
</div>
	<h3 class="clickable hoverFeedback" title="<?php echo $helper->getLang('toggle_defaults') ?>">
		<a id="toggleDefaults">
			<?php echo $helper->getLang('default_values') ?>
			<img id="defaults_toggle_button"/>
		</a>
	</h3>
	<div class="defaults">
		<p>
			<?php echo hsc($helper->getLang('defaults_description')) ?>
		</p>
	    <table class="inline confmanager_twoLineLeftImage">
	        <tr>
	            <th><?php echo $helper->getLang('key') ?></th>
	            <th><?php echo $helper->getLang('value') ?></th>
	            <th><?php echo $helper->getLang('actions') ?></th>
	        </tr>
	        <?php foreach ($default as $key => $value): ?>
	        	<?php $isOverridden = array_key_exists($key, $local) ?>
	            <?php $image = $this->getImage('default', $key); ?>
	            <tr<?php if($isOverridden): ?> class="overridden"<?php endif ?>>
	                <td>
	                	<div class="defaultValue" title="<?php echo hsc($helper->getLang('default_value_tooltip')) ?>">
	                		<?php if ($image !== '' && $this->imageAlignment == 'left'): ?>
	                            <img src="<?php echo hsc($image) ?>" alt="" class="exampleimage <?php echo hsc($this->internalName) ?>" />
	                        <?php endif ?>
                            <span class="default_key"><?php echo hsc($key) ?></span>
	                	</div>
	                </td>
	                <td>
	                	<div class="defaultValue" title="<?php echo hsc($helper->getLang('default_value_tooltip')) ?>">
	                        <?php if ($image !== '' && $this->imageAlignment == 'right'): ?>
	                            <img src="<?php echo hsc($image) ?>" alt="" class="exampleimage <?php echo hsc($this->internalName) ?>" />
	                        <?php endif ?>
                            <span class="default_value"><?php echo hsc($value) ?></span>
                            <?php if($isOverridden): ?>
                                <br>
                                <span class="overriddenValue">
                                    <?php if($local[$key] === ''): ?>
                                        <?php echo $helper->getLang('disabledbylocal') ?>
                                    <?php else : ?>
                                        <?php echo $helper->getLang('modifiedbylocal') ?>
                                    <?php endif ?>
                                </span>
                            <?php endif ?>
	                    </div>
	                </td>
	                <td class="defaultValue">
                        <?php include DOKU_PLUGIN . 'confmanager/tpl/disableButton.php' ?>

                        <img src="<?php echo DOKU_PLUGIN_ICONS.'picture_edit_disabled.png' ?>"
                            alt="<?php echo hsc($helper->getLang('edit_icon_action')) ?>"
                            title="<?php echo hsc($helper->getLang('edit_icon_action_tooltip_disabled')) ?>" />
	                </td>
	            </tr>
	        <?php endforeach ?>
	    </table>
    </div>
</div>
