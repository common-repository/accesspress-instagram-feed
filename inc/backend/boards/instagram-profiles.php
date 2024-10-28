<?php defined('ABSPATH') or die("No script kiddies please!"); ?>
<div class="apsc-boards-tabs" id="apsc-board-social-profile-settings">
    <div class="apsc-tab-wrapper">
        <?php
        $username = '';
        $user_id = '';
        $access_token = '';
        if (isset($apif_settings['app_id']) && $apif_settings['app_id'] != '') {
            $app_id = esc_attr($apif_settings['app_id']);
        } else {
            $app_id = '1195004343537123774';
        }
        if (isset($apif_settings['app_secret']) && $apif_settings['app_secret'] != '') {
            $app_secret = esc_attr($apif_settings['app_secret']);
        } else {
            $app_secret = '5ea56ffgtyhjhje4560f2db96f';
        }
        if (isset($apif_settings['username']) && $apif_settings['username'] != '') {
            $username = esc_attr($apif_settings['username']);
        } else {
            $username = '';
        }
        if (isset($apif_settings['user_id']) && $apif_settings['user_id'] != '') {
            $user_id = esc_attr($apif_settings['user_id']);
        } else {
            $user_id = '';
        }
        if (isset($apif_settings['access_token']) && $apif_settings['access_token'] != '') {
            $access_token = esc_attr($apif_settings['access_token']);
        } else {
            $access_token = '';
        }
        ?>
        <!--Instagram-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Plugin Settings', 'accesspress-instagram-feed') ?></h4>
            <div class="updated settings-error notice is-dismissible">
                <p><b><?php _e("Note: In this plugin, we have used instagram basic display api.On using basic display api, you can fetch your medias and get your profile's username and media count.Basic display api has provided only few of these criteria to fetch.But if you want to get more data such as get instagram likes count,comments count,your profile picture, other public profile user's medias and hashtag based search,please upgrade to pro version of this plugin where we have used instagram graph api.", 'accesspress-instagram-feed'); ?></b></p></br>
            </div>
            <br/>
            <div class="apsc-option-extra">
                <div id="login_with_instagram">
<a target="_self" href="https://demo.accesspressthemes.com/wordpress-plugins/insta-feed/basic-api/index.php?back_url=<?php echo admin_url('admin.php?page=if-instagram-feed'); ?>">Login with Instagram</a>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label for='instagram_username'><?php _e('Your instagram username', 'accesspress-instagram-feed'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="instagram[username]" id='instagram_username' value="<?php
                    if (isset($_GET["username"])) {
                        echo esc_attr($_GET["username"]);
                    } else {
                        echo esc_attr($username);
                    }
                           ?>"/>
                        <div class="apsc-option-note"><?php _e('Note: If not loaded automatically after clicking <strong>Get Access Token</strong> button provided above, please enter the instagram username.', 'accesspress-instagram-feed'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label for='instagram_user_id'><?php _e('Your instagram user ID', 'accesspress-instagram-feed'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="instagram[user_id]" id='instagram_user_id' value="<?php
                               if (isset($_GET["userid"])) {
                                   echo esc_attr($_GET["userid"]);
                               } else {
                                   echo esc_attr($user_id);
                               }
                           ?>"/><?php //var_dump($user_id); ?>
                        <div class="apsc-option-note"><?php _e('Note: If not loaded automatically after clicking <strong>Get Access Token</strong> button provided above, please check if you have followed every step mentioned above properly.', 'accesspress-instagram-feed'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label for='instagram_access_token'><?php _e('Your instagram access token', 'accesspress-instagram-feed'); ?></label>
                    <div class="apsc-option-field">
                        <!--<input type="text" name="instagram[access_token]" id='instagram_access_token' value="<?php echo esc_attr($access_token); ?>"/>-->
                        <input type="text" name="instagram[access_token]" id='instagram_access_token' value="<?php
                        if (isset($_GET["access_token"])) {
                            echo esc_attr($_GET["access_token"]);
                        } else {
                            echo esc_attr($access_token);
                        }
                           ?>"/>
                        <div class="apsc-option-note">
<?php _e('Please enter the instagram Access Token.You can get this by clicking the above button. If new access token not received in the above Instagram access token field, please check if you have followed every step mentioned above properly.', 'accesspress-instagram-feed'); ?>
<?php _e("Please don't forget to click save button.", 'accesspress-instagram-feed'); ?>
                        </div>
                    </div>
                </div>


                <div class="apsc-option-inner-wrapper">
                    <label for='enablecache'><?php _e('Enable Cache?', 'accesspress-instagram-feed'); ?></label>
                    <div class="apsc-option-field">
                        <input type="checkbox" name="instagram[enable_cache]" id="enablecache" value="1" <?php
if (isset($apif_settings['enable_cache'])) {
    checked($apif_settings['enable_cache'], '1');
}
?> />
                        <div class="apsc-option-note"><?php _e('Please enable this option if you want to use the cache on the first load.', 'accesspress-instagram-feed'); ?></div>
                    </div>
                </div>

                <div class="apsc-option-inner-wrapper">
                    <label for='enablecache'><?php _e('Cache Period', 'accesspress-instagram-feed'); ?></label>
                    <div class="apsc-option-field">
                        <input type="number" step="0.01" min='0' max='24' name="instagram[cache_period]" value="<?php
                        if (isset($apif_settings['cache_period']) && $apif_settings['cache_period'] != '') {
                            echo esc_attr($apif_settings['cache_period']);
                        }
?>" />
                        <div class="apsc-option-note"><?php _e('Please set the value in hours only. Default if left empty is set to 24.', 'accesspress-instagram-feed'); ?></div>
                    </div>
                </div>

            </div>
        </div>
        <!--Instagram-->
<?php include (APIF_INST_PATH . '/inc/backend/submit-button.php'); ?>
    </div>
</div>