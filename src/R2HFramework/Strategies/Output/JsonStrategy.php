<?php

/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Strategies\Output;

use R2HFramework\Contracts\OutputStrategyInterface;

class JsonStrategy implements OutputStrategyInterface
{
	/**
	 * Convert the array data to json.
	 * @param 	array $data The input data.
	 * @access	public
	 * @return 	mixed
	 */
	public function output(array $data)
	{
		return json_encode($data);
	}
}
