<?php
/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Traits;

use R2HFramework\Strategies\Output\JsonStrategy;

trait Fillable
{
	/**
	 * Data storage.
	 * @var 	array
	 * @access	protected
	 */
	protected $fillableData = [];

	/**
	 * Fillable fields.
	 * @var		array
	 * @access	protected
	 */
	protected $fillableFields = [];

	/**
	 * Hidden fields to exclude from output functions.
	 * @var 	array
	 * @access	protected
	 */
	protected $hiddenFields = [];

	/**
	 * Set a fillable property.
	 * @param	string $name  The name of the field.
	 * @param 	mixed  $value The value of the field.
	 * @access	public
	 * @return 	void
	 * @throws	\InvalidArgumentException Thrown on invalid input or when a fillable field is not found.
	 */
	public function __set(string $name, $value) : void
	{
		$this->set($name, $value);
	}

	/**
	 * Get a fillable property.
	 * @param 	string $name The name of the field.
	 * @access	public
	 * @return 	mixed
	 * @throws	\InvalidArgumentException Thrown on invalid input or when a fillable field is not found.
	 */
	public function __get(string $name)
	{
		return $this->get($name);
	}

	/**
	 * Set a property by function call.
	 * @param 	string $name  The name of the fillable field.
	 * @param 	mixed  $value The value of the field.
	 * @access 	public
	 * @return 	boolean
	 * @throws 	\InvalidArgumentException Thrown when a field is not found.
	 */
	public function set(string $name, $value): bool
	{
		// Check if the field exists in the fillable array
		if (!in_array($name, $this->fillableFields)) {
			throw new \InvalidArgumentException('Field "' . $name . '" does not exist or is not fillable.');
		}

		// Check if there is a validating function for the field
		$function = 'validate' . $this->convertToCamelCase($name);
		if (method_exists($this, $function)) {
			$this->$function($value);
		}

		// Update the value
		$this->fillableData[$name] = $value;
		return true;
	}

	/**
	 * Get a property by function call.
	 * @param 	string $name The name of the field.
	 * @access 	public
	 * @return 	mixed
	 * @throws 	\InvalidArgumentException Thrown on invalid input or when a fillable field is not found.
	 */
	public function get(string $name)
	{
		// If the field exists and is filled
		if (array_key_exists($name, $this->fillableData)) {
			return $this->fillableData[$name];
		}

		// If the field does not exist, but is declared
		if (in_array($name, $this->fillableFields)) {
			return null;
		}

		throw new \InvalidArgumentException('Fillable field "' . $name . '" not found.');
	}

	/**
	 * Check if the data is set.
	 * @param 	string $name The name of the fillable field.
	 * @access 	public
	 * @return 	boolean
	 */
	public function __isset(string $name) : bool
	{
		return isset($this->fillableData[$name]);
	}

	/**
	 * Unset a field.
	 * @param 	string $name The name of the fillable field.
	 * @access 	public
	 * @return 	void
	 */
	public function __unset(string $name)
	{
		if (array_key_exists($name, $this->fillableData)) {
			unset($this->fillableData[$name]);
		}
	}

	/**
	 * Convert the object to a string.
	 * @access 	public
	 * @return 	string
	 */
	public function __toString() : string
	{
		return $this->toString();
	}

	/**
	 * Populate the fillable object.
	 * @param 	array|\stdClass $data The data to fill the object with.
	 * @access	public
	 * @return 	boolean
	 */
	public function populate($data) : bool
	{
		if ($data instanceof \stdClass) {
			$data = (array) $data;
		}

		foreach ($data as $k => $v) {
			$this->set($k, $v);
		}

		return true;
	}

	/**
	 * Convert the object to a string format.
	 * @param 	object $strategy The optional strategy to use. Defaults to json.
	 * @access 	public
	 * @return 	string
	 */
	public function toString($strategy = null) : string
	{
		$copy = $this->fillableData;

		foreach ($this->hiddenFields as $field) {
			unset($copy[$field]);
		}

		if ($strategy) {
			return $strategy->output($copy);
		}

		return (new JsonStrategy)->output($copy);
	}

	/**
	 * Convert a dash-formatted name to a camelcase one.
	 * @param 	string $name The name to format.
	 * @access 	private
	 * @return 	string
	 */
	private function convertToCamelCase(string $name) : string
	{
		return str_replace('_', '', ucwords($name, '_'));
	}
}
