<?php
/**
 * less.php Plugin 
 *
 * @version 1.7.0.4 - 150701
 * @author Matt Agar
 * @author Martin Jantošovič
 * @author Daniel Weitenauer - studio ahoi
 */

$page = 'lessdotphp';

// Configuration
$REX['ADDON']['rxid'][$page] = $page;
$REX['ADDON']['page'][$page] = $page;
#$REX['ADDON']['name'][$page] = 'Less.php';
$REX['ADDON']['version'][$page] = '1.7.0.4';
$REX['ADDON']['author'][$page] = 'Matt Agar, Martin Jantošovič, Daniel Weitenauer - studio ahoi';
$REX['ADDON']['supportpage'][$page] = 'forum.redaxo.de';

if (!$REX['SETUP']) {
	rex_register_extension('SEO42_COMPILE_LESS', 'ahoi_compile_lessdotphp');
}

function ahoi_compile_lessdotphp($params) 
{
	require_once (__DIR__.'/lib/lessc.php');

	$less = new lessc();
	$less->setImportDir($params['path']);
	$less->setFormatter('compressed');
	$less->setPreserveComments(true);
	$less->setVariables($params['vars']);
	$compiledCSS = $less->compile($params['subject']);

	return $compiledCSS;
}
