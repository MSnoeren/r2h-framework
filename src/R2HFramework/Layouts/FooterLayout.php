<?php
/**
 * R2H Framework
 * @author		Michael Snoeren <michael@r2h.nl>
 * @license 	GNU/GPLv3
 * @copyright 	R2H Marketing & Internet Solutions
 */

namespace R2HFramework\Layouts;

class FooterLayout extends AbstractLayout
{
    /**
     * @var     string $extensionName The name of the extension.
     * @access  protected
     */
    protected $extensionName = '';

    /**
     * @var     string $extensionUrl The url of the extension.
     * @access  protected
     */
    protected $extensionUrl = '';

    /**
     * @var     string $jedUrl The url of the extension in the JED.
     * @access  protected
     */
    protected $jedUrl = '';

    /**
     * Constructor
     * @param   string $name Name of the extension.
     * @param   string $url  Url of the extension.
     * @param   string $jurl JED URL of the extension.
     * @access  public
     * @return  void
     */
    public function __construct(string $name = '', string $url = '', string $jurl = '')
    {
        if (!empty($name)) {
            $this->setExtensionName($name);
        }
        if (!empty($url)) {
            $this->setExtensionUrl($url);
        }
        if (!empty($jurl)) {
            $this->setJedUrl($jurl);
        }

        parent::__construct();
    }

    /**
     * Render the layout.
     * @access  public
     * @return  string
     */
    public function render(): string
    {
        ob_start();
        ?><div class="fr-footer">
            <div class="fr-footer-extension">
                <?php
                echo !empty($this->extensionUrl)
                    ? sprintf('<a href="%s" target="_blank">', $this->extensionUrl)
                    : '';

                echo $this->extensionName;

                echo !empty($this->extensionUrl)
                    ? '</a>'
                    : '';
                ?>
            </div>

            <?php if (!empty($this->jedUrl)) { ?>
            <div class="fr-footer-review">
                <?php echo sprintf('<a href="%s" target="_blank">Leave a review!</a>', $this->jedUrl); ?>
            </div>
            <?php } ?>

            <div class="fr-footer-copyright">
                Copyright &copy; <?php echo date('Y'); ?> R2H Marketing & Internet Solutions.
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Set the extension name.
     * @param   string $name The name of the extension.
     * @access  public
     * @return  FooterLayout
     * @throws  \InvalidArgumentException Thrown on bad input.
     */
    public function setExtensionName(string $name): FooterLayout
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Extension name is empty.');
        }

        $this->extensionName = $name;
        return $this;
    }

    /**
     * Set the extension url.
     * @param   string $url The url of the extension.
     * @access  public
     * @return  FooterLayout
     * @throws  \InvalidArgumentException Thrown on bad input.
     */
    public function setExtensionUrl(string $url): FooterLayout
    {
        if (empty($url)) {
            throw new \InvalidArgumentException('Extension url is empty.');
        }

        $this->extensionUrl = $url;
        return $this;
    }

    /**
     * Set the JED url.
     * @param   string $url The url to the JED page.
     * @access  public
     * @return  FooterLayout
     * @throws  \InvalidArgumentException Thrown on bad input.
     */
    public function setJedUrl(string $url): FooterLayout
    {
        if (empty($url)) {
            throw new \InvalidArgumentException('JED URL is empty.');
        }

        $this->jedUrl = $url;
        return $this;
    }
}
