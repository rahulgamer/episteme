<?php 
session_start(); 
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);	
?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>
		<meta http-equiv="x-ua-compatible" content="IE=9">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<meta http-equiv="Content-type" content="text/html" charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
																		
		<title><?php wp_title('|', true, 'right'); ?></title>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/foundation.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/iconfont.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/webfont.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/slick/slick.css">
		
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.jscrollpane.custom.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bookblock.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/custom.css">
        
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr.js"></script>
    	
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
		 
		<div class="off-canvas-wrap" data-offcanvas>
			<div class="inner-wrap">
				<nav class="tab-bar show-for-small">
					<section class="left-small">
						<a class="left-off-canvas-toggle menu-icon"><span></span></a>
					</section>

					<section class="middle tab-bar-section">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h1 class="title">EPISTEME</h1></a>
					</section>

					<section class="right-small">
						<a class="right-off-canvas-toggle menu-icon"><span></span></a>
					</section>
				</nav>

				<aside class="left-off-canvas-menu">
					<ul class="off-canvas-list">
						<li><label>EPISTEME</label></li>
						<li><a class="episteme-user"><span class="module-name-mobile"> Deepak Pradeep</span></a></li>
						<li class="active"><a href="" class="episteme-forum"><span class="module-name-mobile"> Forum</span></a></li>
						<li><a class="episteme-store"><span class="module-name-mobile"> Store</span></a></li>
						<li><a class="episteme-tech-talk"><span class="module-name-mobile"> Tech Talk</span></a></li>
						<li><a href="periodiko-landingpage.html" class="episteme-periodiko"><span class="module-name-mobile"> Periodiko</span></a></li>
						<li><a href="engage.html" class="episteme-coe-plus"><span class="module-name-mobile"> CoE Plus</span></a></li>
						<!--<li><label>Quick Links</label></li>
						<li><a>About</a></li>
						<li><a>Contact us</a></li>
						<li><a>Sitemap</a></li>-->
					</ul>
				</aside>

				<aside class="right-off-canvas-menu">
					<ul class="off-canvas-list">
						<li><label>EPISTEME</label></li>
						<li><a>Register as an Expert</a></li>
						<li><label>Forum</label></li>
						<li><a href="#questions">Questions</a></li>
						<li><a href="#informational">Informational</a></li>
						<li><a href="#concepts">Concepts</a></li>
						<li><a href="#users">Users</a></li>
					</ul>
				</aside>
				</div>
			</div>
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