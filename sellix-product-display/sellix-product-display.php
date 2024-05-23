<?php
/*
Plugin Name: CRD-Sellix-Product-Display
Description: Fetches and displays Sellix.io products for sale.
Version: 1.5
Author: <a href="https://discord.gg/MKnNmVNnPY">Cloudrack Development</a>
*/

// Include the admin settings file
include_once('settings-page.php');

// Include the Parsedown library
include_once('Parsedown.php');

// Register shortcode to display Sellix products
add_shortcode('sellix_products', 'sellix_display_products');

function sellix_display_products($atts) {
    $hide_shortcode = get_option('sellix_hide_shortcode', 'no');

    if ($hide_shortcode === 'yes') {
        return ''; // Return empty if shortcode display is hidden
    }

    // Fetch API URL and API key from database
    $api_url = get_option('sellix_api_url');
    $api_key = get_option('sellix_api_key');
    $currency_api_key = get_option('freecurrencyapi_key');
    $currency = get_option('sellix_currency', 'CAD'); // Fetch selected currency
    $rounding_option = get_option('sellix_rounding_option', 'none'); // Fetch rounding option

    // Check if API URL is empty
    if (empty($api_url)) {
        return '<p>Error: API URL is not configured.</p>';
    }

    // Check if API key is empty remove // from below 3 lines to make active
    // if (empty($api_key)) {
        // return '<p>Error: API Key is not configured.</p>';
    // }

    // Check if currency API key is empty
    if (empty($currency_api_key)) {
        return '<p>Error: Currency API Key is not configured. If you are an admin please obtain your free key by going to <a href="https://app.freecurrencyapi.com/register" target="_blank">freecurrencyapi.com</a>; this is also needed to make proper currency conversions. If you are not an admin of this site please inform them if you can.</p>';
    }

    // Fetch exchange rate from Free Currency API
    $exchange_rate = fetch_exchange_rate($currency_api_key, $currency);

    // Fetch products from Sellix API
    $products = fetch_sellix_products($api_url, $api_key);

    // Check if there was an error fetching products
    if (is_wp_error($products)) {
        return '<p>Error fetching products: ' . $products->get_error_message() . '</p>';
    }

    // Display products
    $output = '<div class="sellix-products">';
    foreach ($products as $product) {
        $price_in_currency = $product['price'] * $exchange_rate;
        if ($rounding_option === 'half') {
            $price_in_currency = round($price_in_currency * 2) / 2; // Round to nearest half dollar
        } elseif ($rounding_option === 'whole') {
            $price_in_currency = round($price_in_currency); // Round to nearest whole dollar
        }
        $output .= '<div class="sellix-product">';
        $output .= '<h3 class="sellix-product-title">' . esc_html($product['title']) . '</h3>';
        $output .= '<p class="sellix-product-price"><strong>Price:</strong> $' . number_format($price_in_currency, 2) . ' ' . $currency . '</p>';

        // Add button for product purchase
        $output .= '<button class="sellix-product-button" data-sellix-product="' . esc_attr($product['uniqid']) . '">Learn More or Buy Now</button>';
        $output .= '</div>';
    }
    $output .= '</div>';

    // Enqueue Sellix JavaScript
    wp_enqueue_script('sellix-embed-js', 'https://cdn.sellix.io/static/js/embed.js', array(), null, true);

    // Enqueue styles
    wp_enqueue_style('sellix-embed-css', 'https://cdn.sellix.io/static/css/embed.css');
    wp_enqueue_style('sellix-product-display-style', plugins_url('sellix-product-display/style.css'));

    return $output;
}

// Function to fetch exchange rate from Free Currency API
function fetch_exchange_rate($currency_api_key, $currency) {
    $response = wp_remote_get('https://api.freecurrencyapi.com/v1/latest?apikey=' . $currency_api_key . '&currencies=' . $currency);

    if (is_wp_error($response)) {
        return 1; // Default to 1 if there is an error
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (isset($data['data'][$currency])) {
        return $data['data'][$currency];
    } else {
        return 1; // Default to 1 if the exchange rate is not found
    }
}

// Function to fetch products from Sellix API
function fetch_sellix_products($api_url, $api_key) {
    // Ensure the URL does not end with a slash and append the endpoint
    $api_url = rtrim($api_url, '/') . '/api/Products';

    // Perform API request and fetch products
    $response = wp_remote_get($api_url, array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $api_key,
        ),
    ));
    if (!is_wp_error($response) && $response['response']['code'] == 200) {
        $products = json_decode($response['body'], true);
        return $products;
    } else {
        return new WP_Error('api_error', 'Error fetching products.');
    }
}

// Activation hook
register_activation_hook(__FILE__, 'sellix_plugin_activate');

function sellix_plugin_activate() {
    // Create necessary database options on plugin activation
    add_option('sellix_api_url', '');
    add_option('sellix_api_key', '');
    add_option('freecurrencyapi_key', '');
    add_option('sellix_currency', 'CAD'); // Add default currency option
    add_option('sellix_rounding_option', 'none'); // Add default rounding option
    add_option('sellix_hide_shortcode', 'no'); // Add default hide shortcode option
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'sellix_plugin_deactivate');

function sellix_plugin_deactivate() {
    // Remove options on plugin deactivation
    delete_option('sellix_api_url');
    delete_option('sellix_api_key');
    delete_option('freecurrencyapi_key');
    delete_option('sellix_currency');
    delete_option('sellix_rounding_option');
    delete_option('sellix_hide_shortcode');
}

// Uninstall hook
register_uninstall_hook(__FILE__, 'sellix_plugin_uninstall');

function sellix_plugin_uninstall() {
    // Clean up options when the plugin is uninstalled
    delete_option('sellix_api_url');
    delete_option('sellix_api_key');
    delete_option('freecurrencyapi_key');
    delete_option('sellix_currency');
    delete_option('sellix_rounding_option');
    delete_option('sellix_hide_shortcode');
}
?>
