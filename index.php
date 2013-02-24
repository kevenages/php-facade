<?php
/**
 * Index.php
 * 
 * @author Keven Ages <kages@gmail.com>
 * @version 1.0
 * @since 1.0
 *
 */
define('DS', DIRECTORY_SEPARATOR);
define('CONFIGS', 'C:\\Users\\dell\\Projects\\php-facade\\Config' . DS);

require_once CONFIGS . 'core.php'; 
/**
 * Listen for routes -- header/footer?  Yuck!  Need better view support
 */
#$Request = new Request;
$route->submit();