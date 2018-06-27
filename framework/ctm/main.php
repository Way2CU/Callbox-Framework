<?php

/**
 * Call Tracking Metricks
 *
 * Support for accessing and modifying data on CTM through API.
 */

namespace CTM;

require_once('config.php');
require_once('calls.php');


class Exception extends \Exception;


/**
 * Configure access to API.
 *
 * @param integer $account_id
 * @param string $key
 * @param string $secret
 */
function configure($account_id, $key, $secret) {
	Config::apply($account_id, $key, $secret);
}

/**
 * Get POST data and try to parse it. If parsing fails `false` is returned,
 * otherwise JSON object is returned.
 *
 * @return mixed
 */
function parse_data() {
	$result = false;

	// we can only parse specific data
	if (!$_SERVER['REQUEST_METHOD'] == 'POST' || !strtolower($_SERVER['CONTENT_TYPE']) == 'application/json')
		return $result;

	// parse data
	$raw_data = file_get_contents('php://input');
	$data = json_decode($raw_data);

	if ($data !== NULL)
		$result = $data;

	return $result;
}

?>
