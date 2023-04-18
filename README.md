# Cafeteria Ordering System

This is a demo application which allows placing orders for customers and
managing placed orders. It implements authentication, separate user roles for
customers and cafeterias, order management (including tracking and updates).

## Requirements
- PHP 7.x or higher
- MySQL

The above requirements can be fulfilled as [WAMP][wamp], [LAMP][lamp], or
[MAMP][mamp] setups.

## Installation
1. Create the project directory in the `.../www` directory as per your operating
   system.
2. Configure the username, password, and database name in
   `./app/includes/DatabaseEngine.php`.
3. Set the database name in `./sql/generate.sql` at lines 1 and 2.
3. Execute the DDL script `generate.sql` by running the command below:
```bash
mysql -u <USEERNAME> -p < ./sql/generate.sql
```
4. Navigate to the URL specified by your installed server.

## Architecture

This application follows a typical MVC architecture. All code is nested under
`./app`. Models, views, and controllers are stored in their respective
subdirectories. Some common view elements are stored in `./app/includes` along
with `DatabaseEngine.php` that initializes a throwaway database connection.
All routing information is stored in `./app/config/routes.php`.

[wamp]: https://make.wordpress.org/core/handbook/tutorials/installing-a-local-server/wampserver/
[lamp]: https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-ubuntu-18-04
[mamp]: https://make.wordpress.org/core/handbook/tutorials/installing-a-local-server/mamp/