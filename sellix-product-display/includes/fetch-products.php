<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function fetch_sellix_products($api_url, $api_key) {
    $response = wp_remote_get($api_url, array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key
        )
    ));

    if (is_wp_error($response)) {
        return $response;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);

    if (isset($data->status) && $data->status !== 'success') {
        return new WP_Error('api_error', $data->message);
    }

    return $data->data->products;
}
