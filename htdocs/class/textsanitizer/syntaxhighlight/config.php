<?php
/**
 * TextSanitizer extension
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       (c) 2000-2015 XOOPS Project (www.xoops.org)
 * @license             GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package             class
 * @subpackage          textsanitizer
 * @since               2.3.0
 * @author              Taiwen Jiang <phppp@users.sourceforge.net>
 * @version             $Id: config.php 13082 2015-06-06 21:59:41Z beckmi $
 */
defined('XOOPS_ROOT_PATH') || exit('Restricted access');

return $config = array(
    'highlight' => 'php',// Source code highlight: '' - disable; 'php' - php highlight; 'geshi' - geshi highlight
    'language'  => 'PHP');// Default language for code highlight, applicable only if geshi is enabled
