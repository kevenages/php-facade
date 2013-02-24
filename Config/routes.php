<?php
/**
 * Routes
 * 
 * @author Keven Ages <kages@gmail.com>
 * @version 1.0
 * @since 1.0
 *
 */
require_once LIBS . 'Route.php';
/**
 * Setup our routes
 */
$route = new Route();

$route->add('/', function() {
	print 'Welcome to the PHP Facade'
});
/* Multi var examples:

$route->add('/name/.+', function($name) {
	echo "Name $name";
});

$route->add('/this/is/the/.+/story/of/.+', function($first, $second) {
	echo "This is the $first story of $second";
});
*/