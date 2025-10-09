<?php
add_action('wp_head', function (): void {
	/*
	* Add styles for another templates here
	*/

	ob_start();
	include_once('css/style.css'); // Default styles
	$default_styles = ob_get_clean();
	printf('<style>%s</style>', trim($default_styles));
});

add_action('wp_enqueue_scripts', function (): void {

	if (is_singular('post')) {
		wp_enqueue_script(
			'post',
			DIST_PATH . '/js/post.js',
			[],
			'1.0.0',
			true
		);
	}
});
