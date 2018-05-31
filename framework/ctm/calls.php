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
 */
function update($call_id, $data) {
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
