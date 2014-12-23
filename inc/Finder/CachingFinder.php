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
 * A finder decorator that caches the results for a given post type.
 *
 * @since   1.0
 */
final class CachingFinder implements TemplateFinder
{
    const GROUP = 'pmg:templates';
    const TTL   = 1800; // same as WordPress' page template cache

    /**
     * @var     TemplateFinder
     */
    private $wrapped;

    public function __construct(TemplateFinder $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    /**
     * {@inheritdoc}
     */
    public function findTemplates($postType)
    {
        $templates = wp_cache_get($postType, self::GROUP, false, $found);
        if (!$found) {
            $templates = $this->wrapped->findTemplates($postType);
            wp_cache_set($postType, $templates, self::GROUP, self::TTL);
        }

        return $templates;
    }
}
