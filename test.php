<?php




//ALL WARNINGS AS EXCEPTIONS
error_reporting(E_ALL);
set_error_handler(function ($errno, $errstr, $errfile, $errline ) {
	throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});


//PHP REQUIRES DEFAULT TIMEZONE TO BE SET NOW
date_default_timezone_set('UTC');


//SET FLOATING POINT SERIALIZATION PRECISION TO A KNOWN VALUE
ini_set('precision', 14);
ini_set('serialize_precision', 14);


//CHANGE TO THIS DIRECTORY FOR CONSISTENCY
chdir(__DIR__);




$out = [

	http_build_query(
		['x' => 'a test']
	),

	http_build_query(
		['x' => 'a test'],
		'',
		ini_get('arg_separator.output'),
		PHP_QUERY_RFC1738
	),

	http_build_query(
		['x' => 'a test'],
		'',
		ini_get('arg_separator.output'),
		PHP_QUERY_RFC3986
	),

];


var_dump($out);


if ($out[0] !== 'x=a+test') exit(1);
if ($out[1] !== 'x=a+test') exit(1);
if ($out[2] !== 'x=a%20test') exit(1);
