<?php

/**
 * @package LightSaberTheme
 * =======================
 * Sidebar.php
 * =======================
 * 
 */
if (!is_active_sidebar('lightsaber-sidebar')) {
    return;
}
?>
<aside id="secondary" class="widget-area" role="complementary">
    <?php dynamic_sidebar('lightsaber-sidebar') ?>
</aside>