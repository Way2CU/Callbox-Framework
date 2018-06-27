<?php

/**
 * Calls Handling - Callbox Framework
 * Copyright © 2018 Way2CU. All Rights Reserved.
 *
 * Provides functions for interacting with CTM API. Before
 * using these functions `Callbox\configure` function must
 * be called.
 *
 * Author: Mladen Mijatov
 */

namespace CTM\Calls;

use CTM\Exception;
use CTM\Config;


/**
 * Find a call for specified set of parameters. If no call
 * is found `null` is returned. If more than one record is matched
 * only the first one will be returned.
 *
 * @param array $params
 * @return array
 */
function find($params) {
}

/**
 * Get a list of calls for specified time period. If no calls
 * can be found empty array is returned.
 *
 * @param string $period
 * @return array
 */
function get_for_period($period) {
}

/**
 * Destroy all personally identifiable information about a contact. Extra
 * care needs to be taken when setting `$redact_related` to `True`.
 *
 * Note: This action can not be undone!
 *
 * @param integer $call_id
 * @param boolean $redact_related
 */
function redact($call_id, $redact_related) {
}

/**
 * Update specified call data.
 *
 * @param integer $call_id
 * @param array $data
 * @return boolean
 */
function update($call_id, $data=array()) {
	$result = true;

	// make sure we have data to work with
	if (count($data) == 0)
		throw new Exception('Unable to modify call with empty data!');

	// prepare for call
	$url = Config::get_endpoint_url('/calls/{call_id}/modify', array('call_id' => $call_id));
	$context = Config::get_context(
			'POST',
			array('Content-Type', 'application/json'),
			json_encode($data)
		);

	// get response from remote server
	$raw_response = file_get_contents($url, false, $context);
	$response = json_decode($raw_response);

	// TODO: Test stupid API and see what the response code is.
	/* if ($response !== null) */
	/* 	$result = $response->code; */

	return $result;
}

/**
 * Add comment for current call.
 *
 * @param integer $call_id
 * @param string $text
 */
function add_comment($call_id, $text) {
}

/**
 * Update existing comment.
 *
 * @param integer $call_id
 * @param integer $note_id
 * @param string $text
 */
function update_comment($call_id, $note_id, $text) {
}

/**
 * Remove specified comment from call.
 *
 * @param integer $call_id
 * @param integer $note_id
 */
function delete_comment($call_id, $note_id) {
}

/**
 * Mark phone call as sale with optional data.
 *
 * @param integer $call_id
 * @param string $name Reporting tag within a call.
 * @param integer $score Number between 1 and 5 indicating quality of call.
 * @param boolean $conversion Indicator whether call resulted in a sale.
 * @param numeric $value Numeric value indicating value of the call.
 * @param string $date Date of sale in YYYY-MM-DD format.
 * @return boolean
 */
function create_sale($call_id, $name=null, $score=null, $conversion=null, $value=null, $date=null) {
}

/**
 * Remove sale data from this call.
 *
 * @param integer $call_id
 */
function delete_sale($call_id) {
}

?>
