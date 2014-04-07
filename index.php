<?php

/**
 * A simple PHP MVC skeleton
 *
 * @package php-mvc
 * @author Panique
 * @link http://www.php-mvc.net
 * @link https://github.com/panique/php-mvc/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load application config (error reporting etc.)
require 'appserver/config/config.php';

// load application utils
require 'appserver/utils/constants.php';
require 'appserver/utils/functions.php';


// load application class
require 'appserver/libs/application.php';
require 'appserver/libs/controller.php';

// start the application
$app = new Application();
