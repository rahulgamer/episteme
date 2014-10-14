<?php
/*
Template Name: Periodiko Home
Authors : Prasanna Bommu, Pradeep Deepak
*/


//add css files to header

wp_enqueue_script('episteme', get_stylesheet_directory_uri().'/css/episteme.css', '', '',false);
wp_enqueue_script('jquery.jscrollpane.custom', get_stylesheet_directory_uri().'/css/jquery.jscrollpane.custom.css', '', '',false);
wp_enqueue_script('bookblock', get_stylesheet_directory_uri().'/css/bookblock.css', '', '',false);
wp_enqueue_script('custom', get_stylesheet_directory_uri().'/css/custom.css', '', '',false);
wp_enqueue_script('modernizr', get_stylesheet_directory_uri().'/js/vendor/modernizr.js"', '', '',false);

//add js files to footer
wp_enqueue_script('jquery', get_stylesheet_directory_uri().'/js/vendor/jquery.js', '', '',true);
wp_enqueue_script('sticky-footer', get_stylesheet_directory_uri().'/js/episteme/sticky-footer.js', '', '',true);
wp_enqueue_script('slick.min', get_stylesheet_directory_uri().'/slick/slick.min.js', '', '',true);
wp_enqueue_script('slick', get_stylesheet_directory_uri().'/js/slick/slick.js', '', '',true);
wp_enqueue_script('nav', get_stylesheet_directory_uri().'/js/episteme/nav.js', '', '',true);
wp_enqueue_script('foundation.min', get_stylesheet_directory_uri().'/js/foundation.min.js', '', '',true);

get_header();
?>

<div class="off-canvas-wrap" data-offcanvas>
		<!-- All main area content comes here -->
		<!-- The "main-section" section, "row" div and "main-container" div are critical for making it work -->
	<div class="row collapse">
		<section class="main-section">			
			<div id="main-container" class="large-10 large-offset-2 medium-9 medium-offset-3 columns">

				<!-- All body content comes here -->
				
				<div class="row">
					<div class="large-12 large-centered columns text-center">
						
						<ul class="small-block-grid-2 medium-block-grid-2 large-block-grid-2">
							<li><a href="<?php echo site_url('/periodiko_detail/');?>"><img src="<?php echo get_stylesheet_directory_uri();?>/img/welcome-message.jpg" /></a></li>
							<li><a href="<?php echo site_url('/periodiko_detail/');?>">  <img src="<?php echo get_stylesheet_directory_uri();?>/img/think-episteme.jpg" /></li>
							<li><a href="<?php echo site_url('/periodiko_detail/');?>"> <img src="<?php echo get_stylesheet_directory_uri();?>/img/Big-data.jpg" /></li>
							<li ><a href="<?php echo site_url('/periodiko_detail/');?>"><img src="<?php echo get_stylesheet_directory_uri();?>/img/know-ur-Coes.jpg" /></li>
						</ul>

					</div>
				</div>

				<!-- All footer content comes here -->
				<!-- The id "footer" is required for the sticky-footer to work. Renaming the <div> to <footer> breaks the stick-footer logic -->

				<div id="footer">
					<div class="footer-logo row">
						<div class="large-12 medium-12 columns">
							<div class="large-6 medium-6 small-6 columns">
								<img src="<?php echo get_stylesheet_directory_uri();?>/img/cognizant-qea-logo.png">
							</div>
							<div class="large-6 medium-6 small-6 text-right columns">
								<p>Technology CoE</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<a class="exit-off-canvas"></a>

	</div>
</div>


<script>
	$(document).foundation();
</script>