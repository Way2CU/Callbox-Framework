<?php

/**
 * Update Call Tags
 *
 * This example configures API access and then for submitted
 * call data through POST updates call tags.
 */

require_once('../init.php');

// configure
CTM\configure(10000, 'key', 'secret');

// update call
$data = CTM\parse_data();

if ($data) {
	$tags = array('new', 'sold');
	CTM\Calls\update($data->id, array('tag_list' => implode(',', $tags)));
}

?>
