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

 define( 'WP_MEMORY_LIMIT', '64M' );
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '57964wordpress');

/** MySQL database username */
define('DB_USER', '57964wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'mick123');

/** MySQL hostname */
define('DB_HOST', 'sql3.pcextreme.nl');

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
define('AUTH_KEY',         'Ms1vp2dy2T@.C6+.|9>M(C3UaV}LoY_b`Nhu=7Bioa]>jH)V@PdJ}iw~*&9)^,{z');
define('SECURE_AUTH_KEY',  '4Y#(0J}K+uT53(v5m`oiD4SLjO:+Veo51gyOuF_lst(|U#%3>(vhh+RT/l)(;$3H');
define('LOGGED_IN_KEY',    '5@ia;mV}~$G_[fzo:[#Zrvf++B?$|^{-aYYP[`u{cmc+XPO%jkzKCtMqigUDj?d^');
define('NONCE_KEY',        'XenfIrBI.m,)9(Qvi5xwUkIn-H+bz-#kf{-A10J~to2`$r>,M9ebi@* 0_]!$kW7');
define('AUTH_SALT',        'c->|mF}Hda3$mU:E;%>d*`Xo(~eaG`MV)p|b.G&[hg)@Rw([0~PM+X(<=yOkB.[=');
define('SECURE_AUTH_SALT', 'UGCZ2JBzDM:&$5$/-c%-B1:sM{YfB!]818,fXA;I^PpSnH4x+2@KD=`pB`BQ,3:s');
define('LOGGED_IN_SALT',   'm-v=nincGdH%A-Il[deM?&emn7Sg+3&aZ6+%QK>)?FN7r8U%*$P6rBHpw7=yEo+q');
define('NONCE_SALT',       '|0zl|%j-%(d0nsHbOz%8@jz{3-{j|&fO&}uj{E|gN5IBg|]~~[=2JG25oRy$+zmV');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'nl_NL');

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
