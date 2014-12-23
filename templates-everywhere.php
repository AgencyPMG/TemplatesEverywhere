<?php
/**
 * Plugin Name: Templates Everywhere
 * Plugin URI: https://github.com/AgencyPMG/TemplatesEverywhere
 * Description: Custom templates for your custom post types.
 * Version: 1.0
 * Text Domain: templates-everywhere
 * Author: Christopher Davis
 * Author URI: https://www.pmg.co/team/
 * License: MIT
 *
 * Copyright (c) 2015 PMG <https://www.pmg.co>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category    WordPress
 * @package     PMG\TemplatesEverywhere
 * @copyright   2015 PMG <https://www.pmg.co>
 * @license     http://opensource.org/licenses/mit MIT
 */

!defined('ABSPATH') && exit;

require_once __DIR__.'/inc/Finder/TemplateFinder.php';
require_once __DIR__.'/inc/Finder/ThemeTemplateFinder.php';
require_once __DIR__.'/inc/Hooks.php';
require_once __DIR__.'/inc/Admin.php';
require_once __DIR__.'/inc/Frontend.php';
require_once __DIR__.'/inc/core.php';

add_action('plugins_loaded', 'pmg_templateseverywhere_load');
