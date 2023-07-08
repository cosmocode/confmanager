<?php $helper = plugin_load('helper', 'confmanager');
/**
 * @var ConfigManagerSingleLineCoreConfig $this
 * @var array $local
 * @var array $default
 * @var array[] $configs
 */ ?>
<div class="table">
	<h3><?php echo $helper->getLang('user_defined_values') ?></h3>
	<table class="inline confmanager_singleLine" id="local">
        <tr>
            <th><?php echo $helper->getLang('value') ?></th>
            <th><?php echo $helper->getLang('actions') ?></th>
        </tr>
        <?php $lineCounter = 0; ?>
        <?php foreach ($local as $config): ?>
            <?php
            $isDefault = substr($config,0,1) == DOKU_CONF_NEGATION
                        && in_array(trim(substr($config,1)), $default)
            ?>
            <tr>
                <td>
                    <input
                            id="value<?php echo $lineCounter ?>"
                            type="text"
                            name="line[]"
                            value="<?php echo hsc($config) ?>"
                            class="value"
                    />
                    <?php if($isDefault): ?>
                        <br>
                        <span class="overriddenValue">
                            <?php echo $helper->getLang('disablesdefault') ?>
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
                <input type="text" name="line[]" class="newItem value submitOnTab" />
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
		<table class="inline confmanager_singleLine">
			<tr>
				<th><?php echo $helper->getLang('value') ?></th>
	            <th><?php echo $helper->getLang('actions') ?></th>
			</tr>
			<?php foreach($default as $item): ?>
                <?php $isOverridden = in_array('!' . $item, $local) ?>

                <tr<?php if($isOverridden): ?> class="overridden"<?php endif ?>>
					<td>
						<div class="defaultValue" title="<?php echo hsc($helper->getLang('default_value_tooltip')) ?>">
                            <span class="default_key"><?php echo hsc($item) ?></span>
	                    </div>
                        <?php if($isOverridden): ?>
                            <br>
                            <span class="overriddenValue">
                                <?php echo $helper->getLang('disabledbylocal') ?>
                            </span>
                        <?php endif ?>
					</td>
					<td>
                        <?php include DOKU_PLUGIN . 'confmanager/tpl/disableButton.php' ?>
	                </td>
				</tr>
			<?php endforeach ?>
		</table>
	</div>
</div>
