<?php
/**
 * less.php Plugin
 *
 * @version 1.7.0.4 - 150724
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
	require_once (__DIR__.'/lib/Less.php');

	$compiled_css = '';

	if (!is_array($params['path'])) {
		$params['path'] = array(
			 $params['path'] => '',
		);
	}

	$options = array(
		'compress'  => true,
		'sourceMap' => false,
		'relativeUrls' => false,
	);

	try {
		$parser = new Less_Parser($options);
		$parser->SetImportDirs($params['path']);
		$parser->parse($params['subject']);
		$parser->ModifyVars($params['vars']);
		$compiled_css = $parser->getCss();
	} catch(Exception $e) {
		echo $e->getMessage();
	}

	// Remove comments
	$compiled_css = preg_replace('%/\*.*?\*/%s', '', $compiled_css);

	return $compiled_css;
}
