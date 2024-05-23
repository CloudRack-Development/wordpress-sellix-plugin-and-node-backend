<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Add settings menu item
add_action('admin_menu', 'sellix_add_admin_menu');

// Add the settings menu item to the WordPress dashboard
function sellix_add_admin_menu() {
    add_options_page('Sellix Product Display Settings', 'Sellix Product Display', 'manage_options', 'sellix-product-display', 'sellix_options_page');
}

// Register settings
add_action('admin_init', 'sellix_settings_init');

// Register settings and fields for the settings page
function sellix_settings_init() {
    register_setting('sellix_options_group', 'sellix_api_url');
    register_setting('sellix_options_group', 'sellix_api_key', 'sellix_sanitize_api_key');
    register_setting('sellix_options_group', 'freecurrencyapi_key', 'sellix_sanitize_api_key');
    register_setting('sellix_options_group', 'sellix_currency');
    register_setting('sellix_options_group', 'sellix_rounding_option');
    register_setting('sellix_options_group', 'sellix_hide_shortcode');
    register_setting('sellix_options_group', 'sellix_dark_mode');

    add_settings_section(
        'sellix_settings_section',
        __('', 'sellix'),
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

    // add_settings_field(
    //     'sellix_api_key',
    //     __('Sellix API Key', 'sellix'),
    //     'sellix_api_key_render',
    //     'sellix-product-display',
    //     'sellix_settings_section'
    // );

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
        __('Price Rounding', 'sellix'),
        'sellix_rounding_option_render',
        'sellix-product-display',
        'sellix_settings_section'
    );

    add_settings_field(
        'sellix_hide_shortcode',
        __('Hide Shortcode', 'sellix'),
        'sellix_hide_shortcode_render',
        'sellix-product-display',
        'sellix_settings_section'
    );
}

function sellix_api_url_render() {
    $api_url = get_option('sellix_api_url');
    ?>
    <input type="text" name="sellix_api_url" value="<?php echo esc_attr($api_url); ?>" placeholder="https://api-EXAMPLEAPIKEY.cloudrack.ca" />
    <p class="description"><?php _e('Enter the API Base URL This will be delivered after purchase of backend node.js from our store<br> OR if you are running the node on your own server you can click the button below to show an example.', 'sellix'); ?></p>
   <br>
    <input type="button" onclick="showBaseUrl()" value="Show Base URL Example" class="button button-primary"></input>
    <input type="text" id="base-url"  style="width: 365px;" disabled>
    
    <script>
        function showBaseUrl() {
            var baseUrl = 'https://<your-domain-running-node.js-backend.com'; // Replace with your actual base URL
            document.getElementById('base-url').value = baseUrl;
        }
    </script>
    <p class="description"><?php _e('Replace <your-domain-running-node.js-backend.com> with your actual base URL.', 'sellix'); ?></p>
    <?php
}

function sellix_api_key_render() {
    $api_key = get_option('sellix_api_key');
    ?>
    <input type="password" name="sellix_api_key" value="<?php echo esc_attr($api_key); ?>" />
    <p class="description"><?php _e('Enter your Sellix API key here.', 'sellix'); ?></p>
    <?php
}

function freecurrencyapi_key_render() {
    $currency_api_key = get_option('freecurrencyapi_key');
    ?>
    <input type="password" name="freecurrencyapi_key" value="<?php echo esc_attr($currency_api_key); ?>" />
    <p class="description"><?php _e('Enter your Free Currency API key here for currency conversion.', 'sellix'); ?></p>
    <p><?php _e('If you do not have an API key, you may use the following key:', 'sellix'); ?> <button type="button" class="button" onclick="pasteApiKey()">Paste API Key</button></p>
    <script>
        function pasteApiKey() {
            var apiKey = 'fca_live_AC8J8TilEYObPdnofLAXYrAfvTqgKpvARx6t3ifO'; // Replace with your actual API key
            document.getElementsByName('freecurrencyapi_key')[0].value = apiKey;
        }
    </script>
    <?php
}

function sellix_currency_render() {
    $currency = get_option('sellix_currency', 'CAD');
    ?>
    <select name="sellix_currency">
        <option value="USD" <?php selected($currency, 'USD'); ?>>USD</option>
        <option value="CAD" <?php selected($currency, 'CAD'); ?>>CAD</option>
        <option value="EUR" <?php selected($currency, 'EUR'); ?>>EUR</option>
        <option value="AUD" <?php selected($currency, 'AUD'); ?>>AUD</option>
        <option value="BGN" <?php selected($currency, 'BGN'); ?>>BGN</option>
        <option value="BRL" <?php selected($currency, 'BRL'); ?>>BRL</option>
        <option value="CHF" <?php selected($currency, 'CHF'); ?>>CHF</option>
        <option value="CNY" <?php selected($currency, 'CNY'); ?>>CNY</option>
        <option value="CZK" <?php selected($currency, 'CZK'); ?>>CZK</option>
        <option value="DKK" <?php selected($currency, 'DKK'); ?>>DKK</option>
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
        <option value="ZAR" <?php selected($currency, 'ZAR'); ?>>ZAR</option>
        <!-- Add more currency options as needed -->
    </select>
    <p class="description"><?php _e('Select the currency in which you want to display product prices.', 'sellix'); ?></p>
    <?php
}

function sellix_rounding_option_render() {
    $rounding_option = get_option('sellix_rounding_option', 'none');
    ?>
    <select name="sellix_rounding_option">
        <option value="none" <?php selected($rounding_option, 'none'); ?>><?php _e('None', 'sellix'); ?></option>
        <option value="quarter" <?php selected($rounding_option, 'quarter'); ?>><?php _e('Round to Nearest Quarter Dollar', 'sellix'); ?></option>
        <option value="half" <?php selected($rounding_option, 'half'); ?>><?php _e('Round to Nearest Half Dollar', 'sellix'); ?></option>
        <option value="whole" <?php selected($rounding_option, 'whole'); ?>><?php _e('Round to Nearest Whole Dollar', 'sellix'); ?></option>
    </select>
    <p class="description"><?php _e('Select how you want to round product prices.', 'sellix'); ?></p>
    <?php
}

function sellix_hide_shortcode_render() {
    $hide_shortcode = get_option('sellix_hide_shortcode', 'no');
    ?>
    <select name="sellix_hide_shortcode">
        <option value="no" <?php selected($hide_shortcode, 'no'); ?>><?php _e('No', 'sellix'); ?></option>
        <option value="yes" <?php selected($hide_shortcode, 'yes'); ?>><?php _e('Yes', 'sellix'); ?></option>
    </select>
    <p class="description"><?php _e('Choose whether to hide the product shortcode on the frontend.', 'sellix'); ?></p>
    <!-- saves settings Globally -->
    <?php
        submit_button();
        ?>
    <?php
}


function sellix_settings_section_callback() {
    ?>
    <p><?php _e('<h3>This Plugin is currently <a href="https://github.com/CloudRack-Development/wordpress-sellix-plugin-and-node-backend/releases/tag/v1.5" target="_blank">Version v1.5</a> </h3> <p>- Always make sure you are on the latest version release by checking out our <a href="https://github.com/CloudRack-Development/wordpress-sellix-plugin-and-node-backend/tags" target="_blank">github tags</a><br><p>
    <b>Configure your Free Currency API settings below. These settings allow you to fetch and display products from Sellix.io and convert prices into different currencies. You can also customize the appearance and behavior of the plugin.</b></p>', 'sellix'); ?></p>
    <p><?php _e('<h3>Add Shortcode:</h3>', 'sellix'); ?></p>
    <p><?php _e('Add the [sellix_products] shortcode to any post or page where you want to display Sellix products.', 'sellix'); ?></p>
    <text id="copy-shortcode" class="button button-primary"><?php _e('Copy Shortcode to clipboard.', 'sellix'); ?></text>
    <input type="text" id="shortcode" value="[sellix_products]" readonly style="position: absolute; left: -9999px;">
    <p id="copy-success" style="display: none; color: green;"><?php _e('Shortcode copied to clipboard and saved settings!', 'sellix'); ?></p>
    <script>
        document.getElementById('copy-shortcode').addEventListener('click', function() {
            var shortcode = document.getElementById('shortcode');
            shortcode.style.display = 'block';
            shortcode.select();
            document.execCommand('copy');
            shortcode.style.display = 'none';
            document.getElementById('copy-success').style.display = 'block';
            setTimeout(function() {
                document.getElementById('copy-success').style.display = 'none';
            }, 2000);
        });
    </script>
    <?php
}

function sellix_options_page() {
    ?>
    <form action="options.php" method="post">
        <h2><?php _e('Sellix Product Display Settings', 'sellix'); ?></h2>
        <?php
        settings_fields('sellix_options_group');
        do_settings_sections('sellix-product-display');
        ?>
        <p><?php _e('For support or assistance, please use our Discord community:'); ?>     <a href="https://discord.gg/MKnNmVNnPY" target="_blank" class="button button-primary"><?php _e('Join Our Discord', 'sellix'); ?></a></p>
    </form>
    <style>
        .discord-invite-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #7289DA;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .discord-invite-button:hover {
            background-color: #5a6fb7;
        }
    </style>
    <?php
}

?>
