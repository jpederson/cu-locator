## Credit Union Locator

This repository contains a website for a credit union locator, and an API with multiple endpoints to search a MySQL database filled with Credit Union ATM and Branch locations.

![preview](preview.jpg)

*****

### Installation

To install this, clone the repository to a folder on your server, like so:

```shell
git clone https://github.com/jpederson/cu-locator.git && cd cu-locator
```

Next, make a mysql database, and a user, and import the `db.sql` into the new database. 

```shell
cp config-sample.php config.php
```

Enter your database credentials and db name into the config.php file. You will also need to provide a [Google Maps API Key](https://developers.google.com/maps/documentation/javascript/get-api-key).

Once you've finished these steps, and set up your apache/nginx virtual host configurations, you should be able to just visit the project to verify it's working - it will look like the screenshot above.

*****

### Using the API

Assuming the project is installed at the root level of your webhost (it can be installed in subdirectories, but for the purposes of this documentation, we'll assume it's in the root), the following API endpoints are available to you once everything is installed correctly.

#### Fetch Basic Statistics

To get a count of the available ATMs and branches in the database, just use the `stats` action.

```
/api/?action=stats
```

#### Search by Lat/Long

To search by latitude and longitude, simply provide those parameters like so:

```
/api/?action=search&latitude=43.0731&longitude=-89.4012
```

#### Search by ZIP Code

To search by zipcode, that's the only parameter you must pass

```
/api/?action=search&zipcode=53714
```

#### Specifying a Search Radius

The default search radius is 25 miles. Specify your own `radius` parameter with a number of miles (just the number) to narrow or expand your search parimeter.

```
/api/?action=search&zipcode=53714&radius=25
```

*****

### Widgets

The widgets are responsive, so you just have to pull them into an iframe of whatever size you need, and they'll use the space. There is a `widget` action in the API, requested like so:

```
/api/?action=widget
```

Here's a bit of iframe code to pull in a widget that expands to the full width of whatever container it's put into, and is 350px tall.

```
<iframe src="https://your.domain/api/?action=widget" style="border: 0; width: 100%; height: 350px;"></iframe>
```

*****

Developed with love by [James Pederson](https://jpederson.com).