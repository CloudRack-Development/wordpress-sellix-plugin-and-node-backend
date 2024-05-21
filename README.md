# SellPress (Sellix.io WordPress Plugin) + Node.js Backend

### Getting started

You Will Need Node.js running for the backend to work and a way to expose the backend api publicly as locally will not work unless you are able to route your traffic.

### Setting Up The Backend First.

__**Step One**__
```bash
git clone https://github.com/StormMoran/wordpress-sellix-plugin-and-node-backend.git
```
__**Step Two**__
```bash
cd wordpress-sellix-plugin-and-node-backend
```
__**Step Three**__
```bash
unzip node\ backend.zip sellix-product-display.zip
```
__**Step Four**__
```bash
rm -rf sellix-product-display.zip node\ backend.zip
```
__**Step Five**__

Edit The `.env` file or you may use 
```bash
cd backend/ && nano .env
```
__**Step Six**__
```bash
npm install express && npm run start
```

### Setting Up The WordPress Plugin

__**Step One**__

Simply download the plugin from [this link](https://github.com/StormMoran/wordpress-sellix-plugin-and-node-backend/raw/main/sellix-product-display.zip).

__**Step Two**__
Go to https://yourdomain.com/wp-admin/plugin-install.php and upload the plugin you just installed above.

__**Step Three**__
go to https://yourdomain.com/wp-admin/options-general.php?page=sellix-product-display replacing yourdomain.com with your actual domain and enter in the credentials requried. (or you can go to the wp-admin section of your site and look for the following images below once you haveve installed tha plugin)

![alt text](https://i.ibb.co/rwg5pWP/image.png)

![alt text](https://i.ibb.co/4T2FKmK/image.png)

![alt text](https://i.ibb.co/XxFf5M7/image.png)

for the `API URL` field you will be putting https://whereeveryouarehostingthebackendcode.com:5000/api/Products typcally unless you are running a proxy of sorts.
and for your `API Key` you can obtain this by going to the sellix.io security section of your dashboard located From [This Link](https://dashboard.sellix.io/settings/security) and copy and paste the key into the backend of the wordpress plugin.

Lastly just paste in the short-code presented below to any page you want to display items for sale.
```bash
[sellix_products]
```

![alt text](https://i.ibb.co/rcZ6CfX/image.png)


![alt text](https://i.ibb.co/SsFLpJj/image.png)

## Last Step Make Money.

> please note i am not affiliated with sellix in any means.
