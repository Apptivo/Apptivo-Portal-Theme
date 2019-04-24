<?php
/*
Template Name: Inner page
*/
?>
<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						
					
						
						<section class="row post_content">
<?php get_sidebar('sidebar2'); // sidebar 2 ?>
						
							<div class="mncntr">
<div class="titlebg">
    		<div class="pull-left"><h4><?php the_title(); ?></h4></div>
<div class="pull-right mrg30p">

<section class="advsrchbginpnew posrel">
              <block class="deleteicon">
                <input type="text" class="advsearchinput1 bxsdw fltlft brdnone" id="advance-search" placeholder="search">
                <block></block>
              </block>
              <span title="Advanced Search" data-placement="bottom" data-toggle="tooltip" class="fltlft siconckz advsrh advarrow "><i class="fa fa-chevron-down"></i> </span> </section>


    </div>
    </div>
						
								<?php the_content(); ?>
								
							</div>
							
						
						
					</article> <!-- end article -->
					
					<?php comments_template('',true); ?>
					
					<?php endwhile; ?>		
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
			
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
