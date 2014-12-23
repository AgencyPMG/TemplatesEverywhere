<?php
/**
 * PMG - Templates Everywhere
 *
 * @category    WordPress
 * @package     PMG\TemplatesEverywhere
 * @copyright   2015 PMG <https://www.pmg.co>
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace PMG\TemplatesEverywhere;

/**
 * Alters the template (and body class) on the front end if applicable.
 *
 * @since   1.0
 */
final class Frontend extends Hooks
{
    private $foundTemplate = null;

    /**
     * {@inheritdoc}
     */
    public function hook()
    {
        add_filter('single_template', array($this, 'hijackTemplate'));
        add_filter('body_class', array($this, 'addBodyClass'));
    }

    public function hijackTemplate($foundTemplate)
    {
        $postId = get_queried_object_id();
        $custom = get_post_meta($postId, self::META, true);

        if (!$custom) {
            return $foundTemplate;
        }

        $located = locate_template($custom);

        if ($located) {
            $this->foundTemplate = $custom;
            return $located;
        }

        return $foundTemplate;
    }

    public function addBodyClass($classes)
    {
        if (null === $this->foundTemplate) {
            return $classes;
        }

        $classes[] = sprintf('pmg-templates-%s', esc_attr($this->normalizeTemplate($this->foundTemplate)));

        return $classes;
    }

    private function normalizeTemplate($name)
    {
        return preg_replace('/[^A-Za-z0-9]+/', '-', $name);
    }
}
