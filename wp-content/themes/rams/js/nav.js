/*------------------------------------------------------*/
/* Epsiteme Navigation JS based on JQuery				 				*/
/* Check http://learn.jquery.com/ for documentation			*/
/*------------------------------------------------------*/

var menuFlag = true;

/* This function resizes the entire grid when Menu button is clicked */
function toggleMenu() {
	if (menuFlag) {
		jQuery("#menu-container li a").css('opacity','0');
		jQuery('#menu-container').removeClass('large-2 medium-3').addClass('large-1 medium-2');
		jQuery('#quick-links').removeClass('large-2 medium-3').addClass('large-1 medium-2');
		jQuery('#main-container').removeClass('large-10 medium-9 large-offset-2 medium-offset-3').addClass('large-11 medium-10 large-offset-1 medium-offset-2');
		jQuery('#main-container-home').removeClass('large-10 medium-9 large-offset-2 medium-offset-3').addClass('large-11 medium-10 large-offset-1 medium-offset-2');
		jQuery('#footer').removeClass('large-10 medium-9 large-offset-2 medium-offset-3').addClass('large-11 medium-10 large-offset-1 medium-offset-2');
		jQuery('#episteme-menu-img').hide();
		jQuery('.menu-title').addClass('text-center');
		jQuery('.module-name').hide();
		jQuery('.module-icon').addClass('text-center');
		menuFlag = false; }
	else {
		jQuery("#menu-container li a").css('opacity','1');
		jQuery('#menu-container').removeClass('large-1 medium-2').addClass('large-2 medium-3');
		jQuery('#quick-links').removeClass('large-1 medium-2').addClass('large-2 medium-3');
		jQuery('#main-container').removeClass('large-11 medium-10 large-offset-1 medium-offset-2').addClass('large-10 medium-9 large-offset-2 medium-offset-3');
		jQuery('#main-container-home').removeClass('large-11 medium-10 large-offset-1 medium-offset-2').addClass('large-10 medium-9 large-offset-2 medium-offset-3');
		jQuery('#footer').removeClass('large-11 medium-10 large-offset-1 medium-offset-2').addClass('large-10 medium-9 large-offset-2 medium-offset-3');
		jQuery('#episteme-menu-img').delay('150').fadeIn('150');
		jQuery('.menu-title').removeClass('text-center');
		jQuery('.module-name').delay('150').fadeIn('150');
		jQuery('.module-icon').removeClass('text-center');
		menuFlag = true; } }