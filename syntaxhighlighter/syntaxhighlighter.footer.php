<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=footer.first
[END_COT_EXT]
==================== */

/**
 * SyntaxHighlighter connector for Cotonti
 *
 * @package syntaxhighligther
 * @version 1.0
 * @author Trustmaster
 * @copyright Copyright (c) Cotonti Team 2011
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

$shTheme = $cfg['plugin']['syntaxhighlighter']['theme'];
$shTheme = $shTheme ? $shTheme : 'Default';

/**
 * Returns full path to theme css file
 * Allowing override it with user custom css file located in `themes/themename/styles` folder
 *
 * @param string $chTheme Theme name (without prefix)
 * @return string Full path to theme css file
 */
function shl_cssname($chTheme = 'Default')
{
	global $cfg, $theme;
	$cssfile = $cfg['themes_dir'] . '/' . $theme . '/styles/shCore' . $chTheme . '.css';
	if (is_file($cssfile)) return $cssfile;
	$cssfile = $cfg['plugins_dir'] . '/syntaxhighlighter/lib/styles/shCore' . $chTheme . '.css';
	if (is_file($cssfile)) return $cssfile;
	return $cfg['plugins_dir'] . '/syntaxhighlighter/lib/styles/shCoreDefault.css';;
}

$sh_core_css = cot_rc('code_rc_css_file', array(
	'url' => shl_cssname($shTheme)
));
$sh_core_js = $cfg['plugins_dir'] . '/syntaxhighlighter/lib/scripts/shAll.min.js';

cot_rc_embed_footer(<<<JS
$(function(){if($('pre').length>0){ $('head').append('$sh_core_css');var sh_e1=document.createElement('script');sh_e1.async=true;sh_e1.src ='$sh_core_js';$('body').append(sh_e1);}});
JS
);

