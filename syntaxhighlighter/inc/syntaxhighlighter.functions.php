<?php

/**
 * Returns list of available color themes for Syntax highlighter
 */
function shl_get_themes()
{
	global $cfg, $theme;
	$prefix = 'shCore';
	$themes = array();
	$files_def = glob($cfg['plugins_dir'] . '/syntaxhighlighter/lib/styles/' . $prefix . '*.css');
	$files_cus = glob($cfg['themes_dir'] . '/' . $cfg['defaulttheme'] . '/styles/' . $prefix . '*.css');
	$files = array_merge($files_def, $files_cus);
	foreach ($files as $path)
	{
		$fname = pathinfo($path, PATHINFO_BASENAME);
		$themename = preg_replace("/$prefix(.*)\.css/i", '$1', $fname);
		$path = pathinfo($path, PATHINFO_DIRNAME);
		if ($themename && is_file($path . '/shCore' . $themename . '.css')) $themes[] = $themename;
	}
	sort($themes);
	return array_unique($themes);
}