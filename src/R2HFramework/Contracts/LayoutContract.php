<?php
/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Contracts;

interface LayoutContract
{
    /**
     * Render the layout.
     * @access  public
     * @return  string
     */
    public function render(): string;
}
