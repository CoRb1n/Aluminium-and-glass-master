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
        $ratio = $width > $height ? $maxLong / $width : $maxLong / $height;
        $newWidth = ceil($width * $ratio);
        $newHeight = ceil($height * $ratio);

        // Resize
        $fnCreate = "imagecreatefrom" . ($ext == "jpg" ? "jpeg" : $ext);
        $fnOutput = "image" . ($ext == "jpg" ? "jpeg" : $ext);
        $source = $fnCreate($dir . $img);
        $destination = imagecreatetruecolor($newWidth, $newHeight);

        // Transparent images only
        if ($ext == "png" || $ext == "gif") {
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
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon.png"/>
    <link
            rel="icon"
            type="image/png"
            sizes="96x96"
            href="assets/img/favicon.png"
    />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Aluminium And Glass Master About Us</title>
    <meta
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
            name="viewport"
    />
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <link href="assets/css/gaia.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
    <!--     Fonts and icons     -->
    <link
            href="https://fonts.googleapis.com/css?family=Cambo|Poppins:400,600"
            rel="stylesheet"
            type="text/css"
    />
    <link
            href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
            rel="stylesheet"
    />
    <link href="assets/css/fonts/pe-icon-7-stroke.css" rel="stylesheet"/>
</head>

<body>
<nav
        class="navbar navbar-default navbar-transparent navbar-fixed-top"
        color-on-scroll="200"
>
    <!-- if you want to keep the navbar hidden you can add this class to the navbar "navbar-burger"-->
    <div class="container">
        <div class="navbar-header">
            <button
                    id="menu-toggle"
                    type="button"
                    class="navbar-toggle"
                    data-toggle="collapse"
                    data-target="#example"
            >
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a href="index.html" class="navbar-brand">
                Aluminium And Glass Master
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right navbar-uppercase">
                <li>
                    <a href="contact.html" target="_blank">Contact Us</a>
                </li>
                <li class="dropdown">
                    <a href="assets/css/gaia.css" class="dropdown-toggle" data-toggle="dropdown">
                        Site Map
                    </a>
                    <ul class="dropdown-menu dropdown-danger">
                        <li>
                            <a href="gallery.html">GALLERY</a>
                        </li>
                        <li>
                            <a href="aboutUs.html">ABOUT US</a>
                        </li>
                        <li>
                            <a href="contact.html">CONTACT US</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="contactForm.html" class="btn btn-danger"
                    >Let Us Contact You</a
                    >
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>


<main>
    <div class="section section-header">
        <div id="contactsPage" class="parallax filter filter-color-black">
            <div
                    class="image"
                    style="background-image: url('assets/img/back5.png');"
            ></div>

            <div class="container">
                <div class="content">
                    <div class="title-area">
                        <h4>Take a browse though some of our completed work in our</h4>
                        <h1 class="title-modern">Aluminium And Glass Master Gallery</h1>
                        <div class="separator line-separator">♦</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="lback" onclick="gallery.hide()">
        <div id="lfront"></div>
    </div>

    <!-- [THE GALLERY] -->
    <div id="gallery"><?php
        foreach ($images as $i) {
            printf("<img src='gallery/%s' onclick='gallery.show(this)'/>", basename($i));
        }
        ?></div>
</main>

<footer class="footer footer-big footer-color-black" data-color="black">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class="info">
                    <h5 class="title">Quick Contact</h5>
                    <nav>
                        <ul>
                            <li>
                                <p>
                                    Shop No 2 Palm Crest Centre
                                </p>
                            </li>
                            <li>
                                <p>Margate</p>
                            </li>
                            <li>
                                <p>KwaZulu-Natal</p>
                            </li>
                            <li>
                                <p>4275</p>
                            </li>
                            <li>
                                <p>(TEL) 039 317 2210</p>
                            </li>
                            <li>
                                <p>(CELL) 084 585 5822</p>
                            </li>
                            <li>
                                <a
                                style="color: whitesmoke;"
                                href="mailto:info@aluminiumandglassmaster.co.za"
                                ><i class="fa fa-envelope"></i>
                                info@aluminiumandglassmaster.co.za</a
                                >
                            </li>
                            <li>
                                <a
                                style="color: whitesmoke;"
                                href="www.aluminiumandglassmaster.co.za"
                                ><i class="fa fa-weibo"></i>
                                www.aluminiumandglassmaster.co.za</a
                                >
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 centrallize">
                <div class="info">
                    <h5 style="text-align: center;" class="title">
                        Follow us on Social Media
                    </h5>
                    <nav>
                        <ul>
                            <li>
                                <a
                                        href="https://www.facebook.com/pages/category/Window-Installation-Service/Aluminium-and-Glass-Master-102264963744367/"
                                        class="btn btn-social btn-facebook btn-simple"
                                >
                                    <i class="fa fa-facebook-square"></i> aluminium and
                                    glassmaster
                                </a>
                            </li>
                        </ul>
                        <img
                                class="smallLogo img-fluid"
                                src="assets/img/favicon.png"
                                alt="logo small"
                        />
                    </nav>
                </div>
            </div>
            <div class="col-md-3 col-md-pull-0 col-sm-3 RHS">
                <div class="info">
                    <h5 style="text-align: end;" class="title">Quick Links</h5>
                    <nav>
                        <ul>
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li>
                                <a href="aboutUs.html">About Us</a>
                            </li>
                            <li>
                                <a href="contact.html">Contact Us</a>
                            </li>
                            <li>
                                <a href="gallery.html">Gallery</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <hr/>
        <div class="copyright">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            DESIGNED AND MAINTAINED BY CB-UX
        </div>
    </div>
</footer>
</body>

<!--   core js files    -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.js" type="text/javascript"></script>
<!--  js library for devices recognition -->
<script type="text/javascript" src="assets/js/modernizr.js"></script>

<!--  script for google maps   -->
<script
        type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js"
></script>

<!--   file where we handle all the script from the Gaia - Bootstrap Template   -->
<script type="text/javascript" src="assets/js/gaia.js"></script>
<script>
    var gallery = {
        show : function(img){
            // show() : show selected image in light box

            var clone = img.cloneNode(),
                domain = clone.src.substr(0, clone.src.lastIndexOf("/",clone.src.lastIndexOf("/")-1)+1),
                image = clone.src.substr(clone.src.lastIndexOf("/")+1),
                front = document.getElementById("lfront"),
                back = document.getElementById("lback");

            clone.src = domain + "gallery/" + image;
            front.innerHTML = "gallery/";
            front.appendChild(clone);
            back.classList.add("show");
        },

        hide : function(){
            // hide() : hide the lightbox

            document.getElementById("lback").classList.remove("show");
        }
    };
</script>
</html>
