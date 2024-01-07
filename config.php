<?php
ob_start();
//GLOBAL CONSTANTS
ini_set("error_reporting",		"on");
session_start();
define( 'WEB_TITLE',			'PanTeam | BookList' );
define( 'WEB_DESCRIPTION',		'PanTeam');
define( 'WEB_AUTHOR',			'panteroot');
define( 'WEB_ABSTRACT',			'wiwiwi');
define( 'URL_LOCATION',			'http://localhost/booklist/' ); 
define( 'MYSQL_HOST',			'localhost' );
define( 'DATBASE_NAME',			'db_books' ); 
define( 'DATBASE_USER',			'root' );
define( 'DATBASE_PASSWORD',		'rootx' );
define( 'PDO_DSN',		 		'mysql:host='.MYSQL_HOST.';dbname='.DATBASE_NAME.';charset=utf8');

define( 'MAIN_PAGE',			URL_LOCATION.'?parameter=' );
define( 'CLASSES',	 			'classes/' );
define( 'SETTINGS',				'settings/' );
define( 'LAYOUT',				'layout/' );
define( 'MODULES',				'pages/' );
define( 'CONTROLLERS',			URL_LOCATION.'controllers/' );

//FILE LOCATIONS
define( 'IMAGES',		 		URL_LOCATION.'images/' );
define( 'STYLES',				URL_LOCATION.'styles/' );
define( 'JAVASCRIPTS',			URL_LOCATION.'javascripts/' );
define( 'PLUGINS',				URL_LOCATION.'plugins/' );
define( 'UPLOADS',		 		URL_LOCATION.'uploads/' );

//PLUGINS
define( 'FLEXIGRID',			PLUGINS.'flexigrid/' );
define( 'DATATABLES',			PLUGINS.'dataTables/' );
define( 'DATETIMEPICKER',		PLUGINS.'datetimepicker/' );
define( 'PAIRSELECT',			PLUGINS.'pairselect/' );
define( 'HIGHCHART',			PLUGINS.'highchart/' );
define( 'JQUERYUI',				PLUGINS.'jqueryui/' );
define( 'BOOTBOX',				PLUGINS.'bootbox/' );
define( 'CHOSEN',				PLUGINS.'chosen/' );
define( 'TIMEPICKER', 			PLUGINS.'timepicker/');

//SECURITY CONFIGURATIONS
define( 'WEB_KEY',				'secret04' );

//OTHER CONFIGURATIONS
define( 'DEFAULT_TIMEZONE',		'Asia/Manila' );
define( 'DEFAULT_LANGUAGE',		'en' );
define( 'ROBOTS',		        'noindex, nofollow' );
define( 'REQRD_FLD',		    '<span style="color: red;font: normal bold 16px Helvetica;">*</span>' );



?>