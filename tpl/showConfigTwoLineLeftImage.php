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
                	<input name="key[<?php echo hsc($key) ?>]" value="<?php echo hsc($key) ?>" />
                </td>
                <td>
                    <input
                        type="text"
                        name="value[<?php echo hsc($key) ?>]"
                        value="<?php echo hsc($value) ?>"
                        class="edit"
                        id="confmanager_item<?php echo $configCounter ?>"
                        />
                </td>
                <td>
	                    <?php include DOKU_PLUGIN . 'confmanager/tpl/deleteButton.php' ?>
                    	<img class="upload_image_button clickable"
                    		 src="<?php echo 'lib/plugins/confmanager/icons/picture_edit.png' ?>"
                        	 alt="<?php echo hsc($helper->getLang('edit_icon_action')) ?>"
                        	 title="<?php echo hsc($helper->getLang('edit_icon_action_tooltip')) ?>" />
                </td>
            </tr>
            <?php $configCounter++ ?>
        <?php endforeach ?>
        <tr>
            <td>
                <input class="newItem" type="text" name="newKey[]">
            </td>
            <td>
                <input class="newItem submitOnTab" type="text" name="newValue[]" />
            </td>
            <td/>
        </tr>
	</table>
	<?php $this->helper->tplSaveButton() ?>
	<div class="popup">
		<h3 class="popupheader">File Upload</h3>
		<div class="popupcontent">
			<form id="fileuploadform" enctype="multipart/form-data" method="post" action="<?php echo 'lib/exe/ajax.php' ?>">
				<div class="popupprompt"><?php echo $helper->getLang('file_upload_prompt') ?></div>
				<input type="file" name="icon" />
				<br/>
				<br/>
				<input type="submit" class="button saveButton right" value="<?php echo $helper->getLang('upload') ?>" />
				<span class="right spacer"></span>
				<input id="popup_cancel" type="submit" class="right"  value="<?php echo $helper->getLang('cancel') ?>" />
				<input type="hidden" name="call" value="confmanager_upload" />
				<input type="hidden" name="configId" id="configIdParam" />
				<input type="hidden" name="key" id="keyParam" />
			</form>
			<div class="progress">
		        <div class="bar"></div>
		        <div class="percent"></div>
	        </div>
        </div>
    </div>
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
</div>