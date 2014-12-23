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
 * Takes care of the admin area functionality of the plugin.
 *
 * @since   1.0
 */
final class Admin extends Hooks
{
    const NONCE = 'pmg_templateseverywhere_nonce';

    /**
     * @var     Finder\TemplateFinder;
     */
    private $finder;

    public function __construct(Finder\TemplateFinder $finder=null)
    {
        $this->finder = $finder ?: pmg_templateseverywhere_finder();
    }

    public function hook()
    {
        add_action('add_meta_boxes', array($this, 'addBox'));
        add_action('save_post', array($this, 'saveTemplate'), 10, 2);
    }

    public function addBox($postType)
    {
        if (!$this->hasTemplateSupport($postType)) {
            return;
        }

        $templates = $this->finder->findTemplates($postType);
        if (!$templates) {
            return;
        }

        add_meta_box(
            "pmg-template-{$postType}",
            __('Template', 'templates-everywhere'),
            array($this, 'boxCallback'),
            $postType,
            'side',
            'low',
            array('templates' => $templates)
        );
    }

    public function boxCallback($post, $args)
    {
        $templates = array_merge(array(
            ''      => __('Default', 'templates-everywhere'),
        ), isset($args['args']['templates']) ? (array)$args['args']['templates'] : array());

        $saved = get_post_meta($post->ID, self::META, true);

        printf('<select id="%1$s" name="%1$s" class="widefat">', self::META);
        foreach ($templates as $template => $label) {
            printf(
                '<option value="%s" %s>%s</option>',
                esc_attr($template),
                selected($saved, $template, false),
                esc_html($label)
            );
        }
        echo '</select>';

        wp_nonce_field(self::NONCE.$post->ID, self::NONCE, false);
    }

    public function saveTemplate($postId, $post)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (
            !isset($_POST[self::NONCE]) ||
            !wp_verify_nonce($_POST[self::NONCE], self::NONCE.$postId)
        ) {
            return;
        }

        $type = get_post_type_object($post->post_type);
        $cap = isset($type->cap->edit_post) ? $type->cap->edit_post : 'edit_post';
        if (!current_user_can($cap, $postId)) {
            return;
        }

        if (empty($_POST[self::META])) {
            delete_post_meta($postId, self::META);
        } else {
            update_post_meta($postId, self::META, $_POST[self::META]);
        }
    }
}
