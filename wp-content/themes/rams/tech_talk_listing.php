<?php
/*
Template Name: Tech Talk List
Description: Listing All Tech Talk Events
Version: 1.0
Author: Prasanna Bommu
*/
get_header();
global $wpdb;

$result = $wpdb->get_results( 'SELECT * FROM wp_tech_talk ORDER BY id DESC');
// echo "<pre>";
// print_r($result);
// echo "</pre>";
?>

<table style="border:1 solid #000;" border="1">
	<tr>
		<th>Speaker(s)</th>
		<th>Topic</th>
		<th>Venue</th>
		<th>Date</th>
		<th>Talk Type</th>
	</tr>
	<?php
		$rows = "";
		foreach($result as $data_row){
			$rows .= "<tr>";
			$rows .= "<td>".$data_row->speaker1_name;
			if ($data_row->speaker1_id != null){
				$rows .= "<br />".$data_row->speaker2_name;
			}
			$rows .= "</td>";
			$rows .= "<td>";
			$rows .= "<a href='".site_url()."/tech-talk-details/?details=".$data_row->ID."'>".$data_row->topic."</a>";
			$rows .= "</td>";
			$rows .= "<td>".$data_row->venue;
			$rows .= "</td>";
			$datetime = $data_row->date.' '.$data_row->time;
			$datetime = strtotime($datetime);
			$rows .= "<td>".date('M d, Y',$datetime).' '. date('h:i A', $datetime)."</td>";
			$rows .= "<td>".$data_row->type."</td>";			
			$rows .= "</tr>";
		}
		echo $rows;
	?>
</table>