<?php
/**
 * Core Config file
 * 
 * @author Keven Ages <kages@gmail.com>
 * @version 1.0
 * @since 1.0
 *
 */
/**
 * Site Configs
 */
//0 = Forever
define('SESSION_COOKIE_LIFETIME', 0);
//For Redis
define('SESSION_COOKIE_PATH', '');
//Password reset expiry, takes a strtotime value
define('FORGOT_PASSWORD_EXPIRE', '+1 day');
//Array keys for Ajax responses
define('AJAX_ERROR_KEY', 'Error');
define('AJAX_SUCCESS_KEY', 'Success');
/**
 * Debug (Not implemented fully)
 *  0 = Off (production)
 *  1 = On
 */
define('DEBUG', 1);
//Site URL -- with trailing slash
define('SITE_URL', 'http://localhost/php-facade/');
define('SITE_NAME', 'PHP Facade');
define('ROOT', 'C:\\Users\\dell\\Projects\\');
define('APP', ROOT . 'php-facade' . DS);
define('LIBS', APP . 'Lib' . DS);
define('MODELS', APP . 'Model' . DS);
define('CONTROLLERS', APP . 'Controller' . DS);
define('VIEWS', APP . 'View' . DS);
define('HELPERS', LIBS . 'Helpers' . DS);
define('VENDORS', APP . 'Vendor' . DS);
define('WEB_ROOT', APP);
/**
 * Database config
 */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_SCHEMA', '');
define('DB_PORT', '');
/**
 * Mobile Support
 */
define('MOBILE_AGENT', '(iPhone|MIDP|AvantGo|BlackBerry|J2ME|Opera Mini|DoCoMo|NetFront|Nokia|PalmOS|PalmSource|portalmmm|Plucker|ReqwirelessWeb|SonyEricsson|Symbian|UP\.Browser|Windows CE|Xiino)');
/**
 * Regex's
 * -------
 */
/**
 * General
 */
define('REGEX_NOT_EMPTY', '/.+/');
/**
 * Security (untested/unused)
 */
define('REGEX_IP', '(?:(?:25[0-5]|2[0-4][0-9]|(?:(?:1[0-9])?|[1-9]?)[0-9])\.){3}(?:25[0-5]|2[0-4][0-9]|(?:(?:1[0-9])?|[1-9]?)[0-9])');
define('REGEX_HOST', '(?:[a-z0-9][-a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,4}|museum|travel)');
/**
 * Billing/Shipping
 */
define('REGEX_PHONE', '/^(?:\+?1)?[-. ]?\\(?[2-9][0-8][0-9]\\)?[-. ]?[2-9][0-9]{2}[-. ]?[0-9]{4}$/');
define('REGEX_EMAIL', "/^[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[a-z]{2,4}|museum|travel)$/i");
define('REGEX_POSTAL_CA', '/\\A\\b[ABCEGHJKLMNPRSTVXY][0-9][A-Z] ?[0-9][A-Z][0-9]\\b\\z/i');
/** 
 * Credit cards/Bank card
 */
define('REGEX_AMEX', '/^3[4|7]\\d{13}$/');
define('REGEX_MASTERCARD', '/^5[1-5]\\d{14}$/');
define('REGEX_VISA', '/^4[0-9]{12}(?:[0-9]{3})?$/');
define('REGEX_BANKCARD', '/^56(10\\d\\d|022[1-5])\\d{10}$/');
define('REGEX_CC_MONTH_YEAR', '/^[0-9]{2}$/');
define('REGEX_CC_CVV', '/^[0-9]{3}$/');
define('REGEX_CC_GENERAL', '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|622((12[6-9]|1[3-9][0-9])|([2-8][0-9][0-9])|(9(([0-1][0-9])|(2[0-5]))))[0-9]{10}|64[4-9][0-9]{13}|65[0-9]{14}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})*$/');
/**
 * Required (Needs better integration)
 */
require_once CONFIGS . 'definitions.php';
require_once CONFIGS . 'routes.php';
require_once VENDORS . 'adodb5' . DS . 'adodb.inc.php';
/**
 * Libraries
 */
require_once LIBS . 'Object.php';
require_once LIBS . 'Model.php';
require_once LIBS . 'Route.php';
require_once LIBS . 'Request.php';
require_once LIBS . 'Validate.php';
require_once LIBS . 'Sanitize.php';
/**
 * Models
 */

/**
 * Controllers
 */