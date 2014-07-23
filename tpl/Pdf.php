<?php
	ob_start();
	require_once __DIR__.'/../inc/dompdf/dompdf_config.inc.php';
?>
<!DOCTYPE html>
<html lang="fr"><head>
	<meta charset="UTF-8">
	<title><?= $doc ?>.pdf</title>
	<style type="text/css">
	body {
		margin: .3in;
		background: white !important;
	}
	</style>
	<style type="text/css">
		<?= $styles ?>
	</style>
</head><body>
	<?= $html ?>
</body></html>
<?php
	$pdfContents = ob_get_clean();
	$dompdf = new DOMPDF();
	$dompdf->load_html($pdfContents);
	$dompdf->render();
	$dompdf->stream($doc.'.pdf', array("Attachment" => 0));
?>
