<?php
/**
 * Extension to mimetype lookup table
 *
 * This file is provided as an helper for objects who need to perform filename to mimetype translations.
 * Common types have been provided, but feel free to add your own one if you need it.
 * <br /><br />
 * See the enclosed file LICENSE for licensing information.
 * If you did not receive this file, get it at http://www.fsf.org/copyleft/gpl.html
 *
 * @copyright       (c) 2000-2015 XOOPS Project (www.xoops.org)
 * @license             GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author              Skalpa Keo <skalpa@xoops.org>
 * @since               2.0.9.3
 * $Id: mimetypes.inc.php 13082 2015-06-06 21:59:41Z beckmi $
 * @deprecated
 */
defined('XOOPS_ROOT_PATH') || exit('Restricted access');

$GLOBALS['xoopsLogger']->addDeprecated("'/class/mimetypes.inc.php' is deprecated, use '/include/mimetypes.inc.php' directly.");

return include XOOPS_ROOT_PATH . '/include/mimetypes.inc.php';