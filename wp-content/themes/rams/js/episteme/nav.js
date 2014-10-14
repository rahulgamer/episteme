/*------------------------------------------------------*/
/* Epsiteme Navigation JS based on JQuery				 				*/
/* Check http://learn.jquery.com/ for documentation			*/
/*------------------------------------------------------*/

var menuFlag = true;

/* This function resizes the entire grid when Menu button is clicked */
function toggleMenu() {
	if (menuFlag) {
		$('#menu-container').removeClass('large-2 medium-3').addClass('large-1 medium-2');
		$('#quick-links').removeClass('large-2 medium-3').addClass('large-1 medium-2');
		$('#main-container').removeClass('large-10 medium-9 large-offset-2 medium-offset-3').addClass('large-11 medium-10 large-offset-1 medium-offset-2');
		$('#main-container-home').removeClass('large-10 medium-9 large-offset-2 medium-offset-3').addClass('large-11 medium-10 large-offset-1 medium-offset-2');
		$('#episteme-menu-img').hide();
		$('.menu-title').addClass('text-center');
		$('.module-name').hide();
		$('.module-icon').addClass('text-center');
		menuFlag = false; }
	else {
		$('#menu-container').removeClass('large-1 medium-2').addClass('large-2 medium-3');
		$('#quick-links').removeClass('large-1 medium-2').addClass('large-2 medium-3');
		$('#main-container').removeClass('large-11 medium-10 large-offset-1 medium-offset-2').addClass('large-10 medium-9 large-offset-2 medium-offset-3');
		$('#main-container-home').removeClass('large-11 medium-10 large-offset-1 medium-offset-2').addClass('large-10 medium-9 large-offset-2 medium-offset-3');
		$('#episteme-menu-img').delay('150').fadeIn('150');
		$('.menu-title').removeClass('text-center');
		$('.module-name').delay('150').fadeIn('150');
		$('.module-icon').removeClass('text-center');
		menuFlag = true; } }