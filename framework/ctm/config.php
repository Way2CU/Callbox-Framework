<?php

/**
 * Call Tracking Metricks Configuration
 *
 * Globally available configuration class which is used as
 * container by CTM functions.
 */

namespace CTM;


final class Config {
	private $account_id;
	private $key;
	private $secret;

	public static function apply($account_id, $key, $secret) {
	}
}

?>
