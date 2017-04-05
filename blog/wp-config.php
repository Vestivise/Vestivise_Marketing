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
define('DB_NAME', 'blog');

/** MySQL database username */
define('DB_USER', 'blog');

/** MySQL database password */
define('DB_PASSWORD', 'ManhattanIsland12!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'eDBX-1T(5I)U}|en(1T*tZ/M?;&ZYvJcLuQtorvS(l9@8KIU [HU]Iv#||4Ak<-4');
define('SECURE_AUTH_KEY',  'I-Rgp=XJ1P|F&0J1l#6tlz-}%-`joHju@Z0eDa:*r-Io?xDTN-$=H`!BC&SI?9-L');
define('LOGGED_IN_KEY',    '~os~8+Z0e*QAy%PYV^|[sdPT.EOz!-mck<L:GV:y/Hw:.%XJ)Zav6M=<GroQxd1*');
define('NONCE_KEY',        'jIdMg,T,M^%S;(avSf]&4d*xPM+<CGEe?38 A.8v ]eA-Z_5In}}shLPS|%WN-VB');
define('AUTH_SALT',        '*A0bo35LC-40{w`}m:t=I,O;dp`Z8<O=-KFc,va!2|Czzuud@#Fu3+TF&Yx=v$>E');
define('SECURE_AUTH_SALT', '9YCox6WEFXF|=ekxN}%:a<kvpn1^iNzzk%jp_|deV*j0 UWy-/#R:{Hl,!*v&B/ ');
define('LOGGED_IN_SALT',   'R0}ay<cLYy%9knh3CQ[pe)P~ke-kkyyLa}8%/S&c-5xI$GO`#=c$pURQ|-kI$$M6');
define('NONCE_SALT',       '8A]@4;RK. BXR>dg|ktl@_{(~:O/n6K=Yw7<{]DVWr:20hztG%rN@m.:Tc8bp|oo');
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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_MEMORY_LIMIT', '3000M');

define('FS_METHOD','direct');
