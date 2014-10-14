
<?php
	ap_custom_tabs('users');
?>
<?php dynamic_sidebar( 'ap-top' ); ?>
<div id="ap-users" class="clearfix">
	<?php
	ap_users_tab();
	
	if ( ! empty( $users->results ) ) {
		foreach ( $users->results as $f ) {
			$data = $f->data;
			$current_user_meta = array_map( function( $a ){ return $a[0]; }, get_user_meta($f->ID));
			include(ap_get_theme_location('content-user.php'));
		}


	} else {
		_e('No users found.', 'ap');
	}
	?>
</div>
