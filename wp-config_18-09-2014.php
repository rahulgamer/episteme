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
define('DB_NAME', 'episteme');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**define('WP_HOME','localhost:9090/episteme');
define('WP_SITEURL','localhost:9090/episteme');*/

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+i~Z:!di~ D+b4$+#RpLFS0`OPBb=qbE:WmM7%cLFWb/7A|~+vG3mW*5V|)bIcyH');
define('SECURE_AUTH_KEY',  ' >?z{EjY6BW<33I)6,:)SF>id&m-31!Kp1*/ocuD- 6s&xMNf&4=Z-:8t.v#JG1|');
define('LOGGED_IN_KEY',    'Vv`FPcWxNm0ByZX<;ab5/0M-aef<D`g;1<cxFK1E$%Rf.]e@Q3F1h?+<h_B<f A|');
define('NONCE_KEY',        'NI6S*Hr<*` V{x-_ea!l=NqQ<1@a;?B<Q8IX j) (GE0=l(cy0;%J.e9VTeM_<~l');
define('AUTH_SALT',        'mNHuYv%o4sZeT/X5f~ 2lj|}41zr 9xK7PBw{]@ZcAmgssp)R`CC}g4(vlOCO~+U');
define('SECURE_AUTH_SALT', '$x#.szH_bN%WN1o.#$FhcscGxHat|~oNXVoD49_5K#YF>gc%+fdqFsw,:Sswzi<J');
define('LOGGED_IN_SALT',   ']U{GNp&uKMQ0}i}1>7[5(hq_A#zw}$~ZHY/JJY8mSX9G?|^WbS<jh1=gpF4Qmt>z');
define('NONCE_SALT',       'v`=bM<C)T) -lvH(ECY,^8m 7)4%sB!#!kpG`c(ro[4CYc:RR@Q^OF*k{d=~L{n7');

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
