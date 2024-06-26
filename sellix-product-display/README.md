# Sellix Product Display Plugin

The Sellix Product Display Plugin allows you to fetch and display products from Sellix.io on your WordPress site. It also includes currency conversion using the Free Currency API and optional rounding for product prices.

## Installation

1. **Download the Plugin:**
   - Download the plugin files. Located [HERE](https://github.com/CloudRack-Development/wordpress-sellix-plugin-and-node-backend/raw/main/sellix-product-display.zip)

2. **Upload the Plugin:**
   - Go to your WordPress dashboard.
   - Navigate to `Plugins` > `Add New`.
   - Click on `Upload Plugin`.
   - Select the downloaded plugin zip file and click `Install Now`.

3. **Activate the Plugin:**
   - After installation, click `Activate` to activate the plugin.

## Configuration

1. **API Settings:**
   - Go to `Settings` > `Sellix Product Display`.
   - Enter your `API Base URL`. Defined in the plugin how to setup.
   - Enter your `Free Currency API Key`.
   - Select your preferred currency from the dropdown menu.
   - Select the rounding option for prices (None, Quarter Dollar, Half Dollar, Whole Dollar).

2. **Save Settings:**
   - Click `Save Changes` to save your API and currency settings.

## Usage

1. **Add Shortcode:**
   - Add the `[sellix_products]` shortcode to any post or page where you want to display Sellix products.

2. **View Products:**
   - Visit the page or post where you added the shortcode to see the products displayed.

## Rounding Prices

The plugin allows you to round prices to the nearest half dollar or whole dollar. You can select the rounding option in the settings page.

## Uninstall

To uninstall the plugin:
1. Deactivate the plugin from the `Plugins` page.
2. Delete the plugin from the `Plugins` page.

## Developers Note
   If you like to be able to customize this plugin more if you are a developer please feel free there is a note in the settings page to read the readme for the missing `sellix_api_key_render()` function that function is below add it in place
   of the note in settings that states to read the readme.

```php
function sellix_api_key_render() {
    $api_key = get_option('sellix_api_key');
    ?>
    <input type="password" name="sellix_api_key" value="<?php echo esc_attr($api_key); ?>" />
    <p class="description"><?php _e('Enter your Sellix API key here.', 'sellix'); ?></p>
    <?php
}
```
## License

This project is licensed under the GNU General Public License v2 (GPLv2).  You can find the complete license text in the file.

[Link to GPLv2 text on GNU website](https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt)

## Support

For support, join our [Discord](https://discord.gg/MKnNmVNnPY).

---

**Version:** 1.5
**Author:** [Cloudrack Development](https://discord.gg/MKnNmVNnPY)
