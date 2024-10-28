<?php
defined('ABSPATH') or die("No script kiddies please!");
global $apif_settings, $insta;
$apif_settings = get_option('apif_settings');
$username = !empty($apif_settings['username']) ? $apif_settings['username'] : ''; // your username
$access_token = !empty($apif_settings['access_token']) ? $apif_settings['access_token'] : '';
$user_id = !empty($apif_settings['user_id']) ? $apif_settings['user_id'] : '';
$enable_cache = (isset($apif_settings['enable_cache']) && $apif_settings['enable_cache'] == 1) ? 1 : 0;
$cache_period = (isset($apif_settings['cache_period']) && $apif_settings['cache_period'] == 1) ? intval($apif_settings['cache_period']) : '24';
$followmefontsize = !empty($apif_settings['followmefontsize']) ? esc_attr($apif_settings['followmefontsize']) : '';
$followmetext = !empty($apif_settings['followmetext']) ? $apif_settings['followmetext'] : __('Follow Me', 'accesspress-instagram-feed');
$layout = $apif_settings['instagram_mosaic'];
$image_like = isset($apif_settings['active']) ? $apif_settings['active'] : '';
$count = 7; // number of images to show
require_once('instagram.php');

if ($username == '' && $access_token == '') {
    $response = array('meta' => array('error_message' => 'Username and access token field is empty. Please configure.'));
} else if ($username == '') {
    $response = array('meta' => array('error_message' => 'Username field is empty.'));
} else if ($access_token == '') {
    $response = array('meta' => array('error_message' => 'Access token field is empty.'));
} else {

    if ($enable_cache) {
        $recent_feed_transient_name = 'recent_feed_transient';
        $recent_feed_transient = get_transient($recent_feed_transient_name);
        if (false === $recent_feed_transient) {
            $response = $insta->userMedia();
            set_transient($recent_feed_transient_name, $response, $cache_period * HOUR_IN_SECONDS);
        } else {
            $response = $recent_feed_transient;
        }
    } else {
        $response = $insta->userMedia();
    }
}

if ($response == NULL) {
    $response = array('meta' => array('error_message' => 'Username field is empty.'));
}

$ins_media = $response;
// echo('<pre>');
// print_r($ins_media);
// echo('</pre>');
// die();

if ($layout == 'mosaic' || $layout == 'mosaic_lightview') {
    ?>
    <section id="apif-main-wrapper" class="thumb-view">
        <div class="row masonry for-mosaic isotope ifgrid" ">
            <?php
            $i = 1;
            $j = 0;
            if (isset($ins_media['error']['message'])) {
                ?>
                <h1 class="widget-title-insta"><span><?php echo $ins_media['error']['message']; ?></span></h1>
                <?php
            } else if (is_array($ins_media['data']) || is_object($ins_media['data'])) {
                foreach ($ins_media['data'] as $vm):
                    if ($count == $j) {
                        break;
                    }
                    $j++;
                    if (isset($vm['caption'])) {
                        $img_alt = $vm['caption'];
                    } else {
                        $img_alt = '';
                    }
                    $img = $vm['media_url'];
                    ?>
                    <?php
                    if ($i <= 2 || $i == 6 || $i == 7) {
                        $masonary_class = 'grid-small';
                        $image_url = APIF_IMAGE_DIR . '/image-square.png';
                        $image = $vm['media_url'];
                    } elseif ($i == 4 || $i == 5) {
                        $masonary_class = 'grid-medium';
                        $image_url = APIF_IMAGE_DIR . '/image-rect.png';
                        $image = $vm['media_url'];
                    } elseif ($i == 3) {
                        $masonary_class = 'grid-large';
                        $image_url = APIF_IMAGE_DIR . '/image-square.png';
                        $image = $vm['media_url'];
                    }
                    $link = $vm['permalink'];
                    $flow_icon = APIF_IMAGE_DIR . '/sc-icon.png';
                    ?>
                    <div class="masonry_elem columns isotope-item element-itemif <?php echo esc_attr($masonary_class); ?>">
                        <div class="thumb-elem large-mosaic-elem small-mosaic-elem  hovermove large-mosaic-elem">
                            <header class="thumb-elem-header">
                                <?php
                                if ($layout == 'mosaic_lightview') {
                                    ?>
                                    <div class="featimg">
                                        <?php
                                        if ($vm['media_type'] == "VIDEO") {
                                            $video_link = $vm['media_url'];
                                            ?>
                                            <a class="example-image-link" href="<?php echo esc_url($video_link); ?>" data-lightbox="example-set">
                                                <div id="inline-1" style="width:100%;height:100%">
                                                    <video controls style="width:100%;height:100%">
                                                        <source src="<?php echo esc_url($video_link); ?>" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                            </a>
                                        <?php } else { ?>
                                            <a class="example-image-link" href="<?php echo esc_url($img); ?>" data-lightbox="example-set">
                                                <img class="the-thumb" src="<?php echo esc_url($image); ?>" alt='<?php echo esc_attr($img_alt); ?>'>
                                                <img class="transparent-image" src="<?php echo esc_url($image_url); ?>" alt='Transparent Image'>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <a href="https://instagram.com/<?php echo esc_attr($username); ?>" target="_blank" class="image-hover">
                                        <span class="follow"><?php echo esc_attr($followmetext); ?></span>
                                        <span class="follow_icon">
                                            <img src="<?php echo $flow_icon; ?>"/>
                                        </span>
                                    </a>
                                <?php } if ($layout == 'mosaic') { ?>
                                    <div class="featimg">
                                        <?php
                                        if ($vm['media_type'] == "VIDEO") {
                                            $video_link = $vm['media_url'];
                                            ?>
                                            <!--<div id="inline-1" style="width:100%;height:100%">-->
                                            <video class="the-thumb" controls style="width:100%;height:100%">
                                                <source class="the-thumb" src="<?php echo esc_url($video_link); ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            <!--</div>-->
                                        <?php } else { ?>
                                            <img class="the-thumb" src="<?php echo esc_url($image); ?>">
                                            <img class="transparent-image" src="<?php echo esc_url($image_url); ?>">
                                        <?php } ?>
                                    </div>
                                    <a href="https://instagram.com/<?php echo esc_attr($username); ?>" target="_blank" class="image-hover">
                                        <span class="follow"><?php echo esc_attr($followmetext); ?></span>
                                        <span class="follow_icon">
                                            <img src="<?php echo $flow_icon; ?>"/>
                                        </span>
                                    </a>
                                <?php } ?>
                            </header>
                        </div>
                    </div>
                    <?php
                    $i++;
                endforeach;
            }
            ?>
        </div>
    </section>
    <?php
} else if ($layout == 'slider') {
    ?>
    <?php
    $j = 0;
    if (isset($ins_media['error']['message'])) {
        ?>
        <h1 class="widget-title-insta"><span><?php echo $ins_media['error']['message']; ?></span></h1> 
    <?php } elseif (is_array($ins_media['data']) || is_object($ins_media['data'])) {
        ?>
        <div id="owl-demo" class="apif-owl-carousel owl-carousel">
            <?php
            foreach ($ins_media['data'] as $vm):
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
                //echo $img_alt;
                //die($img_alt);
                ?>
                <div class="item">
                <?php
                if ($vm['media_type'] == "VIDEO") {
                    $video_link = $vm['media_url'];
                    ?>
                        <div id="inline-1" style="width:100%;height:100%">
                            <video controls style="width:100%;height:100%">
                                <source src="<?php echo esc_url($video_link); ?>" type="video/mp4">
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
        <?php } ?>

<?php } else if ($layout == 'grid_rotator') { ?>
    <?php
    if (isset($ins_media['error']['message'])) {
        ?>
        <h1 class="widget-title-insta"><span><?php echo $ins_media['error']['message']; ?></span></h1>
    <?php } else if (is_array($ins_media['data']) || is_object($ins_media['data'])) {
        ?>
        <div class="ri-grid apif-ri-grid">
            <img class="ri-loading-image" src="<?php echo esc_attr(APIF_IMAGE_DIR) . '/ripple.gif'; ?>"/>
            <ul>
        <?php
        foreach ($ins_media['data'] as $vm):
            if (isset($vm['caption'])) {
                $img_alt = $vm['caption'];
            } else {
                $img_alt = '';
            }
            $img = $vm['media_url'];
            $image_url = APIF_IMAGE_DIR . '/image-square.png';
            $image = $vm['media_url'];
            $link = $vm['permalink'];
            $flow_icon = APIF_IMAGE_DIR . '/sc-icon.png';
            ?>
                    <li style="position:relative">
                    <?php
                    if ($vm['media_type'] == "VIDEO") {
                        $video_link = $vm['media_url'];
                        ?>
                                <!--<a href="<?php //echo $link  ?>" target="_blank">-->
                            <!--<div id="inline-1" style="width:100%;height:100%;position:relative">-->
                                <!--<a href="<?php //echo $link  ?>" target="_blank">-->
                            <video controls style="width:inherit !important;height:100%;position:relative;right:0;display:block">
                                <source src="<?php echo esc_url($video_link); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <!--</a>-->
                            <!--</div>/-->
                            <!--</a>-->
            <?php } else { ?>
                            <a href="<?php echo esc_url($link); ?>" target="_blank">
                                <img src="<?php echo esc_url($image); ?>" alt='<?php echo strip_tags(substr($img_alt, 0, 20)); ?>'>
                            </a>
            <?php } ?>
                    </li>
                    <?php endforeach; ?>
            </ul>
        </div>
            <?php } ?>
    <?php }
?>
<style>
    span.follow{
        font-size:<?php
if (isset($followmefontsize) && $followmefontsize != "") {
    echo $followmefontsize;
}
?>px;
    </style>