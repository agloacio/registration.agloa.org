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
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:/Users/steig/source/repos\registration.agloa.org\wp-content\plugins/wp-super-cache/' );
define('DB_NAME', 'registration_agloa_org');

/** MySQL database username */
define('DB_USER', 'registrationaglo');

/** MySQL database password */
define('DB_PASSWORD', 'u*2kDNS6');

/** MySQL hostname */
define('DB_HOST', 'mysql.registration.agloa.org');

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
define('AUTH_KEY',         'FhA"vh5Min+AwYxi/h#ofb8MQYqz@eVGH^;v2&Y92_F/EnIA/+jv4cS@hM*iWk_2');
define('SECURE_AUTH_KEY',  'UOX^@d~sk63S30C6f:_Ofd82(PtPeCyiYn:rDsNTFxo/bPHXIvV3XA6^LUKy9qy*');
define('LOGGED_IN_KEY',    'cml#CYyyTIk@OH8Y1@Ab#w)9^|b8yM5Vn_j2~PDsem6Lq~z&tJe?&:q$ZxOL3sWD');
define('NONCE_KEY',        'np+4@@@qmOYYBzg~0Uqxfgm|Qmq@)y^NsxWb^wBrOqa:3p&)VE99#OVZa$h:r;D:');
define('AUTH_SALT',        'BlOlioRM$$(rUqwp9*hzhYz*q?~b6~WjSRD"4OF!:p)?8:f#U`0kQCt(j4iWtkc!');
define('SECURE_AUTH_SALT', ')a$9Zu;5!pEZa2Na71&Nh)KEaC?4(pm@+~`RE^ofpJI(u:inK|Q)NHJr4uLKEIw1');
define('LOGGED_IN_SALT',   'm6(p:L(cEKL^lS7R*Hv??%$(&xd4%UGUDE(KH13Qeok"G8s#4Fv7J?:G%t(Mxr2x');
define('NONCE_SALT',       'o_w_lmrbcLR"w$Cma_quUqrNYjC@L9zQOgoAcj8kfP3%*7BI_sxFyB"WJ:o|m%K~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_de9id5_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
