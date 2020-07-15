<?php
// INIT
$dir = __DIR__ . DIRECTORY_SEPARATOR . "gallery" . DIRECTORY_SEPARATOR;
$tdir = __DIR__ . DIRECTORY_SEPARATOR . "thumbnail" . DIRECTORY_SEPARATOR;
$maxLong = 600; // maximum width or height, whichever is longer
$images = [];

// READ FILES FROM GALLERY FOLDER
$files = glob($dir . "*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);

// CHECK AND GENERATE THUMBNAILS
foreach ($files as $f) {
  $img = basename($f);
  $images[] = $img;
  if (!file_exists($tdir . $img)) {
    // Extract image information
    $ext = strtolower(pathinfo($img)['extension']);
    list ($width, $height) = getimagesize($dir . $img);
    $ratio = $width > $height ? $maxLong / $width : $maxLong / $height ;
    $newWidth = ceil($width * $ratio);
    $newHeight = ceil($height * $ratio);

    // Resize
    $fnCreate = "imagecreatefrom" . ($ext=="jpg" ? "jpeg" : $ext);
    $fnOutput = "image" . ($ext=="jpg" ? "jpeg" : $ext);
    $source = $fnCreate($dir . $img);
    $destination = imagecreatetruecolor($newWidth, $newHeight);
    
    // Transparent images only
    if ($ext=="png" || $ext=="gif") {
      imagealphablending($destination, false);
      imagesavealpha($destination, true);
      imagefilledrectangle(
        $destination, 0, 0, $newWidth, $newHeight,
        imagecolorallocatealpha($destination, 255, 255, 255, 127)
      );
    }

    imagecopyresampled($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    $fnOutput($destination, $tdir . $img);
  }
}

// DRAW HTML ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple PHP gallery</title>
    <link href="2-box.css" rel="stylesheet">
    <script src="3-thumbnail.js"></script>
  </head>
  <body>
    <!-- [LIGHTBOX] -->
    <div id="lback" onclick="gallery.hide()">
      <div id="lfront"></div>
    </div>

    <!-- [THE GALLERY] -->
    <div id="gallery"><?php
    foreach ($images as $i) {
      printf("<img src='thumbnail/%s' onclick='gallery.show(this)'/>", basename($i));
    }
    ?></div>
  </body>
</html>