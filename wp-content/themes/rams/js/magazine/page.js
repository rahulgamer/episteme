var Page = (function() {

	var jQuerycontainer = jQuery( '#container' ),
		jQuerybookBlock = jQuery( '#bb-bookblock' ),
		jQueryitems = jQuerybookBlock.children(),
		itemsCount = jQueryitems.length,
		current = 0,
		bb = jQuery( '#bb-bookblock' ).bookblock( {
			speed : 800,
			perspective : 2000,
			shadowSides	: 0.8,
			shadowFlip	: 0.4,
			onEndFlip : function(old, page, isLimit) {
				
				current = page;
				// update TOC current
				updateTOC();
				// updateNavigation
				updateNavigation( isLimit );
				// initialize jScrollPane on the content div for the new item
				setJSP( 'init' );
				// destroy jScrollPane on the content div for the old item
				setJSP( 'destroy', old );

			}
		} ),
		jQuerynavNext = jQuery( '#bb-nav-next' ),
		jQuerynavPrev = jQuery( '#bb-nav-prev' ).hide(),
		jQuerymenuItems = jQuerycontainer.find( 'ul.menu-toc > li' ),
		jQuerytblcontents = jQuery( '#tblcontents' ),
		transEndEventNames = {
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'oTransitionEnd',
			'msTransition': 'MSTransitionEnd',
			'transition': 'transitionend'
		},
		transEndEventName = transEndEventNames[Modernizr.prefixed('transition')],
		supportTransitions = Modernizr.csstransitions;

	function init() {

		// initialize jScrollPane on the content div of the first item
		setJSP( 'init' );
		initEvents();

	}
	
	function initEvents() {

		// add navigation events
		jQuerynavNext.on( 'click', function() {
			bb.next();
			return false;
		} );

		jQuerynavPrev.on( 'click', function() {
			bb.prev();
			return false;
		} );
		
		// add swipe events
		jQueryitems.on( {
			'swipeleft'		: function( event ) {
				if( jQuerycontainer.data( 'opened' ) ) {
					return false;
				}
				bb.next();
				return false;
			},
			'swiperight'	: function( event ) {
				if( jQuerycontainer.data( 'opened' ) ) {
					return false;
				}
				bb.prev();
				return false;
			}
		} );

		// show table of contents
		jQuerytblcontents.on( 'click', toggleTOC );

		// click a menu item
		jQuerymenuItems.on( 'click', function() {

			var jQueryel = jQuery( this ),
				idx = jQueryel.index(),
				jump = function() {
					bb.jump( idx + 1 );
				};
			
			current !== idx ? closeTOC( jump ) : closeTOC();

			return false;
			
		} );

		// reinit jScrollPane on window resize
		jQuery( window ).on( 'debouncedresize', function() {
			// reinitialise jScrollPane on the content div
			setJSP( 'reinit' );
		} );

	}

	function setJSP( action, idx ) {
		
		var idx = idx === undefined ? current : idx,
			jQuerycontent = jQueryitems.eq( idx ).children( 'div.content' ),
			apiJSP = jQuerycontent.data( 'jsp' );
		
		if( action === 'init' && apiJSP === undefined ) {
			jQuerycontent.jScrollPane({verticalGutter : 0, hideFocus : true });
		}
		else if( action === 'reinit' && apiJSP !== undefined ) {
			apiJSP.reinitialise();
		}
		else if( action === 'destroy' && apiJSP !== undefined ) {
			apiJSP.destroy();
		}

	}

	function updateTOC() {
		jQuerymenuItems.removeClass( 'menu-toc-current' ).eq( current ).addClass( 'menu-toc-current' );
	}

	function updateNavigation( isLastPage ) {
		
		if( current === 0 ) {
			jQuerynavNext.show();
			jQuerynavPrev.hide();
		}
		else if( isLastPage ) {
			jQuerynavNext.hide();
			jQuerynavPrev.show();
		}
		else {
			jQuerynavNext.show();
			jQuerynavPrev.show();
		}

	}

	function toggleTOC() {
		var opened = jQuerycontainer.data( 'opened' );
		opened ? closeTOC() : openTOC();
	}

	function openTOC() {
		jQuerynavNext.hide();
		jQuerynavPrev.hide();
		jQuerycontainer.addClass( 'slideRight' ).data( 'opened', true );
	}

	function closeTOC( callback ) {

		updateNavigation( current === itemsCount - 1 );
		jQuerycontainer.removeClass( 'slideRight' ).data( 'opened', false );
		if( callback ) {
			if( supportTransitions ) {
				jQuerycontainer.on( transEndEventName, function() {
					jQuery( this ).off( transEndEventName );
					callback.call();
				} );
			}
			else {
				callback.call();
			}
		}

	}

	return { init : init };

})();