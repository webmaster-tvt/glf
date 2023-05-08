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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u389210813_glf' );

/** MySQL database username */
define( 'DB_USER', 'u389210813_glf' );

/** MySQL database password */
define( 'DB_PASSWORD', 'tAaV3tT1' );

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
define('AUTH_KEY',         '5BPpMyOyP01YkMBOFtSKV99rfIuXx/txUzF1Ki4wMIRRpjuLOmHCvq7NoJHWvPfeFlqTUHBgR4VDO8J/IML2Ew==');
define('SECURE_AUTH_KEY',  'k5iOFe8KbTMmXFIh61hVhC8lx2qBBU7qHmuyZh2Aj+seLvQnUpT2AuIqJPtBm1gWMTEQw5xsUWMvLXLnBxGzRA==');
define('LOGGED_IN_KEY',    'j797uVwPDiOHtvmv3x/Y5nnqtgfOu7lvTsSLzDoun8jDHKRmZiFDXg/41fpQHaZdH4em0sjG8jOMxb6kUQZWxA==');
define('NONCE_KEY',        '7Xzt7g8zfvpHB0jhz0p0Au2g1hURsO8fyianS6bvsecZT7ZmXiHHJfuMABtcnzUFEX+4ZqiEa88YGL946I13hw==');
define('AUTH_SALT',        'efzt8U/3jSWJN12/puXOn0psWscORBSTgL+QIa5imJhEOOg/VWta6MmMDd7JuPL96XhFC1EQ4Rzczs+ZbdNRoQ==');
define('SECURE_AUTH_SALT', '5goeW6wehOfa3kGW5N2GP8ELDaYBTt8qxq0dLvdvO5Iq0J8IEKgNIcq6A0wJ8vZFyUJ2uSbOiGunhfFcDW5juw==');
define('LOGGED_IN_SALT',   'tCD8+HyOmvLV+UE75EWb90DrqdWF8uuFAiT1DUqaWbTp3JLxdZFiBBbOPhfahxAY6+GZBNT6/EDAG5i8vntaSQ==');
define('NONCE_SALT',       'Gnpb0BBKMwpKlg1/sYKbrM+KXJrtLUspul4YEutylxsD11/nPkeZZuJRAdp1fpvjUEf8cZe+m38LcUjp77BpmA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




define( 'FS_METHOD', 'direct' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
