<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'mikeynetwordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'r00t');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'kS6%kVBQ(HTmbWP|gonE[o&ve&Tab7/#<|0-@N$nx*lg41hwC7V,fvu<#<U#~}u1');
define('SECURE_AUTH_KEY',  'S3fwKY$gN.BXl)[3?p|SO[&5X?8N1LA|7OlbWp&{n!pvllK3lOsLgRu#H=[~d%&8');
define('LOGGED_IN_KEY',    '0O^~^}q+|*=HU:)@(&&]vao%wlt l}bb^4z%1 1B]D^mU]csFO:{a+mL0l,VBH20');
define('NONCE_KEY',        'KUZm WtIno/jsAq33swWLuI-QS_CE9OH4Gy-M`x`vS>l[&GO-Z|$PDg}k^O.K-]a');
define('AUTH_SALT',        '/m)K?fTjHfj+%bs!wQn#PrMA-w|Z[({)ztWBp@C1: ,P|ESf_OE+0zV+#nS{W(g(');
define('SECURE_AUTH_SALT', '|vD>D%Pd.Su7swK#G$nYE;sAgsdgGW&+tY!|uBA9[8|YW(btGL_Md=#GL7aQ%56-');
define('LOGGED_IN_SALT',   'eB<%}$StSJz)>ECV9Ac+fSk0.+.FXRD*{ -d|*;U@a02^db,%ZD*^TJHt7T~l6J/');
define('NONCE_SALT',       '<<Z-Q+$yll8tacI9wniT--5iS;hSe`^ Q0c7v ;+pWYa.7-d8h8.w=V</Gy,], 5');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
