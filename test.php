<?php


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
