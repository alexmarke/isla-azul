<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'isla-azul' );

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
define( 'AUTH_KEY',         '?f(/]E*_Rg]jYe,)6vQ8js.(sw$W?s`SkpK2FQS1qTLZXr#AmyDRN@R{0%-OMi#h' );
define( 'SECURE_AUTH_KEY',  'J ?ccJ75]8U*:l_/^Oq6a2Y]##K(9<TIIL<dhI0,/5tGh[Z[^z9e7Qv1*$>.Vw{w' );
define( 'LOGGED_IN_KEY',    '0XeYO>_g<(grW+ZQrT):8^BuaPyv0,0ao0z`t`9C,:y8xDzMI@h({U?hL.DmRyU!' );
define( 'NONCE_KEY',        '55^/7jML9 al$k0[n!gCdJt~v~r}2m*ziX6mKlrCjlte~%.;cX)~>t1~}Hi_n-2q' );
define( 'AUTH_SALT',        '`JZV2lu@xDJ g`o,z`xXCp/tp>#$VRzOMmg1~;}gtQ:/f($T-A)u/2T]q^h].WR3' );
define( 'SECURE_AUTH_SALT', '>W2gr9,ge*S~T1D{,9L-ng@6$k4r21!1}v|l7NYwy!MPBW7h3u!$f<UE3K <b*>r' );
define( 'LOGGED_IN_SALT',   '=u4Iw:=ef@yAUomk*aEDI:3Ida87$Arzlt1OJT21aZl:^h5F3>^zCPhn4gT@<$UO' );
define( 'NONCE_SALT',       'u-.;q+#Oks{YI}}}ve}L)/~tBU_j/zkw(3/gL5#Ct[,9=Gioux|:/QMD}kBD-OT[' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
