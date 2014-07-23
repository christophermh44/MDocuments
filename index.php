<?php

	function explore($dir, $ext) {
		$files = [];
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
		            if ($file != '..' && $file != '.' && end(explode('.', $file)) == $ext) {
		            	$fileNameArray = explode('.', $file);
		            	array_pop($fileNameArray);
		            	$files[] = implode('.', $fileNameArray);
		            }
		        }
		        closedir($dh);
		    }
		}
		return $files;
	}

	$mds = explore(__DIR__.'/md/', 'md');
	$tpls = explore(__DIR__.'/tpl/', 'php');

?>

<!DOCTYPE html>
<html lang="fr"><head>
	<meta charset="UTF-8">
	<title>Documents</title>
	<style>
		html, body { display: inline-block; height: 100%; margin: 0; padding: 0; overflow: hidden; width: 100%; }
		#explorer { background: black; color: white; bottom: 0; left: 0; padding: 20px; position: absolute; top: 0; width: 320px; }
		#explorer ul { margin: 0; padding: 0; }
		#explorer li { cursor: default; list-style-type: square; list-style-position: inside; }
		#explorer li span { margin-right: 5px; }
		#explorer li ul { display: none; margin: 0; padding: 0; }
		#explorer li:hover ul { display: inline; }
		#explorer li li { display: inline; font-size: .8em; list-style-type: none; margin-right: .5em; }
		#explorer a { color: white; }
		#explorer .bottom { bottom: 1em; font-size: .8em; position: absolute; text-align: center; width: 310px; }
		#iframe { bottom: 0; left: 360px; position: absolute; right: 0; top: 0; }
		#iframe iframe { height: 100%; width: 100%; }
		#full-screen { bottom: 0; height: 3em; padding: 3em 1em 1em 3em; position: absolute; right: 0; width: 7em; z-index: 10; }
		#full-screen button { background: #ccc; border: none; border-radius: .5rem; color: black; cursor: pointer; display: none; font-size: 1rem; line-height: 2rem; padding: .5rem; }
		#full-screen:hover button { display: inline-block; text-decoration: none; }
		#full-screen button:hover { background: #eee; }
	</style>
</head><body>
	<div id="explorer">
		<h1>MDocuments</h1>
		<ul>
		<?php foreach ($mds as $md) {
			?><li>
				<span><?= $md ?></span>
				<ul>
					<?php foreach ($tpls as $tpl) {
						?><li><a href="view.php?tpl=<?= $tpl ?>&amp;doc=<?= $md ?>"><?= $tpl ?></a></li><?php
					} ?>
				</ul>
			</li><?php
		} ?>
		</ul>
		<div class="bottom"><a href="https://github.com/christopher-mh/MDocuments">Projet sur Github</a></div>
	</div>
	<div id="iframe"><iframe src="empty.html" frameborder="0"></iframe></div>
	<div id="full-screen"><button>Plein écran</button></div>
	<script src="assets/js/zepto.js"></script>
	<script>$("#explorer a").click(function(e){e.preventDefault();$("iframe").attr('src',$(this).attr('href'));return false})</script>
	<script>$("#full-screen button").click(function(e){e.preventDefault();window.open($("iframe").attr('src'));return false})</script>
</body></html>
