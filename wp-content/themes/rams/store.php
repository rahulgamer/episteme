<?php
/*
Template Name: Store Page
Authors : Pradeep Deepak, Rahul Gupta
*/
get_header();
wp_head();
?>

	
<div class="off-canvas-wrap" data-offcanvas>
		<!-- All main area content comes here -->
		<!-- The "main-section" section, "row" div and "main-container" div are critical for making it work -->
	<div class="row collapse">
		<section class="main-section">
			
				<div id="main-container" style="margin-left:0 !important;padding: 0 !important;width:100%" class="large-10 large-offset-2 medium-9 medium-offset-3 columns">
					<!-- All body content comes here -->
					
							<div class="row store-showcase">
								<div class="large-12 text-center large-centered columns">
									<h5 class="subheader">Featured Apps</h5>
									<div class="large-12 text-center large-centered columns">
										<div class="store-showcase-slider">
											<div>
												<!--<img src="http://placehold.it/185x100&text=1">-->
												<img src="<?php echo get_template_directory_uri(); ?>/img/mint-device-featured.png">
											</div>
											<div>
												<img src="<?php echo get_template_directory_uri(); ?>/img/spritz-featured.png">
											</div>
											<div>
												<img src="<?php echo get_template_directory_uri(); ?>/img/mint-pro-featured.png">
											</div>
											<div>
												<!--<img src="http://placehold.it/185x100&text=1">-->
												<img src="<?php echo get_template_directory_uri(); ?>/img/mint-device-featured.png">
											</div>
											<div>
												<img src="<?php echo get_template_directory_uri(); ?>/img/spritz-featured.png">
											</div>
											<div>
												<img src="<?php echo get_template_directory_uri(); ?>/img/mint-pro-featured.png">
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row store-container">
								<div class="large-12 columns">
									<div class="large-12 columns">
										<!--<div class="panel">
											<div class="store-search-panel row collapse">
												<div class="large-6 medium-6 small-6 columns">
													<h5>All apps</h5>
												</div>
												<div class="large-6 medium-6 small-6 columns">
													<input type="text" placeholder="Search apps..." />
												</div>
											</div>
										</div>-->
											
										<div class="store-filter-search row collapse hide-for-small">
											<div class="large-6 medium-6 columns">
												<dl class="sub-nav">
													<dd class="active"><a>Newest</a></dd>
													<dd><a>Rating</a></dd>
													<dd><a>Likes</a></dd>
													<dd><a>Downloads</a></dd>
												</dl>
											</div>
											<div class="large-3 medium-3 columns">
												<input type="text" placeholder="Search apps..." />
											</div>
											<div class="large-3 medium-3 columns">
												<select>
													<option value="">Filter by CoE</option>
													<option value="automation">Automation</option>
													<option value="data">Data</option>
													<option value="mobile">Mobile</option>
													<option value="soa">SOA</option>
													<option value="sv">Service Virtualization</option>
													<option value="tdm">Test Data Management</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="large-12 columns text-center store-app-list">
									<ul class="large-block-grid-3 medium-block-grid-2 small-block-grid-1">
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/ahead.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/casp.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/craft.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/craft-lite.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/ctdm.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/iauthorize.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/mintDevice.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/mintPro.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/pdf-automation-pro.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/rapido.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/safeplus.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/td-maxim.png"></li>
										<li><img src="<?php echo get_template_directory_uri(); ?>/img/apps/virtualizer.png"></li>
									</ul>
								</div>
							</div>

					<!-- All footer content comes here -->
					<!-- The id "footer" is required for the sticky-footer to work. Renaming the <div> to <footer> breaks the stick-footer logic -->

					<!--<div id="footer">
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
					</div>-->

				</div>
			</div>
		</section>

		<a class="exit-off-canvas"></a>

	</div>
</div>
<?php
get_footer();
?>
<!-- script>
	jQuery(document).foundation();
</script -->