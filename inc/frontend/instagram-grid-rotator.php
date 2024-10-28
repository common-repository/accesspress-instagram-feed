<?php
defined('ABSPATH') or die("No script kiddies please!");
global $apif_settings, $insta;
$apif_settings = get_option('apif_settings');
$username = !empty($apif_settings['username']) ? $apif_settings['username'] : ''; // your username
$access_token = !empty($apif_settings['access_token']) ? $apif_settings['access_token'] : '';
$user_id = !empty($apif_settings['user_id']) ? $apif_settings['user_id'] : '';
$layout = $apif_settings['instagram_mosaic'];
$image_like = $apif_settings['active'];
$count = 7; // number of images to show
require_once('instagram.php');
// $ins_media = $insta->userMedia();
$rand_no = rand();
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

$ins_media = $response;
?>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.ri-grid-<?php echo $rand_no; ?>').gridrotator({
            rows: '2',
            columns: '5',
            maxStep: 2,
            interval: 2000,
            preventClick: false,
            w1024: {
                rows: '2',
                columns: '5'
            },
            w768: {
                rows: '2',
                columns: '5'
            },
            w480: {
                rows: '2',
                columns: '5'
            },
            w320: {
                rows: '2',
                columns: '5'
            },
            w240: {
                rows: '2',
                columns: '5'
            }
        });

    });
</script>
<?php
if (isset($ins_media['error']['message'])) {
    ?>
    <h1 class="widget-title-insta"><span><?php echo $ins_media['error']['message']; ?></span></h1>
<?php } else if (is_array($ins_media['data']) || is_object($ins_media['data'])) {
    ?>
    <div class="ri-grid ri-grid-<?php echo $rand_no; ?> apif-ri-grid">
        <img class="ri-loading-image" src="<?php echo esc_attr(APIF_IMAGE_DIR) . '/ripple.gif'; ?>"/>
        <ul>
            <?php
            foreach ($ins_media['data'] as $vm):
                $img = $vm['media_url'];
                $image_url = APIF_IMAGE_DIR . '/image-square.png';
                $image = esc_url($vm['media_url']);
                if (isset($vm['caption'])) {
                    $img_alt = $vm['caption'];
                } else {
                    $img_alt = '';
                }
                $link = esc_url($vm['permalink']);
                $flow_icon = APIF_IMAGE_DIR . '/sc-icon.png';
                ?>
                <li>
                    <?php
                    if ($vm['media_type'] == "VIDEO") {
                        $video_link = esc_url($vm['media_url']);
                        ?>
                                <!--<a href="<?php //echo $link ?>" target="_blank">-->
                        <!--<div id="inline-1" style="width:100%;height:100%;position:relative">-->
                            <!--<a href="<?php //echo $link   ?>" target="_blank">-->
                        <video controls style="width:inherit !important;height:100%;position:relative;right:0;display:block">
                            <source src="<?php echo $video_link; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <!--</a>-->
                        <!--</div>-->
                        <!--</a>-->
                    <?php } else { ?>
                        <a href="<?php echo $link ?>" target="_blank"><img src="<?php echo esc_url($image); ?>" alt='<?php echo strip_tags(substr($img_alt, 0, 20)); ?>'></a></li>
                <?php
                }
            endforeach;
            ?>
        </ul>
    </div>
<?php } ?>