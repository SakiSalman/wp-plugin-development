<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'ujKdQybLY1K_n=1Z?Xt-&lB=nex#y:CJMFaomJpJ 61X0w_w-,KeMq2NZN@]VppW' );
define( 'SECURE_AUTH_KEY',   ';E^Mef9t@:h8Nm~y$,R}5:,,E~ {Vp$I`nPy/@g:zUUz L/G07@#%C86OBGl3#Cf' );
define( 'LOGGED_IN_KEY',     'q[mkBIyUn7weC2f0BJLQxEJQ!F6+N3EF*G5f.I06;&Nrd%0J#&FQx|,K/fQ.Z6|@' );
define( 'NONCE_KEY',         'mkG4Iuvh4gRVMQF4LS?1.+D|R)%F.qd%&9I2vD5>o`s&OD$Kd34l&w->D eN;F2{' );
define( 'AUTH_SALT',         '@)n:7 Nx|/x^^Kf4JxH{|XJZ]HT/>^5![855dZ#XKH2hyjj0}%#*w8JRcEFr.C0,' );
define( 'SECURE_AUTH_SALT',  'IoWZ|dBG2^{j3N3OY6&#e.5b:BT.].[e$ L3RD#.@p#OR8L@Ij01~DX,0nng_kDD' );
define( 'LOGGED_IN_SALT',    '!o8n>x(1dS#%O&6>X82:W3hZng[4/]u,=;Vz=`wq!07S8N:m#t%^2^^xsF-*`UKQ' );
define( 'NONCE_SALT',        '$jxk%@73j?T8-5EaOg;vx5.YI,c<VlDU6z.g5@^q{4zE5>Ff6T[^W%GbYq))Dvr4' );
define( 'WP_CACHE_KEY_SALT', 'aSX[)o9DhVtNklvyT4Uq8?GkRXi~&Ck:[NWH%3(;n]wNg3%#kt>s8jnb=_hV2=r,' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
