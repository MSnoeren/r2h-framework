<?php
/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Layouts;

class SidebarLayout extends AbstractLayout
{
    /**
     * Render the layout.
     * @access  public
     * @return  string
     */
    public function render(): string
    {
        ob_start();
		?><div class="fr-sidebar">
			<div class="fr-sidebar-inner">
				<?php echo \JHtmlSidebar::render(); ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
    }
}
