# SellPress (Sellix.io WordPress Plugin) + Node.js Backend v1.1

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

    Before unzipping the zip folder, you may review the backend code located [Here](https://github.com/CloudRack-Development/my-project/tree/main/backend) to ensure reliability and security.

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

### Setting Up The WordPress Plugin

1. **Navigate to your WordPress installation directory and upload the `sellix-product-display` plugin folder**:

    - You can find the plugin folder in the `sellix-product-display` directory extracted earlier.

2. **Activate the SellPress plugin**

    - Go to your WordPress admin dashboard.
    - Navigate to `Plugins` > `Installed Plugins`.
    - Find `SellPress (Sellix.io WordPress Plugin)` and click `Activate`.

3. **Configure the plugin settings**

    - Navigate to `Settings` > `SellPress (Sellix.io WordPress Plugin)`.
    - Fill in the required settings:
      - **API Base URL:** Enter the base URL of your backend running Sellix API.
      - **Sellix API Key:** Enter your Sellix API Key. This key is necessary to fetch product data from your Sellix store.
      - **Free Currency API Key:** Enter your Free Currency API Key to convert product prices to your selected currency.
      - **Currency:** Select your preferred currency for displaying product prices.
      - **Rounding Option:** Choose whether to round prices to the nearest half dollar, whole dollar, or not at all.
      - **Custom Prices:** Optionally define custom prices for products in case the API cannot fetch the exchange rate.

4. **Using the shortcode**

    - Use the `[sellix_products]` shortcode on any page or post to display your Sellix products.

5. **Optional: Configure Uninstallation Settings**

    - In the plugin settings, you can choose whether to remove all plugin data upon uninstallation.

### Additional Information

**Discord Support:**

- A Discord invite button is available in the plugin settings for quick access to support.

**Custom Price Fallback:**

- If the currency API cannot be reached, the plugin can use custom-defined prices to ensure products are always displayed correctly.

**Salting API Keys:**

- For added security, the plugin salts API keys before storing them in the database.

**Database Options Management:**

- On plugin activation, necessary options are created.
- On plugin deactivation, options can be removed if configured in the settings.
- On plugin uninstallation, options can be removed if configured in the settings.

For further details and advanced configurations, please refer to the plugin's settings page in your WordPress admin dashboard.

---

Feel free to reach out via our Discord for any support or inquiries.


## Support

For support, join our [Discord](https://discord.gg/MKnNmVNnPY).

---

**Version:** 1.2
**Author:** [Cloudrack Development](https://discord.gg/MKnNmVNnPY)
