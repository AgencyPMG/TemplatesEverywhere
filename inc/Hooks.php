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
 * ABC for class that "hook" in an do stuff.
 *
 * @since   1.0
 */
abstract class Hooks
{
    const SUPPORT   = 'pmg:templates';
    const META      = '_pmg_templateseverywhere_template';

    private static $reg = array();

    public static function instance()
    {
        $cls = get_called_class();
        if (!isset(self::$reg[$cls])) {
            self::$reg[$cls] = new $cls();
        }

        return self::$reg[$cls];
    }

    public static function init()
    {
        static::instance()->hook();
    }

    /**
     * This is where all the calls to add_{action,filter} should go.
     *
     * @return  void
     */
    abstract public function hook();

    protected static function hasTemplateSupport($postType)
    {
        $types = pmg_templateseverywhere_types();

        return isset($types[$postType]) && post_type_supports($postType, self::SUPPORT);
    }
}
