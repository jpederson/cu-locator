## Credit Union Locator

To install this, clone the repository to a folder on your server, like so:

```shell
git clone https://github.com/jpederson/cu-locator.git && cd cu-locator
```

Next, make a mysql database, and a user, and import the `db.sql` into the new database. 

```shell
cp config-sample.php config.php
```

Enter your database credentials and db name into the config.php file.

*****

Developed with love by [James Pederson](https://jpederson.com).