<?php
/*
Template Name: Tech Talk
Description: This Template will allow admin user to create a tech-talk schedule
Version: 1.0
Author: Prasanna Bommu
*/
get_header();

if (!(is_admin())){
	wp_redirect( site_url().'/tech-talk-list');
	exit;
}

// Processing form data
$errorStr = "";	
$inserted = 0; 
if($_POST['save_details'] == 'Save'){
	if($_POST['speaker1_id'] == '')
		$errorStr .= "Enter First Speaker 1 CTS ID <br />";
	else{
		$speaker_details = ldap_user_details($_POST['speaker1_id']);
		if($speaker_details['valid'] == 0 ){
			$errorStr .= "Enter Valid CTS ID as Speaker 1<br />";
		}else {
			 $speaker_data = array('speaker1_id' => $_POST['speaker1_id'],
							'speaker1_name' => $speaker_details['name'],
							'speaker1_email' => $speaker_details['email'],
							'about_speaker1' => $_POST['about_speaker1']);
		}
	}
	if($_POST['speaker2_id'] != ''){
		$speaker2_details = ldap_user_details($_POST['speaker2_id']);
		if($speaker2_details['valid'] == 0 ){
			$errorStr .= "Enter Valid CTS ID as Speaker 2<br />";
		}else {
			$speaker2_data = array('speaker2_id' => $_POST['speaker2_id'],
							'speaker2_name' => $speaker2_details['name'],
							'speaker2_email' => $speaker2_details['email'],
							'about_speaker2' => $_POST['about_speaker2']);
		}
	}
	if($_POST['topic'] == '')
		$errorStr .= "Enter Topic <br />";
	if($_POST['vanue'] == '')
		$errorStr .= "Enter Venue Details <br />";
	if($_POST['talk_date'] == '')
		$errorStr .= "Enter Date  <br />";
	if($_POST['talk_time'] == '')
		$errorStr .= "Enter  Time <br />";	
		
	
	// Save the values into DB
	
	if($errorStr =='') {
		global $wpdb;
		
		$data = array( 
					'type' => $_POST['type'], 					
					'topic' => $_POST['topic'],
					'topic_description' => nl2br($_POST['topic_description']),
					'talk_date' => $_POST['talk_date'],
					'talk_time' => $_POST['talk_time'],
					'venue' => $_POST['venue'],
					//'have_presentation' => $_POST['speaker1_id']
					//'presentation_path' => $_POST['speaker1_id'],
					'added_by_user' => get_current_user_id()
				);
		$data = array_merge($data,$speaker_data);
		
		if($_POST['speaker2_id'] != ''){
			$data = array_merge($data,$speaker2_data);
		}
		
		$inserted = $wpdb->insert( 'wp_tech_talk', $data );
		if ($inserted){
		  wp_redirect( site_url().'/tech-talk-list');
		  exit;
		}
	}
}

?>
<?php
/**
	A form to enter Tech talk event details

**/
if (get_current_user_id() == 1) {
 echo "Login as non-admin user, to get the speaker details from LDAP";
}
?>
<div >
	<a href="<?php echo site_url().'/tech-talk-list/' ?>">Display List</a>
</div>
<div id="error_msgs">
<?php
	if ($errorStr != ""){
?>
	
		<?php echo $errorStr; ?>
	
<?php
	}
?>
</div>

<form action="" method="post">

	<input type="hidden" name="added_by_user" value="<?php echo get_current_user_id();?>" />
	<div>
		<label for="type" > Tech-Talk Type</label>
		<select name='type'>
			<option value='Internal'>Internal</option>
			<option value='External'>External</option>
		</select>
	</div>
	<div>
		<label for="speaker1_id" > First Speaker CTS ID *</label>
		<input type="number" name="speaker1_id" pattern=".{6,6}" value="" />
	</div>
	<div>
		<label for="about_speaker1" > About First Speaker *</label>
		<textarea name="about_speaker1" rows="7"></textarea>
	</div>
	<div>
		<label for="speaker2_id" > Second Speaker CTS ID *</label>
		<input type="number" name="speaker2_id" maxlength='6' value="" />
	</div>
	<div>
		<label for="about_speaker2" > About Second Speaker *</label>
		<textarea name="about_speaker2" rows="7"></textarea>
	</div>
	<div>
		<label for="topic" > Topic *</label>
		<input type="text" name="topic" value=""  />
	</div>
	<div>
		<label for="topic_description" > Topic Description *</label>
		<textarea name="topic_description" rows="7"></textarea>
	</div>
	<div>
		<label for="venue" > Venue *</label>
		<input type="text" name="venue" value="" />
	</div>
	<div>
		<label for="talk_date" > Date *</label>
		<input type="date" name="talk_date" min="<?php echo date('m/d/Y')?>" placeholder="<?php echo date('m/d/Y')?>" value="" />
	</div>
	<div>
		<label for="talk_time" > Time *</label>
		<input type="time" name="talk_time" min="<?php echo date('h:i a')?>" placeholder="<?php echo date('h:i a')?>"  value="" />
	</div>
	<!--<div>
		<label for="presentation" > Upload Presentation</label>
		<input type="file" name="presentation" value="" />
	</div>-->
	<div>
		<input type="submit" name="save_details" value="Save" />
	</div>
</form>