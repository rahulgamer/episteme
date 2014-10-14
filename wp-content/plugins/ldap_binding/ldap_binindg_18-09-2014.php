<?php
/**
 * Plugin Name: Ldap Binding
 **/
add_filter('authenticate', 'ldap_binding', 1, 3);
function ldap_binding($user, $username="", $password){
   if ( $username == 'admin' ) { return $user; }
	$ldaprdn = '';
	$domain = '';
	$samaccount = trim($username);
	$ldaprdn = $username.'@cts.com';
	$ldappass = $password;
	$ldapconfig['basedn'] = 'dc=cts,dc=com';
	$ldapconfig['authrealm'] = 'My CTS';
	//LDAP Connection to SERVER
	if($username != ''){
		$ldapconn = ldap_connect("LDAP://10.237.5.185", "389") or die("Could not connect to LDAP server.");
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);	
	}

	if ($ldapconn) {		
		// binding to ldap server
		$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass) or die("Could not bind " . ldap_errno());
		$filter1 = "(SAMAccountName=" . $samaccount . ")";
		//without attribute all the variables present in the LDAP will be displayed
		$result = ldap_search($ldapconn, $ldapconfig['basedn'], $filter1) or die("Search error.");
		$entries = ldap_get_entries($ldapconn, $result);
		$user = get_user_by('login', $username);
		// Prepare $user_data array
		$user_data = array();
		if( is_array($entries) ) {
			$user_data['user_nicename'] = $entries[0]['cn'][0];
			$user_data['user_email'] 	= $entries[0]['mail'][0];
			$user_data['display_name']	= $entries[0]['displayname'][0];
			$user_data['first_name']	= $entries[0]['givenname'][0];
			$user_data['last_name'] 	= $entries[0]['sn'][0];
			$user_data['user_login']  =  $username;
			$user_data['user_pass']    =  $password;
		}
		ldap_close($ldapconn); 
		if ( ! $user || ( strtolower($user->user_login) !== strtolower($username) ) )  {			
			$new_user = wp_insert_user( $user_data );
			if( ! is_wp_error($new_user) ){
				// On Successful Login create WP user object and settion
				$new_user = new WP_User($new_user);
				do_action_ref_array('auth_success', array($new_user) );
				return ($new_user);
			} else {
				do_action( 'wp_login_failed', $username );
				return new WP_Error("login_error", __('<strong>Simple LDAP Login Error</strong>: LDAP credentials are correct and user creation is allowed but an error occurred creating the user in WordPress. Actual error: '.$new_user->get_error_message() ));
			}
		}else {
			$user_id = wp_update_user( $user_data);
			return new WP_User($user->ID);
		}
	}
}
		
add_filter('login_redirect', 'ldap_login_redirect', 10, 3);
// custom function to redirect user after login
function ldap_login_redirect($redirect_to, $request, $user){
	return (is_array($user->roles) && in_array('administrator', $user->roles)) ? admin_url() : site_url();
}
?>