<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Add settings menu item
add_action('admin_menu', 'sellix_add_admin_menu');

function sellix_add_admin_menu() {
    add_options_page('Sellix Product Display', 'Sellix Product Display', 'manage_options', 'sellix-product-display', 'sellix_options_page');
}

// Register settings
add_action('admin_init', 'sellix_settings_init');

function sellix_settings_init() {
    register_setting('sellix_options_group', 'sellix_api_url');
    register_setting('sellix_options_group', 'sellix_api_key');
    register_setting('sellix_options_group', 'freecurrencyapi_key');
    register_setting('sellix_options_group', 'sellix_currency');
    register_setting('sellix_options_group', 'sellix_rounding_option');
    register_setting('sellix_options_group', 'sellix_custom_prices'); // Register custom pricing option

    add_settings_section(
        'sellix_settings_section',
        __('Sellix API Settings', 'sellix'),
        'sellix_settings_section_callback',
        'sellix-product-display'
    );

    add_settings_field(
        'sellix_api_url',
        __('API Base URL', 'sellix'),
        'sellix_api_url_render',
        'sellix-product-display',
        'sellix_settings_section'
    );

    add_settings_field(
        'sellix_api_key',
        __('Sellix API Key', 'sellix'),
        'sellix_api_key_render',
        'sellix-product-display',
        'sellix_settings_section'
    );

    add_settings_field(
        'freecurrencyapi_key',
        __('Free Currency API Key', 'sellix'),
        'freecurrencyapi_key_render',
        'sellix-product-display',
        'sellix_settings_section'
    );

    add_settings_field(
        'sellix_currency',
        __('Currency', 'sellix'),
        'sellix_currency_render',
        'sellix-product-display',
        'sellix_settings_section'
    );

    add_settings_field(
        'sellix_rounding_option',
        __('Rounding Option', 'sellix'),
        'sellix_rounding_option_render',
        'sellix-product-display',
        'sellix_settings_section'
    );

    add_settings_field(
        'sellix_custom_prices',
        __('Custom Pricing', 'sellix'),
        'sellix_custom_prices_render',
        'sellix-product-display',
        'sellix_settings_section'
    );

    add_settings_field(
        'sellix_discord_invite',
        __('Join our Discord', 'sellix'),
        'sellix_discord_invite_render',
        'sellix-product-display',
        'sellix_settings_section'
    );
}

function sellix_api_url_render() {
    $api_url = get_option('sellix_api_url');
    ?>
    <input type="text" name="sellix_api_url" value="<?php echo esc_attr($api_url); ?>" placeholder="https://your-domain.com" />
    <?php
}

function sellix_api_key_render() {
    $api_key = get_option('sellix_api_key');
    ?>
    <input type="password" name="sellix_api_key" value="<?php echo esc_attr($api_key); ?>" />
    <?php
}

function freecurrencyapi_key_render() {
    $currency_api_key = get_option('freecurrencyapi_key');
    ?>
    <input type="password" name="freecurrencyapi_key" value="<?php echo esc_attr($currency_api_key); ?>" />
    <?php
}

function sellix_currency_render() {
    $currency = get_option('sellix_currency', 'CAD');
    ?>
    <select name="sellix_currency">
        <option value="AUD" <?php selected($currency, 'AUD'); ?>>AUD</option>
        <option value="BGN" <?php selected($currency, 'BGN'); ?>>BGN</option>
        <option value="BRL" <?php selected($currency, 'BRL'); ?>>BRL</option>
        <option value="CAD" <?php selected($currency, 'CAD'); ?>>CAD</option>
        <option value="CHF" <?php selected($currency, 'CHF'); ?>>CHF</option>
        <option value="CNY" <?php selected($currency, 'CNY'); ?>>CNY</option>
        <option value="CZK" <?php selected($currency, 'CZK'); ?>>CZK</option>
        <option value="DKK" <?php selected($currency, 'DKK'); ?>>DKK</option>
        <option value="EUR" <?php selected($currency, 'EUR'); ?>>EUR</option>
        <option value="GBP" <?php selected($currency, 'GBP'); ?>>GBP</option>
        <option value="HKD" <?php selected($currency, 'HKD'); ?>>HKD</option>
        <option value="HRK" <?php selected($currency, 'HRK'); ?>>HRK</option>
        <option value="HUF" <?php selected($currency, 'HUF'); ?>>HUF</option>
        <option value="IDR" <?php selected($currency, 'IDR'); ?>>IDR</option>
        <option value="ILS" <?php selected($currency, 'ILS'); ?>>ILS</option>
        <option value="INR" <?php selected($currency, 'INR'); ?>>INR</option>
        <option value="ISK" <?php selected($currency, 'ISK'); ?>>ISK</option>
        <option value="JPY" <?php selected($currency, 'JPY'); ?>>JPY</option>
        <option value="KRW" <?php selected($currency, 'KRW'); ?>>KRW</option>
        <option value="MXN" <?php selected($currency, 'MXN'); ?>>MXN</option>
        <option value="MYR" <?php selected($currency, 'MYR'); ?>>MYR</option>
        <option value="NOK" <?php selected($currency, 'NOK'); ?>>NOK</option>
        <option value="NZD" <?php selected($currency, 'NZD'); ?>>NZD</option>
        <option value="PHP" <?php selected($currency, 'PHP'); ?>>PHP</option>
        <option value="PLN" <?php selected($currency, 'PLN'); ?>>PLN</option>
        <option value="RON" <?php selected($currency, 'RON'); ?>>RON</option>
        <option value="RUB" <?php selected($currency, 'RUB'); ?>>RUB</option>
        <option value="SEK" <?php selected($currency, 'SEK'); ?>>SEK</option>
        <option value="SGD" <?php selected($currency, 'SGD'); ?>>SGD</option>
        <option value="THB" <?php selected($currency, 'THB'); ?>>THB</option>
        <option value="TRY" <?php selected($currency, 'TRY'); ?>>TRY</option>
        <option value="USD" <?php selected($currency, 'USD'); ?>>USD</option>
        <option value="ZAR" <?php selected($currency, 'ZAR'); ?>>ZAR</option>
        <!-- Add more currencies as needed -->
    </select>
    <?php
}

function sellix_rounding_option_render() {
    $rounding_option = get_option('sellix_rounding_option', 'none');
    ?>
    <select name="sellix_rounding_option">
        <option value="none" <?php selected($rounding_option, 'none'); ?>>None</option>
        <option value="half" <?php selected($rounding_option, 'half'); ?>>Half Dollar</option>
        <option value="whole" <?php selected($rounding_option, 'whole'); ?>>Whole Dollar</option>
    </select>
    <?php
}

function sellix_custom_prices_render() {
    $custom_prices = get_option('sellix_custom_prices', '');
    ?>
    <textarea name="sellix_custom_prices" rows="5" cols="50"><?php echo esc_textarea($custom_prices); ?></textarea>
    <p class="description"><?php _e('Enter custom pricing settings. Example format: {"product_id": "price"}'); ?></p>
    <?php
}

function sellix_discord_invite_render() {
    ?>
    <a href="https://discord.gg/MKnNmVNnPY" target="_blank">
        <button type="button">Join our Discord</button>
    </a>
    <?php
}

function sellix_settings_section_callback() {
    ?>
    <p><?php _e('Configure the settings below to display your Sellix products on your WordPress site.', 'sellix'); ?></p>
    <h3><?php _e('Steps to Setup the Plugin', 'sellix'); ?></h3>
    <ol>
        <li><strong><?php _e('API Base URL', 'sellix'); ?>:</strong> <?php _e('Enter the base URL of your backend running Sellix API. For example, if your Sellix API is at', 'sellix'); ?> <code>https://your-domain.com/api/Products</code>, <?php _e('enter', 'sellix'); ?> <code>https://your-domain.com</code>.</li>
        <li><strong><?php _e('Sellix API Key', 'sellix'); ?>:</strong> <?php _e('Enter your Sellix API Key. This key is necessary to fetch product data from your Sellix store.', 'sellix'); ?></li>
        <li><strong><?php _e('Free Currency API Key', 'sellix'); ?>:</strong> <?php _e('Enter your Free Currency API Key to convert product prices to your selected currency.', 'sellix'); ?></li>
        <li><strong><?php _e('Currency', 'sellix'); ?>:</strong> <?php _e('Select your preferred currency for displaying product prices.', 'sellix'); ?></li>
        <li><strong><?php _e('Rounding Option', 'sellix'); ?>:</strong> <?php _e('Select the rounding option for product prices (None, Half Dollar, Whole Dollar).', 'sellix'); ?></li>
        <li><strong><?php _e('Custom Pricing', 'sellix'); ?>:</strong> <?php _e('Enter custom pricing settings in JSON format.', 'sellix'); ?></li>
    </ol>
    <?php
}

function sellix_options_page() {
    ?>
    <form action="options.php" method="post">
        <h2><?php _e('Sellix Product Display Settings', 'sellix'); ?></h2>
        <?php
        settings_fields('sellix_options_group');
        do_settings_sections('sellix-product-display');
        submit_button();
        ?>
    </form>
    <?php
}
