<?php

define('TEMPLATE_PATH', get_template_directory_uri());
define('DIST_PATH', TEMPLATE_PATH . '/dist');


// TODO Add connection styles and scripts to the head and footer

/**
 * Include functions 
 */
require_once(__DIR__ . '/includes/functions.php');

/**
 * Include modules functions 
 */
require_once(__DIR__ . '/modules/functions.php');

/**
 * Include templates functions
 */
require_once(__DIR__ . '/templates/functions.php');

/**
 * Include dist scripts and styles
 */
require_once(__DIR__ . '/dist/scripts.php');
