<?php
defined('ABSPATH') or die("No script kiddies please!");
global $apif_settings, $insta;
$apif_settings = get_option('apif_settings');
$username = $apif_settings['username']; // your username
$access_token = $apif_settings['access_token'];
$image_like = $apif_settings['active'];
$user_id = !empty($apif_settings['user_id']) ? $apif_settings['user_id'] : '';
$count = 10; // number of images to show
require_once('instagram.php');
if ($username == '' && $access_token == '') {
    $response = array('meta' => array('error_message' => 'Username and access token field is empty. Please configure.'));
} else if ($username == '') {
    $response = array('meta' => array('error_message' => 'Username field is empty.'));
} else if ($access_token == '') {
    $response = array('meta' => array('error_message' => 'Access token field is empty.'));
} else {
    $response = $insta->userMedia();
}

if ($response == NULL) {
    $response = array('meta' => array('error_message' => 'Username field is empty.'));
}

$ins_media_slider = $response;
?>
<?php
$j = 0;
if (isset($ins_media_slider['error']['message'])) {
    ?>
    <h1 class="widget-title-insta"><span><?php echo $ins_media_slider['error']['message']; ?></span></h1> 
<?php } else if (is_array($ins_media_slider['data']) || is_object($ins_media_slider['data'])) {
    ?>
    <div id="owl-demo" class="apif-owl-carousel owl-carousel">
        <?php
        foreach ($ins_media_slider['data'] as $vm):
            if ($count == $j) {
                break;
            }
            $j++;
            $imgslider = $vm['media_url'];
            if (isset($vm['caption'])) {
                $img_alt = $vm['caption'];
            } else {
                $img_alt = '';
            }
            ?>
            <div class="item">
                <?php
                if ($vm['media_type'] == "VIDEO") {
                    $video_link = esc_url($vm['media_url']);
                    ?>
                    <div id="inline-1" style="width:100%;height:100%">
                        <video controls style="width:100%;height:100%">
                            <source src="<?php echo $video_link; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                <?php } else { ?>
                    <img src="<?php echo esc_url($imgslider); ?>" alt='<?php echo esc_attr($img_alt); ?>'/>
                <?php } ?>
            </div>

            <?php
        endforeach;
        ?>
    </div>
    <?php
}
?>
