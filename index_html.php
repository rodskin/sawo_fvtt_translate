<?php
$url_json = 'swade-core-rules.swade-rules_-_06_-_fr_copy.json';
$trad = file_get_contents($url_json);
?><!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea',
        menu: {
            source: {title: 'Source', items: 'code'}
        },
        plugins: 'code',  // required by the code menu item
        menubar: 'source'  // adds happy to the menu bar
      });
    </script>
</head>
<body>
    <textarea id="mytextarea" style="height:800px"><?php echo $trad; ?></textarea>
</body>
</html>
