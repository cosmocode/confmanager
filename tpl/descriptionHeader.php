<?php $helper = plugin_load('helper', 'confmanager'); ?>
<script type="text/javascript">
	function toggleDescription() {
		$('#description').toggle();
	}
</script>
<a href="javascript:toggleDescription()"><?php echo $helper->getLang('toggle_description') ?></a>