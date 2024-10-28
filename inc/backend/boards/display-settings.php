<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="apsc-boards-tabs" id="apsc-board-display-settings" style="display: none">
    <div class="apsc-tab-wrapper">
        <div class="apsc-option-inner-wrapper">
            <label style="width:30%;"><?php _e('Choose Themes Layout', 'accesspress-instagram-feed'); ?></label>
            <div class="apsc-option-field">
                <label class="apsc-layouts-preview">
                    <input type="radio" name="instagram[instagram_mosaic]" value="mosaic" <?php if(isset($apif_settings['instagram_mosaic']) && $apif_settings['instagram_mosaic']=='mosaic'){?>checked="checked"<?php }?>/><?php _e('Mosaic layout', 'accesspress-instagram-feed'); ?>
                    <div class="apsc-theme-image"><img src="<?php echo esc_attr(APIF_IMAGE_DIR).'/themes/massonary.png';?>"/></div>
                </label>
                <label class="apsc-layouts-preview">
                    <input type="radio" name="instagram[instagram_mosaic]" value="mosaic_lightview" <?php if(isset($apif_settings['instagram_mosaic']) && $apif_settings['instagram_mosaic']=='mosaic_lightview'){?>checked="checked"<?php }?>/><?php _e('Mosaic LightBox Layout', 'accesspress-instagram-feed'); ?>
                    <div class="apsc-theme-image"><img src="<?php echo esc_attr(APIF_IMAGE_DIR).'/themes/lightbox.png';?>"/></div>
                    <div class="apsc-option-note"><p><?php _e("Note:Lightbox feature won't work for videos.Please, update your free plugin to pro to get more features on lightbox as well as in designs.", 'accesspress-instagram-feed'); ?></p></div>
                </label>
                <label class="apsc-layouts-preview">
                    <input type="radio" name="instagram[instagram_mosaic]" value="slider" <?php if(isset($apif_settings['instagram_mosaic']) && $apif_settings['instagram_mosaic']=='slider'){?>checked="checked"<?php }?>/><?php _e('Slider Layout', 'accesspress-instagram-feed'); ?>
                    <div class="apsc-theme-image"><img src="<?php echo esc_attr(APIF_IMAGE_DIR).'/themes/slider.png';?>"/></div>
                </label>
               <label class="apsc-layouts-preview">
                    <input type="radio" name="instagram[instagram_mosaic]" value="grid_rotator" <?php if(isset($apif_settings['instagram_mosaic']) && $apif_settings['instagram_mosaic']=='grid_rotator'){?>checked="checked"<?php }?>/><?php _e('Grid Rotator', 'accesspress-instagram-feed'); ?>
                    <div class="apsc-theme-image"><img src="<?php echo esc_attr(APIF_IMAGE_DIR).'/themes/grid-rotator.png';?>"/></div>
                </label>
            </div>
        </div>
   <?php
  $followmetext = (isset($apif_settings['followmetext']) && $apif_settings['followmetext'] != '')?esc_attr($apif_settings['followmetext']):'';
   ?>
        <div class="apsc-option-inner-wrapper">
            <div class="apsc-option-field">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Follow Me Text', 'accesspress-instagram-feed') ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="instagram[followmetext]" value="<?php echo $followmetext;?>"/>
                     <p class="description" style="font-size: 12px;font-weight: 500;"><?php _e('Fill your own custom follow me text. Default is set as "Follow Me".', 'accesspress-instagram-feed') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="apsc-option-inner-wrapper">
           <label><?php _e('Font Size', 'accesspress-instagram-feed'); ?></label>
            <div class="apsc-option-field">
                <input type="number" name="instagram[followmefontsize]" value="<?php if(isset($apif_settings['followmefontsize']) && $apif_settings['followmefontsize'] != ''){ echo intval($apif_settings['followmefontsize']); } ?>" />
                <div class="apsc-option-note"><?php _e('Please set custom font size for follow me text.', 'accesspress-instagram-feed'); ?></div>
            </div>
        </div>

        <?php include (APIF_INST_PATH . '/inc/backend/submit-button.php'); ?>
    </div>
</div>
