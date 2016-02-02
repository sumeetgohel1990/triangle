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
define('DB_NAME', 'sumit_demo_wordpress44_twig');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']5i4T5+7{3)HNoCL7`hW_12T,2D:ccKpQ QBMOAa*}l,XFLQIqQh{>>w+c~HZDQ8');
define('SECURE_AUTH_KEY',  'JEqg_G>:E4N*QewH5z$ 4a ct&Y*s*x52O=*h:m~SxJVs253:*ZceO4?C*%&j.6c');
define('LOGGED_IN_KEY',    '/y+]PQ1Hv$R>(N_}B{`b+HVl(-#t6m+vRqnV#!)=a4+L+8>Ke6C-|[iv-mRk(}zM');
define('NONCE_KEY',        'g0A.r]-d}_3amNA{9$KLnPv>MWSv{-WTvfPoA=EEu8|^cb~1=e(}%d71uJG!~5(f');
define('AUTH_SALT',        '=Xzc1pCbr1LQ@9mvc)L~:JK;7-}gW1`1|VIvj&=/x~CXN)}~MBD|= Ft}6+]jAy6');
define('SECURE_AUTH_SALT', 'e}vQP*l|/T|a+9{//r>30|SV_lvY2{#JP7g|i-_bA2m&rIQ:wCn`;5Rx6=7zw5%Z');
define('LOGGED_IN_SALT',   'G<dKlrGppnMzi{C!{M+(YGJ|5,!Y9A]p-9hDB/%lUK]G!(oPnAxpcldCyOdp6|z}');
define('NONCE_SALT',       'y:Nnx|{+CwmL/DH.KY1*a<zS>kh$@-CI|$^BtRwGn>9k=YON;KWbD<wXw})O.|xB');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
