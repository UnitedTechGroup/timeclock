
PHP Timeclock
=============

REQUIREMENTS
------------

- At least PHP 5.4, with mysql support
- MySQL or MariaDB
- Webserver
- Javascript enabled web browser

For barcode rendering (optional):

- GNU barcode
- imagemagick (convert script)
- ghostscript


TESTED CONFIGURATIONS
---------------------

Debian 9.0 (Stretch): PHP 7.0.27, MariaDB 10.1, Apache 2.4.25
    packages: apache2 libapache2-mod-php php7.0-mysql mariadb-server
    A Dockerfile is available at: https://github.com/duelafn/dockerfiles/tree/master/timecard

Debian 8.0 (Jessie): PHP 5.6.30, MariaDB 10.0, Apache 2.4.10
    packages: apache2 libapache2-mod-php5 php5-mysqlnd mariadb-server


INSTALLATION
------------

### New Install

- Unpack the distribution into your webserver's document root directory.

- Create a database named `timeclock` or whatever you wish to name it.

- Create a mysql user named `timeclock` (or whatever you wish to name it)
  with a password. Give this user `SELECT`, `INSERT`, `UPDATE`, `DELETE`
  privileges to this database.

  If you wish to use the automatic online database upgrading feature, also
  grant `ALTER` and `CREATE` privileges to this database.

- Import the tables using the `create_tables.sql` script included in this
  distribution.

  If you are using a table prefix, be sure to modify `create_tables.sql` to
  include your prefix.

- Copy `config.inc.php.sample` to `config.inc.php` and modify settings as
  desired.

- Copy `punchclock/config.inc.php.sample` to `punchclock/config.inc.php`
  and modify settings as desired.

- Open index.php with your web browser.

- Click on the Administration link on the right side of the page. Input
  "admin" (without the quotes) for the username and "admin" (without the
  quotes) for the password. Please change the password for this admin user
  after the initial setup of PHP Timeclock is complete.

- Create at least one office by clicking on the "Create Office" link on the
  left side of the page. You MUST create an office to achieve the desired
  results. Create more offices if needed.

- Create at least one group by clicking on the "Create Group" link on the
  left side of the page. You MUST create a group to achieve the desired
  results. Create more groups if needed.

- Add your users by clicking on the "Create New Users" link, and assign
  them to the office(s) and group(s) you created above. Give Sys Admin
  level access for users who will administrate PHP Timeclock. Give Time
  Admin level access for users who will need to edit users' time, but who
  will not need Sys Admin level access. If you require the reports to be
  secured so only certain users can run them, then give these users reports
  level access.

  Admin level access and reports level access are completely separate from
  each other. Just because a user has admin level access does not give that
  user reports level access. You must specifically give them reports level
  access when you are creating or editing the users, if you choose to
  secure these reports for these users. To make PHP Timeclock lock down the
  reports to only these users, set the `use_reports_password` setting in
  `config.inc.php` to "yes".

- Optionally, create `css/local.css` with any style customizations


### Upgrading from 1.0 – 1.04 to the current release

- Backup and move your current installation.

- Unpack the distribution into your webserver's document root directory.

- Merge any new parameters in `config.inc.php.sample` into your
  `config.inc.php` or else copy `config.inc.php.sample` to `config.inc.php`
  and modify settings as desired.

- Either login to PHP Timeclock and run the "Upgrade Database" script
  within the Admin section, or upgrade the database by running the named
  upgrade scripts in the "sql" directory, one at a time, until your
  database is upgraded to the latest version.

  If you are using a table prefix, be sure to modify the upgrade scripts to
  include your prefix (or just use the online upgrader).


### Upgrading from 0.9.4 to the current release

- Backup and move your current installation.

- Unpack the distribution into your webserver's document root directory.

- Merge any new parameters in `config.inc.php.sample` into your
  `config.inc.php` or else copy `config.inc.php.sample` to `config.inc.php`
  and modify settings as desired.

- Upgrade the database by running the named upgrade scripts in the "sql"
  directory, one at a time, until your database is upgraded to the latest
  version.

  The Upgrade Database link in the Administration section of PHP Timeclock
  will not work for this particular upgrade since the admin user needs to
  be added to the database initially. Meaning, you cannot even get to the
  Upgrade Database page until the admin user is added to the database.

  If you are using a table prefix, be sure to modify the upgrade scripts to
  include your prefix (or just use the online upgrader).

- Open index.php with your web browser and continue with configuration
  described above under "New Install".


### Upgrading from releases prior to 0.9.4

- The best way to upgrade from versions prior to 0.9.4 is to download
  version 0.9.4 and upgrade to that version first. Then follow the upgrade
  instructions included in that version of the distribution.

  The reason for doing it this way is that the timestamps are stored
  differently for versions 0.9.4 and higher than in previous versions.
  Upgrading to 0.9.4 first will preserve the punch-in/out history for each
  user.
