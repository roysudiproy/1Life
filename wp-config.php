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
define('DB_NAME', '1Life-Passport');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'brainium123');

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
define('AUTH_KEY',         'yM.@cK|T&[8QK$gkNu.@WTt6s3%<w1m5T+iLW$B4/4qfMq|SsIO7J)a~(i.Qa]l~');
define('SECURE_AUTH_KEY',  'Jq0HsK>eAC<|?[lAdxE?{(K-0=(`VX@unOzp=KLa|L/1Dp@v;)-u*[Hw=B}@b>d?');
define('LOGGED_IN_KEY',    'tpVDRiO>8ArVBe#gS!Um&RbJ]:6W)~{27euk`9w1)!$v+hM}9qBm~ RZ5=dc<^sT');
define('NONCE_KEY',        ';rNC8d>RNm+48XY=gNz|,bmAfWHY[&)6v~S2gR45g(ms HWs(8*lh!1dy,%H#oaG');
define('AUTH_SALT',        'IXLX5|36ptan!gk)PK/$SQxlpUyu 8[?Kc_TgHUNT_btBPqmDgJDa:{B)q{k~*j:');
define('SECURE_AUTH_SALT', 'q09lc;+UYujt([W1w_<gT*pq~+XFw>.nOr(aSS^h=[0bC$tY2?_#.C@4t<6yjZ`v');
define('LOGGED_IN_SALT',   'ODp!~Uuov1)o_wYycB`bKg>$7a`77`4--]My$Q)>0<ny1JcvQ1 xH[q`&yd5@5[w');
define('NONCE_SALT',       'q^`)j/&DTS?;IypnWo>Ry9eW;!d?##Pk.Ept= 8<W9r=N_75dH|XrA6]*b=!vV?T');

define('FS_METHOD', 'direct');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'Lp18_';

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
