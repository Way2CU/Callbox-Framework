<?php

/**
 * Call Tracking Metricks Configuration
 *
 * Globally available configuration class which is used as
 * container by CTM functions.
 */

namespace CTM;


final class Config {
	const API_URL = 'https://api.calltrackingmetrics.com/api/v1/accounts/{account_id}';

	private static $configured = false;
	private static $account_id;
	private static $key;
	private static $secret;

	/**
	 * Generate and return authentication header.
	 *
	 * @return string
	 */
	private static function get_authentication_header() {
		if (!self::$configured)
			throw new Exception('Access to CTM framework is not configured!');

		$auth = base64_encode(self::$key.':'.self::$secret);
		return 'Authorization: Basic '.$auth;
	}

	/**
	 * Apply configuration values for communicating with CTM.
	 *
	 * @param integer $account_id
	 * @param string $key
	 * @param string $secret
	 */
	public static function apply($account_id, $key, $secret) {
		self::$account_id = $account_id;
		self::$key = $key;
		self::$secret = $secret;
		self::$configured = true;
	}

	/**
	 * Generate stream context for sending requests. Only additional headers need
	 * to be specified. Headers for authentication with CTM are automatically included.
	 * Headers array is key/value pair instead of pre-formatted.
	 *
	 * Example:
	 *	Config::get_context(
	 *				'POST',
	 *				array(
	 *					'Content-type' => 'application/json'
	 *					),
	 *				json_encode($some_object)
	 *			);
	 *
	 * @param string $method
	 * @param array $headers
	 * @param string $content
	 * @return object
	 */
	public static function get_context($method='GET', $headers=array(), $content=null) {
		// prepare headers
		$final_headers = array();
		$final_headers []= self::get_authentication_header();

		if (!is_null($headers) && count($headers) > 0)
			foreach ($headers as $header => $value)
				$final_headers [] = $header.': '.$value;

		// prepare options
		$options = array('http' => array(
					'method'        => $method,
					'header'        => implode("\r\n", $final_headers),
					'ignore_errors' => true
				));

		// include content if specified
		if (!is_null($content))
			$options['http']['content'] = $content;

		return stream_context_create($options);
	}

	/**
	 * Generate API endpoint URL and replace parameters with values
	 * provided in `$params`.
	 *
	 * Note: In addition to parameters specified in `$params` array it's
	 * also possible to specify `account_id` parameter, which will override
	 * default account ID provided by the configuration.
	 *
	 * Example:
	 *	Config::get_endpoint_url(
	 *				'/calls/{call_id}',
	 *				array('call_id' => $data->id)
	 *			);
	 *
	 * @param string $path
	 * @param array $params
	 * @return string
	 */
	public static function get_endpoint_url($path, $params=array()) {
		// prepare full length path
		$result = self::API_URL.$path;

		// replace parameters in path
		$final_params = array('account_id' => self::$account_id);
		$final_params = array_merge($final_params, $params);

		foreach ($final_params as $param => $value)
			$result = str_replace('{'.$param.'}', $value, $result);

		return $result;
	}
}

?>
