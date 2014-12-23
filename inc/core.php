<?php
/**
 * PMG - Templates Everywhere
 *
 * @category    WordPress
 * @package     PMG\TemplatesEverywhere
 * @copyright   2015 PMG <https://www.pmg.co>
 * @license     http://opensource.org/licenses/mit MIT
 */

use PMG\TemplatesEverywhere as TE;

function pmg_templateseverywhere_load()
{
    if (is_admin()) {
        TE\Admin::init();
    } else {
        TE\Frontend::init();
    }
}

function pmg_templateseverywhere_types()
{
    return apply_filters('pmg_templates_everywhere_types', get_post_types(array(
        'public'    => true,
        '_builtin'  => false,
    ), 'names'));
}

function pmg_templateseverywhere_finder()
{
    return new TE\Finder\ThemeTemplateFinder();
}
