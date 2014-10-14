<?php
/*
Template Name: Magazine
*/
get_header();
?>
<div style="margin-top:15px;">
<?php
query_posts( array ( 'category_name' => 'Magazine', 'posts_per_page' => -1 ) );

while ( have_posts() ) : the_post();
	echo '<h1>';
	echo "<a href='".get_permalink()."'>".get_the_title()."</a>";
	echo '</h1>';
	the_excerpt();
	echo ' <p class="postinfo">Written by: ';
	the_author_posts_link();
	echo '</p>';
	echo ' <p class="postinfo"> ';
	echo 'Posted on ';
	the_date();
	echo '</p>';
	
endwhile; 
wp_reset_query();
?>

</div>
<div style="margin-top:15px;">

Archeives
<!-- Displays Monthly archieves -->
<?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 12 ) ); ?>

</div>
