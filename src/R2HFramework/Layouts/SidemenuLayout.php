<?php
/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Layouts;

use Joomla\CMS\Factory;
use Joomla\CMS\Filter\OutputFilter;

class SidemenuLayout extends AbstractLayout
{
    /**
     * @var     boolean $theme The theme switch.
     * @access  protected
     */
    protected $theme = false;

    /**
     * Constructor
     * @param   boolean $theme The theme switch.
     * @access  public
     * @return  void
     */
    public function __construct(bool $theme = false)
    {
        $this->setTheme($theme);
    }

    /**
     * Render the layout.
     * @access  public
     * @return  string
     */
    public function render(): string
    {
        $entries = \JHtmlSidebar::getEntries();
		if (!count($entries)) {
			return '';
		}

		ob_start();
		?><div class="fr-sidemenu<?php echo (!$this->theme ? ' sidemenu-dark' : ''); ?>">
			<div class="list-group list-group-flush">
                <?php
                foreach ($entries as $item) {
                    $active = isset($item[2]) && (bool) $item[2] === true;

                    echo sprintf(
                        '<a href="%s" class="list-group-item list-group-item-action%s">%s</a>',
                        OutputFilter::ampReplace($item[1]),
                        $active
                            ? ' active'
                            : '',
                        $item[0]
                    );
                }
                ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
    }

    /**
     * Set the theme.
     * @param   boolean $theme The theme switch.
     * @access  public
     * @return  SidemenuLayout
     */
    public function setTheme(bool $theme): SidemenuLayout
    {
        $this->theme = $theme;
        return $this;
    }
}
