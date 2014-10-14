<?php get_header(); 
if (is_user_logged_in()){
?>
<div class="row">				 
	<div class="large-9 medium-11 small-11 large-centered medium-centered small-centered columns">
		<!-- The "slick" div is the media/content slider -->
		<!-- Check http://kenwheeler.github.io/slick/ for docs -->

		<div class="slick small-text-justify medium-text-left large-text-left">
			<div>
				<div class="large-9 medium-8 columns">
					<h1>EPISTEME in new form</h1>
					<p>EPISTEME a way of life is now presented with a new look and feel. Requesting your valuable feedback. Please send your views and reviews at <a href="mailto:episteme@cognizant.com">episteme@cognizant.com</a></p>
				</div>
				<div class="large-3 medium-4 columns">
					<img src="<?php echo get_template_directory_uri(); ?>/img/EE.png">
				</div>
			</div>
			<div>
				<div class="large-9 columns">
					<h1>Periodiko</h1>
					<p>EPISTEME is proud to launch a vehicle that will provide the source of knowledge. Enriched with articles on what is happening in the world of technology and much more. Requesting you to email articles at <a href="mailto:episteme@cognizant.com">episteme@cognizant.com</a></p>
				</div>
				<div class="large-3 columns">
					<img src="<?php echo get_template_directory_uri(); ?>/img/EE.png">
				</div>
			</div>
			<div>
				<div class="large-9 columns">
					<h1>techTalk | Live</h1>
					<p>EPISTEME had the first techTalk | Live session at Siruseri SEZ on July 11. Venkataraman and Vijayagopal shared invaluable insights on how to look at testing and test automation, in particular, differently to Test at the Speed Of Trust</a></p>
				</div>
				<div class="large-3 columns">
					<img src="<?php echo get_template_directory_uri(); ?>/img/EE.png">
				</div>
			</div>
		</div>

	</div>
</div>
<?php
} else {
 ?>
 <div class="login-form">
      <form action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
        <input type="text" name="log" id="log" value="Username<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" class="login-fields" onclick="this.value='';" onblur="this.value=!this.value?'Username':this.value;"/>
        <input type="password" name="pwd" id="pwd" value="Password" size="20" class="login-fields" onclick="this.value='';" onblur="this.value=!this.value?'Password':this.value;"/>
        <input type="submit" name="submit" value="Login" class="login-button" />
      </form>
</div>
 <?php
}
?> 
<script src="<?php echo get_template_directory_uri(); ?>/slick/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/slick.js"></script>
<div class="content">
																	                    
	<?php if (have_posts()) : ?>
	
		<div class="posts" id="posts">
	
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$total_post_count = wp_count_posts();
			$published_post_count = $total_post_count->publish;
			$total_pages = ceil( $published_post_count / $posts_per_page );
			
			if ( "1" < $paged ) : ?>
			
				<div class="page-title">
				
					<h4><?php printf( __('Page %s of %s', 'rams'), $paged, $wp_query->max_num_pages ); ?></h4>
					
				</div> <!-- /page-title -->
				
				<div class="clear"></div>
			
			<?php endif; ?>
				
		    	<?php while (have_posts()) : the_post(); ?>
		    	
		    		<?php get_template_part( 'content', get_post_format() ); ?>
		    			        		            
		        <?php endwhile; ?>
        	                    
		<?php endif; ?>
		
	</div> <!-- /posts -->
	
	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	
		<div class="archive-nav">
				
			<?php echo get_next_posts_link( __('Older posts', 'rams') . ' &rarr;'); ?>
				
			<?php echo get_previous_posts_link( '&larr; ' . __('Newer posts', 'rams')); ?>
			
			<div class="clear"></div>
						
		</div> <!-- /archive-nav -->
						
	<?php endif; ?>
		
</div> <!-- /content section-inner -->
	              	        
<?php get_footer(); ?>