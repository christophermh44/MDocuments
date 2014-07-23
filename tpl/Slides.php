<!DOCTYPE html>
<html>
  <head>
    <title><?= $doc ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <style type="text/css">
      <?= $styles ?>
    </style>
  </head>
  <body id="slides">
<!-- class: center, middle -->
    <div id="source">
<?= $md ?>
    </div>
    <script src="assets/js/remark.js" type="text/javascript"></script>
    <script type="text/javascript">
      var slideshow = remark.create();
    </script>
  </body>
</html>
