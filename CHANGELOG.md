osCommerce Online Merchant Changelog

Copyright (c) 2021 osCommerce

------------------------------------------------------------------------------
XX/03/2021 osCommerce Online Merchant v2.3.5
------------------------------------------------------------------------------

 * PHP v8 compatibility fixes.
 * MySQL v8 compatibility fixes.
 * Introduce hooks implementation.
 * Update layout of the orders and products administration pages to a tabbed
   layout.
 * Automatically select the first shipping rate available instead of the
   cheapest rate.
 * Display the total price of the order in the label of the checkout
   confirmation button.
 * Improve session functions.
 * Disable output of PHP error messages; log errors to a file in the work
   directory.
 * Update PayPal modules to the latest PayPal App version (v5.018).
 * Update Braintree module to the latest Braintree App version (v2.015).
 * Add information pages.
 * Add option Upload favicon.
 * Cookie notice and compliance for GDPR/CCPA
 * Recently viewed products.
 * Bootstrap 5 template.
 * New location and control images.
 * New sorting products in listing and modularized.
 * Add Spanish language.
 * Modularized the index page.
 * Update review system.
 * Add wishlist.
 * Modularized the XML sitemap.
 * Modularized the box product filter.
 * SMTP send email Swift Mailer.

------------------------------------------------------------------------------
08/18/2017 osCommerce Online Merchant v2.3.4.1
------------------------------------------------------------------------------

 * Improve detection of MySQLi during setup.

 * Update session handler functions to return correct return value types.

 * Ignore E_DEPRECATED PHP notices.

 * Set empty MySQL sql_mode for compatibility across MySQL versions.

------------------------------------------------------------------------------
06/05/2014 osCommerce Online Merchant v2.3.4
------------------------------------------------------------------------------

 * Introduce new Card Acceptance box.

 * Place Administration Tool Orders link in own box.

 * New Content Modules implementation for the following pages:
   - Login
   - My Account
   - Checkout Success

 * Force HTTPS in Administration Tool if SSL has been enabled.

 * Add CA certificate bundle for curl to verify secure connections with.

 * Add Message Stack output to the checkout confirmation page.

 * Block orders when no defined shipping rates is available to the
   destination.

 * Sessions
   - Let PHP handle session garbage collection for database based sessions to
     have the same behaviour as file based sessions.
   - Ignore GET and POST session IDs if force cookie usage is enabled.
   - Only set the session ID if it differs from the cookie value.

 * Fix $PHP_SELF so it works in pages located in subdirectories.

 * PayPal Modules:
   - Update PayPal Express Checkout payment module
   - Update PayPal Payments Standard payment module
   - Update PayPal Payments Pro (Direct Payments) payment module
   - Update PayPal Express Checkout (Payflow Edition) payment module
   - Update PayPal Payments Pro (Payflow Edition) payment module
   - Introduce PayPal Payments Pro (Hosted Solution) payment module
   - Introduce Log In with PayPal content module

 * Sage Pay Modules:
   - Update Sage Pay Direct payment module
   - Update Sage Pay Form payment module
   - Update Sage Pay Server payment module
   - Introduce Sage Pay Cards Management Page content module

 * Authorize.net Modules:
   - Update Server Integration Method (SIM) payment module
   - Update Advanced Integration Method (AIM) payment module
   - Introduce Direct Post Method payment method

 * Stripe Modules:
   - Introduce Stripe.js payment module
   - Introduce Stripe Cards Management content module

 * Braintree Modules:
   - Introduce Braintree payment module
   - Introduce Braintree Cards Management Page content module

 * WorldPay Modules:
   - Update WorldPay Hosted Payment Pages payment module

 * Libraries Update
   - jQuery 1.11.1
   - jQuery UI 1.10.4
   - Flot 0.8.3
   - bxGallery replaced by PhotosetGrid
   - FancyBox replaced by ColorBox

------------------------------------------------------------------------------
09/25/2013 osCommerce Online Merchant v2.3.3.4
------------------------------------------------------------------------------

 * MySQL Error Functions
   Don't pass a null parameter to the MySQL error functions otherwise PHP will
   display a warning message.

 * UTF-8 Conversion
   Also manually convert existing data records to UTF-8 and detect encodings
   to prevent double encodings. Allow a dry-run to show which queries would be
   performed.

 * LC_NUMERIC Locale
   As LC_ALL is now being used to set the locale, some languages other than
   English were using commas in float/decimal values which conflicted with
   MySQL. LC_NUMERIC is now set and forced to the system locale after the main
   language file has loaded.

------------------------------------------------------------------------------
09/20/2013 osCommerce Online Merchant v2.3.3.3
------------------------------------------------------------------------------

 * Database Query Logging
   Improve database query error logging.

 * Administration Tool Navigation Menu
   Dynamically load navigation boxes.

 * HTTPS -> HTTP Browser Alert
   Have forms posting from a HTTPS to HTTP page post to a HTTPS version to
   prevent the browser (Firefox) from alerting the user of being directed to
   an insecure page.

 * Currencies
   Force decimal places value to an integer value.

 * Action Recorder
   When expiring logged entries, don't pass the database connection link to
   tep_db_affected_rows().

 * UTF-8
   Set the MySQL character set to UTF-8 after a connection is made.
   Create the database tables in utf8_unicode_ci for new installations.
   Set the English locale to en_US.UTF-8, en_US.UTF8, enu_usa.

 * Date of Birth
   Take the Configuration -> Minimum Values -> Date of Birth value into
   consideration to make the date of birth field optional.

 * Administration Tool Automatic HTTP Authentication Login
   Don't use the HTTP Authentication values when the login form is being
   submitted.
   Don't show an invalid administrator notice when an automatic HTTP
   Authentication fails.
   Don't record failed automatic HTTP Authentication log ins.

 * Canonical Manufacturer ID
   Force the Manufacturer ID to an integer value.

 * Administration Tool -> Who's Online
   Remove the session_decode() functionality and show shopping cart contents
   only for logged in customers.
   When regenerating a session ID, update the session ID in the who's online
   database table to prevent duplicate entries.

 * MailChimp 360
   Fix module title.

 * Administration Tool Extended Security Check Modules
   Introduce new extended security check modules that are called in the new
   Administration Tool -> Tools -> Security Checks page. These modules are
   not called on the Administration Tool Dashboard page as normal security
   check modules as these modules are more resource intensive. New modules
   include:

   - admin/backups directory public accessibility check
   - admin/backups file public accessibility check
   - admin http authentication check
   - ext/ directory public accessibility check
   - mysql utf8 database tables check
   - version update performed check (30 days)

   A normal extended_last_run security check module is also added to check if
   the extended checks have run in the last 30 days.

 * Administration Tool -> Tools -> Database Tables
   Introduce a new Database Tables page to check, analyze, optimize, and
   repair database tables. A Convert to UTF8 action is also available to
   convert existing database tables to utf8_unicode_ci.

------------------------------------------------------------------------------
09/04/2013 osCommerce Online Merchant v2.3.3.2
------------------------------------------------------------------------------

 * PHP 5.5 Compatibility
   Replace mysql_* database function calls with mysqli_*.

 * Administration Tool -> Dashboard -> Partner News
   Add new Administration Tool Dashboard module.

 * Administrator Account Initialization
   Prevent empty administrator account from being initialized.

 * tep_catalog_href_link()
   Take the catalog HTTPS path into consideration for HTTPS links.

 * Administration Tool Navigation Menu
   Collapse navigation menu on the Dashboard page.

 * Google+ +1 and Google+ Share Social Bookmark Modules
   Show the button images in the chosen language.

 * Template Modules
   Only include template module class files and language definitions if their
   files exist.

 * Canonical Header Tag Module
   Link to the main product information page and ignore product attribute
   combinations.

 * New Twitter Product Card Header Tag Module
   Add Twitter Product Card meta tags to the product information page.

 * New Google AdWords Conversion Tracking Header Tag Module
   Add Google AdWords Conversion Tracking code to the checkout success page.

------------------------------------------------------------------------------
08/26/2013 osCommerce Online Merchant v2.3.3.1
------------------------------------------------------------------------------

 * Who's Online
   Parse REQUEST_URI with tep_db_prepare_input() before storing the value in
   the database.
   Replace REMOTE_ADDR with tep_get_ip_address().

 * Administration Tool -> Catalog -> Categories/Products
   Fix product price gross tax calculations when adding or editing products.

 * Sessions
   Register a shutdown function to close and write the session data.

 * tep_redirect()
   When redirecting from HTTPS -> HTTP and replacing the url with a HTTPS
   version, also take DIR_WS_HTTPS_CATALOG into consideration which may differ
   from DIR_WS_HTTP_CATALOG.

 * Session
   Also check for and allow , (comma) and - (minus) characters in the session
   ID.

------------------------------------------------------------------------------
08/15/2012 osCommerce Online Merchant v2.3.3
------------------------------------------------------------------------------

 * Administration Tool -> Tools -> Send E-Mail
   Convert HTML e-mail to plain-text if HTML E-Mails is disabled.

 * tep_redirect()
   Fix URL encoding by replacing '&amp;' with '&'.

 * Administration Tool -> Tools -> Define Languages
   Keep the selected language in the language selection pull down menu.

 * Checkout Process
   Improve checking of shopping cart product attributes.

 * Shopping Cart
   Replace hardcoded text with new TEXT_OR and TEXT_REMOVE language
   definitions.

 * Product Info
   Redirect to store index if no product ID exists in the request URL.

 * Administration Tool Dashboard Modules
   Properly close HTML links.

 * New Products Module
   Fix check on new products existing.

 * Administration Tool -> Catalog -> Reviews
   Fix typo in table width.

 * tep_image()
   Remove extra space in image title.

 * Administration Tool -> Tools -> Action Recorder
   Fix paging of action recorder listing.

 * Administration Tool -> Catalog -> Categories/Products
   Fix casing of onkeyup HTML attribute.

 * Administration Tool -> Catalog -> Categories/Products
   Remove legacy product preview code.

 * Checkout Confirmation
   Improve checking of order comments.

 * Shopping Cart
   Remove legacy TABLE_HEADING_REMOVE, TABLE_HEADING_QUANTITY,
   TABLE_HEADING_MODEL, and TABLE_HEADING_TOTAL language definitions.

 * Manufacturers
   Improve filtering of manufacturers.

 * Product Information
   Fix the total number of product reviews to count only the reviews in the
   selected language.

 * Sessions - tep_session_register()
   Also reference and keep track of null variables in the session. This
   general bug fix also addresses a compatibility issue with PHP 5.4.0.

 * Sessions - tep_session_recreate()
   Replace internal logic to use session_regenerate_id() for PHP 5.1+ servers.
   If $SID is defined, also update its value with the new session ID.

 * Product Information
   Prevent the session ID being added to product images.

 * Payment Class
   Remove legacy PHP 3 code.

 * GZIP Compression
   Automatically disable if PHP 5.4.0 to PHP 5.4.5 is used due to PHP bug
   #55544.

 * Checkout Shipping
   Improve checking of the shopping cart ID.

 * Time Zone Compatibility
   Improve PHP 5.2 Time Zone compatibility by setting the time zone to
   CFG_TIME_ZONE or to the default time zone if it is not defined.

 * General
   Typecast remaining variables used in SQL queries.

 * Administration Tool -> Modules
   Fix edit button link containing the module code.

 * Administration Tool -> Tools -> Banner Manager
   Properly delete banner image when the banner is being deleted.

 * Social Bookmark Modules
   Replace hardcoded 'images/' path with DIR_WS_IMAGES.

 * New Robot NoIndex Header Tag Module
   Adds a noindex meta tag to specified pages.

 * New Google+ +1 Button and Google+ Share Social Bookmark Modules
   Adds Google+ +1 and Google+ Share buttons to the product information page.

 * New Canonical Header Tag Module
   Adds canonical meta links to the product information and category listing
   pages.

 * New Pinterest Social Bookmark Module
   Adds Pinterest share button to the product information page.

 * Libraries Update
   - 960gs updated to latest version.
   - jQuery 1.4.2 to 1.8.0.
   - jQuery UI 1.8.6 to 1.8.22.
   - bxGallery compatibility changes for jQuery 1.8.0.

------------------------------------------------------------------------------
07/17/2012 osCommerce Online Merchant v2.3.2
------------------------------------------------------------------------------

 * Changed customer password forgotten feature to e-mail a personal link to
   the customer where they can change their password up to 24 hours, instead
   of directly changing the password to a random string and e-mailing it to
   the customer.

   Added new password_reset.php page to manage personal password reset links.

   Added new ar_password_reset.php Action Recorder module to log and limit
   the request of personal password reset links to once every 5 minutes.

 * Improve logic of tep_create_random_value() by using Phpass' random number
   generator.

   If function parameter $type is not 'mixed', 'chars', or
   'digits', return a 'mixed' string instead of false.

 * Add openssl_random_pseudo_bytes() and mcrypt_create_iv() to Phpass'
   get_random_bytes() class method. These are used if /dev/urandom is not
   available.

 * Only seed the random number generator if PHP < 4.2 is used.

------------------------------------------------------------------------------
11/15/2010 osCommerce Online Merchant v2.3.1
------------------------------------------------------------------------------

 * Confirm new Product Reviews to the customer.

 * Fix a PHP notice in Phpass.

 * Fix Reviews Box language definition.

 * Fix pre-defined Australian Dollar currency code.

 * Label the HTML Content field for large product images.

 * XHTML fixes for pop-up pages.

------------------------------------------------------------------------------
11/13/2010 osCommerce Online Merchant v2.3
------------------------------------------------------------------------------

* Payment module updates:
  - 2Checkout
  - PayPal Website Payments Pro - Direct Payments
  - PayPal Website Payments Pro (Payflow Edition) - Direct Payments
  - PayPal Website Payments Pro - Express Checkout
  - PayPal Website Payments Pro (Payflow Edition) - Express Checkout
  - Sage Pay Form, Server, and Direct
  - iPayment
  - RBS WorldPay Hosted
  - Moneybookers
  - InPay
  - PayPoint.net SECPay

* Shipping module updates:
  - USPS

* Allow new template group modules to be created to inject HTML content into
  the page layout.

* Update boxes to modules which can be installed, configured, and sorted.

* Show only installed modules on the Administration Tool Modules page, and
  link to a listing showing new and available modules.

* Moderate product reviews.

* Load either includes/local/configure.php or includes/configure.php, not
  both.

* Modularize Administration Tool Modules page.

* Allow multiple large product images and HTML content (eg, Flash video) for
  products.

* Replace usage of SpiffyCal with jQuery UI DatePicker widgets.

* Update layout to XHTML Transitional.

* Integrate 960 Grid System CSS Framework into the layout.

* Update buttons with jQuery UI Buttons.

* Add jQuery, jQuery UI, Flot, bxGallery, Fancybox javascript libraries.

* Introduce Administration Tool Dashboard modules.

* Migrate customer and administrator passwords to phpass.

* Introduce Social Bookmark modules for products.
  - Facebook and Facebook Like
  - Twitter and Twitter Button
  - Google Buzz
  - Digg

* Introduce Store Logo for the Administration Tool.

* Allow anonymous server statics to be sent from the Administration Tool
  Server Information page.

* Add a is_writable() compatibility function for Windows.

* Introduce Header Tags modules.
  - Google Analytics and E-Commerce Tracking
  - MailChimp E-Commerce 360
  - OpenSearch

* Move HTML layout to template_top.php/template_bottom.php files.

* Add new tep_get_version() function to retrieve the installed version.

* Introduce Version Checker for the Administration Tool.

* Set session.use_only_cookies to match SESSION_FORCE_COOKIE_USE.

* Show list of pre-defined currencies when adding new currencies.

* Example Credit Card payment module removed.

* German and Spanish language definitions removed from the core. (To be
  maintained as add-ons)

* Remove File Manager from the Administration Tool.

* Don't show languages or currencies box if only one language or currency is
  defined.

* Add API tag to modules.

* Introduce Security Check modules for the Administration Tool.

* Introduce Security Directory Permissions feature for the Administration
  Tool.

* PHP v3 compatibility code removed.

* Recreate session IDs by default when customers login or create an account.

* Introduce Action Recorder to log and limit actions.

* Strengthen Administration Tool login routine.

* Replace ereg functions with preg functions for PHP v5.3.

* Fix timezone warning messages on PHP v5.3 servers.

* Protect forms with a token ID that is assigned to the customers session.

* Generate a new $cartID value when restoring shopping cart contents.

* Calculate shipping fees only for shippable products and not virtual/download
  products.

* Parse Date of Birth values.

* Escape the filename and parameters in tep_href_link().

* Escape shell arguments in the checkdnsrr() compatibility function.

* Apply magic_quotes to GET parameters when Search Engine Friendly URLs is
  enabled.

* Support automatic HTTP Authentication logins for the Administration Tool.

------------------------------------------------------------------------------
01/30/2008 osCommerce Online Merchant 2.2 RC2a
------------------------------------------------------------------------------

Due to two bugs that were introduced with 2.2 RC2, it has been repackaged as
2.2 RC2a with the following changes:

* The Administration Tool -> Backup Manager -> Restoration routine failed on
  PHP <5 servers due to the use of stripos(). A compatibility function has
  been added to fix this.
  [r1829]

* The reference of $_SESSION in the tep_session_is_registered() function
  produces a PHP warning when the session has not been started (ie, for search
  engine spiders). This has been fixed by checking if $_SESSION is set.
  [r1830]

------------------------------------------------------------------------------
01/16/2008 osCommerce Online Merchant 2.2 RC2
------------------------------------------------------------------------------

* Payment module changes:
  - Authorize.net module replaced with newer AIM and SIM modules.
  - New PayPal Express Checkout, PayPal Express Checkout (UK), PayPal Direct,
    PayPal Direct (UK), and PayPal Website Payments Standard modules.
  - Removed paypal.php and paypal_ipn.php modules.
  - Removed PayQuake module (the gateway now uses Authorize.net).

* Shipping module changes:
  - USPS updated to match new shipping methods. The test/production server
    parameter has been removed as the test server only works with specific
    test-cases.

* Retrieve product names in one query for the new products module.
  [r1806]

* When restoring a database, only drop tables that are being restored.
  [r1804, r1805]

* Display module version on the Administration Tool if it contains a version
  signature string.
  [r1802]

* Add a .htaccess file to the admin/includes/ directory to prevent direct HTTP
  requests to PHP files.
  [r1775]

* Fix the pagination links on the Administration Tool -> Products Attributes
  page.
  [r1774, r1776]

* Verify the customers primary address when it is being updated.
  Verify the number of address book entries before inserting a new one.
  [r1766]

* Avoid removal of products when deleting a category in a search result
  listing.
  [r1754]

* Make the database session storage handler return an empty string for
  variables that don't exist in the session instead of returning a boolean
  false value.
  [r1752]

* Fix a variable name being checked against in the
  Administration Tool -> Tools -> Newsletter Manager section.
  [r1751]

* Improve the product nofitication logic on the checkout success page.
  [r1749]

* Fix http_build_query() compatibility function in the Administration Tool.
  [r1748]

* Increase the orders.payment_method database table field length to 255
  characters.
  [r1747]

* MySQL 5.0 Strict Mode compatibility fixes.
  [r1746, 1755, 1810]

* Fix logic with nested tables in the Administration Tool tableBlock class.
  [r1745]

* Add checks when creating files and directories on the
  Administration Tool -> Tools -> File Manager section.
  [r1744]

* Remove HTML formatting from credit card processing error messages.
  [r1743]

* Move the logic of storing the credit card number from the order class to
  the payment module level.
  [r1736]

* Use the free shipping language definition for the shipping title when free
  shipping is active.
  [r1732]

* Add indexes to database tables.
  [r1729]

* Introduce an active download flag and a public status flag to the order
  status levels.
  [r1724, r1725, r1728] (r1724 was reverted in r1725)

* Fix the shipping address when a virtual product was added to the cart and
  replaced with a physical product.
  [r1716]

* Improve register_globals compatibility layer when registering session
  variables.
  [r1704, r1705, r1723, r1741] (r1704, r1705, and r1723 were all reverted in r1741)

* Correctly parse the products to remove from the product notifications list.
  [r1703]

* Introduce the ability to show additional checkout buttons on the shopping
  cart page for certain payment methods (eg, PayPal Express Checkout).
  Introduce the ability to define foreign shipping and billing addresses
  during the checkout procedure (eg, the shipping address provided by PayPal
  Express Checkout).
  Add further checks to the checkout process page to prevent fraud orders.
  [r1699, r1750]

* Calling $order_total_modules->process() multiple times would duplicate the
  output data due to the order total modules already being instantiated.
  [r1698]

* Make sure $parameters is an array in the navigation history class.
  [r1696]

* Remove secondary pre-euro currencies from display.
  [r1695]

* Fix downloads when "Download by redirect" and "SEFU" are both enabled.
  Fallback to readfile() download delivery mechanism if direct download files.
  [r1681, r1720]

* Add toggleDivBlock() Javascript function to admin/includes/general.js.
  [r1663]

------------------------------------------------------------------------------
07/03/2007 osCommerce Online Merchant 2.2 RC1
------------------------------------------------------------------------------

* Remove additional slashes when editing a file in the Administration Tool ->
  Tools -> File Manager section.
  [r1652]

* Update Administration Tool pages. Introduce index summary modules
  (backported from v3.0).
  [r1633, r1634, r1635]

* Increase configuration_title and configuration_key field sizes
  [r1631]

* Update project version. Update osCommerce logo. Use standard store_logo.png
  image to easily allow the store logo to be changed.
  [r1626]

* New administrators page to create, edit, and delete administrators
  [r1625]

* Filter the parameters to not include any containing '_nh_dns' in the name so
  they do not get stored in the navigation history session file.
  [r1619, r1620]

* Add a public_title variable to the payment modules so the payment method can
  display "Credit Card" instead of the name of the payment service provider.
  [r1617, r1621]

* When editing reviews, strip additional slashes in the reviews text before
  storing it in the database.
  [r1614]

* PHP < 4.1 compatibility update.
  [r1612]

* Backport v3.0 installation procedure.
  [r1611, r1613, r1629]

* Add a simple administrator login routine to the Administrator Tool.
  [r1610, r1632]

* Process the order total modules earlier on the checkout confirmation page.
  [r1609]

* Fix typo in the products new page.
  [r1608]

* Add the session ID to the GET based forms as a hidden field value.
  [r1606, r1607]

* Updating category settings without selecting a category image was removing
  the previous category image.
  [r1603]

* Check the selected payment module radio field.
  [r1601]

* Load the payment modules after the order total modules to get the proper
  final order total value. This will break some payment modules duplicating
  the checkout_process.php logic (ie, PayPal IPN contribution).
  [r1600]

* Improve the logic of accepting state names.
  [r1598]

* Add a new configuration parameter to control the maximum quantity a product
  can be added to the shopping cart (99 by default).
  [r1596]

* The quantity is added to the database as an integer so the quantity in the
  shopping cart session should also be treated as an integer.
  [r1595]

* Fix the display of the country name on the order history page.
  [r1594]

* Don't calculate prices with tax by rounding the net value, as this brings
  down the default precision of 4 to the decimal places the selected currency
  has.
  [r1592, r1593]

* Fix sql injection vulnerability when sorting product listings.
  [r1591]

* Pass the connection identifier link to the mysql_insert_id() function.
  [r1590]

* Reset the array index counter after working through its elements.
  [r1589]

* Respect the Configuration -> Minimum Values settings.
  [r1587, r1588]

* Correct the display of the billing address on the invoice and packing slip
  pages.
  [r1586]

* Fix currency case-sensitivity bug.
  [r1585]

* Add a register_globals compatibility layer for PHP 4.3+ servers.
  [r1583, r1584, r1597, r1599, r1647]

* Allow payment modules to display input fields on the checkout confirmation
  page.
  [r1582]

* Add fulltext support into the database backup dumps.
  Don't backup the data from the sessions table nor the who's online table.
  Delete the contents of the sessions table and who's online table after a
  restoration has been performed.
  [r1274]

* Fix manufacturers caching block.
  [r726]

------------------------------------------------------------------------------
08/17/2006 osCommerce 2.2 Milestone 2 Update 060817
------------------------------------------------------------------------------

Please review the update-20060817.txt file for the important changes made.

------------------------------------------------------------------------------
11/13/2005 osCommerce 2.2 Milestone 2 Update 051113
------------------------------------------------------------------------------

 * Fixed bug 1662; update of customers address through the My Account page
   resulted in the country value not being stored properly and affected tax
   rate values.

------------------------------------------------------------------------------
11/12/2005 osCommerce 2.2 Milestone 2 Update 051112
------------------------------------------------------------------------------

Please review the update-20060817.txt file for the important changes made.

 * Index language definition: updated the Wiki link to point to the Knowledge
   Base site

 * Reviews Box: Renamed the following variables due to naming conflicts:

   $review_query -> $rand_review_query
   $review       -> $rand_review
   $review       -> $rand_review_text

 * Wrapped all input parameters with tep_output_string() in the tep_image()
   function on the administration tool
   (admin/includes/functions/html_output.php)

 * UPS shipping module removed due to it violating the UPS terms of service.
   An alternative module can be found here:
   http://www.oscommerce.com/community/contributions,1323

 * Updated codebase for PHP 5.0 compatibility

 * Updated database structure for MySQL 5.0 compatibility

------------------------------------------------------------------------------
12/07/2003 osCommerce 2.2 Milestone 2
------------------------------------------------------------------------------

 * Shared SSL servers are now properly supported with cookie parameters
   existing for both normal and secure servers.

 * The installation/upgrade procedure was simplified with a new layout.

 * Internally set PHPs error reporting to E_ALL to remove all notice messages
   on the Catalog module.

 * Renamed default.php to index.php.

 * Sanitize all user input on the Catalog module before inserting it into the
   database.

 * Updated the layout of the shopping cart page.

 * Fixed linefeed issues with emails.

 * Modules are now installed at the Administration Tool via Install/Remove
   buttons located in the infobox; no longer through clicking on the status
   icons. This is to be consistent with other areas of the Administration
   Tool.

 * Updated the layout of the product listing page.

 * Updated the splitPageResults class to use the benefits a class provides.

 * Realized the My Account Proposal as discussed on the developers forum
   channel.

 * Introduced the message stack class used on the Administration Tool to the
   Catalog module. It has been extended to store messages in groups allowing
   to display the messages in groups at separate sections of the page.

 * Removed old European currencies (Deutsche Mark and Spanish Peseta)

 * Update the default configuration parameters to meet the needs of USA (it
   was previously meeting a mix of USA and European regulations)

 * IP Address and Client Browser User Agent validations implemented for the
   Security And Privacy Proposal.

 * Session ID Regeneration feature implemented as part of the Security And
   Privacy Proposal.

 * New file upload class implemented.

 * Search Engine Spider Session Prevention feature implemented as part of the
   Security And Privacy Proposal.

 * Manually round numbers in the tep_round() function, bypassing PHPs round()
   and number_format() functions.

   The PHP round() and number_format() functions return different results when
   strings or floats are being processed.

 * Added data validation to the Customers section on the Administration Tool.

 * Tax Compounding logic corrected.

 * Cross site scripting vulnerabilities fixed.

 * Moved filename and database table definitions from application_top.php to
   their own files.

 * The Tax Priority can now be inserted when creating new tax rates in the
   Administration Tool.

 * Implement the force cookie usage and ssl_session_id validations features
   from the Security and Privacy Proposal.

 * Virtual products tax update (virtual products were not being updated as no
   shipping address is in use. Instead, the billing address is used to base
   the taxes on.

------------------------------------------------------------------------------
02/17/2003 osCommerce 2.2 Milestone 1
------------------------------------------------------------------------------

*** The changelog entry for the 2.2 Milestone releases will be updated     ***
*** throughout the Milestone release path. The information here is         ***
*** currently old.                                                         ***

 * Manufacturer now saved when adding products. (bug fix)

 * Added .htaccess file in the 'includes' directory for some security (blocks
   direct http requests to .php files).
   ie, http://server/catalog/includes/application_top.php

 * New cache class added for the categoies box (only for PHP4)
   - Note, this is disabled by default due to our run out-of-the-box approach.
     Can also be used in other areas of the catalog.

 * New Who's Online section in the administration tool.

 * Updated payment and shipping modules structure - no longer has multiple
   include statements - and are now classes.

 * Administration Tool sections now with opened/closed box approach (the list
   of functions was getting too long!).

 * New login and create account option page (ala Amazon style)

 * Click on the products image (in products details) and a new browser window
   will open and resize itself to the image shown - used to display larger
   pictures of the product.

 * All font styles are now in stylesheets.

 * Full locaization support (ie, categories title, products descriptions,
   image buttons, etc)

 * Table names now as constants (variables)

 * Banner support functionality

 * Products expected now as normal products (with descriptions)

 * Stock control functionality

 * Products with different attributes can now be added to the shopping cart.
   (feature fix)

 * Authorize.net support added

 * Sessions can now be stored in the database

 * Tell-A-Friend function for products

 * Information box, with all informations about shipping & returns, privacy
   notice and conditions of use

 * Newsletter function in the administration tool.

 * New zones for germany, swiss and austria.

 * Prices can now be handled with/without tax. The tax would be correct
   calculated.

 * Prices in all countries which joined the euro currency, displays the prices
   in euro and national currency. This is a european guideline which is now
   support by TEP.

 * All address information is now stored in the address_book table only. This
   change was made to reduce redundancy and allow more feautures in the
   checkout part (e.g. selection of different BillTo and SendTo addresses)

------------------------------------------------------------------------------
03/06/2001 The Exchange Project Preview Release 2.1
------------------------------------------------------------------------------

 * Payment methods are now modules, makes it easier to implement other payment
   methods. Supported methods COD, Credit Card, Paypal. CC also supports
   storing only part of the CC# in the DB with the other digits being emailled
   to a specific email address.

 * Shipping Modules - Modular shipping methods with support for UPS, USPS,
   FEDEX(Ground), Per Item and Flat rate shipping.

 * Db query clean up a few AS clauses were added for earlier MySQL versions.
   Error checking added for when no records exist.

 * Added languages box - customers can now choose their language anywhere
   except during the checkout procedure (due to POST variables in forms)

 * Added currencies box - customers can now choose their currency independent
   from the language chosen

 * Currencies can be added/deleted/modified through the administration tool -
   no longer through individual language files in the include directory

 * Added a 'Contact Us' Page.

 * Added COMMENTS field to Orders table - an order history
   Need to ALTER TABLE orders ADD comments TEXT not null;

 * Selectable columns in 'Product Listings'.

 * Added a delete button to the orders in the admin tool.

 * Solved a problem with the session id not being passed to the secure server.

 * Countries added to the admin tool.

 * The 'Add a Quickie' box now uses the model number instead of the product
   id.

 * The 'Search' box and the 'Advanced Search' now use the same engine.

 * Backup in the admin tool.

 * Numerous bugs fixed.

 * Categories box has been updated to display path taken in bold, and display
   the parent categories (tree navigation)

 * Font styles implemented

 * tep_image now optionally calculates image size if omitted

 * products_to_manufacturers table removed. Manufacturers are now directly
   link to products, via manufacturers_id record in the products table

 * tep_href_link now removes extra & and ? characters in the URL

 * Products with no manufacturers are now listed in the catalog module

 * New DIR_* definitions for easier understanding ->
   FS = Filesystem (physical)
   WS = Webserver (virtual)

------------------------------------------------------------------------------
12/13/2000 The Exchange Project Preview Release 2.0a
------------------------------------------------------------------------------

 * Added FedEx shipping module
 * Bugfixes

------------------------------------------------------------------------------
12/02/2000 The Exchange Project Preview Release 2.0
------------------------------------------------------------------------------

 * Manufacturers pull-down select box
 * Number of products in each category displayed
 * Bestsellers box
 * See what other customers have brought (linked to current product displayed)
 * Administration Tool now user-friendlier via new layout
 * Categories-to-Categories structure
 * Spanish added to the official languages supported
 * Dynamic product attributes
 * Tax zones, classes, and rates
 * Now PHP3/PHP4 compatible
 * Some configuration parameters now in database
 * Manufacturers now directly linked to products
 * Status of orders can now be modified
 * New advanced search page
 * Order confirmation emails can now be sent to multiple addresses
 * Address formating function implemented
 * PayPal payments implemented
 * Currencies are now formated to the selected locale

------------------------------------------------------------------------------
05/14/2000 The Exchange Project Preview Release 1.1
------------------------------------------------------------------------------

 * Customization variables and constants
 * English and German localization
 * New products and upcoming products modularized
 * Added custom tep_db_* database functions
 * Added custom tep_session_* session functions
 * Added tep_href_link function
 * Added tep_image function
 * Added tep_image_submit function
 * Added tep_black_line function
 * Added tep_break_string function
 * Added tep_products_in_cart function
 * Added tep_exit function
 * Added tep_number_format function
 * Reviews-Box now displays a random review
 * account_edit_process.php updated
 * Review-Box: text now broken to avoid exceeding box width
 * address_book_add.php updated, also combined with
   address_book_add_process.php
 * login.php updated, also combined with login_process.php
 * login_forgotten.php and login_forgotten_process.php now combined to
   password_forgotten.php
 * Added products image to reviews info
 * products_reviews_write.php and products_reviews_write_process.php combined
 * shopping_cart.php updates
 * shopping_cart.php now displays proper price on special for nonsess cart
 * Fixed misalignment of checkout information
 * New directory structure for includes
 * application_top.php and application_bottom.php implemented for application
   wide parameters
 * column_left.php and column_right.php structure implemented
 * Display parse time of pages
 * SQL queries optimized
 * tep_number_format function implemented, but not in use
 * Fixed add a quickie bug - when product did not exist in catalog, it
   inserted a null entry in the cart

------------------------------------------------------------------------------
03/12/2000 The Exchange Project Preview Release 1.0
------------------------------------------------------------------------------

 * Initial Release
