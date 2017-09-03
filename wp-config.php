<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db_arti_site');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123456');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'iUlXru$-&)~KX/U`l9Rw5ZL]-]B]+ox$NkQ%pHIw5X6VQ4u84TJn+za szlciJn+');
define('SECURE_AUTH_KEY',  'dJ3zZZI%}5z*hE&EaZS~LA9sexWg~^RyM6&O5fK%@HxJyVYDDctrmWy%*N9lyeSK');
define('LOGGED_IN_KEY',    '%FjY3GA,`&3)BqxsE*$4)QIUX;eXf1aKfcefZ VPIWbFhs)OM)q7q=-jDnm`?--s');
define('NONCE_KEY',        'FJci .9olpr[XP]tm>_f1@bvU*QL;fZE*cFgQ,Xj=;:KpSe*G>izc)V5P<cPWwe8');
define('AUTH_SALT',        'P<.$A{_bX_,ERI>]U^ZTr>_>-Y,EyqNe-AfB_sD<mZ80_( K*tK8^!!P8w7?,7{u');
define('SECURE_AUTH_SALT', 'oi`X@_WuM4!XB;3&J13,HRd*~k0bS{moGvyIqA0n(y$gwFuF<9~>t&6Oqyz4srrq');
define('LOGGED_IN_SALT',   'I}9_c2>r<7-Q rSwI;Z(I/.Hx}!=YY&?^&gG%2u7!W-y+bx97`VBjWh]?Kq-:.2^');
define('NONCE_SALT',       'L(yl+5W(6yN9s;VEFu/%q^vyz6QTK:^A?x)Adj0!%h eo^ 8J$&hrt&X-mNVFZSA');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'arti_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
