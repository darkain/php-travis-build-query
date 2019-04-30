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



function query($data, $prefix='', $separator=NULL) {
	switch (true) {
		case $data === NULL:
		case $data === '':
		case is_bool($data):
		case is_array($data)	&&  empty($data):
		case is_object($data)	&&  empty($data):
			return '';

		case is_string($data):
		case is_int($data):
		case is_float($data):
			return (string) $data;
	}

	if ($separator === '') {
		$separator = ini_get('arg_separator.output');
	}

	return http_build_query($data, $prefix, $separator,  PHP_QUERY_RFC3986);
}



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

	query(
		['x' => 'a test'],
	),

	ini_get('arg_separator.output'),

];


var_dump($out);


if ($out[0] !== 'x=a+test') exit(1);
if ($out[1] !== 'x=a+test') exit(1);
if ($out[2] !== 'x=a%20test') exit(1);
