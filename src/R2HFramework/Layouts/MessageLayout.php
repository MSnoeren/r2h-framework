<?php
/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Layouts;

class MessageLayout extends AbstractLayout
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
    public function render(): string
    {
        $messages = \Joomla\CMS\Factory::getDocument()->loadRenderer('message');
        return $messages->render('message');
    }
}
