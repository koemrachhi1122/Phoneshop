WHAT WAS WRONG
==============
Your screenshot showed:
  Warning: include(includes/db.php): Failed to open stream: No such file or directory
  Warning: include(includes/header.php): Failed to open stream...
  Fatal error: Uncaught Error: Call to a member function query() on null

This happens when PHP can't find the "includes" folder next to index.php.
The code was using plain relative paths like:
    include "includes/db.php";
which only works if PHP's current working directory happens to match the
script's folder exactly. Depending on how the ZIP was extracted (you had an
extra nested "phoneshop/phoneshop" folder inside the ZIP) or how the folder
was copied into htdocs, that assumption broke, so PHP couldn't find the file,
$conn was never created, and the site crashed on the first database query.

WHAT I FIXED
============
1. Every include/require across the project (index.php, product.php,
   products.php, cart.php, checkout.php, login.php, register.php, test.php,
   the admin/ folder, includes/header.php, config/test.php, and the PHP/
   folder) now uses __DIR__, e.g.:
       include __DIR__ . "/includes/db.php";
   __DIR__ always points to the real folder the current file lives in, so
   these includes now work no matter where the project folder is placed or
   what the current working directory is.

2. Removed the confusing extra nested folder from the ZIP (previously
   phoneshop/phoneshop/...). This ZIP has the project files directly at the
   top level.

HOW TO SET IT UP CORRECTLY
===========================
1. Extract this ZIP.
2. Copy the WHOLE resulting folder into your XAMPP htdocs, e.g.:
       C:\xampp\htdocs\PhoneShop\
   Make sure index.php, includes/, config/, admin/, CSS/, img/ etc. all sit
   directly inside C:\xampp\htdocs\PhoneShop\ (not one level deeper).
3. Start Apache and MySQL in the XAMPP control panel.
4. Open http://localhost/phpmyadmin, create/import the database:
   - Go to the "Import" tab and import Database/Phone shop.sql
     (it creates and uses a database called "phoneshop" automatically).
5. Visit http://localhost/PhoneShop/ in your browser.

Database credentials used by includes/db.php (default XAMPP values):
   host: localhost, user: root, password: (empty), database: phoneshop
If your MySQL root user has a password, update includes/db.php accordingly.

NOTE ON THE "PHP" FOLDER
=========================
The PHP/ folder (Customer.php, Login.php, Sale.php, etc.) is a separate,
older mini admin app that connects to a differently-named database
("phone_shop" instead of "phoneshop") via config/database.php. It looks like
leftover/duplicate code from an earlier version and isn't linked from the
main site (index.php, products.php, admin/...). I fixed its include path too
so it won't error out if you open it directly, but you likely don't need it
alongside the admin/ folder, which is the active admin panel.
