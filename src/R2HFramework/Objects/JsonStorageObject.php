<?php
/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Objects;

class JsonStorageObject extends \Joomla\Registry\Registry
{
	/**
	 * File reference.
	 * @var 	string
	 * @access	protected
	 */
	protected $file = '';

	/**
	 * Current file state.
	 * @var		boolean
	 * @access	protected
	 */
	protected $fileOpen = false;

	/**
	 * Open a file for reading.
	 * @param 	string $file The full path to the file.
	 * @access	public
	 * @return 	boolean
	 * @throws	\InvalidArgumentException Thrown on bad input.
	 */
	public function open(string $file): bool
	{
		if (empty($file)) {
			$file = $this->getFile();
		} else {
			$this->setFile($file);
		}

		// Throw an exception when the file is not set or passed.
		if (empty($file)) {
			throw new \InvalidArgumentException('Filename is empty.');
		}

		// Load the file if it exists.
		if (file_exists($this->getFile())) {
			$this->loadFile($this->getFile());
		}

		return true;
	}

	/**
	 * Save the file to the storage.
	 * @access	public
	 * @return 	boolean
	 */
	public function save(): bool
	{
		if (!$this->hasFile()) {
			return false;
		}

		return file_put_contents($this->getFile(), $this->toString('JSON'));
	}

	/**
	 * Set the file.
	 * @param 	string $file The full path to the file.
	 * @access	public
	 * @return 	boolean
	 * @throws	\InvalidArgumentException Thrown on bad input.
	 */
	public function setFile(string $file): bool
	{
		if (empty($file)) {
			throw new \InvalidArgumentException('Filename is empty.');
		}

		$this->file = $file;
		return true;
	}

	/**
	 * Get the file.
	 * @access	public
	 * @return	string
	 */
	public function getFile(): string
	{
		return $this->file;
	}

	/**
	 * Check if the file has been set.
	 * @access	public
	 * @return 	boolean
	 */
	public function hasFile(): bool
	{
		return !empty($this->getFile());
	}
}
