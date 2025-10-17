<?php
add_action('wp_head', function (): void {
	/*
	* Add styles for another templates here
	*/
	$styles = [
		'/dist/css/tailwind.css',
		'/dist/css/style.css',
	];

	if (is_singular('listings')) {
		$styles[] = '/dist/css/single-listings.css';
	}

	foreach ($styles as $style) {
		$file_path = get_template_directory() . $style;

		if (file_exists($file_path)) {
			ob_start();
			include_once($file_path);
			$default_styles_content = ob_get_clean();
			printf('<style>%s</style>', trim($default_styles_content));
		}
	}
});

add_action('wp_enqueue_scripts', function (): void {
	if (is_home()) {
		wp_enqueue_script(
			'home',
			DIST_PATH . '/js/home.js',
			[],
			'1.0.0',
			true
		);

		// Localize script for AJAX
		wp_localize_script('home', 'ajaxData', [
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'nonce'   => wp_create_nonce('filter_listings_nonce'),
		]);
	}

	if (is_singular('listings')) {
		wp_enqueue_script(
			'listings',
			DIST_PATH . '/js/listings.js',
			[],
			'1.0.0',
			true
		);
	}
});
