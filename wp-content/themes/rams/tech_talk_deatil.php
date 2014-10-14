<?php
/*
Template Name: Tech Talk Detail
Description: Tech Talk Detailsed Page
Version: 1.0
Author: Prasanna Bommu
*/
get_header();

global $wpdb;
if(!isset($_GET['details'])){
	echo "Page not found";
	exit;
}

$result = $wpdb->get_results( 'SELECT * FROM wp_tech_talk where id = '.$_GET['details'].' ORDER BY id DESC');

?>

<div style="margin:5px 10px;background-color:#6DB33F; color:#fff; font-size:14px;">
 <?php echo $result[0]->topic.' | '. $result[0]->date . ' ' .$result[0]->time; ?>
</div>

<div style="margin:5px 10px; color:#50B3CF; font-size:16px;">
 <?php echo $result[0]->topic; ?>
</div>

<p style="margin:5px 10px; color:#222; font-size:12px;">
<?php echo $result[0]->topic_description; ?>
</p>

<p style="margin:5px 10px; color:#222; font-size:12px;">
	<span style="color:#222; font-size:13px; font-weight:bold;">speaker </span>: 
	<span style="color:#50B3CF; font-size:13px; font-weight:bold;"><?php echo $result[0]->speaker1_name; ?> </span>
	<br />
	<span style="color:#222; font-size:12px;">
		About Speaker : <?php echo $result[0]->about_speaker1; ?>
		<br />
		Associate can be reached at 
		<span style="color:#50B3CF; font-size:12px; font-weight:bold;"><?php echo $result[0]->speaker1_email; ?> </span> <br />
	</span>
</p>