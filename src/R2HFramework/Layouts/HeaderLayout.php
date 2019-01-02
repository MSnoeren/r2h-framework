<?php
/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Layouts;

class HeaderLayout extends AbstractLayout
{
    /**
     * @var     string $title The title in the header.
     * @access  protected
     */
    protected $title = '';

    /**
     * @var     integer $size The size of the title-part in the header in columns.
     * @access  protected
     */
    protected $size = 2;

    /**
     * Constructor
     * @param   string  $title The title to display in the header.
     * @param   integer $size  The size of the column.
     * @access  public
     * @return  void
     */
    public function __construct(string $title = '', int $size = 2)
    {
        if (!empty($title)) {
            $this->setTitle($title);
        }
        $this->setSize($size);
    }

    /**
     * Render the layout.
     * @access  public
     * @return  string
     */
    public function render(): string
    {
        $toolbar = \Joomla\CMS\Toolbar\Toolbar::getInstance();

        ob_start();
        ?><div class="fr-header">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-xs-12 col-sm-<?php echo $this->size; ?>">
                        <h2 class="ft-header-title">
                            <?php echo $this->title; ?>
                        </h2>
                    </div>

                    <div class="col-xs-12 col-sm-<?php echo (12 - $this->size); ?>">
                        <div class="fr-header-toolbar clearfix">
                            <?php echo $toolbar->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Set the title.
     * @param   string $title The title in the header.
     * @access  public
     * @return  HeaderLayout
     * @throws  \InvalidArgumentException Thrown on bad input.
     */
    public function setTitle(string $title): HeaderLayout
    {
        if (empty($title)) {
            throw new \InvalidArgumentException('Title is empty.');
        }

        $this->title = $title;
        return $this;
    }

    /**
     * Set the size.
     * @param   integer $size The size of the column.
     * @access  public
     * @return  HeaderLayout
     * @throws  \InvalidArgumentException Thrown on bad input.
     */
    public function setSize(int $size): HeaderLayout
    {
        if ($size < 1 || $size > 12) {
            throw new \InvalidArgumentException('Size is invalid. It should be between 1 and 12.');
        }

        $this->size = $size;
        return $this;
    }
}
