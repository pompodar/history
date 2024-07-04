<?php
define( 'WP_CACHE', true );
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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'history' );

/** Database username */
define( 'DB_USER', 'user' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

/** Database hostname */
define( 'DB_HOST', 'database' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '=r0An(+xGBMT>Imd+*vUc#U I5>.Tow*p>a3B]:Ogt%7lB-htS=$h]2!ES%a:qhN' );
define( 'SECURE_AUTH_KEY',  'E2=)Gr.G3:tiHh^{dz1GRcWf:!;XYbXzGxT cavBsB|ZI=[%!&z2<+_$*?;;iiBV' );
define( 'LOGGED_IN_KEY',    'f;ajeQtQEq-Q/favg=lOp&h}SF(hwVVL:N){uB)b/i<}Fih2F.KrD=(b%<6na;[t' );
define( 'NONCE_KEY',        'rt.Y)A*. rF29 XEy%lJ|viQwjmLt><:k)=jO>]yfqy9z8;X%,kY6+ytl&yN_zmy' );
define( 'AUTH_SALT',        '<A*::>{`p$B2DT[t>[ln|khTW3[bQCtM2x8akZ]C6cZ4v&qae>PF)2=zT*60A`a!' );
define( 'SECURE_AUTH_SALT', 'pYEBOU(moy-fMPM![+oVC/L)uiB3Sq8}6Xi7v1pol0=^/P[Q*=_.tT%txp$9wKVP' );
define( 'LOGGED_IN_SALT',   '=8%dkib?O36oxTlf9e5D]Z;L>g=9Y{E[gK&M;!mazSgHO@by8DN-sn$t.i`%iBj_' );
define( 'NONCE_SALT',       '?{&oU6#<QO!|iSZsfC4#`Rlm:[[S_ERv7IemeaO4^H=O}4,|1I+iYu;/cA0Q~#)u' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
