<?php
	$dev = true;
	if ($dev) {
		error_reporting(-1);
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 'On');
	}
	require_once __DIR__.'/inc/php-markdown/Michelf/Markdown.inc.php';
	require_once __DIR__.'/inc/php-markdown/Michelf/MarkdownExtra.inc.php';
	use \Michelf\Markdown;
	use \Michelf\MarkdownExtra;
	$doc = $_GET['doc'];
	$template = $_GET['tpl'];
	if (strpos($doc, '/') !== false || strpos($doc, '..') !== false || strpos($template, '/') !== false || strpos($template, '..') !== false) die;
	if (! is_file(__DIR__.'/md/'.$doc.'.md') || ! is_file(__DIR__.'/tpl/'.$template.'.php')) {
		die;
	}
	$md = file_get_contents(__DIR__.'/md/'.$doc.'.md');
	$styles = is_file(__DIR__.'/md/'.$doc.'.css') ? file_get_contents(__DIR__.'/md/'.$doc.'.css') : '';
	$parser = new MarkdownExtra;
	$html = $parser->transform($md);
	require_once __DIR__.'/tpl/'.$template.'.php';
?>
