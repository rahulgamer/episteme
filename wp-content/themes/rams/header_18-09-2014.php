<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<!-- ?php header('X-UA-Compatible: IE=edge,chrome=1'); ? -->
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<meta http-equiv="Content-type" content="text/html;charset=<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
																		
		<title><?php wp_title('|', true, 'right'); ?></title>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/foundation.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/iconfont.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/webfont.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/slick/slick.css">
		
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox.css" />
		<?php wp_head(); ?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.js?v=2.1.5"></script>
		<style>#wpadminbar{display:none;}</style>	
	</head>
	<style>
		html{margin-top:0 !important;}
	</style>
	
	<body <?php body_class(); ?>>
	
		<div class="sidebar bg-mint">
		
			<!--<div class="sidebar-inner">
						
				<?php if ( get_theme_mod( 'rams_logo' ) ) : ?>
				
			        <a class="blog-logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>' rel='home'>
			        	<img src='<?php echo esc_url( get_theme_mod( 'rams_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>'>
			        </a>
			
				<?php elseif ( get_bloginfo( 'description' ) || get_bloginfo( 'title' ) ) : ?>
			
					<h1 class="blog-title">
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'title' ) ); ?></a>
					</h1>
					
				<?php endif; ?>
				
				<a class="nav-toggle hidden" title="<?php _e('Click to view the navigation','rams') ?>" href="#">
				
					<div class="bars">
					
						<div class="bar"></div>
						<div class="bar"></div>
						<div class="bar"></div>
						
						<div class="clear"></div>
					
					</div>
					
					<p>
						<span class="menu"><?php _e('Menu','rams') ?></span>
						<span class="close"><?php _e('Close','rams') ?></span>
					</p>
				
				</a>
				
				<ul class="main-menu">
					
					<?php if ( has_nav_menu( 'primary' ) ) {
																		
						wp_nav_menu( array( 
						
							'container' => '', 
							'items_wrap' => '%3$s',
							'theme_location' => 'primary'
														
						) ); } else {
					
						wp_list_pages( array(
						
							'container' => '',
							'title_li' => ''
						
						));
						
					} ?>
					
				 </ul>
				 
				 <p class="credits"><?php _e('Theme by','rams'); ?> <a href="http://www.andersnoren.se">Anders Nor&eacute;n</a></p>
				
				 <div class="clear"></div>
			
			</div> -->
			<div id="menu-container" class="side-nav-container large-2 medium-3 hide-for-small-only columns">
				<div class="menu-title">
					<a class="episteme-menu" onclick="toggleMenu()"></a>
				</div>

				<ul class="side-nav">
					<!--<li><a class="module-icon episteme-user"><span class="module-name"> My Profile</span></a></li>
					<li><a href="forum.html" class="module-icon episteme-forum"><span class="module-name"> Forum</span></a></li>
					<li><a class="module-icon episteme-store"><span class="module-name"> Store</span></a></li>
					<li><a class="module-icon episteme-tech-talk"><span class="module-name"> Tech Talk</span></a></li>
					<li><a href="periodiko-landingpage.html" class="module-icon episteme-periodiko"><span class="module-name"> Periodiko</span></a></li>
					<li class="active"><a href="" class="module-icon episteme-coe-plus"><span class="module-name"> CoE Plus</span></a></li>-->
					
					<?php if ( has_nav_menu( 'primary' ) ) {
																		
						wp_nav_menu( array( 
						
							'container' => '', 
							'items_wrap' => '%3$s',
							'theme_location' => 'primary'
														
						) ); } else {
					
						wp_list_pages( array(
						
							'container' => '',
							'title_li' => ''
						
						));
						
					} ?>
				</ul>
			</div>
			
			<!-- /sidebar-inner -->
							
		</div> <!-- /sidebar -->
		
		<!--<ul class="mobile-menu bg-dark hidden">
					
			<?php if ( has_nav_menu( 'primary' ) ) {
																
				wp_nav_menu( array( 
				
					'container' => '', 
					'items_wrap' => '%3$s',
					'theme_location' => 'primary'
												
				) ); } else {
			
				wp_list_pages( array(
				
					'container' => '',
					'title_li' => ''
				
				));
				
			} ?>
			
		 </ul>-->

		<div class="wrapper" id="wrapper">
		
			<!--<div class="section-inner wrapper-inner">-->
			<div class="large-10 large-offset-2 medium-9 medium-offset-3 columns" id="main-container-home">
				<header class="header-home row">
					<div class="large-12 columns">
						<div class="logo large-4 medium-4 text-left hide-for-small columns">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><div class="episteme-logo-home"></div></a>
						</div>
						<!--<div class="module-name-header large-4 medium-4 text-center hide-for-small columns">
							<a href=""><h4>Home</h4></a>
						</div>-->
						<?php
							if (is_user_logged_in()){
						?>
						<div class="register-expert large-4 medium-4 text-right hide-for-small columns">
							<a class="radius register-expert-home button" href="">Register as an Expert →</a>
						</div>
						<?php
							}
						?>
					</div>
				</header>
				<script src="<?php echo get_template_directory_uri(); ?>/js/nav.js"></script>