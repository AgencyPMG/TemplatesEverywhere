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
 * Locates template files for a single post type.
 *
 * @since   1.0
 */
interface TemplateFinder
{
    /**
     * Return an array of template files for a given post type.
     *
     * The file names should be relative to the theme root.
     *
     * @param   string $postType The post type to which the templates belong
     * @return  string[]
     */
    public function findTemplates($postType);
}
