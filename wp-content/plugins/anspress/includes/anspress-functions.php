<?php
/**
 * AnsPress.
 *
 * @package   AnsPress
 * @author    Rahul Aryan <admin@rahularyan.com>
 * @license   GPL-2.0+
 * @link      http://rahularyan.com
 * @copyright 2014 Rahul Aryan
 */


// AnsPress options
function ap_opt($key = false, $value = false){
	$settings = wp_cache_get('ap_opt', 'options');
	
	if($settings === false){
		$settings = get_option( 'anspress_opt');
		if(!$settings)
			$settings = array();
		$settings = $settings + ap_default_options();
		
		wp_cache_set('ap_opt', $settings, 'options');
	}	
	if($value){
		$settings[$key] = $value;
		update_option( 'anspress_opt', $settings);
		return;
	}	
	if(!$key)
		return $settings;
		
	if(isset($settings[$key]))
		return $settings[$key];
	else
		return NULL;
	
	return false;
}

function ap_default_options(){
	$ap_options = get_option( 'anspress_opt');
	$page = get_page($ap_options['base_page']);
	return array(
		'base_page' 			=> get_option('ap_base_page_created'),
		'base_page_slug' 		=> $page->post_name,
		'allow_non_loggedin' 	=> true,
		'show_login' 			=> true,
		'show_signup' 			=> true,
		'login_after_signup' 	=> true,
		'theme' 				=> 'default',
		'author_credits' 		=> false,
		'clear_databse' 		=> false,
		'minimum_qtitle_length'	=> 3,
		'minimum_question_length'=> 5,
		'multiple_answers' 		=> false,
		'minimum_ans_length' 	=> 5,
		'avatar_size_qquestion' => 55,
		'avatar_size_qanswer' 	=> 30,
		'down_vote_points' 		=> -1,
		'flag_note' 			=> array(0 => array('title' => 'it is spam', 'description' => 'This question is effectively an advertisement with no disclosure. It is not useful or relevant, but promotional.')),			
		'bootstrap' 			=> true,
		'question_per_page' 	=> '20',
		'answers_per_page' 		=> '5',
		'tags_per_page' 		=> '20',
		
		'answers_sort' 			=> 'voted',
		
		'base_page_title' 		=> 'AnsPress - Question and answer plugin',
		'ask_page_title' 		=> 'Ask a question',
		'categories_page_title' => 'AnsPress Categories',
		'tags_page_title' 		=> 'AnsPress Tags',
		'users_page_title' 		=> 'AnsPress users',
		'search_page_title' 	=> 'Search result for %s',
		
		'close_selected' 		=> true,
		'enable_tags' 			=> true,
		'max_tags'				=> 5,
		
		'enable_categories'		=> true,
		'cover_width'			=> '878',
		'cover_height'			=> '200',
		'default_rank'			=> '0',
		'users_per_page'		=> 15,
		'cover_width_small'		=> 275,
		'cover_height_small'	=> 80,
		'captcha_ask'			=> true,
		'captcha_answer'		=> true,
		'moderate_new_question'	=> 'no_mod',
		'mod_question_point'	=> 10,
		'categories_per_page'	=> 20,
	);
}

function ap_theme_list(){
	$themes = array();
	$dirs = array_filter(glob(ANSPRESS_THEME_DIR.'/*'), 'is_dir');
	foreach($dirs as $dir)
		$themes[basename($dir)] = basename($dir);		
	return $themes;
}

function ap_get_theme(){	
	$option = ap_opt('theme');
	if(!$option)
		return 'default';
		
	return ap_opt('theme');
}

// get the location of the theme
function ap_get_theme_location($file){
	// checks if the file exists in the theme first,
	// otherwise serve the file from the plugin
	if ( $theme_file = locate_template( array( 'anspress/'.$file ) ) ) {
		$template_path = $theme_file;
	} else {
		$template_path = ANSPRESS_THEME_DIR .'/'.ap_get_theme().'/'.$file;
	}
	return $template_path;
}

// get the url theme
function ap_get_theme_url($file){
	// checks if the file exists in the theme first,
	// otherwise serve the file from the plugin
	if ( $theme_file = locate_template( array( 'anspress/'.$file ) ) ) {
		$template_url = get_template_directory_uri().'/anspress/'.$file;
	} else {
		$template_url = ANSPRESS_THEME_URL .'/'.ap_get_theme().'/'.$file;
	}
	return $template_url;
}


//get current user id
function ap_current_user_id() {
	require_once(ABSPATH . WPINC . '/pluggable.php');
	global $current_user;
	get_currentuserinfo();
	return $current_user->ID;
}

function ap_question_content(){
	global $post;
	echo $post->post_content;
}



function ap_human_time($time, $unix = true){
	if(!$unix)
		$time = strtotime($time);
		
	return human_time_diff( $time, current_time('timestamp') );
}


function ap_please_login(){
	$o  = '<div id="please-login">';
	$o .= '<button>x</button>';
	$o .= __('Please login or register to continue this action.', 'ap');
	$o .= '</div>';
	
	echo apply_filters('ap_please_login', $o);
}

//check if user answered on a question
function ap_is_user_answered($question_id, $user_id){
	global $wpdb;
	
	$count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts where post_parent = $question_id AND ( post_author = $user_id AND post_type = 'answer')");
	if($count)	
		return true;	
	return false;
}


// count numbers of answers
function ap_count_ans($id){
		
	global $wpdb;
	$count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts where post_parent = $id AND post_status = 'publish' AND post_type = 'answer'");

	return $count;
}

function ap_count_ans_meta($post_id =false){
	if(!$post_id) $post_id = get_the_ID();
	$count = get_post_meta($post_id, ANSPRESS_ANS_META, true);
	 return $count ? $count : 0;
}

function ap_last_active($post_id =false){
	if(!$post_id) $post_id = get_the_ID();
	return get_post_meta($post_id, ANSPRESS_UPDATED_META, true);
}

//check if current questions have answers
function ap_have_ans($id){
	
	if(ap_count_ans($id) > 0)
		return true;	
	
	return false;
}

// link to asnwers
function ap_answers_link(){
	return get_permalink().'#answers';
}

function ap_get_link_to($page){
	//$home = wp_make_link_relative(home_url() );
	$base = rtrim(get_permalink(ap_opt('base_page')), '/');

	/* if (filter_var($home, FILTER_VALIDATE_URL) !==FALSE)
		$home = '';
	
	$home = ltrim($home,'/');
	$base = ltrim($base,'/');
	$rel = ltrim($base, $home); */

	return $base.'/'.$page;
}

function ap_comment_btn_html(){
	$action = get_post_type(get_the_ID()).'-'.get_the_ID();
	$nonce = wp_create_nonce( $action );
	echo '<a href="#ap-comment-area-'.get_the_ID().'" class="comment-btn" data-action="ap-load-comment" data-args="'. get_the_ID().'-'. $nonce .'" title="'.__('Add comment', 'ap').'">'.__('Comment', 'ap').'</a>';
}
function ap_edit_q_btn_html(){
	$post_id = get_the_ID();
	if(ap_user_can_edit_question($post_id)){		
		$action = 'question-'.$post_id;
		$nonce = wp_create_nonce( $action );
		$edit_link = add_query_arg( array('edit_q' => $post_id, 'nonce' => $nonce), get_permalink( ap_opt('base_page')) );
		//$args = json_encode(array('action' => 'ap_load_edit_form', 'id'=> $post_id, 'nonce' => $nonce, 'type' => 'question'));
		echo "<a href='$edit_link' data-button='ap-edit-post' title='".__('Edit this question', 'ap')."'>".__('Edit', 'ap')."</a>";
	}
	return;
}

function ap_edit_a_btn_html(){
	$post_id = get_edit_answer_id();
	if(ap_user_can_edit_ans($post_id)){		
		$action = 'answer-'.$post_id;
		$nonce = wp_create_nonce( $action );
		$edit_link = add_query_arg( array('edit_a' => $post_id, 'ap_nonce' => $nonce), get_permalink( ap_opt('a_edit_page')) );
		$args = json_encode(array('action' => 'ap_load_edit_form', 'id'=> $post_id, 'nonce' => $nonce, 'type' => 'answer'));
		echo "<a href='$edit_link.' class='btn btn-xs edit-btn aicon-edit' data-button='ap-edit-post' data-args='$args' title='".__('Edit Answer', 'ap')."'>".__('Edit', 'ap')."</a>";
	}
	return;
}
function ap_answer_edit_link(){
	$post_id = get_the_ID();
	if(ap_user_can_edit_ans($post_id)){		
		$action = get_post_type($post_id).'-'.$post_id;
		$nonce = wp_create_nonce( $action );
		$edit_link = add_query_arg( array('edit_a' => $post_id, 'ap_nonce' => $nonce), get_permalink( ap_opt('base_page')) );
		return apply_filters( 'ap_answer_edit_link', $edit_link );
	}
	return;
}

function ap_truncate_chars($text, $limit, $ellipsis = '...') {
    if( strlen($text) > $limit ) {
        $endpos = strpos(str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $text), ' ', $limit);
        if($endpos !== FALSE)
            $text = trim(substr($text, 0, $endpos)) . $ellipsis;
    }
    return $text;
}


function ap_get_all_users(){
	$paged 			= (get_query_var('paged')) ? get_query_var('paged') : 1;
	$per_page    	= ap_opt('tags_per_page');
	$total_terms 	= wp_count_terms('question_tags'); 	
	$offset      	= $per_page * ( $paged - 1) ;
	
	$args = array(
		'number'		=> $per_page,
		'offset'       	=> $offset
	);
	
	$users = get_users( $args); 
		
	echo '<ul class="ap-tags-list">';
		foreach($users as $key => $user) :

			echo '<li>';
			echo $user->display_name;			
			echo '</li>';

		endforeach;
	echo'</ul>';
	
	ap_pagination(ceil( $total_terms / $per_page ), $range = 1, $paged);
}


function ap_editor_content($content){
	wp_editor( esc_textarea($content), 'post_content', array('tinymce' => false, 'textarea_rows' => 7, 'media_buttons' => false, 'quicktags'=> array('buttons'=>'strong,em,link,blockquote,del,ul,li,ol,img,code,close'))); 
}

function ap_base_page_slug(){
	$base_page_slug = ap_opt('base_page_slug');
	
	// get the base slug, if base page was set to home page then dont use any slug
	$slug = ((ap_opt('base_page') !== get_option('page_on_front')) ? $base_page_slug.'/' : '');
	
	$base_page = get_post(ap_opt('base_page'));
	
	if( $base_page->post_parent != 0 ){
		$parent_page = get_post($base_page->post_parent);
		$slug = $parent_page->post_name . '/'.$slug;
	}
	
	return apply_filters('ap_base_page_slug', $slug) ;
}

function ap_answers_list($question_id, $order = 'voted'){

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if(is_question()){
		$order = get_query_var('sort');
		if(empty($order ))
			$order = ap_opt('answers_sort');
	}
	
	if($order == 'voted'){
		$ans_args=array(
			'ap_query' => 'answer_sort_voted',
			'post_type' => 'answer',
			'post_status' => 'publish',
			'post_parent' => get_the_ID(),
			'showposts' => ap_opt('answers_per_page'),
			'paged' => $paged,
			'orderby' => 'meta_value_num',
			'meta_key' => ANSPRESS_VOTE_META,
			'meta_query'=>array(
				'relation' => 'OR',
				array(
					'key' => ANSPRESS_BEST_META,
					'compare' => '=',
					'value' => '1'
				),
				array(
					'key' => ANSPRESS_BEST_META,
					'compare' => 'NOT EXISTS'
				)
			)
		);
	}elseif($order == 'oldest'){
		$ans_args=array(
			'ap_query' => 'answer_sort_newest',
			'post_type' => 'answer',
			'post_status' => 'publish',
			'post_parent' => get_the_ID(),
			'showposts' => ap_opt('answers_per_page'),
			'paged' => $paged,
			'orderby' => 'meta_value date',
			'meta_key' => ANSPRESS_BEST_META,
			'order' => 'ASC',
			'meta_query'=>array(
				'relation' => 'OR',
				array(
					'key' => ANSPRESS_BEST_META,
					'compare' => 'NOT EXISTS'
				)
			)
		);
	}else{
		$ans_args=array(
			'ap_query' => 'answer_sort_newest',
			'post_type' => 'answer',
			'post_status' => 'publish',
			'post_parent' => get_the_ID(),
			'showposts' => ap_opt('answers_per_page'),
			'paged' 	=> $paged,			
			'orderby' 	=> 'meta_value date',
			'meta_key' => ANSPRESS_BEST_META,
			'order' 	=> 'DESC',
			'meta_query'=>array(
				'relation' => 'OR',
				array(
					'key' => ANSPRESS_BEST_META,
					'compare' => 'NOT EXISTS'
				)
			)
		);
	}
	
	$ans_args = apply_filters('ap_answers_query_args', $ans_args);
	
	$ans = new WP_Query($ans_args);	
	
	// get answer sorting tab
	echo '<div id="answers-c">';
	ap_ans_tab(); 	
	echo '<div id="answers">';
		echo '<span class="ap-tline"></span>';
		while ( $ans->have_posts() ) : $ans->the_post(); 
			include(ap_get_theme_location('answer.php'));
		endwhile ;
	echo '</div>';	
	ap_pagination('', 2, $paged, $ans);
	echo '</div>';
	wp_reset_query();
}

function ap_ans_tab(){
	$order = get_query_var('sort');
	if(empty($order ))
		$order = ap_opt('answers_sort');
		
		$link = '?sort=';
		$ans_count = ap_count_ans(get_the_ID());
	?>
		<div class="ap-anstabhead clearfix">
			<h2 class="ap-answer-count pull-left" data-view="ap-answer-count-label"><?php printf(_n('<span>1 Answer</span>', '<span>%d Answers</span>', $ans_count, 'ap'), $ans_count); ?></h2>
			<ul class="ap-ans-tab ap-tabs clearfix" role="tablist">
				<li class="<?php echo $order == 'newest' ? ' active' : ''; ?>"><a href="<?php echo $link.'newest'; ?>"><?php _e('Newest', 'ap'); ?></a></li>
				<li class="<?php echo $order == 'oldest' ? ' active' : ''; ?>"><a href="<?php echo $link.'oldest'; ?>"><?php _e('Oldest', 'ap'); ?></a></li>
				<li class="<?php echo $order == 'voted' ? ' active' : ''; ?>"><a href="<?php echo $link.'voted'; ?>"><?php _e('Voted', 'ap'); ?></a></li>
			</ul>
		</div>
	<?php
}

function ap_ans_list_tab(){
	$order = get_query_var('sort');
	if(empty($order ))
		$order = ap_opt('answers_sort');
		
		$link = '?sort=';
		$ans_count = ap_count_ans(get_the_ID());
	?>
		<ul class="ap-ans-tab ap-tabs clearfix" role="tablist">
			<li class="<?php echo $order == 'newest' ? ' active' : ''; ?>"><a href="<?php echo $link.'newest'; ?>"><?php _e('Newest', 'ap'); ?></a></li>
			<li class="<?php echo $order == 'oldest' ? ' active' : ''; ?>"><a href="<?php echo $link.'oldest'; ?>"><?php _e('Oldest', 'ap'); ?></a></li>
			<li class="<?php echo $order == 'voted' ? ' active' : ''; ?>"><a href="<?php echo $link.'voted'; ?>"><?php _e('Voted', 'ap'); ?></a></li>
		</ul>
	<?php
}

function ap_questions_tab(){
	$order = get_query_var('sort');
	$label = sanitize_text_field(get_query_var('label'));
	$search_q = sanitize_text_field(get_query_var('ap_s'));
	if(empty($order ))
		$order = 'active';//ap_opt('answers_sort');
	
	if(empty($status ))
		$status = '';
	
	$search = '';
	if(empty($status ))
		$search = 'ap_s='.$search_q.'&';
		
	$link = '?'.$search.'sort=';
	$label_link = '?'.$search.'sort='.$order.'&label=';
	
	?>
	<div class="ap-lists-tab clearfix">
		<ul class="ap-tabs clearfix" role="tablist">			
			<li class="<?php echo $order == 'active' ? ' active' : ''; ?>"><a href="<?php echo $link.'active'; ?>"><?php _e('Active', 'ap'); ?></a></li>
			<li class="<?php echo $order == 'newest' ? ' active' : ''; ?>"><a href="<?php echo $link.'newest'; ?>"><?php _e('Newest', 'ap'); ?></a></li>			
			<li class="<?php echo $order == 'voted' ? ' active' : ''; ?>"><a href="<?php echo $link.'voted'; ?>"><?php _e('Voted', 'ap'); ?></a></li>
			<li class="<?php echo $order == 'answers' ? ' active' : ''; ?>"><a href="<?php echo $link.'answers'; ?>"><?php _e('Most answers', 'ap'); ?></a></li>
			<li class="<?php echo $order == 'unanswered' ? ' active' : ''; ?>"><a href="<?php echo $link.'unanswered'; ?>"><?php _e('Unanswered', 'ap'); ?></a></li>
			<li class="<?php echo $order == 'oldest' ? ' active' : ''; ?>"><a href="<?php echo $link.'oldest'; ?>"><?php _e('Oldest', 'ap'); ?></a></li>			
		</ul>
		<div class="pull-right">
			<ul class="ap_status ap-dropdown">
				<a href="#" class="btn ap-btn ap-dropdown-toggle"><?php _e('Label', 'ap'); ?> &#9662;</a>
				<ul class="ap-dropdown-menu">
					<?php
						$labels = get_terms('question_label', array('orderby'=> 'name','hide_empty'=> true));
						foreach($labels as $l){
							$color = ap_get_label_color($l->term_id);
							echo '<li'. ($label == $l->slug ? ' class="active" ' : '') .'><a href="'.$label_link.$l->slug.'" title="'.$l->description.'"><span class="question-label-color" style="background:'.$color.'"> </span>'.$l->name.'</a></li>';
						}
					?>
				</ul>
			</ul>
		</div>
	</div>
	<?php
}

function ap_untrash_post( $post_id ) {
    // no post?
    if( !$post_id || !is_numeric( $post_id ) ) {
        return false;
    }
    $_wpnonce = wp_create_nonce( 'untrash-post_' . $post_id );
    $url = admin_url( 'post.php?post=' . $post_id . '&action=untrash&_wpnonce=' . $_wpnonce );
    return $url; 
}

function ap_user_can($id){
	get_user_meta( $id, 'ap_role', true );
}

function ap_question_tab(){
	?>
		<ul class="ap-tabs ap-question-tab clearfix" data-action="ap-tabs" role="tablist">
			<li class="active"><a href="#discussion"><?php _e('Discussion', 'ap'); ?></a></li>
			<li><a href="#history"><?php _e('History', 'ap'); ?></a></li>
			<li><a href="#related"><?php _e('Related', 'ap'); ?></a></li>
		</ul>
	<?php
}

function ap_selected_answer($post_id = false){
	if(!$post_id)
		$post_id = get_the_ID();
		
	return get_post_meta($post_id, ANSPRESS_SELECTED_META, true);
}


function ap_is_answer_selected($post_id = false){
	if(!$post_id)
		$post_id = get_the_ID();
		
	$meta = get_post_meta($post_id, ANSPRESS_SELECTED_META, true);

	if(!$meta)
		return false;
	
	return true;
}

function ap_is_best_answer($post_id = false){
	if(!$post_id){
		$post_id = get_the_ID();
	}
	$meta = get_post_meta($post_id, ANSPRESS_BEST_META, true);
	if($meta) return true;
		
	return false;
}

function ap_select_answer_btn_html($post_id){
	if(!ap_user_can_select_answer($post_id))
		return;
	
	$ans = get_post($post_id);
	$action = 'answer-'.$post_id;
	$nonce = wp_create_nonce( $action );	
	
	if(!ap_is_answer_selected($ans->post_parent)){		
		return '<a href="#" class="ap-sicon ap-icon-answer ap-tip" data-button="ap-select-answer" data-args="'. $post_id.'-'. $nonce .'" title="'.__('Select this answer as best', 'ap').'"></a>';
		
	}elseif(ap_is_answer_selected($ans->post_parent) && ap_is_best_answer($ans->ID)){
		return '<a href="#" class="ap-sicon ap-icon-answer selected ap-tip" data-button="ap-select-answer" data-args="'. $post_id.'-'. $nonce .'" title="'.__('Unselect this answer', 'ap').'"></a>';
		
	}
}

function ap_post_delete_btn_html($post_id = false){
	if(!$post_id){
		$post_id = get_the_ID();
	}
	if(ap_user_can_delete($post_id)){		
		$action = 'delete_post_'.$post_id;
		$nonce = wp_create_nonce( $action );
		
		echo '<a href="#" class="delete-btn" data-button="ap-delete-post" data-args="'. $post_id.'-'. $nonce .'" title="'.__('Delete', 'ap').'">'.__('Delete', 'ap').'</a>';
	}
}

function ap_get_child_answers_comm($post_id){
	global $wpdb;
	$ids = array();
	
	$query = "SELECT p.ID, c.comment_ID from $wpdb->posts p LEFT JOIN $wpdb->comments c ON c.comment_post_ID = p.ID OR c.comment_post_ID = $post_id WHERE post_parent = $post_id";
	
	$key = md5($query);	
	$cache = wp_cache_get($key, 'count');
	
	if($cache === false){
		$cols = $wpdb->get_results( $query, ARRAY_A);
		wp_cache_set($key, $cols, 'count');
	}else
		$cols = $cache;
	
	
	if($cols){
		foreach($cols as $c){
			if(!empty($c['ID']))
				$ids['posts'][] = $c['ID'];
			
			if(!empty($c['comment_ID']))
				$ids['comments'][] = $c['comment_ID'];
		}
	}else{
		return false;
	}
	
	if(isset($ids['posts']))
		$ids['posts']= array_unique ($ids['posts']);
	
	if(isset($ids['comments']))
		$ids['comments'] = array_unique ($ids['comments']);

	return $ids;
}

function ap_short_num($num, $precision = 2) {
	if ($num >= 1000 && $num < 1000000) {
		$n_format = number_format($num/1000,$precision).'K';
	} else if ($num >= 1000000 && $num < 1000000000) {
		$n_format = number_format($num/1000000,$precision).'M';
	} else if ($num >= 1000000000) {
		$n_format=number_format($num/1000000000,$precision).'B';
	} else {
		$n_format = $num;
	}
	return $n_format;
}

function sanitize_comma_delimited($str){
	return implode(",", array_map("intval", explode(",", $str)));
}

function ap_pagi($base, $total_pages, $paged, $end_size = 1, $mid_size = 5){
	$pagi_a = paginate_links( array(
		'base' => $base, // the base URL, including query arg
		'format' => 'page/%#%', // this defines the query parameter that will be used, in this case "p"
		'prev_text' => __('&laquo; Previous', 'ap'), // text for previous page
		'next_text' => __('Next &raquo;', 'ap'), // text for next page
		'total' => $total_pages, // the total number of pages we have
		'current' => $paged, // the current page
		'end_size' => 1,
		'mid_size' => 5,
		'type' => 'array'
	));
	if($pagi_a){
		echo '<ul class="ap-pagination clearfix">';
			echo '<li><span class="page-count">'. sprintf(__('Page %d of %d', 'ap'), $paged, $total_pages) .'</span></li>';
			foreach($pagi_a as $pagi){
				echo '<li>'. $pagi .'</li>';
			}
		echo '</ul>';
	}
}

function ap_question_side_tab(){
	$links = array (
		'discussion' => array('icon' => 'ap-icon-flow-tree', 'title' => __('Discussion', 'ap'), 'url' => '#discussion')
	);
	$links = apply_filters('ap_question_tab', $links);
	$i = 1;
	if(count($links) > 1){
		echo '<ul class="ap-question-extra-nav" data-action="ap-tab">';
			foreach($links as $link){
				echo '<li'.($i == 1 ? ' class="active"' : '').'><a class="'.$link['icon'].'" href="'.$link['url'].'">'.$link['title'].'</a></li>';
				$i++;
			}
		echo '</ul>';
	}
}

function ap_read_features($type = 'addon'){
	$option = get_option('ap_addons');
	$cache = wp_cache_get('ap_'.$type.'s_list', 'array');
	
	if($cache !== FALSE)
		return $cache;
		
	$features = array();
	//load files from addons folder
	$files=glob(ANSPRESS_DIR.'/'.$type.'s/*/'.$type.'.php');
	//print_r($files);
	foreach ($files as $file){
		$data = ap_get_features_data($file);
		$data['folder'] = basename(dirname($file));
		$data['file'] = basename($file);
		$data['active'] = (isset($option[$data['name']]) && $option[$data['name']]) ? true : false;
		$features[$data['name']] = $data;
	}
	wp_cache_set( 'ap_'.$type.'s_list', $features, 'array');
	return $features;
}


function ap_get_features_data( $plugin_file) {
	$plugin_data = ap_get_file_data( $plugin_file);

	return $plugin_data;
}

function ap_get_file_data( $file) {
	// We don't need to write to the file, so just open for reading.
	$fp = fopen( $file, 'r' );

	// Pull only the first 8kiB of the file in.
	$file_data = fread( $fp, 1000 );

	// PHP will close file handle, but we are good citizens.
	fclose( $fp );

	$metadata=ap_features_metadata($file_data, array(
		'name' 				=> 'Name',
		'version' 			=> 'Version',
		'description' 		=> 'Description',
		'author' 			=> 'Author',
		'author_uri' 		=> 'Author URI',
		'addon_uri' 		=> 'Addon URI'
	));

	return $metadata;
}

function ap_features_metadata($contents, $fields){
	$metadata=array();

	foreach ($fields as $key => $field)
		if (preg_match('/'.str_replace(' ', '[ \t]*', preg_quote($field, '/')).':[ \t]*([^\n\f]*)[\n\f]/i', $contents, $matches))
			$metadata[$key]=trim($matches[1]);
	
	return $metadata;
}

function ap_users_tab(){
	$order = get_query_var('sort');
	
	if(empty($order ))
		$order = 'points';//ap_opt('answers_sort');
	
	$link = '?sort=';

	
	?>
	<div class="ap-lists-tab clearfix">
		<ul class="ap-tabs clearfix" role="tablist">			
			<li class="<?php echo $order == 'points' ? ' active' : ''; ?>"><a href="<?php echo $link.'points'; ?>"><?php _e('Points', 'ap'); ?></a></li>
			<li class="<?php echo $order == 'newest' ? ' active' : ''; ?>"><a href="<?php echo $link.'newest'; ?>"><?php _e('Newest', 'ap'); ?></a></li>			
		</ul>
	</div>
	<?php
}

function ap_custom_tabs($category_name=''){
$category_name = strtolower($category_name);
if(empty($category_name ))
		$category_name = 'active';
?>

	<div class="tabs hide-for-small">
		<li class="tab-title<?php echo $category_name == 'active' ? ' active' : ''; ?>"><a class="episteme-questions" href="<?php echo site_url('/forum-2/'); ?>">Questions</a></li>
		<li class="tab-title<?php echo $category_name == 'informational' ? ' active' : ''; ?>"><a class="episteme-informational" href="<?php echo site_url('/forum-2/category/informational/'); ?>">Informational</a></li>
		<li class="tab-title<?php echo $category_name == 'concepts' ? ' active' : ''; ?>"><a class="episteme-concepts" href="<?php echo site_url('/forum-2/category/concepts/'); ?>">Concepts</a></li>
		<li class="tab-title<?php echo $category_name == 'users' ? ' active' : ''; ?>"><a class="episteme-users" href="<?php echo site_url('/forum-2/users/'); ?>">Users</a></li>
	</div>
<?php
}
?>