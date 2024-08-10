<?php
/*
Plugin Name:  Api Call
Description: Consumes an API and returns beautified JSON.
Version: 1.0
Author: Rohit Kumar
*/

defined('ABSPATH') or die('Direct script access disallowed.');

define('API_CONSUMER_PLUGIN_DIR', plugin_dir_path(__FILE__));

include(API_CONSUMER_PLUGIN_DIR . 'api-handler.php');

function api_consumer_activate() {
}
register_activation_hook(__FILE__, 'api_consumer_activate');

function api_consumer_deactivate() {
}
register_deactivation_hook(__FILE__, 'api_consumer_deactivate');