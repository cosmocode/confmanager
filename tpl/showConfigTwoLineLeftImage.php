<?php $helper = plugin_load('helper', 'confmanager'); ?>
<div class="table">
    <table class="inline confmanager_twoLineLeftImage">
        <tr>
            <th colspan="3"><?php echo $helper->getLang('config values') ?></th>
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
            <tr<?php if ($defaultValue) echo ' class="confmanager_defaultValue"' ?>>
                <td>
                    <label for="confmanager_item<?php echo $configCounter ?>">
                        <?php if ($image !== ''): ?>
                            <img src="<?php echo hsc($image) ?>" alt="" />
                        <?php endif ?>
                        <?php echo hsc($key) ?>
                    </label>
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
                    <?php if ($defaultValue): ?>
                        <?php echo hsc($helper->getLang('cannot change default file icon')) ?>
                    <?php else: ?>
                        <input
                            type="file"
                            name="icon[<?php echo hsc($key) ?>]"
                            class="edit"
                            />
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