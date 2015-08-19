// Add a screen meta tab (like the tabs Screen Options, Help ).
try {
jQuery(document).ready(function($){
	// Rendered tab panel and link in the wrong place.
	var $panel = $('#foo-test-tab-wrap');
	var $link = $('#foo-test-tab-link-wrap');

	if ( $panel.length && $link.length ) {

		// New WP 4.3 data structure in wp-admin/js/common.js.
		if ( typeof screenMeta == 'object' && screenMeta.toggles && screenMeta.init ) {

			// Move tab panel and link to the right place.
			$panel.appendTo('#screen-meta');
			$link.appendTo('#screen-meta-links').show();

			// Now the complicated stuff.
			// Difficult to load this script first, so instead re-inititalize the object.
			// First remove the previous click handler!
			screenMeta.toggles.off( 'click' );
			// Run init, which scans the DOM and assigns the click().
			screenMeta.init();
			// console.log( 'ok re-init: screenMeta.toggles', screenMeta.toggles );

			// Copy some code from common.js.
			// Scroll into view when focused
			$('#foo-test-tab-link').on( 'focus.scroll-into-view', function(e){
				if ( e.target.scrollIntoView )
					e.target.scrollIntoView(false);
			});
		} // else console.log('err, missing', 'screenMeta.toggles');
	} // else console.log('ok, missing', 'foo-test-tab');
});
} catch(e) {}
