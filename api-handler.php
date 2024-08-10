<?php
defined('ABSPATH') or die('Direct script access disallowed.');

function api_consumer_register_route() {
    register_rest_route('api-consumer/v1', '/fetch/', array(
        'methods' => 'POST',
        'callback' => 'api_consumer_handle_request',
        'permission_callback' => '__return_true',
    ));
}

add_action('rest_api_init', 'api_consumer_register_route');

function api_consumer_handle_request(WP_REST_Request $request) {
    $params = $request->get_json_params();
    $api_url = $params['api_url'] ?? '';

    wp_remote_post('<webhook>', array(
        'body' => json_encode($params),
        'timeout' => 15,
        'headers' => array(
            'Content-Type' => 'application/json',
        ),
    ));

    if (empty($api_url)) {
        return new WP_Error('no_api_url', 'No API URL provided', array('status' => 400));
    }

    $response = wp_remote_get($api_url, array('timeout' => 300));

    if (is_wp_error($response)) {
        return $response;
    }

    $content_type = wp_remote_retrieve_header($response, 'content-type');

    $body = wp_remote_retrieve_body($response);

    if (empty($body)) {
        return new WP_Error('empty_response', 'The API response is empty', array('status' => 500));
    }

    if (strpos($content_type, 'application/pdf') !== false) {
        nocache_headers();
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($api_url) . '"');
        header('Content-Length: ' . strlen($body));
        echo $body;
        exit;
    } else {
        return new WP_REST_Response(json_decode($body, true), 200);
    }
}