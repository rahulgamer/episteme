<?php
/*
Template Name: Periodiko Detail Page
Authors : Prasanna Bommu, Pradeep Deepak
*/

//add css files to header

// wp_enqueue_script('jquery.jscrollpane.custom', get_stylesheet_directory_uri().'/css/jquery.jscrollpane.custom.css', '', '',false);
// wp_enqueue_script('bookblock', get_stylesheet_directory_uri().'/css/bookblock.css', '', '',false);
// wp_enqueue_script('custom', get_stylesheet_directory_uri().'/css/custom.css', '', '',false);
// wp_enqueue_script('modernizr', get_stylesheet_directory_uri().'/js/vendor/modernizr.js"', '', '',false);

//add js files to footer

// wp_enqueue_script('jquery', get_stylesheet_directory_uri().'/js/vendor/jquery.js', '', '',true);
wp_enqueue_script('jquery.mousewheel', get_stylesheet_directory_uri().'/js/magazine/jquery.mousewheel.js', '', '',true);
wp_enqueue_script('jquery.jscrollpane.min', get_stylesheet_directory_uri().'/js/magazine/jquery.jscrollpane.min.js', '', '',true);
wp_enqueue_script('jquerypp.custom', get_stylesheet_directory_uri().'/js/magazine/jquerypp.custom.js', '', '',true);
wp_enqueue_script('jquery.bookblock', get_stylesheet_directory_uri().'/js/magazine/jquery.bookblock.js', '', '',true);
wp_enqueue_script('page', get_stylesheet_directory_uri().'/js/magazine/page.js', '', '',true);

wp_enqueue_script('sticky-footer', get_stylesheet_directory_uri().'/js/episteme/sticky-footer.js', '', '',true);
wp_enqueue_script('slick.min', get_stylesheet_directory_uri().'/slick/slick.min.js', '', '',true);
wp_enqueue_script('slick', get_stylesheet_directory_uri().'/js/slick/slick.js', '', '',true);
wp_enqueue_script('nav', get_stylesheet_directory_uri().'/js/episteme/nav.js', '', '',true);
wp_enqueue_script('foundation.min', get_stylesheet_directory_uri().'/js/foundation.min.js', '', '',true);
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
					
					<div class="row">
						<div class="large-12 columns">
							<div id="container" class="container ">	
								<div class="menu-panel">
								<h3>Table of Contents</h3>
								<ul id="menu-toc" class="menu-toc">
									<li class="menu-toc-current"><a href="#item1">Welcome Message</a></li>
									<li><a href="#item2">Introduction to EPISTEME </a></li>
									<li><a href="#item3">Topic of the month  </a></li>
									<li><a href="#item4">Know your CoEs</a></li>
								</ul>
							</div>

							<div class="bb-custom-wrapper">
								<div id="bb-bookblock" class="bb-bookblock">
									<div class="bb-item" id="item1">
										<div class="content">
											<div class="scroller">
												<h4><b>Welcome Message</b></h4>
												
												<p>It is our honor and privilege to present EPISTEME in a brand new form. Thus far, EPISTEME has been the monthly Tech Webinar 
												Series from QE&A Technology CoE. Covering topics such as, Big Data Testing, Mobile Payment Testing, so on and so forth. 
												In this new form, as a first step, we are proud to remind you, EPISTEME went online in April 2014.</p>
												  
												
												<p> EPISTEME is etymologically derived from the Ancient Greek word "" for knowledge. We believe, sharing and gaining 
												knowledge is the path that leads to triumph. In our efforts to contribute to your triumph, we present EPISTEME, more than 
												an initiative - 'A Way of Life'. Our vision with your collaboration and contribution is to become the TEDX of the Technology CoE. 
												EPISTEME is an integrated technology platform which will soon evolve as the first source of knowledge for knowledge seekers.
												Experts will be able to capitalize EPISTEME as a platform to exhibit Thought Leadership. Various flavors will be added to EPISTEME
												as it grows. At this time you have an access to the Forums, CoE store, FAQ (Jumpstart) and TechTalk. Consequently, soon enough you 
												name it and EPISTEME will serve it. </p>

												<p> An integral part of EPISTEME is the EPISTEME magazine - an instrument to enrich your minds with information and current trends
												in Technology or the markets that impact us. A channel to know our leaders, current happening in CoE last but not the least; 
												EPISTEME magazine will recognize the hard work and highlight our accomplishments. Stay tuned for the best in QE&A Technology CoE.</p>

												<p>This is the beginning and we invite you to be a part of EPISTEME Juggernaut to Connect, Collaborate, and Contribute.</p>

												<p>- Manish Kulkarni, Global Head - Technology Centre of Excellence<br>
												<img src="<?php echo get_stylesheet_directory_uri();?>/img/manish.jpg" /></p>

												
											</div>
										</div>
									</div>
									<div class="bb-item" id="item2">
										<div class="content">
											<div class="scroller">
												<h4><b>Think Technology. Think EPISTEME</b></h4>
												<p>Remember the times when one had to shuffle through myriad shelves, piles of books and engage in endless 
												conversations to find answers to questions? Bang came the labyrinth of 'Google', which pretty much has answers
												or perhaps too many answers! Remember the times when one waited for alumni meets and phone directories to
												connect with people? Viola! Now we are the world of Facebook and Twitter connecting everyone from everywhere.</p>

												<p>As much as socializing and learning has become effortless in our day-to-day lives, connecting and effectively 
												sharing knowledge within one's organization remains obscure. Most of us today when stuck with a query, reflexively
												'Google' for solutions, not realizing that we might have an expert on the topic sitting right next to us. We might be
												in search of a solution outside without knowing that it already exists. Many of us might be adept professionals in various
												technologies, lacking visibility and deprived of a platform to showcase our expertise. All of us want to grow up the career ladder,
												inspired by our leaders but how well do we know them and what it takes to become one?  </p>

												<p>With Cognizant QE&A spanning across more than 600+ accounts globally, the Technology CoEs (Centre of Excellence) 
												have acted as channels for QE&A accounts to enhance their services. Episteme is that one-of-a-kind body that unifies
												every need and every associate across Cognizant's QE&A practice and the Technology CoEs. Post queries and get 
												expert answers, register as experts and gain prominence, cruise through the 'CoE Store' for best-in-class 
												solutions, be included in Tech-conferences and leadership talks, know associates with similar expertise, 
												share and gain knowledge, know your leaders, get your monthly dose of technology through e-magazines and be 
												a part of Episteme - a 'way of life' for every Cognizant QE&A associate to Connect, Collaborate and Contribute. </p>

												<p>Think Technology. Think Episteme. </p>

												<p>- Lakshmi Subramaniam <br>
												<img src="<?php echo get_stylesheet_directory_uri();?>/img/lakshmi.png" />
												</p>
											</div>
										</div>
									</div>
									<div class="bb-item" id="item3">
										<div class="content">
											<div class="scroller">
											<h4>Topic of the month </h4>
												<p><b>Big Data: Two Steps in the Right Direction</b></p>
												<p>Where are companies making progress in their big data and analytics work?
												Although many companies are taking early steps on the Big Data journey, it is useful 
												to explore where these companies are making progress in the Big Data and its analytics. 
												Two steps in the right direction...</p>
												<p>An Organizational Culture that supports Analytics</p>
												<p>A company that has the following culture can derive invaluable business insight moreover 
												leverage analytics from the data available, provided:
													<ul class="big-data">
													<li>Analytics are valued</li> 
													<li>Creativity and innovation are a way of life</li>
													<li>Coworkers collaborate and share</li>
													<li>Data drives business decisions</li>
													</ul>
												</p>
												<p>In the event a company is data driven and innovative, it may explore newer kinds of data as part
												of the Business Analysis. A company should strongly support a culture of analytics that would facilitate
												procuring funding for new products, develop a proof of concept, and deliver measurable value. 
												An Organizational Culture that supports Analytics is a critical early step in harvesting business 
												insight from the Big Data.</p>

												<p>An understanding of Security and Compliance with regards to Governance</p>

												<p>Data governance is vital to a company no matter what the data sources are or the manner in which it is managed.
												As the Big Data and Big Data Analytics efforts increase, it will become more important than ever to understand issues
												such as data provenance, data ownership and metadata. </p>

												<p>Companies should build on the existing strength to leverage insights from Big Data. Therefore,
												building on an organizational culture that supports analytics is as essential as laying the building 
												blocks in place for security and governance. These are the two steps in the right direction for 
												successfully utilizing the Big Data.</p>

												<p>- J. Jai Ganesh <br>
												<img src="<?php echo get_stylesheet_directory_uri();?>/img/ganesh.jpg" />
												</p>
												<p><b><u>About the Author</u></b></p>
												<p>Jai Ganesh has been a member of the Data Testing CoE for the past one year and has actively worked in Testing
												and Architecting of Cognizant proprietary Product 'data Test Pro'. He has contributed vastly towards Data 
												CoE -R&D activities and has worked on various Data Testing Products. He has completed his B.Tech in 
												Electronics and Communication Engineering and has ardent interest in the fields of Data Warehousing Testing 
												and Cloud Computing.</p>
											</div>
										</div>
									</div>
									<div class="bb-item" id="item4">
										<div class="content">
											<div class="scroller">
												<h4>Know your CoEs</h4>
												<p><b>Mobile CoE</b>
												Mobile Testing CoE is a brain child of Cognizant's Thought Leadership in next generation Mobile Technologies 
												to deliver optimal yet cost effective solutions for our customers by continuously striving to provide best
												in class Mobility Solutions.</p>
												<p><span class="coe-lead">Reach the CoE Lead at: </span>
												<a class="email" href="Ramakrishnan.Venkatasubramanian@cognizant.com">Ramakrishnan.Venkatasubramanian@cognizant.com</a></p>

												<p><b>Data CoE</b>
												Cognizant QE&A Data Testing Center of Excellence is an independent verification and validation team focused 
												on state-of-the-art solutions for Data Testing requirements by using the best-in-class methodologies set out 
												for Data Testing projects.</p>
												<p><span class="coe-lead">Reach the CoE Lead at: </span>
												<a class="email" href="Avadhoot.Panse@cognizant.com">Avadhoot.Panse@cognizant.com</a></p>

												<p><b>Test Data Management CoE</b>
												TDM CoE's charter is to research, augment and/or build solutions that efficiently deliver on-demand 'fit for use'
												data with referential integrity & data privacy, while also optimizing the data storage/processing costs.</p>
												<p><span class="coe-lead">Reach the CoE Lead at: </span>
												<a class="email" href="Gopinath.Mandala@cognizant.com">Gopinath.Mandala@cognizant.com</a></p>

												<p><b>Service Virtualization CoE</b>
												Service Virtualization CoE is a dedicated team of SV SMEs, Architect, and trained practitioners building 
												frameworks, virtualized assets and accelerators delivering the benefits of Virtualization for QA.  </p>
												<p><span>Reach the CoE Lead at: </span>
												<a class="email" href="Ramakrishnan.Venkatasubramanian@cognizant.com ">Ramakrishnan.Venkatasubramanian@cognizant.com </a></p>

												<p><b>Automation CoE</b>
												The Automation Center of Excellence provides state-of-the-art consulting, delivery enablement and a solution
												accelerator to meet the client's testing requirements with best of the breed automation practices,
												processes and solutions.</p>
												<p><span class="coe-lead">Reach the CoE Lead at: </span>
												<a class="email" href="Ramakrishnan.Venkatasubramanian@cognizant.com ">Ramakrishnan.Venkatasubramanian@cognizant.com </a></p>
											</div>
										</div>
									</div>
								</div>
								
								<nav>
									<span id="bb-nav-prev">&larr;</span>
									<span id="bb-nav-next">&rarr;</span>
								</nav>

								<span id="tblcontents" class="menu-button">Table of Contents</span>

							</div>
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
<script>
	jQuery(function() {

		Page.init();

	});
</script>
<script>
	jQuery(document).foundation();
</script>