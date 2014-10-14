<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<div id="secondary">
	<?php
		$description = get_bloginfo( 'description', 'display' );
		if ( ! empty ( $description ) ) :
	?>
	<h2 class="site-description"><?php echo esc_html( $description ); ?></h2>
	<?php endif; ?>

	<?php if ( has_nav_menu( 'secondary' ) ) : ?>
	<nav role="navigation" class="navigation site-navigation secondary-navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
	</nav>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<div id="menu-container" class="side-nav-container large-2 medium-3 hide-for-small-only columns">
			<!--<div class="menu-title">
				<a class="episteme-menu" onclick="toggleMenu()"></a>
			</div>
			<ul class="side-nav">
				<li><a class="module-icon episteme-user"><span class="module-name"> My Profile</span></a></li>
				<li><a href="forum.html" class="module-icon episteme-forum"><span class="module-name"> Forum</span></a></li>
				<li><a class="module-icon episteme-store"><span class="module-name"> Store</span></a></li>
				<li><a class="module-icon episteme-tech-talk"><span class="module-name"> Tech Talk</span></a></li>
				<li><a href="periodiko-landingpage.html" class="module-icon episteme-periodiko"><span class="module-name"> Periodiko</span></a></li>
				<li class="active"><a href="" class="module-icon episteme-coe-plus"><span class="module-name"> CoE Plus</span></a></li>
			</ul>-->
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #primary-sidebar -->
	</div><!-- #primary-sidebar -->
	<?php endif; ?>
</div><!-- #secondary -->
