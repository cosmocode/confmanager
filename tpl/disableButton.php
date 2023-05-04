<?php if($isOverridden): ?>

    <img src="<?php echo DOKU_PLUGIN_ICONS.'delete_disabled.png' ?>"
         alt="<?php echo hsc($helper->getLang('disable_action')) ?>"
         title="<?php echo hsc($helper->getLang('disable_action_tooltip_disabled')) ?>" />

<?php else : ?>

    <a class="disableButton clickable">
        <img
            src="<?php echo DOKU_PLUGIN_ICONS.'delete.png'?>"
            alt="<?php echo hsc($helper->getLang('disable_action')) ?>"
            title="<?php echo hsc($helper->getLang('disable_action_tooltip')) ?>"
        />
    </a>

<?php endif ?>



