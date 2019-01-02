<?php
/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Contracts;

interface OutputStrategyContract
{
	/**
	 * Convert the array data to the right format.
	 * @param 	array $data The input data.
	 * @access	public
	 * @return 	mixed
	 */
	public function output(array $data);
}
