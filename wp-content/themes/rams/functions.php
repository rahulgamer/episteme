<?php

// Theme setup
add_action( 'after_setup_theme', 'rams_setup' );

function rams_setup() {
	
	// Automatic feed
	add_theme_support( 'automatic-feed-links' );
	
	// Post thumbnails
	add_theme_support( 'post-thumbnails' ); 
	add_image_size( 'post-image', 800, 9999 );
	
	// Post formats
	add_theme_support( 'post-formats', array( 'gallery', 'quote', 'video' ) );
		
	// Jetpack infinite scroll
	add_theme_support( 'infinite-scroll', array(
	    'container' => 'posts',
	    'footer' => 'wrapper',
	    'type' => 'click'
	) );
	
	// Add nav menu
	register_nav_menu( 'primary', __('Primary Menu','rams') );
	
	// Make the theme translation ready
	load_theme_textdomain('rams', get_template_directory() . '/languages');
	
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable($locale_file) )
	  require_once($locale_file);
	
}

// Register and enqueue Javascript files
function rams_load_javascript_files() {

	if ( !is_admin() ) {
		wp_register_script( 'rams_global', get_template_directory_uri().'/js/global.js', array('jquery'), '', true );
		wp_register_script( 'rams_flexslider', get_template_directory_uri().'/js/flexslider.min.js', array('jquery'), '', true );
		
		wp_enqueue_script( 'rams_flexslider' );
		wp_enqueue_script( 'rams_global' );
		
		if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
		
	}
}

add_action( 'wp_enqueue_scripts', 'rams_load_javascript_files' );


// Register and enqueue styles
function rams_load_style() {
	if ( !is_admin() ) {
	    wp_register_style('rams_googleFonts', '//fonts.googleapis.com/css?family=Montserrat:400,700|Crimson+Text:400,700,400italic,700italic' );
		wp_register_style('rams_style', get_stylesheet_uri() );
		
	    wp_enqueue_style( 'rams_googleFonts' );
	    wp_enqueue_style( 'rams_style' );
	}
}

add_action('wp_print_styles', 'rams_load_style');


// Add editor styles
function rams_add_editor_styles() {
    add_editor_style( 'rams-editor-styles.css' );
    $font_url = '//fonts.googleapis.com/css?family=Montserrat:400,700|Crimson+Text:400,700,400italic,700italic';
    add_editor_style( str_replace( ',', '%2C', $font_url ) );
}
add_action( 'init', 'rams_add_editor_styles' );


// Set content-width
if ( ! isset( $content_width ) ) $content_width = 672;


// Check whether the browser supports javascript
function html_js_class () {
    echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
}
add_action( 'wp_head', 'html_js_class', 1 );


// Custom title function
function rams_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'rams' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'rams_wp_title', 10, 2 );


// Add classes to next_posts_link and previous_posts_link
add_filter('next_posts_link_attributes', 'rams_posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'rams_posts_link_attributes_2');

function rams_posts_link_attributes_1() {
    return 'class="archive-nav-older"';
}
function rams_posts_link_attributes_2() {
    return 'class="archive-nav-newer"';
}


// Custom more-link text
add_filter( 'the_content_more_link', 'rams_custom_more_link', 10, 2 );

function rams_custom_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, __('Read more', 'rams') . ' &rarr;', $more_link );
}


// Add class to the post and body elements if the post/page has a featured image
add_filter('post_class','rams_if_featured_image_class');
add_filter('body_class','rams_if_featured_image_class');

function rams_if_featured_image_class($classes) {
	global $post;
	if ( has_post_thumbnail() ) {
		$classes[] = 'has-featured-image';
	} else {
		$classes[] = 'no-featured-image';
	}
	return $classes;
}


// Remove inline styling of attachment
add_shortcode('wp_caption', 'rams_fixed_img_caption_shortcode');
add_shortcode('caption', 'rams_fixed_img_caption_shortcode');

function rams_fixed_img_caption_shortcode($attr, $content = null) {
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}
	
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	
	if ( $output != '' ) return $output;
	extract(shortcode_atts(array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attr));
	
	if ( 1 > (int) $width || empty($caption) )
	return $content;
	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >' 
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}


// Style the admin area
function rams_custom_colors() { 
   echo '
<style type="text/css">

	#postimagediv #set-post-thumbnail img {
		max-width: 100%;
		height: auto;
	}

</style>';
}

add_action('admin_head', 'rams_custom_colors');


// Flexslider function for format-gallery
function rams_flexslider($size) {

	if ( is_page()) :
		$attachment_parent = $post->ID;
	else : 
		$attachment_parent = get_the_ID();
	endif;

	if($images = get_posts(array(
		'post_parent'    => $attachment_parent,
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'           => 'ASC',
	))) { ?>
	
		<div class="flexslider">
		
			<ul class="slides">
	
				<?php foreach($images as $image) { 
					
					$default_attr = array(
						'alt'   => trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )),
					);
				
					$attimg = wp_get_attachment_image($image->ID, $size, $default_attr); ?>
					
					<li>
						<?php echo $attimg; ?>
					</li>
					
				<?php }; ?>
		
			</ul>
			
		</div><?php
		
	}
}


// Rams comment function
if ( ! function_exists( 'rams_comment' ) ) :
function rams_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	
		<?php __( 'Pingback:', 'rams' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'rams' ), '<span class="edit-link">', '</span>' ); ?>
		
	</li>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	
		<div id="comment-<?php comment_ID(); ?>" class="comment">
		
			<div class="avatar-container">
				<?php echo get_avatar( $comment, 160 ); ?>
			</div>
			
			<div class="comment-inner">
		
				<div class="comment-header">
											
					<h4><?php echo get_comment_author_link(); ?></h4>
					
					<p class="comment-date"><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" title="<?php echo get_comment_date() . ' at ' . get_comment_time(); ?>"><?php echo get_comment_date() . '<span> &mdash; ' . get_comment_time() . '</span>'; ?></a></p>
				
				</div>
	
				<div class="comment-content post-content">
				
					<?php if ( '0' == $comment->comment_approved ) : ?>
					
						<p class="comment-awaiting-moderation"><?php __( 'Your comment is awaiting moderation.', 'rams' ); ?></p>
						
					<?php endif; ?>
				
					<?php comment_text(); ?>
					
				</div><!-- /comment-content -->
				
				<div class="comment-actions">
					
					<?php 
						comment_reply_link( array_merge( $args, 
						array( 
							'reply_text' 	=>  	__( 'Reply', 'rams' ), 
							'depth'			=> 		$depth, 
							'max_depth' 	=> 		$args['max_depth'],
							'before'		=>		'<p class="comment-reply">',
							'after'			=>		'</p>'
							) 
						) ); 
					?>
					
					<?php edit_comment_link( __( 'Edit', 'rams' ), '<p class="comment-edit">', '</p>' ); ?>
													
				</div> <!-- /comment-actions -->
			
			</div> <!-- /comment-inner -->
						
		</div><!-- /comment-## -->
				
	<?php
		break;
	endswitch;
}
endif;


// Add and save meta boxes for posts
add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add() {
	add_meta_box( 'post-video-url', __('Video URL', 'rams'), 'cd_meta_box_video_url', 'post', 'side', 'high' );
	add_meta_box( 'post-quote-content-box', __('Quote content', 'rams'), 'cd_meta_box_quote_content', 'post', 'normal', 'core' );
	add_meta_box( 'post-quote-attribution-box', __('Quote attribution', 'rams'), 'cd_meta_box_quote_attribution', 'post', 'normal', 'core' );
}

function cd_meta_box_video_url( $post ) {
	$values = get_post_custom( $post->ID );
	$video_url = isset( $values['video_url'] ) ? esc_attr( $values['video_url'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
		<p>
			<input type="text" class="widefat" name="video_url" id="video_url" value="<?php echo $video_url; ?>" />
		</p>
	<?php		
}

function cd_meta_box_quote_content( $post ) {
	$values = get_post_custom( $post->ID );
	$quote_content = isset( $values['quote_content'] ) ? esc_attr( $values['quote_content'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
		<p>
			<textarea name="quote_content" id="quote_content" class="widefat" rows="5"><?php echo $quote_content; ?></textarea>
		</p>
	<?php		
}

function cd_meta_box_quote_attribution( $post ) {
	$values = get_post_custom( $post->ID );
	$quote_attribution = isset( $values['quote_attribution'] ) ? esc_attr( $values['quote_attribution'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
		<p>
			<input name="quote_attribution" id="quote_attribution" class="widefat" value="<?php echo $quote_attribution; ?>" />
		</p>
	<?php		
}

add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id ) {
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);
	
	// Probably a good idea to make sure the data is set		
	if( isset( $_POST['video_url'] ) ) {
		update_post_meta( $post_id, 'video_url', wp_kses( $_POST['video_url'], $allowed ) );
	}
	
	if( isset( $_POST['quote_content'] ) ) {
		update_post_meta( $post_id, 'quote_content', wp_kses( $_POST['quote_content'], $allowed ) );
	}
	
	if( isset( $_POST['quote_attribution'] ) ) {
		update_post_meta( $post_id, 'quote_attribution', wp_kses( $_POST['quote_attribution'], $allowed ) );
	}

}


// Hide/show meta boxes depending on the post format selected
function meta_box_post_format_toggle()
{
    wp_enqueue_script( 'jquery' );

    $script = '
    <script type="text/javascript">
        jQuery( document ).ready( function($)
            {
            
                $( "#post-video-url" ).hide();
                $( "#post-quote-content-box" ).hide();
                $( "#post-quote-attribution-box" ).hide();
            	
            	if($("#post-format-video").is(":checked"))
	                $( "#post-video-url" ).show();
                
            	if($("#post-format-quote").is(":checked")) {
	                $( "#post-quote-content-box" ).show();
	                $( "#post-quote-attribution-box" ).show();
				}
                
                $( "input[name=\"post_format\"]" ).change( function() {
	                $( "#post-video-url" ).hide();
	                $( "#post-quote-content-box" ).hide();
	                $( "#post-quote-attribution-box" ).hide();
                } );

                $( "input#post-format-video" ).change( function() {
                    $( "#post-video-url" ).show();
				});
				
                $( "input#post-format-quote" ).change( function() {
                    $( "#post-quote-content-box" ).show();
                    $( "#post-quote-attribution-box" ).show();
                });

            }
        );
    </script>';

    return print $script;
}
add_action( 'admin_footer', 'meta_box_post_format_toggle' );


// Rams theme options
class rams_Customize {

   public static function rams_register ( $wp_customize ) {
   
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'rams_options', 
         array(
            'title' => __( 'Options for Rams', 'rams' ), //Visible title of section
            'priority' => 35, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Allows you to customize theme settings for Rams.', 'rams'), //Descriptive tooltip
         ) 
      );
      
      //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'accent_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#6AA897', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );
      
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'rams_accent_color', //Set a unique ID for the control
         array(
            'label' => __( 'Accent Color', 'rams' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'accent_color', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
      
      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
   }

   public static function rams_header_output() {
      ?>
      
	      <!-- Customizer CSS --> 
	      
	      <style type="text/css">
	           <?php self::rams_generate_css('body a', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('body a:hover', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.sidebar', 'background', 'accent_color'); ?>
	           <?php self::rams_generate_css('.flex-direction-nav a:hover', 'background-color', 'accent_color'); ?>
	           <?php self::rams_generate_css('a.post-quote:hover', 'background', 'accent_color'); ?>
	           <?php self::rams_generate_css('.post-title a:hover', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.post-content a', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.post-content a:hover', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.post-content a:hover', 'border-bottom-color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.post-content a.more-link:hover', 'background', 'accent_color'); ?>
	           <?php self::rams_generate_css('.post-content input[type="submit"]:hover', 'background', 'accent_color'); ?>
	           <?php self::rams_generate_css('.post-content input[type="button"]:hover', 'background', 'accent_color'); ?>
	           <?php self::rams_generate_css('.post-content input[type="reset"]:hover', 'background', 'accent_color'); ?>
	           <?php self::rams_generate_css('#infinite-handle span:hover', 'background', 'accent_color'); ?>
	           <?php self::rams_generate_css('.page-links a:hover', 'background', 'accent_color'); ?>
	           <?php self::rams_generate_css('.post-meta-inner a:hover', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.add-comment-title a', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.add-comment-title a:hover', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.bypostauthor .avatar', 'border-color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.comment-actions a:hover', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.comment-header h4 a:hover', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('#cancel-comment-reply-link', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.comments-nav a:hover', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.comment-form input[type="submit"]:hover', 'background-color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.logged-in-as a:hover', 'color', 'accent_color'); ?>
	           <?php self::rams_generate_css('.archive-nav a:hover', 'color', 'accent_color'); ?>
	      </style> 
	      
	      <!--/Customizer CSS-->
	      
      <?php
   }
   
   public static function rams_live_preview() {
      wp_enqueue_script( 
           'rams-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

   public static function rams_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'rams_Customize' , 'rams_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'rams_Customize' , 'rams_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'rams_Customize' , 'rams_live_preview' ) );


// Custom function to send email
function send_mail($to, $from, $subject, $body){
	$to = $to;
	$from = $from;
	ini_set('sendmail_from', $from);
	$subject = $subject;
	$body = $body;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To: '.$to. "\r\n";
	$headers .= 'From: '.$from . "\r\n";
	if(mail($to, $subject, $body, $headers)){	
		echo "sent the mail";
	} else {
		echo "failed";
	}
}


// Logout link in menu
function add_loginout_to_menu( $items, $args ){
	$current_user = wp_get_current_user(); // Get current user login
        //Nav location in your theme. In this case, primary nav. Adjust accordingly.
        if( is_admin() ||  $args->theme_location != 'primary' )
            return $items; 
        if( is_user_logged_in( ) ) {
            $link = '<a href="' . wp_logout_url(site_url('/index.php')) . '" title="' .  __( 'Logout' ) .'">' . __( 'Logout' ) . '</a>';
        }
		else  $link = '<a href="' . site_url('/index.php') . '" title="' .  __( 'Login' ) .'">' . __( 'Login' ) . '</a>';
		$newItems = '<li class="module-icon episteme-user menu-item menu-item-type-custom menu-item-object-custom menu-item-74"><a href="' . site_url('/forum-2/user/'.$current_user->user_login.'/') . '" title="' .  __( 'My Profile' ) .'">' . __( 'My Profile' ) . '</a></li>';
        $logout.= '<li id="loginout-link" class="menu-item menu-type-link">'. $link . '</li>';
		return $newItems.$items.$logout; 
    }
add_filter( 'wp_nav_menu_items', 'add_loginout_to_menu', 10, 2 );

/**
 Validate given user id in LDAP
**/
function ldap_user_details($userId){
	$current_user = wp_get_current_user(); 
	if ( $current_user->user_login == 'admin' || $userId == 'admin'){
		$result1['valid']  = 1;
	} else {
		$current_user = wp_get_current_user(); 
		$ldaprdn = $current_user->user_login.'@cts.com';
		$ldapconn = ldap_connect(LDAP_SERVER, LDAP_PORT) or die("Could not connect to LDAP server.");
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
		$result1['valid']  = 0;	
		if($ldapconn){
			$ldapbind = ldap_bind($ldapconn, $ldaprdn,base64_decode($_SESSION['userpass'])) or die("Incorrect Credentials. Please reload the page " . ldap_errno());			
			
			$filter1 = "(SAMAccountName=".$userId.")";
			$result = ldap_search($ldapconn, LDAP_BASEDN, $filter1) or die("Search error.");
			$entries = ldap_get_entries($ldapconn, $result);
			$result1['valid']  = ldap_count_entries($ldapconn, $result);	
			$result1['image'] = 'data:image/png;base64, '.base64_encode($entries[0]['thumbnailphoto'][0]);
			$result1['email'] = $entries[0]['mail'][0];
			$result1['name'] = $entries[0]['cn'][0];
		}	
	}
	return $result1;
}
?>