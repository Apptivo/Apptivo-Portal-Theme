<?php
/*
Template Name: Knowledge Base
*/
?>


<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						
					
						
						<section class="row post_content">
<?php get_sidebar('sidebar3'); // sidebar 3 ?>
						
							<div class="mncntr">
<div class="titlebg">
    		<h4><?php the_title(); ?></h4>
    </div>
						
								<?php the_content(); ?>
								
							</div>
							
						
						
					</article> <!-- end article -->
					
					<?php comments_template('',true); ?>
					
					<?php endwhile; ?>		
					
					<?php else : ?>
					
					
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
			
    
			</div> <!-- end #content -->

<?php get_footer(); ?>