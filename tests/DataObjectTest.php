<?php

use PHPUnit\Framework\TestCase;

class DataObjectTest extends TestCase
{
	/**
	 * Data storage object.
	 * @var		DataObject
	 * @access	protected
	 */
	protected $object = null;

	/**
	 * Setup the class before each test.
	 * @access	protected
	 * @return 	void
	 */
	protected function setUp()
	{
		$this->object = new R2HFramework\Objects\DataObject;
	}

	/**
	 * Test if the stand-alone object rejects the unknown property.
	 * @access	public
	 * @return 	void
	 */
	public function testObjectShouldRejectUnknownProperty()
	{
		$this->expectException(InvalidArgumentException::class);
		$this->object->set('test', 'value');
	}

	/**
	 * Test if the default output is json.
	 * @access	public
	 * @return 	void
	 */
	public function testObjectShouldOutputJsonByDefault()
	{
		json_decode($this->object->toString());
		$this->assertTrue(json_last_error() === JSON_ERROR_NONE);
	}
}
