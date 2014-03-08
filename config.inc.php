<?php
/**
 * less.php Plugin 
 *
 * @version 0.1 rev 140308
 * @author Matt Agar
 * @author Martin Jantošovič
 * @author Daniel Weitenauer
 */

$page = 'lessdotphp';

// Configuration
$REX['ADDON']['rxid'][$page] = $page;
$REX['ADDON']['page'][$page] = $page;
$REX['ADDON']['name'][$page] = 'Less.php';
$REX['ADDON']['version'][$page] = '0.1';
$REX['ADDON']['author'][$page] = 'Matt Agar, Martin Jantošovič, Daniel Weitenauer - studio ahoi';
$REX['ADDON']['supportpage'][$page] = 'forum.redaxo.de';

if (!$REX['SETUP']) {
	rex_register_extension('COMPILE_LESS', 'ahoi_compile_lessdotphp');
}

function ahoi_compile_lessdotphp($params) 
{
	require_once (__DIR__.'/lib/lessc.php');

	$less = new lessc();
	$less->setFormatter('compressed');
	$less->setPreserveComments(true);
	$less->setVariables($params['vars']);
	$compiledCSS = $less->compile($params['subject']);
	
	return $compiledCSS;
}