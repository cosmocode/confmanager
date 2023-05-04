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
            <?php $isDefault = array_key_exists($key, $default) ?>

            <tr>
                <td>
                	<input
                        type="text"
                        name="keys[]"
                        id="key<?php echo $lineCounter ?>"
                        value="<?php echo hsc($key) ?>"
                        class="key"
                    >
                </td>
                <td>
                    <input
                    	id="value<?php echo $lineCounter ?>"
                        type="text"
                        name="values[<?php echo hsc($key) ?>]"
                        value="<?php echo hsc($value) ?>"
                        class="edit value"
                        />
                    <?php if($isDefault): ?>
                        <br>
                        <span class="overriddenValue">
                            <?php if($local[$key] === ''): ?>
                                <?php echo $helper->getLang('disablesdefault') ?>
                            <?php else : ?>
                                <?php echo $helper->getLang('modifiesdefault') ?>
                            <?php endif ?>
                        </span>
                    <?php endif ?>
                </td>
                <td>
                    <?php include DOKU_PLUGIN . 'confmanager/tpl/deleteButton.php' ?>
                </td>
            </tr>
            <?php $lineCounter++; ?>
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
		<table class="inline confmanager_twoLine">
			<tr>
				<th><?php echo $helper->getLang('key') ?></th>
	            <th><?php echo $helper->getLang('value') ?></th>
                <th><?php echo $helper->getLang('actions') ?></th>
            </tr>
			<?php foreach($default as $key => $value): ?>
                <?php $isOverridden = array_key_exists($key, $local) ?>

                <tr<?php if($isOverridden): ?> class="overridden"<?php endif ?>>
					<td class="defaultValue">
						<span class="default_key"><?php echo hsc($key); ?></span>
					</td>
					<td class="defaultValue">
						<span class="default_value"><?php echo hsc($value); ?></span>
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
					</td>
                    <td class="default_value">
                        <?php include DOKU_PLUGIN . 'confmanager/tpl/disableButton.php' ?>
                    </td>
				</tr>
			<?php endforeach ?>
		</table>
	</div>
</div>
