<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $video_url = get_post_meta($post->ID, 'video_url', true); if ( $video_url != '' ) : ?>
	
		<div class="featured-media">
		
			<?php if (strpos($video_url,'.mp4') !== false) : ?>
				
				<video controls>
				  <source src="<?php echo $video_url; ?>" type="video/mp4">
				</video>
																		
			<?php else : ?>
				
				<?php 
				
					$embed_code = wp_oembed_get($video_url); 
					
					echo $embed_code;
					
				?>
					
			<?php endif; ?>
			
		</div>
	
	<?php endif; ?>
	
	<div class="post-inner">
		
		<div class="post-header">
			
			<p class="post-date">
			
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_time(get_option('date_format')); ?></a>
				
				<?php if ( is_sticky() ) : ?>
				
					<span class="sep">/</span> <?php _e('Sticky','rams'); ?>
				
				<?php endif; ?>
				
			</p>
			
		    <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		    	    
		</div> <!-- /post-header -->
		
		<div class="post-content">
		
			<?php the_content(); ?>
		
		</div>
	
	</div> <!-- /post-inner -->

</div> <!-- /post -->