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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'lnBz5ren9deju+9vai1r+iol0vFu6wk0/ueouy1Fo+qoON35MrIwNe2qJMJEhlH9kJUVkV2xdlRWT5R5ymsjRg==');
define('SECURE_AUTH_KEY',  'iLYIsOkLT9Xccp4eL5iegKdKV0XNxKXUkSepw7ZHNHG6saLC8fU0r1lgV8ME2ooXnthFKaT0XEVsomi05IfCDQ==');
define('LOGGED_IN_KEY',    '12AVVgx8pbEZ+tvdUoCDYPRZ2A+CbunXtiMchPznv21+CJd67regCSiX7MNR2n7irlbhlmMOvo8+M+o5GBksAg==');
define('NONCE_KEY',        'TNDMLcrtOdulilwBXEEjtR+GmMxMQKoAMYnT5bJ4oZ4GpQJgb17Mi3KhjwUpgjQ/fTpgRDY8gnAqkJG88PbnlA==');
define('AUTH_SALT',        '2U+cONNamqe6LvlJ9oA6h/8ui8+R7WozbR/ZCFCST5Sg1Ndp4rcdftIrGGUrdp9tzsh8DMC6WTUtFQXh1fw87Q==');
define('SECURE_AUTH_SALT', '3MvLSonmi7R1Z3DKCnx1Bo39clURZN8dBF01/NEIoml6XZ6au7iLddjuwZNdoLmfZh58i24tk41oAPJ1chljBg==');
define('LOGGED_IN_SALT',   'FTEE5ojzdrwpKr0+v7nI3kX3PqSaBkHZxnKCyf8Hp0fLCCSCmx/rxHVgrdnWppSqpsk6UuVVXDD69T+hgyEgvA==');
define('NONCE_SALT',       '1m5J3UVLbemvSl6upGnD0W7xBUxmO72nlx2raN6+H5NMs6C4N8vn0jvZW2JvThNBgP7AnEu1JxNRf1xFVHwFgQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

/* Inserted by Local by Flywheel. Fixes $is_nginx global for rewrites. */
if ( ! empty( $_SERVER['SERVER_SOFTWARE'] ) && strpos( $_SERVER['SERVER_SOFTWARE'], 'Flywheel/' ) !== false ) {
	$_SERVER['SERVER_SOFTWARE'] = 'nginx/1.10.1';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
