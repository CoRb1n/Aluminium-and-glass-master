<?php
// READ FILES FROM GALLERY FOLDER
$dir = __DIR__ . DIRECTORY_SEPARATOR . "gallery" . DIRECTORY_SEPARATOR;
$images = glob($dir . "*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);

/* OPTIONAL - SORT BY NEWEST FIRST
usort(
  $images,
  function($file1, $file2) {
    return filemtime($file2) <=> filemtime($file1);
  }
);
 */

// DRAW HTML ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple PHP gallery</title>
    <link href="2-box.css" rel="stylesheet">
    <script src="2-box.js"></script>
  </head>
  <body>
    <!-- [LIGHTBOX] -->
    <div id="lback" onclick="gallery.hide()">
      <div id="lfront"></div>
    </div>

    <!-- [THE GALLERY] -->
    <div id="gallery"><?php
    foreach ($images as $i) {
      printf("<img src='gallery/%s' onclick='gallery.show(this)'/>", basename($i));
    }
    ?></div>
  </body>
</html>