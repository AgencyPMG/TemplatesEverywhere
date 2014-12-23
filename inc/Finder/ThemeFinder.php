<?php
/**
 * PMG - Templates Everywhere
 *
 * @category    WordPress
 * @package     PMG\TemplatesEverywhere
 * @copyright   2015 PMG <https://www.pmg.co>
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace PMG\TemplatesEverywhere\Finder;

/**
 * A TemplateFinder implementation that uses the WP Theme object to find what
 * it needs.
 *
 * @since   1.0
 */
final class ThemeFinder implements TemplateFinder
{
    /**
     * The theme where templates will be found.
     *
     * @var     WP_Theme
     */
    private $theme;

    public function __construct(\WP_Theme $theme=null)
    {
        $this->theme = $theme;
    }

    /**
     * {@inheritdoc}
     */
    public function findTemplates($postType)
    {
        $files = $this->getTheme()->get_files('php', 1, true);
        $pattern = sprintf('/%s template:(?P<name>.*)$/mi', preg_quote($postType, '/'));

        $templates = array();
        foreach ($files as $relativePath => $fullPath) {
            if (!preg_match($pattern, file_get_contents($fullPath), $matches)) {
                continue;
            }

            $templates[$relativePath] = _cleanup_header_comment($matches['name']);
        }

        return $templates;
    }

    private function getTheme()
    {
        if (null === $this->theme) {
            $this->theme = $this->getCurrentTheme();
        }

        return $this->theme;
    }

    private static function getCurrentTheme()
    {
        return wp_get_theme();
    }
}
