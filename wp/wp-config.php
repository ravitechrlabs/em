<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'emwp');

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

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'M[^RYTwqn;{Hkb!Pbqz<2ADOlV8y~e@&dk:~+rP@|A3DA1Q?z?`#*t+B)H]|vBvw');
define('SECURE_AUTH_KEY',  ' @.B_vIA`Ya*q/bv>xbWb:ZI}UGvYIkP{i|/kDUu;$>4gu|lv/qK67j~Rsl=J:ax');
define('LOGGED_IN_KEY',    '}5^F-/vS>ylXh<FCIz+CGE_k1B|0#Qh`!FRj13WX1qd4s@jQ-Mb<`we()L=y)(8j');
define('NONCE_KEY',        'HQ9]H`_shvGA:l@Yf|F_hG#</|7n(_wg]h6-R3EyrXI-FSc+OhZxXG69CiY]H_Lt');
define('AUTH_SALT',        'v<U%V.Ko698fzH72U3Q-N%iYwzZ9UIC*,HQ]N,F|X|InE-A_R& >~??/hQ[Sk0|T');
define('SECURE_AUTH_SALT', '2=B-ZD#eB3Xb68tO?kTjUcYA=Gs53[_1V9K?j+uc+-NyZ~^8_yZ||A%|VEaN!mEv');
define('LOGGED_IN_SALT',   'ko4Qb%gIluc!_+9#L/*h:kj@w:yxE?=]p*d`qj+YVnYU~uxM7+iTT0LFD>-GS$1(');
define('NONCE_SALT',       '7PWoB!F-KIK{s]_F23ph6Te;JyPv-)=py99-1zupE5ba:jgPRZPKCet!bj.#dd1f');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
