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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'e-commerce' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'v!+/YlUY:HA6a&N1M_Ov+g@4$`%Db~`^LZV|HahnZ^Gm!`,bv>g;)#!7VAU_04bK' );
define( 'SECURE_AUTH_KEY',  '>&qFk5i_oe$L4:M1pI^1^P0,6XU@r>e]66cy[JI}YtNYmF6{^:|{88hjZlSLevEK' );
define( 'LOGGED_IN_KEY',    '?Sd44/-vapJxR;Pe#IjCA4IzQY@^O7S ,b:)8:*w~S0E-Kj9Y4>o@a6y:K:hNl00' );
define( 'NONCE_KEY',        ']_^7*-u[D(ZrFoVX59J>[#Z[[<RhKwfmU,E0%kP3^9<:mwbd$S^sKHUp)$vuxYd$' );
define( 'AUTH_SALT',        'cU-_4MI#,8@1hJN[HG2ZFHU:`e>*:w4ot_>axh<GIFH.hD!vadkd*QUFDv7XDo4@' );
define( 'SECURE_AUTH_SALT', 'Z g<Q)~vH-xF~m}x<NFa$RH)N<NEKk}*edmx#%.cqN&?l$gg`*Vv5;DH-~)O;L6D' );
define( 'LOGGED_IN_SALT',   'ACjd>0K6DrT3g)2:RPrk%1<}7+|/3,w[t(e#$onT]2=P%@%tf|P!uYU7^?u .Nr_' );
define( 'NONCE_SALT',       'tF4ORDhVgn!n}y?Dv,dZC} Hr)(T+29-$6XWma1U7C@7u$E>qAOw$~w&hLZbObu*' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
