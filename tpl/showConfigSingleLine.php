<?php $helper = plugin_load('helper', 'confmanager'); ?>
<div class="table">
    <table class="inline confmanager_singleLine">
        <tr>
            <th><?php echo $helper->getLang('config values') ?></th>
        </tr>
        <?php foreach ($configs as $config): ?>
            <?php
            $class = 'edit';
            if (in_array($config, $default)) {
                $class .= ' default';
            }
            ?>
            <tr>
                <td>
                    <input
                        type="text"
                        name="line[]"
                        value="<?php echo hsc($config) ?>"
                        class="<?php echo $class ?>"
                        />
                </td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td>
                <input type="text" name="line[]" />
            </td>
        </tr>
    </table>
</div>