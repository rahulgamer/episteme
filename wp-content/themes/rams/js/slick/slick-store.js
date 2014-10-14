jQuery(document).ready(function(){
	jQuery('.store-showcase-slider').slick({
	  centerMode: true,
	  centerPadding: '0px',
	  slidesToShow: 3,
	  autoplay: true,
	  responsive: [
		{
		  breakpoint: 1024,
		  settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '10px',
			slidesToShow: 3
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '50px',
			slidesToShow: 3		  }
		},
		{
		  breakpoint: 360,
		  settings: {
			arrows: false,
			centerMode: true,
			centerPadding: '50px',
			slidesToShow: 1
		  }
		}
	  ]
	});
});