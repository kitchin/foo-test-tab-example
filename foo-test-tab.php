<?php
/*
Plugin Name: Foo Test Tab Example
Version: 1.2
Description: Add a meta-screen tab to the Dashboard Posts page. The new tab is next to "Screen Options" and "Help." Mod to use for other admin pages. Works with the new js structure in WP 4.3. Warning: future versions of WP may easily break this plugin.
Author: kitchin
*/

class FooTestTab {

	public function __construct() {
		global $pagenow;
		// Load on Dashboard / Posts.
		// May need to restrict this further.
		if ( $pagenow == 'edit.php' ) {
			add_action( 'admin_enqueue_scripts', array( $this,
				'action__admin_enqueue_scripts' ), 20
			);
			add_action( 'in_admin_footer', array( $this,
				'action__in_admin_footer' )
			);
		}
	}


	/*
	*/
	public function action__admin_enqueue_scripts() {
		$ver = '';  // time();
		wp_enqueue_style( 'foo-test-tab', plugins_url( '/foo-test-tab.css', __FILE__ ), array(), $ver );
		wp_enqueue_script( 'foo-test-tab', plugins_url( '/foo-test-tab.js', __FILE__ ), array( 'jquery' ), $ver, true );
	}


	/*
	*/
	public function action__in_admin_footer() {
		// Note, 'aria-controls' is signficant. WP's js uses it to pick the panel to show.
?>
		<div id="foo-test-tab-wrap" class="hidden" tabindex="-1" aria-label="Foo Test Tab">
			<h5>Hello world.</h5>
		</div>
		<div id="foo-test-tab-link-wrap" class="hidden screen-meta-toggle">
			<button type="button" id="foo-test-tab-link" class="button show-settings" aria-controls="foo-test-tab-wrap" aria-expanded="false">
			Foo Test Tab</button>
		</div>
<?php
	}
}


if ( is_admin() ) {
	new FooTestTab();
}
