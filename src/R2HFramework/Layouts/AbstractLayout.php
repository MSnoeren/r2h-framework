<?php
/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Layouts;

use R2HFramework\Contracts\LayoutContract;

abstract class AbstractLayout implements LayoutContract
{
    /**
     * Constructor
     * @access  public
     * @return  void
     */
    public function __construct()
    {
    }

    /**
     * Render the layout.
     * @access  public
     * @return  string
     */
    abstract public function render(): string;
}
