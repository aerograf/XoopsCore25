<?php
/**
 * foreachq Smarty compiler plug-in
 *
 * See the enclosed file LICENSE for licensing information.
 * If you did not receive this file, get it at http://www.fsf.org/copyleft/gpl.html
 *
 * @copyright    (c) 2000-2015 XOOPS Project (www.xoops.org)
 * @license     GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author		Skalpa Keo <skalpa@xoops.org>
 * @package		xos_opal
 * @subpackage	xos_opal_Smarty
 * @since       2.0.14
 * @version		$Id$
 */

/**
 * Quick foreach template plug-in
 *
 * This plug-in works as a direct replacement for the original Smarty
 * {@link http://smarty.php.net/manual/en/language.function.foreach.php foreach} function.
 *
 * The difference with <var>foreach</var> is minimal in terms of functionality, but can boost your templates
 * a lot: foreach duplicates the content of the variable that is iterated, to ensure non-array
 * variables can be specified freely. This implementation does not do that, but as a consequence
 * requires that the variable you specify in the <var>from</var> parameter is an array or
 * (when using PHP5) an object. Check the difference between the code generated by foreach
 * and foreachq to understand completely.
 *
 * <b>Note:</b> to use foreachq, only the opening tag has to be replaced. The closing tab still
 * remains {/foreach}
 *
 * <code>
 * // Iterate, slow version
 * {foreach from=$array item=elt}
 *   {$elt}
 * {/foreach}
 * // Iterate, fast version
 * {foreachq from=$array item=elt}
 *   {$elt}
 * {/foreach}
 * </code>
 */
function smarty_compiler_foreachq( $argStr, &$comp )
{
    $comp->_push_tag('foreach');

    $attrs = $comp->_parse_attrs( $argStr, false );

    $arg_list = array();

    if (empty($attrs['from'])) {
        return $comp->_syntax_error("foreachq: missing 'from' attribute", E_USER_ERROR, __FILE__, __LINE__);
    }
    $from = $attrs['from'];

    if (empty($attrs['item'])) {
        return $comp->_syntax_error("foreachq: missing 'item' attribute", E_USER_ERROR, __FILE__, __LINE__);
    }
    $item = $comp->_dequote($attrs['item']);
    if (!preg_match('~^\w+$~', $item)) {
        return $comp->_syntax_error("'foreachq: item' must be a variable name (literal string)", E_USER_ERROR, __FILE__, __LINE__);
    }

    if (isset($attrs['key'])) {
        $key  = $comp->_dequote($attrs['key']);
        if (!preg_match('~^\w+$~', $key)) {
            return $comp->_syntax_error("foreachq: 'key' must to be a variable name (literal string)", E_USER_ERROR, __FILE__, __LINE__);
        }
        $key_part = "\$this->_tpl_vars['$key'] => ";
    } else {
        $key = null;
        $key_part = '';
    }

    if (isset($attrs['name'])) {
        $name = $attrs['name'];
    } else {
        $name = null;
    }

    $output = '';
    //$output .= "\$_from = $from; if (!is_array(\$_from) && !is_object(\$_from)) { settype(\$_from, 'array'); }";
    if (isset($name)) {
        $foreach_props = "\$this->_foreach[$name]";
        $output .= "{$foreach_props} = array('total' => count($from), 'iteration' => 0);\n";
        //$output .= "{$foreach_props} = array('total' => count(\$_from), 'iteration' => 0);\n";
        $output .= "if ({$foreach_props}['total'] > 0):\n";
        $output .= "    foreach ($from as $key_part\$this->_tpl_vars['$item']):\n";
        //$output .= "    foreach (\$_from as $key_part\$this->_tpl_vars['$item']):\n";
        $output .= "        {$foreach_props}['iteration']++;\n";
    } else {
        $output .= "if (count($from)):\n";
        $output .= "    foreach ($from as $key_part\$this->_tpl_vars['$item']):\n";
        //$output .= "if (count(\$_from)):\n";
        //$output .= "    foreach (\$_from as $key_part\$this->_tpl_vars['$item']):\n";
    }
    //$output .= '';
    return $output;

}
