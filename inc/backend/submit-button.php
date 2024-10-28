<?php 
defined('ABSPATH') or die("No script kiddies please!");

wp_nonce_field('apif_settings_action', 'apif_settings_nonce');
                        ?>
<div id="optionsframework-submit" class="ap-settings-submit">
    <input type="submit" class="button button-primary" value="Save all changes" name="ap_settings_submit"/>
</div>