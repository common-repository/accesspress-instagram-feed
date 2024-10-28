<?php
defined('ABSPATH') or die("No script kiddies please!");
global $apif_settings, $insta;
$apif_settings = get_option('apif_settings');
$username = $apif_settings['username']; // your username
$access_token = $apif_settings['access_token'];
$user_id = !empty($apif_settings['user_id']) ? $apif_settings['user_id'] : '';
$followmetext = !empty($apif_settings['followmetext']) ? $apif_settings['followmetext'] : __('Follow Me', 'accesspress-instagram-feed');
$followmefontsize = !empty($apif_settings['followmefontsize']) ? esc_attr($apif_settings['followmefontsize']) : '';
$image_like = $apif_settings['active'];
$count = 7; // number of images to show
require_once('instagram.php');
// $ins_media_masaic = $insta->userMedia();
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

$ins_media_masaic = $response;
// var_dump($response);
// die();
// echo('<pre>');
// print_r($ins_media_masaic);
// echo("</pre>");
// die();
?>
<section id="apif-main-wrapper-1" class="thumb-view">
    <div class="row masonry for-mosaic isotope ifgrid" >
<?php
$i = 1;
$j = 0;
if (isset($ins_media_masaic['error']['message'])) {
    ?>
            <h1 class="widget-title-insta"><span><?php echo $ins_media_masaic['error']['message']; ?></span></h1>
            <?php
        } else if (is_array($ins_media_masaic['data']) || is_object($ins_media_masaic['data'])) {
            foreach ($ins_media_masaic['data'] as $vm):
                if ($count == $j) {
                    break;
                }
                $j++;
                $img = $vm['media_url'];
                if (isset($vm['caption'])) {
                    $img_alt = $vm['caption'];
                } else {
                    $img_alt = '';
                }
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
                                    <img src="<?php echo $flow_icon; ?>" alt='Follow'/>
                                </span>
                            </a>
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
<style>
    span.follow{
        font-size:<?php if (isset($followmefontsize) && $followmefontsize != "") {
            echo $followmefontsize ;
        }?>px;
</style>
