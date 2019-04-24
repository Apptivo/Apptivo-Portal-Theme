<?php
/*
 * Template Name:Login Page
 */
?><?php 
//get_header();
?>
<?php
if (have_posts()) {
    setup_postdata($post);
}
$postvals = get_post_custom($post->ID);
//print_r($postvals);exit;
$banner_src = wp_get_attachment_image_src($postvals['banner_image'][0], 'full'); //print_r($banner_src[0]);exit;
if($postvals['banner_title'][0]!=''){
?>
<div class="container-fluid Banner AboutUsBanner">
    <div class="container ResetPaddingLR">
        <div class="jumbotron TransBg text-center ResetPadding">
            <h1><?php echo $postvals['banner_title'][0]; ?></h1><br>
            <hr class="hr1">
            <h2><?php echo $postvals['banner_description'][0]; ?></h2>
            <hr class="hr2">
        </div>
    </div>
</div>
<?php }?>
<section class="container-fluid GrayBg aboutsec BookMarkWell">
	<a id="whychooseus" class="bookmark whychoosebmrk"></a>
	<div class="jumbotron TransBg ResetPadding">
    <div class="container ResetPaddingLR whychoosesec">
   <?php    echo do_shortcode($post->post_content);
   			
   ?>
            </div>
    </div>
</section>


<!------End Body--------->

<?php //get_footer(); ?>
